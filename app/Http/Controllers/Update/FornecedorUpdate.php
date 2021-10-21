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
        return response()->json($object);
    }

    /**
     * @return \App\Models\Fornecedores
     */
    protected function updateFornecedor(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nomeFornecedorUp' => ['required', 'string'],
                'cepFornecedorUp' => ['required', 'string', 'formato_cep'],
                'cidadeFornecedorUp' => ['required', 'string'],
                'estadoFornecedorUp' => ['required', 'string'],
                'bairroFornecedorUp' => ['required', 'string'],
                'ruaFornecedorUp' => ['required', 'string'],
                'ncasaFornecedorUp' => ['required'],
                'produtosFornecedorUp' => ['required'],
            ],
            [
                'nomeFornecedorUp.required' => 'Nome obrigatório.',
                'cepFornecedorUp.required' => 'CEP obrigatório.',
                'cepFornecedorUp.formato_cep' => 'CEP inválido.',
                'cidadeFornecedorUp.required' => 'Cidade obrigatória.',
                'estadoFornecedorUp.required' => 'Estado obrigatório.',
                'bairroFornecedorUp.required' => 'Bairro obrigatório.',
                'ruaFornecedorUp.required' => 'Rua obrigatória.',
                'ncasaFornecedorUp.required' => 'Número obrigatório.',
                'produtosFornecedorUp.required' => 'Produto obrigatório.',
            ]
        );

        if (!empty($request->cpfFornecedor || $request->cnpjFornecedor)) {

            if (isset($request->cpfFornecedor)) {
                $validator_cpf_cnpj = Validator::make(
                    $request->all(),
                    [
                        'cpfFornecedorUp' => ['cpf'],
                    ],
                    [
                        'cpfFornecedorUp.cpf' => 'CPF inválido.',
                    ]
                );
            } else {
                $validator_cpf_cnpj = Validator::make(
                    $request->all(),
                    [
                        'cnpjFornecedorUp' => ['cnpj'],
                    ],
                    [
                        'cnpjFornecedorUp.cnpj' => 'CNPJ inválido.',
                    ]
                );
            }
        } else {
            $validator_cpf_cnpj = Validator::make(
                [$request->all()],
                [
                    'cpfFornecedorUp' => ['required'],
                    'cnpjFornecedorUp' => ['required'],
                ],
                [
                    'cpfFornecedorUp.required' => 'CPF ou CNPJ obrigatórios.',
                    'cnpjFornecedorUp.required' => 'CPF ou CNPJ obrigatórios.',
                ]
            );
        }

        if (!empty($request->telefoneFornecedor || $request->celularFornecedor)) {

            if (isset($request->telefoneFornecedor)) {
                $validator_telefone_celular = Validator::make(
                    $request->all(),
                    [
                        'telefoneFornecedorUp' => ['telefone'],
                    ],
                    [
                        'telefoneFornecedorUp.telefone' => 'Telefone inválido.',
                    ]
                );
            } else {
                $validator_telefone_celular = Validator::make(
                    $request->all(),
                    [
                        'celularFornecedorUp' => ['celular_com_ddd'],
                    ],
                    [
                        'celularFornecedorUp.celular_com_ddd' => 'Celular inválido.',
                    ]
                );
            }
        } else if (isset($request->telefoneFornecedor) && isset($request->celularFornecedor)) {
            $validator_telefone_celular = Validator::make(
                [$request->all()],
                [
                    'telefoneFornecedorUp' => ['telefone'],
                    'celularFornecedorUp' => ['celular_com_ddd'],
                ],
                [
                    'telefoneFornecedorUp.telefone' => 'Telefone inválido.',
                    'celularFornecedorUp.celular_com_ddd' => 'Celular inválido.',
                ]
            );
        }
      else {
        $validator_telefone_celular = Validator::make(
            [$request->all()],
            [
                'telefoneFornecedorUp' => ['required'],
                'celularFornecedorUp' => ['required'],
            ],
            [
                'telefoneFornecedorUp.required' => 'Telefone ou Celular obrigatórios.',
                'celularFornecedorUp.required' => 'Telefone ou Celular obrigatórios.',
            ]
        );
    }

        if ($validator->fails() || $validator_cpf_cnpj->fails() || $validator_telefone_celular->fails()  ) {
            return response()->json(['status' => 0, 'error' => $validator->errors(), 'error_cpf_cnpj' => $validator_cpf_cnpj->errors(), 'error_telefone_celular' => $validator_telefone_celular->errors()]);
        }

        $Fornecedores = new Fornecedores;
        $Fornecedores->for_nome = $request->nomeFornecedorUp;
        $Fornecedores->for_telefone = $request->telefoneFornecedorUp;
        $Fornecedores->for_celular = $request->celularFornecedorUp;
        if (isset($cpf)){
        $Fornecedores->for_cpf_cnpj = $request->cpfFornecedorUp;
       }else{
        $Fornecedores->for_cpf_cnpj = $request->cnpjFornecedorUp;
        }
        $Fornecedores->for_cep = $request->cepFornecedorUp;
        $Fornecedores->for_cidade = $request->cidadeFornecedorUp;
        $Fornecedores->for_estado = $request->estadoFornecedorUp;
        $Fornecedores->for_bairro = $request->bairroFornecedorUp;
        $Fornecedores->for_rua = $request->ruaFornecedorUp;
        $Fornecedores->for_numero = $request->ncasaFornecedorUp;
        $Fornecedores->for_produto = $request->produtosFornecedorUp;
        $Fornecedores->save();

        if ($Fornecedores) {
            return response()->json(['status' => 1, 'msg' => 'Fornecedor atualizado com sucesso!']);
        }
    }
}
