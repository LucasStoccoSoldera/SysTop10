<?php

namespace App\Http\Controllers\Update;

use App\Http\Controllers\Controller;
use App\Http\Requests\FornecedorRequest;
use App\Models\Fornecedores;
use App\Providers\RouteServiceProvider;
use Facade\FlareClient\Stacktrace\Frame;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FornecedorUpdate extends Controller
{

    protected function editFornecedor($id)
    {
        $object = Fornecedores::find($id);
        return response()->json('object');
    }

    /**
     * @return \App\Models\Fornecedores
     */
    protected function updateFornecedor(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nomeFornecedor' => ['required', 'string'],
                'cepFornecedor' => ['required', 'string', 'cep'],
                'cidadeFornecedor' => ['required', 'string'],
                'estadoFornecedor' => ['required', 'string'],
                'bairroFornecedor' => ['required', 'string'],
                'ruaFornecedor' => ['required', 'string'],
                'ncasaFornecedor' => ['required', 'digits:4'],
            ],
            [
                'nomeFornecedor.required' => 'Nome obrigatório.',
                'cepFornecedor.required' => 'CEP obrigatório.',
                'cepFornecedor.cep' => 'CEP inválido.',
                'cidadeFornecedor.required' => 'Cidade obrigatória.',
                'estadoFornecedor.required' => 'Estado obrigatório.',
                'bairroFornecedor.required' => 'Bairro obrigatório.',
                'ruaFornecedor.required' => 'Rua obrigatória.',
                'ncasaFornecedor.required' => 'Número obrigatório.',
            ]
        );

        if (!empty($request->cpfFornecedor || $request->cnpjFornecedor)) {

            if (isset($request->cpfFornecedor)) {
                $validator_cpf_cnpj = Validator::make(
                    $request->cpfFornecedor,
                    [
                        'cpfFornecedor' => ['required', 'cpf'],
                    ],
                    [
                        'cpfFornecedor.required' => 'CPF obrigatório.',
                        'cpfFornecedor.cpf' => 'CPF inválido.',
                    ]
                );
                $cpf = $request->cpfFornecedor;
            } else {
                $validator_cpf_cnpj = Validator::make(
                    $request->cnpjFornecedor,
                    [
                        'cnpjFornecedor' => ['required', 'cnpj'],
                    ],
                    [
                        'cnpjFornecedor.required' => 'CNPJ obrigatório.',
                        'cnpjFornecedor.cnpj' => 'CNPJ inválido.',
                    ]
                );
            }
        } else {
            $validator_cpf_cnpj = Validator::make(
                [$request->cpfFornecedor, $request->cnpjFornecedor],
                [
                    'cpfFornecedor' => ['required'],
                    'cnpjFornecedor' => ['required'],
                ],
                [
                    'cpfFornecedor.required' => 'CPF ou CNPJ obrigatórios.',
                    'cnpjFornecedor.required' => 'CPF ou CNPJ obrigatórios.',
                ]
            );
        }

        if (!empty($request->telefoneFornecedor || $request->celularFornecedor)) {

            if (isset($request->telefoneFornecedor)) {
                $validator_telefone_celular = Validator::make(
                    $request->telefoneFornecedor,
                    [
                        'telefoneFornecedor' => ['required', 'telefone'],
                    ],
                    [
                        'telefoneFornecedor.required' => 'Telefone obrigatório.',
                        'telefoneFornecedor.telefone' => 'Telefone inválido.',
                    ]
                );
                $telefone = $request->telefoneFornecedor;
            } else {
                $validator_telefone_celular = Validator::make(
                    $request->celularFornecedor,
                    [
                        'celularCliente' => ['required', 'celular'],
                    ],
                    [
                        'celularFornecedor.required' => 'Celular obrigatório.',
                        'celularFornecedor.celular' => 'Celular inválido.',
                    ]
                );
            }
        } else if (isset($request->telefoneFornecedor) && isset($request->celularFornecedor)) {
            $validator_telefone_celular = Validator::make(
                [$request->telefoneFornecedor, $request->celularFornecedor],
                [
                    'telefoneFornecedor' => ['telefone'],
                    'celularFornecedor' => ['celular'],
                ],
                [
                    'telefoneFornecedor.telefone' => 'Telefone inválido.',
                    'celularFornecedor.celular' => 'Celular inválido.',
                ]
            );
        }
      else {
        $validator_telefone_celular = Validator::make(
            [$request->telefoneFornecedor, $request->celularFornecedor],
            [
                'telefoneFornecedor' => ['required'],
                'celularFornecedor' => ['required'],
            ],
            [
                'telefoneFornecedor.required' => 'Telefone ou Celular obrigatórios.',
                'celularFornecedor.required' => 'Telefone ou Celular obrigatórios.',
            ]
        );
    }

        if ($validator->fails() || $validator_cpf_cnpj->fails() || $validator_telefone_celular->fails()  ) {
            return response()->json(['status' => 0, 'error' => $validator->errors(), 'error_cpf_cnpj' => $validator_cpf_cnpj->errors(), 'error_telefone_celular' => $validator_telefone_celular->errors()]);
        }

        $Fornecedores = new Fornecedores;
        $Fornecedores->for_nome = $request->nomeFornecedor;
        if (isset($telefone)) {
            $Fornecedores->for_telefone = $request->telefoneFornecedor;
        } else {
            $Fornecedores->for_celular = $request->celularFornecedor;
        }
        if (isset($cpf)) {
            $Fornecedores->for_cpf = $request->cpfFornecedor;
        } else {
            $Fornecedores->for_cnpj = $request->cnpjFornecedor;
        }
        $Fornecedores->for_cep = $request->cepFornecedor;
        $Fornecedores->for_cidade = $request->cidadeFornecedor;
        $Fornecedores->for_estado = $request->estadoFornecedor;
        $Fornecedores->for_bairro = $request->bairroFornecedor;
        $Fornecedores->for_rua = $request->ruaFornecedor;
        $Fornecedores->for_numero = $request->ncasaFornecedor;
        $Fornecedores->save();

        if ($Fornecedores) {
            return response()->json(['status' => 1, 'msg' => 'Fornecedor cadastrado com sucesso!']);
        }
    }
}
