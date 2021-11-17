<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClienteRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ClienteRegister extends Controller
{

   protected function createCliente(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'nomeCliente' => ['required', 'string'],
                'usuarioCliente' => ['required','email', 'unique:cliente,cli_usuario', 'unique:usuario,usu_usuario'],
                'senhaCliente' => ['required', 'confirmed'],
                'cepCliente' => ['required'],
                'cidadeCliente' => ['required'],
                'estadoCliente' => ['required'],
                'bairroCliente' => ['required'],
                'ruaCliente' => ['required'],
                'ncasaCliente' => ['required'],
                'complementoCliente' => ['required'],
                'dtNascCliente' => ['required'],
            ],
            [
                'nomeCliente.required' => 'Nome completo obrigatório.',
                'usuarioCliente.required' => 'Usuário obrigatório.',
                'usuarioCliente.email' => 'E-mail inválido.',
                'usuarioCliente.unique' => 'E-mail já está em uso.',
                'senhaCliente.required' => 'Senha obrigatória.',
                'senhaCliente.confirmed' => 'A confirmação não corresponde.',
                'cepCliente.required' => 'CEP obrigatório.',
                'cepCliente.formato_cep' => 'CEP inválido.',
                'cidadeCliente.required' => 'Cidade obrigatória.',
                'estadoCliente.required' => 'Estado obrigatório.',
                'bairroCliente.required' => 'Bairro obrigatório.',
                'ruaCliente.required' => 'Rua obrigatória.',
                'ncasaCliente.required' => 'Número obrigatório.',
                'complementoCliente.required' => 'Complemento obrigatório.',
                'dtNascCliente.required' => 'Dt. Nasc. obrigatória.',
            ]
        );

        if (!empty($request->cpfCliente || $request->cnpjCliente)) {

            if (isset($request->cpfCliente)) {
                $validator_cpf_cnpj = Validator::make(
                    $request->all(),
                    [
                        'cpfCliente' => ['cpf'],
                    ],
                    [
                        'cpfCliente.cpf' => 'CPF inválido.',
                    ]
                );
                $cpf = $request->cpfCliente;
            } else {
                $validator_cpf_cnpj = Validator::make(
                    $request->all(),
                    [
                        'cnpjCliente' => ['cnpj'],
                    ],
                    [
                        'cnpjCliente.cnpj' => 'CNPJ inválido.',
                    ]
                );
            }
        } else {
            $validator_cpf_cnpj = Validator::make(
                [$request->all()],
                [
                    'cpfCliente' => ['required', 'cpf'],
                    'cnpjCliente' => ['required', 'cnpj'],
                ],
                [
                    'cpfCliente.required' => 'CPF ou CNPJ obrigatórios.',
                    'cnpjCliente.required' => 'CPF ou CNPJ obrigatório.',
                ]
            );
        }

        if (isset($request->telefoneCliente) && isset($request->celularCliente)) {

            $validator_telefone_celular = Validator::make(
                [$request->all()],
                [
                    'telefoneCliente' => ['telefone'],
                    'celularCliente' => ['celular_com_ddd'],
                ],
                [
                    'telefoneCliente.telefone' => 'Telefone inválido.',
                    'celularCliente.celular_com_ddd' => 'Celular inválido.',
                ]
            );
        } else{
        if (!empty($request->telefoneCliente || $request->celularCliente)) {

            if (isset($request->telefoneCliente)) {
                $validator_telefone_celular = Validator::make(
                    $request->all(),
                    [
                        'telefoneCliente' => ['telefone'],
                    ],
                    [
                        'telefoneCliente.telefone' => 'Telefone inválido.',
                    ]
                );
                $telefone = $request->telefoneCliente;
            } else {
                $validator_telefone_celular = Validator::make(
                    $request->all(),
                    [
                        'celularCliente' => ['celular_com_ddd'],
                    ],
                    [
                        'celularCliente.celular_com_ddd' => 'Celular inválido.',
                    ]
                );
            }
        } else {
            $validator_telefone_celular = Validator::make(
                [$request->all()],
                [
                    'telefoneCliente' => ['required'],
                    'celularCliente' => ['required'],
                ],
                [
                    'telefoneCliente.required' => 'Telefone ou Celular obrigatórios.',
                    'celularCliente.required' => 'Telefone ou Celular obrigatórios.',
                ]
            );
        }
    }

        if ($validator->fails() || $validator_cpf_cnpj->fails() || $validator_telefone_celular->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors(), 'error_cpf_cnpj' => $validator_cpf_cnpj->errors(),  'error_telefone_celular' => $validator_telefone_celular->errors()]);
        }


        $Cliente = new Cliente;
        if (empty(DB::table('cliente')->where('cli_usuario', $request->usuario)->first())) {
            $Cliente->cli_nome = $request->nomeCliente;
            $Cliente->cli_usuario = $request->usuarioCliente;
            $Cliente->cli_senha = Hash::make($request->senhaCliente);
            if (isset($cpf)){
            $Cliente->cli_cpf_cnpj = $request->cpfCliente;
            }else{
            $Cliente->cli_cpf_cnpj = $request->cnpjCliente;
            }
            $Cliente->cli_telefone = $request->telefoneCliente;
            $Cliente->cli_celular = $request->celularCliente;
            $Cliente->cli_dtnasc = $request->dtNascCliente;
            $Cliente->cli_cep = $request->cepCliente;
            $Cliente->cli_cidade = $request->cidadeCliente;
            $Cliente->cli_uf = $request->estadoCliente;
            $Cliente->cli_bairro = $request->bairroCliente;
            $Cliente->cli_logradouro = $request->ruaCliente;
            $Cliente->cli_n_casa = $request->ncasaCliente;
            $Cliente->cli_complemento = $request->complementoCliente;
            $Cliente->save();

            $credentials = [
                'usuario' => $request->usuarioCliente,
                'password' => $request->senhaCliente
            ];
            if ($Cliente) {
                return response()->json(['status' => 1, 'msg' => 'Cliente cadastrado com sucesso!']);
            }
        }
    }

    protected function createLoginCliente(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nomeCliente' => ['required', 'string'],
                'usuarioCliente' => ['required','email', 'unique:cliente,cli_usuario', 'unique:usuario,usu_usuario'],
                'senhaCliente' => ['required', 'confirmed'],
                'dtNascCliente' => ['required'],
            ],
            [
                'nomeCliente.required' => 'Nome completo obrigatório.',
                'usuarioCliente.required' => 'Usuário obrigatório.',
                'usuarioCliente.email' => 'E-mail inválido.',
                'usuarioCliente.unique' => 'E-mail já está em uso.',
                'senhaCliente.required' => 'Senha obrigatória.',
                'senhaCliente.confirmed' => 'A confirmação não corresponde.',
                'dtNascCliente.required' => 'Dt. Nasc. obrigatória.',
            ]
        );

        if (!empty($request->cpfCliente || $request->cnpjCliente)) {

            if (isset($request->cpfCliente)) {
                $validator_cpf_cnpj = Validator::make(
                    $request->all(),
                    [
                        'cpfCliente' => ['cpf'],
                    ],
                    [
                        'cpfCliente.cpf' => 'CPF inválido.',
                    ]
                );
                $cpf = $request->cpfCliente;
            } else {
                $validator_cpf_cnpj = Validator::make(
                    $request->all(),
                    [
                        'cnpjCliente' => ['cnpj'],
                    ],
                    [
                        'cnpjCliente.cnpj' => 'CNPJ inválido.',
                    ]
                );
            }
        } else {
            $validator_cpf_cnpj = Validator::make(
                [$request->all()],
                [
                    'cpfCliente' => ['required', 'cpf'],
                    'cnpjCliente' => ['required', 'cnpj'],
                ],
                [
                    'cpfCliente.required' => 'CPF ou CNPJ obrigatórios.',
                    'cnpjCliente.required' => 'CPF ou CNPJ obrigatório.',
                ]
            );
        }

        if (isset($request->telefoneCliente) && isset($request->celularCliente)) {

            $validator_telefone_celular = Validator::make(
                [$request->all()],
                [
                    'telefoneCliente' => ['telefone_com_ddd'],
                    'celularCliente' => ['celular_com_ddd'],
                ],
                [
                    'telefoneCliente.telefone' => 'Telefone inválido.',
                    'celularCliente.celular_com_ddd' => 'Celular inválido.',
                ]
            );
        } else{
        if (!empty($request->telefoneCliente || $request->celularCliente)) {

            if (isset($request->telefoneCliente)) {
                $validator_telefone_celular = Validator::make(
                    $request->all(),
                    [
                        'telefoneCliente' => ['telefone_com_ddd'],
                    ],
                    [
                        'telefoneCliente.telefone' => 'Telefone inválido.',
                    ]
                );
                $telefone = $request->telefoneCliente;
            } else {
                $validator_telefone_celular = Validator::make(
                    $request->all(),
                    [
                        'celularCliente' => ['celular_com_ddd'],
                    ],
                    [
                        'celularCliente.celular_com_ddd' => 'Celular inválido.',
                    ]
                );
            }
        } else {
            $validator_telefone_celular = Validator::make(
                [$request->all()],
                [
                    'telefoneCliente' => ['required'],
                    'celularCliente' => ['required'],
                ],
                [
                    'telefoneCliente.required' => 'Telefone ou Celular obrigatórios.',
                    'celularCliente.required' => 'Telefone ou Celular obrigatórios.',
                ]
            );
        }
    }

    if ($validator->fails() || $validator_cpf_cnpj->fails() || $validator_telefone_celular->fails()) {
        return response()->json(['status' => 0, 'error' => $validator->errors(), 'error_cpf_cnpj' => $validator_cpf_cnpj->errors(),  'error_telefone_celular' => $validator_telefone_celular->errors()]);
    }


        $Cliente = new Cliente;
        if (empty(DB::table('cliente')->where('cli_usuario', $request->usuario)->first())) {
            $Cliente->cli_nome = $request->nomeCliente;
            $Cliente->cli_usuario = $request->usuarioCliente;
            $Cliente->cli_senha = Hash::make($request->senhaCliente);
            if (isset($cpf)){
            $Cliente->cli_cpf_cnpj = $request->cpfCliente;
            }else{
            $Cliente->cli_cpf_cnpj = $request->cnpjCliente;
            }
            $Cliente->cli_dtnasc = $request->dtNascCliente;
            $Cliente->cli_telefone = $request->telefoneCliente;
            $Cliente->cli_celular = $request->celularCliente;
            $Cliente->save();

            if ($Cliente) {
            $get_cliente = Cliente::select('id')->where('cli_usuario', '=', $request->usuarioCliente)->first();
            Auth::loginUsingId($get_cliente->id);
            return response()->json(['status' => 1, 'msg' => "Olá $get_cliente->cli_usuario, sua conta criada com sucesso! <br> Agora é só começar a comprar!"]);
            }
        }
    }
}

