<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClienteRequest;
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
                    'cpfCliente' => ['required', 'cpf'],
                    'cnpjCliente' => ['required', 'cnpj'],
                ],
                [
                    'cpfCliente.required' => 'CPF Obrigatório.',
                    'cnpjCliente.required' => 'CNPJ Obrigatório.',
                ]
            );
        }

        if (isset($request->telefoneCliente) && isset($request->celularCliente)) {

            $validator_telefone_celular = Validator::make(
                [$request->telefoneCliente, $request->celularCliente],
                [
                    'telefoneCliente' => ['Celular'],
                    'celularCliente' => ['celular_com_ddd'],
                ],
                [
                    'telefoneCliente.Celular' => 'Telefone inválido.',
                    'celularCliente.celular_com_ddd' => 'Celular inválido.',
                ]
            );
        } else{
        if (!empty($request->telefoneCliente || $request->celularCliente)) {

            if (isset($request->telefoneCliente)) {
                $validator_telefone_celular = Validator::make(
                    $request->telefoneCliente,
                    [
                        'telefoneCliente' => ['Celular'],
                    ],
                    [
                        'telefoneCliente.Celular' => 'Telefone inválido.',
                    ]
                );
                $telefone = $request->telefoneCliente;
            } else {
                $validator_telefone_celular = Validator::make(
                    $request->celularCliente,
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
                [$request->telefoneCliente, $request->celularCliente],
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

