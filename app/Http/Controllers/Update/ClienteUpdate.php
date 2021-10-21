<?php

namespace App\Http\Controllers\Update;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClienteRequest;
use App\Models\Cliente;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteUpdate extends Controller
{

    protected function editCliente($id)
    {
        $object = Cliente::find($id);
        return response()->json($object);
    }

    /**
     * @param  array  $data
     * @return \App\Models\Cliente
     */
    protected function updateCliente(ClienteRequest $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nomeClienteUp' => ['required', 'string'],
                'usuarioClienteUp' => ['required','email'],
                'senhaClienteUp' => ['required', 'confirmed'],
                'cepClienteUp' => ['required'],
                'cidadeClienteUp' => ['required'],
                'estadoClienteUp' => ['required'],
                'bairroClienteUp' => ['required'],
                'ruaClienteUp' => ['required'],
                'ncasaClienteUp' => ['required'],
                'complementoClienteUp' => ['required'],
            ],
            [
                'nomeClienteUp.required' => 'Nome completo obrigatório.',
                'usuarioClienteUp.required' => 'Usuário obrigatório.',
                'usuarioClienteUp.email' => 'E-mail inválido.',
                'senhaClienteUp.required' => 'Senha obrigatória.',
                'senhaClienteUp.confirmed' => 'A confirmação da senha não corresponde.',
                'cepClienteUp.required' => 'CEP obrigatório.',
                'cepClienteUp.formato_cep' => 'CEP inválido.',
                'cidadeClienteUp.required' => 'Cidade obrigatória.',
                'estadoClienteUp.required' => 'Estado obrigatório.',
                'bairroClienteUp.required' => 'Bairro obrigatório.',
                'ruaClienteUp.required' => 'Rua obrigatória.',
                'ncasaClienteUp.required' => 'Número obrigatório.',
                'complementoClienteUp.required' => 'Complemento obrigatório.',
            ]
        );

        if (!empty($request->cpfCliente || $request->cnpjCliente)) {

            if (isset($request->cpfCliente)) {
                $validator_cpf_cnpj = Validator::make(
                    $request->all(),
                    [
                        'cpfClienteUp' => ['cpf'],
                    ],
                    [
                        'cpfClienteUp.cpf' => 'CPF inválido.',
                    ]
                );
                $cpf = $request->cpfCliente;
            } else {
                $validator_cpf_cnpj = Validator::make(
                    $request->all(),
                    [
                        'cnpjClienteUp' => ['cnpj'],
                    ],
                    [
                        'cnpjClienteUp.cnpj' => 'CNPJ inválido.',
                    ]
                );
            }
        } else {
            $validator_cpf_cnpj = Validator::make(
                [$request->all()],
                [
                    'cpfClienteUp' => ['required', 'cpf'],
                    'cnpjClienteUp' => ['required', 'cnpj'],
                ],
                [
                    'cpfClienteUp.required' => 'CPF ou CNPJ obrigatórios.',
                    'cnpjClienteUp.required' => 'CPF ou CNPJ obrigatório.',
                ]
            );
        }

        if (isset($request->telefoneCliente) && isset($request->celularCliente)) {

            $validator_telefone_celular = Validator::make(
                [$request->all()],
                [
                    'telefoneClienteUp' => ['telefone'],
                    'celularClienteUp' => ['celular_com_ddd'],
                ],
                [
                    'telefoneClienteUp.telefone' => 'Telefone inválido.',
                    'celularClienteUp.celular_com_ddd' => 'Celular inválido.',
                ]
            );
        } else{
        if (!empty($request->telefoneCliente || $request->celularCliente)) {

            if (isset($request->telefoneCliente)) {
                $validator_telefone_celular = Validator::make(
                    $request->all(),
                    [
                        'telefoneClienteUp' => ['telefone'],
                    ],
                    [
                        'telefoneClienteUp.telefone' => 'Telefone inválido.',
                    ]
                );
                $telefone = $request->telefoneCliente;
            } else {
                $validator_telefone_celular = Validator::make(
                    $request->all(),
                    [
                        'celularClienteUp' => ['celular_com_ddd'],
                    ],
                    [
                        'celularClienteUp.celular_com_ddd' => 'Celular inválido.',
                    ]
                );
            }
        } else {
            $validator_telefone_celular = Validator::make(
                [$request->all()],
                [
                    'telefoneClienteUp' => ['required'],
                    'celularClienteUp' => ['required'],
                ],
                [
                    'telefoneClienteUp.required' => 'Telefone ou Celular obrigatórios.',
                    'celularClienteUp.required' => 'Telefone ou Celular obrigatórios.',
                ]
            );
        }
    }

        if ($validator->fails() || $validator_cpf_cnpj->fails() || $validator_telefone_celular->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors(), 'error_cpf_cnpj' => $validator_cpf_cnpj->errors(),  'error_telefone_celular' => $validator_telefone_celular->errors()]);
        }


        $Cliente = new Cliente;
        if (empty(DB::table('cliente')->where('cli_usuario', $request->usuario)->first())) {
            $Cliente->cli_nome = $request->nomeClienteUp;
            $Cliente->cli_usuario = $request->usuarioClienteUp;
            $Cliente->cli_senha = Hash::make($request->senhaClienteUp);
            if (isset($cpf)){
            $Cliente->cli_cpf_cnpj = $request->cpfClienteUp;
            }else{
            $Cliente->cli_cpf_cnpj = $request->cnpjClienteUp;
            }
            $Cliente->cli_telefone = $request->telefoneClienteUp;
            $Cliente->cli_celular = $request->celularClienteUp;
            $Cliente->cli_cep = $request->cepClienteUp;
            $Cliente->cli_cidade = $request->cidadeClienteUp;
            $Cliente->cli_uf = $request->estadoClienteUp;
            $Cliente->cli_bairro = $request->bairroClienteUp;
            $Cliente->cli_logradouro = $request->ruaClienteUp;
            $Cliente->cli_n_casa = $request->ncasaClienteUp;
            $Cliente->cli_complemento = $request->complementoClienteUp;
            $Cliente->save();

            $credentials = [
                'usuario' => $request->usuarioClienteUp,
                'password' => $request->senhaClienteUp
            ];
            if ($Cliente) {
                return response()->json(['status' => 1, 'msg' => 'Cliente atualizado com sucesso!']);
            }
        }
    }
}

