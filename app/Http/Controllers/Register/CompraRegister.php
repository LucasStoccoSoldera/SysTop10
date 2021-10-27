<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompraRequest;
use App\Http\Requests\ItemCompraRequest;
use App\Models\Caixa;
use App\Models\Compras;
use App\Models\Compras_Detalhe;
use App\Models\Contas_a_Pagar;
use App\Models\Estoque;
use App\Models\Notificacao;
use Illuminate\Support\Facades\Validator;
use App\Models\Parcelas;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompraRegister extends Controller
{

    /**
     * @return \App\Models\Compras
     */
    protected function createCompra(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'IDCompras' => ['required','unique:compra,id'],
                'descricaoCompras' => ['required'],
                'tpgpagtoCompras' => ['required'],
                'ccCompras' => ['required'],
                'parcelasCompras' => ['required'],
                'dataCompras' => ['required'],
            ],
            [
                'IDCompras.required' => 'ID da compra obrigatório.',
                'IDCompras.unique' => 'ID da compra ja existe.',
                'descricaoCompras.required' => 'Descrição obrigatória.',
                'tpgpagtoCompras.required' => 'Tipo de pagamento obrigatório.',
                'ccCompras.required' => 'Centro de Custo obrigatório.',
                'parcelasCompras.required' => 'Qtde. de parcelas obrigatório.',
                'dataCompras.required' => 'Data da compra obrigatória.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()]);
        }
        $Compras = new Compras;
        $Compras->id = $request->IDCompras;
        $Compras->tpg_id = $request->tpgpagtoCompras;
        $Compras->cc_id = $request->ccCompras;
        $Compras->com_parcelas = $request->parcelasCompras;
        $Compras->com_descricao = $request->descricaoCompras;
        $Compras->com_desconto = $request->descontoCompras;
        $Compras->com_data_compra = $request->dataCompras;
        $Compras->com_data_pagto = $request->datapagCompras;
        $Compras->com_observacoes = $request->obsCompras;
        $Compras->save();

        $Total = DB::table('compras_detalhe')->where('com_id', '=', $request->IDCompras)->sum('cde_valortotal') *
        DB::table('compras_detalhe')->where('com_id', '=', $request->IDCompras)->select('cde_qtde')->get();

        $Final = $Total - ( $Total * ($request->descontoComprasUp / 100));

        $Conta = new Contas_a_Pagar();
        $Conta->tpg_id = $request->tpgpagtoCompras;
        $Conta->cc_id = $request->ccCompras;
        $Conta->con_descricao =  "Compra de $request->descricaoCompras";
        $Conta->con_tipo = "Variável";
        $Conta->con_valor = $Total;
        $Conta->con_valor_final = $Final;
        $Conta->con_data_venc = $request->datapagCompras;
        $Conta->con_parcelas = $request->parcelasCompras;
        if ($request->datapagCompras <> null){
        $Conta->con_data_pag = $request->datapagCompras;
        }
        $Conta->con_status= "Aberto";
        $Conta->con_compra= "Compra";
        $Conta->save();

        $Caixa = new Caixa();
        $Caixa->cax_descricao = "Compra de $request->descricaoCompras";
        $Caixa->cax_operacao = 0;
        $Caixa->cax_valor = $Final;
        $Caixa->cax_ctpagar = $Final;
        $Caixa->save();

        $cont = 0;
        $conta_last = DB::table('contas_a_pagar')->get()->last()->id;
        $compras_dados = Compras::find($request->IDCompras);

        while ($cont < $request->parcelasCompras) {

            $Parcela = new Parcelas();
            $Parcela->tpg_id = $request->tpgpagtoCompras;
            $Parcela->par_conta = $conta_last;
            $Parcela->par_numero = $cont;
            $Parcela->par_valor = ($Final / $request->parcelasCompras) * $cont;
            $Parcela->par_status = "Em Aberto";
            if ($compras_dados->con_data_pag <> null){
            $Parcela->par_data_pagto = ($compras_dados->com_data_pagto->modify('+' . ($cont * 30) . ' days'));
            }
            $Parcela->save();
            $cont ++;
        }

        if ($Parcela) {
            return response()->json(['status' => 1, 'msg' => 'Compra cadastrada com sucesso!', 'codigo' => $request->IDCompras]);
        }
    }


    protected function createItemCompra(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'IDItemCompra' => ['required'],
                'IDFornecedor' => ['required', 'integer'],
                'qtdeItemCompra' => ['required', 'integer'],
                'descricaoItemCompra' => ['required', 'string'],
                'valorItemCompra' => ['required'],
            ],
            [
                'IDItemCompra.required' => 'ID da compra obrigatório.',
                'IDFornecedor.required' => 'Fornecedor obrigatório.',
                'qtdeItemCompra.required' => 'Quantidade obrigatória.',
                'descricaoItemCompra.required' => 'Descrição obrigatória.',
                'valorItemCompra.required' => 'Valor do item obrigatório.',
            ]
        );


        if ($request->tipoItemCompra == "1") {
            $validator_interno = Validator::make(
                $request->all(),
                [
                    'IDProdutoI' => ['required', 'integer'],
                    'dimensaoItemCompra' => ['required', 'integer'],
                    'coresItemCompra' => ['required', 'integer'],

                ],
                [
                    'IDProdutoI.required' => 'Produto obrigatório.',
                    'dimensaoItemCompra.required' => 'Dimensão obrigatória.',
                    'coresItemCompra.required' => 'Cor obrigatória.',
                ]
            );
            $interno = true;
        } else {
            $validator_interno = Validator::make(
                $request->all(),
                [
                    'IDProdutoE' => ['required', 'integer'],
                ],
                [
                    'IDProduto.requiredE' => 'Produto obrigatório.',
                ]
            );
            $interno = false;
        }

        if ($validator->fails() || $validator_interno->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors(), 'error_interno' => $validator_interno->errors()]);
        }
        $Compras_Detalhe = new Compras_Detalhe;
        $Compras_Detalhe->com_id = $request->IDItemCompra;
        $Compras_Detalhe->for_id = $request->IDFornecedor;
        $Compras_Detalhe->cde_tipo = $request->tipoItemCompra;
        if($interno = true){
        $Compras_Detalhe->cde_produto = $request->IDProdutoI;
        $Compras_Detalhe->dim_id = $request->dimensaoItemCompra;
        $Compras_Detalhe->cor_id = $request->coresItemCompra;
        } else{
        $Compras_Detalhe->cde_produto = $request->IDProdutoE;
        }
        $Compras_Detalhe->cde_qtde = $request->qtdeItemCompra;
        $Compras_Detalhe->cde_valoritem = $request->valorItemCompra;
        $Compras_Detalhe->cde_valortotal = $request->valorTotalItemCompra;
        $Compras_Detalhe->cde_descricao = $request->descricaoItemCompra;
        $Compras_Detalhe->save();

        if($interno = true){
        $Estoque = new Estoque();
        $Estoque->pro_id = $request->IDProdutoI;
        $Estoque->dim_id = $request->dimensaoItemCompra;
        $Estoque->cor_id =  $request->coresItemCompra;
        $Estoque->est_qtde = $request->qtdeItemCompra;
        $Estoque->est_data = date("Y-m-d");
        $Estoque->est_time = date("H:i:s");
        $Estoque->est_status = 'Compra realizada';

        $Estoque->save();
        }

        if ($Compras_Detalhe) {
            return response()->json(['status' => 1, 'msg' => 'Item cadastrado com sucesso!']);
        }
    }
}
