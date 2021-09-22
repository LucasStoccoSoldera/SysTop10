<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\Http\Requests\FornecedorRequest;
use App\Models\Fornecedores;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FornecedorRegister extends Controller
{

    /**
     * @return \App\Models\Fornecedores
     */
    protected function createFornecedor(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nomeFornecedor' => ['required', 'string'],
                'cepFornecedor' => ['required', 'string', 'formato_cep'],
                'cidadeFornecedor' => ['required', 'string'],
                'estadoFornecedor' => ['required', 'string'],
                'bairroFornecedor' => ['required', 'string'],
                'ruaFornecedor' => ['required', 'string'],
                'ncasaFornecedor' => ['required', 'digits:4'],
            ],
            [
                'nomeFornecedor.required' => 'Nome obrigatório.',
                'cepFornecedor.required' => 'CEP obrigatório.',
                'cepFornecedor.formato_cep' => 'CEP inválido.',
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
                    $request->all(),
                    [
                        'cpfFornecedor' => ['cpf'],
                    ],
                    [
                        'cpfFornecedor.cpf' => 'CPF inválido.',
                    ]
                );
            } else {
                $validator_cpf_cnpj = Validator::make(
                    $request->all(),
                    [
                        'cnpjFornecedor' => ['cnpj'],
                    ],
                    [
                        'cnpjFornecedor.cnpj' => 'CNPJ inválido.',
                    ]
                );
            }
        } else {
            $validator_cpf_cnpj = Validator::make(
                [$request->all()],
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
                    $request->all(),
                    [
                        'telefoneFornecedor' => ['telefone'],
                    ],
                    [
                        'telefoneFornecedor.telefone' => 'Telefone inválido.',
                    ]
                );
            } else {
                $validator_telefone_celular = Validator::make(
                    $request->all(),
                    [
                        'celularCliente' => ['celular_com_ddd'],
                    ],
                    [
                        'celularFornecedor.celular_com_ddd' => 'Celular inválido.',
                    ]
                );
            }
        } else if (isset($request->telefoneFornecedor) && isset($request->celularFornecedor)) {
            $validator_telefone_celular = Validator::make(
                [$request->all()],
                [
                    'telefoneFornecedor' => ['telefone'],
                    'celularFornecedor' => ['celular_com_ddd'],
                ],
                [
                    'telefoneFornecedor.telefone' => 'Telefone inválido.',
                    'celularFornecedor.celular_com_ddd' => 'Celular inválido.',
                ]
            );
        }
      else {
        $validator_telefone_celular = Validator::make(
            [$request->all()],
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
        $Fornecedores->for_telefone = $request->telefoneFornecedor;
        $Fornecedores->for_celular = $request->celularFornecedor;
        if (isset($cpf)){
        $Fornecedores->for_cpf_cnpj = $request->cpfFornecedor;
       }else{
        $Fornecedores->for_cpf_cnpj = $request->cnpjFornecedor;
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
