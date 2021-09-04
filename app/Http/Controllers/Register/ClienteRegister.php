<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClienteRequest;
use App\Models\Cliente;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteRegister extends Controller
{

    /**
     * @param  array  $data
     * @return \App\Models\Cliente
     */
    protected function createCliente(ClienteRequest $request)
    {
     $dataForm = $request->all();

        $validator = Validator::make(
            $request->all(),
            [
                'nomeCliente' => ['required', 'string'],
                'usuarioCliente' => ['required','email'],
                'senhaCliente' => ['required', 'confirmed'],
            ],
            [
                'nomeCliente.required' => 'Nome completo obrigatório.',
                'usuarioCliente.required' => 'Usuário obrigatório.',
                'usuarioCliente.email' => 'E-mail inválido.',
                'senhaCliente.required' => 'Senha obrigatória.',
                'senhaCliente.confirmed' => 'A confirmação da senha não corresponde.',
            ]
        );

        if (!empty($request->cpfCliente || $request->cnpjCliente)) {

            if (isset($request->cpfCliente)) {
                $validator_cpf_cnpj = Validator::make(
                    $request->cpfCliente,
                    [
                        'cpfCliente' => ['required', 'cpf'],
                    ],
                    [
                        'cpfCliente.required' => 'CPF Obrigatório.',
                        'cpfCliente.cpf' => 'CPF inválido.',
                    ]
                );
                $cpf = $request->cpfCliente;
            } else {
                $validator_cpf_cnpj = Validator::make(
                    $request->cnpjCliente,
                    [
                        'cnpjCliente' => ['required', 'cnpj'],
                    ],
                    [
                        'cnpjCliente.required' => 'CNPJ Obrigatório.',
                        'cnpjCliente.cnpj' => 'CNPJ inválido.',
                    ]
                );
            }
        } else {
            $validator_cpf_cnpj = Validator::make(
                [$request->cpfCliente, $request->cnpjCliente],
                [
                    'cpfCliente' => ['required', 'digits:11', 'cpf'],
                    'cnpjCliente' => ['required', 'digits:14', 'cnpj'],
                ],
                [
                    'cpfCliente.required' => 'CPF Obrigatório.',
                    'cnpjCliente.required' => 'CNPJ Obrigatório.',
                ]
            );
        }

        if (!empty($request->telefoneCliente || $request->celularCliente)) {
            if (isset($request->telefoneCliente) && isset($request->celularCliente)) {

            if (isset($request->telefoneCliente)) {
                $validator_telefone_celular = Validator::make(
                    $request->telefoneCliente,
                    [
                        'telefoneCliente' => ['required', 'telefone'],
                    ],
                    [
                        'telefoneCliente.required' => 'Telefone obrigatório.',
                        'telefoneCliente.telefone' => 'Telefone inválido.',
                    ]
                );
                $telefone = $request->telefoneCliente;
            } else {
                $validator_telefone_celular = Validator::make(
                    $request->celularCliente,
                    [
                        'celularCliente' => ['required', 'celular'],
                    ],
                    [
                        'celularCliente.required' => 'Celular obrigatório.',
                        'celularCliente.celular' => 'Celular inválido.',
                    ]
                );
            }
        } else {
            $validator_telefone_celular = Validator::make(
                [$request->telefoneCliente, $request->celularCliente],
                [
                    'telefoneCliente' => ['required', 'telefone'],
                    'celularCliente' => ['required', 'celular'],
                ],
                [
                    'telefoneCliente.required' => 'Telefone ou Celular obrigatórios.',
                    'celularCliente.required' => 'Telefone ou Celular obrigatórios.',
                ]
            );
        }
    } else {
        $validator_telefone_celular = Validator::make(
            [$request->telefoneCliente, $request->celularCliente],
            [
                'telefoneCliente' => ['telefone'],
                'celularCliente' => ['celular'],
            ],
            [
                'telefoneCliente.telefone' => 'Telefone inválido.',
                'celularCliente.celular' => 'Celular inválido.',
            ]
        );
    }

        if ($validator->fails() || $validator_cpf_cnpj->fails() || $validator_telefone_celular->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors(), 'error_cpf_cnpj' => $validator_cpf_cnpj->errors(),  'error_telefone_celular' => $validator_telefone_celular->errors()]);
        }


        $Cliente = new Cliente;
        if (empty(DB::table('cliente')->where('cli_usuario', $request->usuario)->first())) {
            $Cliente->cli_nome = $request->nomeCliente;
            $Cliente->cli_usuario = $request->usuarioCliente;
            $Cliente->cli_senha = Hash::make($request->senhaCliente);
            if (isset($cpf)) {
                $Cliente->cli_cpf_cnpj = $request->cpfCliente;
            } else {
                $Cliente->cli_cpf_cnpj = $request->cnpjCliente;
            }
            if (isset($telefone)) {
                $Cliente->cli_telefone = $request->telefoneCliente;
            } else {
                $Cliente->cli_celular = $request->celularCliente;
            }
            $Cliente->cli_logradouro = "";
            $Cliente->cli_bairro = "";
            $Cliente->cli_n_casa = "";
            $Cliente->cli_cidade = "";
            $Cliente->cli_uf = "";
            $Cliente->cli_complemento = "";
            $Cliente->save();

            $credentials = [
                'usuario' => $request->usuarioCliente,
                'password' => $request->senhaCliente
            ];
            if ($Cliente) {
                return response()->json(['status' => 1, 'msg' => 'Conta cadastrada com sucesso!']);
            }
        }
    }
}

