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
        $dataForm['statusCliente'] = (!isset($dataForm['statusCliente'])) ? 0 : 1;

        $validator = Validator::make(
            $request->all(),
            [
                'nomeCliente' => ['required', 'string'],
                'usuarioCliente' => ['required'],
                'senhaCliente' => ['required', 'confirmed'],
            ],
            [
                'nomeCliente.required' => 'Nome completo obrigatório.',
                'usuarioCliente.required' => 'Usuário obrigatório.',
                'senhaCliente.required' => 'Senha obrigatória.',
                'senhaCliente.confirmed' => 'A confirmação da senha não corresponde.',
            ]
        );

        if (!empty($request->cpfCliente && $request->cnpjCliente)) {

            if (isset($request->cpfCliente)) {
                $validator_cpf_cnpj = Validator::make(
                    $request->cpfCliente,
                    [
                        'cpfCliente' => ['required', 'digits:11', 'cpf'],
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
                        'cnpjCliente' => ['required', 'digits:14', 'cnpj'],
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

        if (!empty($request->telefoneCliente && $request->celularCliente)) {

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

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors(), $validator_cpf_cnpj->errors(), $validator_telefone_celular->errors()]);
        }


        $Cliente = new Cliente;
        if (empty(DB::table('cliente')->where('cli_usuario', $request->usuario)->first())) {
            $Cliente->cli_nome = $request->nomeCliente;
            $Cliente->cli_usuario = $request->usuarioCliente;
            $Cliente->cli_senha = Hash::make($request->senhaCliente);
            if (isset($cpf)) {
                $Cliente->cli_cpf = preg_replace('/[^0-9]/', "", $request->cpfCliente);
            } else {
                $Cliente->cli_cnpj = preg_replace('/[^0-9]/', "", $request->cnpjCliente);
            }
            if (isset($telefone)) {
                $Cliente->cli_telefone = preg_replace('/[^0-9]/', "", $request->telefoneCliente);
            } else {
                $Cliente->cli_celular = preg_replace('/[^0-9]/', "",$request->celularCliente);
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
