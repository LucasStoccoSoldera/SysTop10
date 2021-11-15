<?php

namespace App\Http\Controllers\Update;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClienteRequest;
use App\Models\Cliente;
use App\Models\Venda;
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
                'usuarioClienteUp' => ['required','email', 'unique:cliente,cli_usuario'],
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
                'nomeCliente.requiredUp' => 'Nome completo obrigatório.',
                'usuarioCliente.requiredUp' => 'Usuário obrigatório.',
                'usuarioCliente.emailUp' => 'E-mail inválido.',
                'usuarioCliente.uniqueUp' => 'Usuário já está em uso.',
                'senhaCliente.requiredUp' => 'Senha obrigatória.',
                'senhaCliente.confirmedUp' => 'A confirmação não corresponde.',
                'cepCliente.requiredUp' => 'CEP obrigatório.',
                'cepCliente.formato_cepUp' => 'CEP inválido.',
                'cidadeCliente.requiredUp' => 'Cidade obrigatória.',
                'estadoCliente.requiredUp' => 'Estado obrigatório.',
                'bairroCliente.requiredUp' => 'Bairro obrigatório.',
                'ruaCliente.requiredUp' => 'Rua obrigatória.',
                'ncasaCliente.requiredUp' => 'Número obrigatório.',
                'complementoCliente.requiredUp' => 'Complemento obrigatório.',
            ]
        );

        if (!empty($request->cpfClienteUp || $request->cnpjClienteUp)) {

            if (isset($request->cpfClienteUp)) {
                $validator_cpf_cnpj = Validator::make(
                    $request->all(),
                    [
                        'cpfClienteUp' => ['cpf'],
                    ],
                    [
                        'cpfClienteUp.cpfUp' => 'CPF inválido.',
                    ]
                );
                $cpf = $request->cpfClienteUp;
            } else {
                $validator_cpf_cnpj = Validator::make(
                    $request->all(),
                    [
                        'cnpjClienteUp' => ['cnpj'],
                    ],
                    [
                        'cnpjClienteUp.cnpjUp' => 'CNPJ inválido.',
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

        if (isset($request->telefoneClienteUp) && isset($request->celularClienteUp)) {

            $validator_telefone_celular = Validator::make(
                [$request->all()],
                [
                    'telefoneClienteUp' => ['telefone'],
                    'celularClienteUp' => ['celular_com_ddd'],
                ],
                [
                    'telefoneCliente.telefoneUp' => 'Telefone inválido.',
                    'celularCliente.celular_com_dddUp' => 'Celular inválido.',
                ]
            );
        } else{
        if (!empty($request->telefoneClienteUp || $request->celularClienteUp)) {

            if (isset($request->telefoneClienteUp)) {
                $validator_telefone_celular = Validator::make(
                    $request->all(),
                    [
                        'telefoneClienteUp' => ['telefone'],
                    ],
                    [
                        'telefoneCliente.telefoneUp' => 'Telefone inválido.',
                    ]
                );
                $telefone = $request->telefoneClienteUp;
            } else {
                $validator_telefone_celular = Validator::make(
                    $request->all(),
                    [
                        'celularClienteUp' => ['celular_com_ddd'],
                    ],
                    [
                        'celularCliente.celular_com_dddUp' => 'Celular inválido.',
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
                    'telefoneCliente.requiredUp' => 'Telefone ou Celular obrigatórios.',
                    'celularCliente.requiredUp' => 'Telefone ou Celular obrigatórios.',
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

