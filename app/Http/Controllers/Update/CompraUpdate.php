<?php

namespace App\Http\Controllers\Update;

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

class CompraUpdate extends Controller
{

    protected function editCompra($id)
    {
        $object = Compras::find($id);
        return response()->json($object);
    }

    protected function editItemCompra($id)
    {
        $object = Compras_Detalhe::find($id);
        return response()->json($object);
    }

    /**
     * @return \App\Models\Compras
     */
    protected function updateCompra(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'IDComprasUp' => ['required', 'unique:compra,id'],
                'descricaoComprasUp' => ['required'],
                'tpgpagtoComprasUp' => ['required'],
                'ccComprasUp' => ['required'],
                'parcelasComprasUp' => ['required'],
                'dataComprasUp' => ['required'],
            ],
            [
                'IDComprasUp.required' => 'ID da compra obrigatório.',
                'IDComprasUp.unique' => 'ID da compra ja existe.',
                'descricaoComprasUp.required' => 'Descrição obrigatória.',
                'tpgpagtoComprasUp.required' => 'Tipo de pagamento obrigatório.',
                'ccComprasUp.required' => 'Centro de Custo obrigatório.',
                'parcelasComprasUp.required' => 'Qtde. de parcelas obrigatório.',
                'dataComprasUp.required' => 'Data da compra obrigatória.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()]);
        }
        $Compras = Compras::find($request->idCom);
        $Compras->com_id = $request->IDComprasUp;
        $Compras->cde_id = $request->descricaoComprasUp;
        $Compras->tpg_id = $request->tpgpagtoComprasUp;
        $Compras->cc_id = $request->ccComprasUp;
        $Compras->com_parcelas = $request->parcelasCompraUp;
        $Compras->com_descricao = $request->descricaoComprasUp;
        $Compras->com_desconto = $request->descontoComprasUp;
        $Compras->com_data_compra = $request->dataComprasUp;
        $Compras->com_data_pagto = $request->datapagComprasUp;
        $Compras->com_observacoes = $request->obsComprasUp;
        $Compras->save();

        $soma_total = DB::table('compras_detalhe')->where('com_id', '=', $request->IDCompras)->sum('cde_valortotal');
        $qtde = DB::table('compras_detalhe')->where('com_id', '=', $request->IDCompras)->first('cde_qtde');

        $Total = $soma_total * $qtde;

        $Final = $Total - ( $Total * ($request->descontoComprasUp / 100));

        $Conta = Contas_a_Pagar::find($request->idCom);
        $Conta->tpg_id = $request->tpgpagtoComprasUp;
        $Conta->cc_id = $request->ccComprasUp;
        $Conta->con_descricao =  "Compra de $request->descricaoComprasUp";
        $Conta->con_tipo = "Variável";
        $Conta->con_valor = $Total;
        $Conta->con_valor_final = $Final;
        $Conta->con_data_venc = $request->datapagComprasUp;
        $Conta->con_parcelas = $request->parcelasComprasUp;
        if ($request->datapagComprasUp <> null){
        $Conta->con_data_pag = $request->datapagComprasUp;
        }
        $Conta->con_status= "Aberto";
        $Conta->con_compra= "Compra";
        $Conta->save();

        if ($request->datapagComprasUp <> null){
        $Caixa = new Caixa();
        $Caixa->cax_descricao = "Compra de $request->descricaoComprasUp";
        $Caixa->cax_operacao = 0;
        $Caixa->cax_valor =  $Final;
        $Caixa->cax_ctpagar = $Final;
        $Caixa->save();
        }

        $cont = 1;
        $conta_last = DB::table('contas_a_pagar')->get()->last()->id;
        $compras_dados = Compras::find($request->IDComprasUp);

            $Parcelas = DB::select('select * from parcelas where par_conta = ?', [$request->idCom]);

            foreach ($Parcelas as $Parcela) {
                $Parcela->tpg_id = $request->tpgpagtoComprasUp;
                $Parcela->par_conta = $conta_last;
                $Parcela->par_numero = $cont;
                if($request->parcelasComprasUp <> 0 and $Final <> 0){
                    $Parcela->par_valor = ($Final / $request->parcelasComprasUp);
                    }else{
                    $Parcela->par_valor = $Final;
                    }
                $Parcela->par_status = "Em Aberto";
                if ($compras_dados->con_data_pag <> null){
                $Parcela->par_data_pagto = ($compras_dados->com_data_pagto->modify('+' . ($cont) . ' month'));
                }
                $Parcela->save();
                $cont ++;
            }

        if ($Parcelas) {
            return response()->json(['status' => 1, 'msg' => 'Compra atualizada com sucesso!']);
        }
    }


    protected function updateItemCompra(Request $request)
    {

        $request->valorItemCompraUp = str_replace('R$ ', '', $request->valorItemCompraUp);
        $request->valorItemCompraUp = str_replace('.', '', $request->valorItemCompraUp);
        $request->valorItemCompraUp = str_replace(',', '.', $request->valorItemCompraUp);

        $request->valorTotalItemCompraUp = str_replace('R$ ', '', $request->valorTotalItemCompraUp);
        $request->valorTotalItemCompraUp = str_replace('.', '', $request->valorTotalItemCompraUp);
        $request->valorTotalItemCompraUp = str_replace(',', '.', $request->valorTotalItemCompraUp);

        $validator = Validator::make(
            $request->all(),
            [
                'IDItemCompraUp' => ['required', 'integer'],
                'IDFornecedorUp' => ['required', 'integer'],
                'qtdeItemCompraUp' => ['required', 'integer'],
                'descricaoItemCompraUp' => ['required', 'string'],
                'valorItemCompraUp' => ['required'],
            ],
            [
                'IDItemCompraUp.required' => 'ID da compra obrigatório.',
                'IDFornecedorUp.required' => 'Fornecedor obrigatório.',
                'qtdeItemCompraUp.required' => 'Quantidade obrigatória.',
                'descricaoItemCompraUp.required' => 'Descrição obrigatória.',
                'valorItemCompraUp.required' => 'Valor do item obrigatório.',
            ]
        );


        if ($request->tipoItemCompra == "1") {
            $validator_interno = Validator::make(
                $request->all(),
                [
                    'IDProdutoIUp' => ['required', 'integer'],
                    'dimensaoItemCompraUp' => ['required', 'integer'],
                    'coresItemCompraUp' => ['required', 'integer'],

                ],
                [
                    'IDProdutoI.requiredUp' => 'Produto obrigatório.',
                    'dimensaoItemCompra.requiredUp' => 'Dimensão obrigatória.',
                    'coresItemCompra.requiredUp' => 'Cor obrigatória.',
                ]
            );
            $interno = true;
        } else {
            $validator_interno = Validator::make(
                $request->all(),
                [
                    'IDProdutoEUp' => ['required', 'integer'],
                ],
                [
                    'IDProduto.requiredEUp' => 'Produto obrigatório.',
                ]
            );
            $interno = false;
        }

        if ($validator->fails() || $validator_interno->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors(), 'error_interno' => $validator_interno->errors()]);
        }
        $Compras_Detalhe = Compras_Detalhe::find($request->idIteCom);
        $Compras_Detalhe->com_id = $request->IDItemCompraUp;
        $Compras_Detalhe->for_id = $request->IDFornecedorUp;
        $Compras_Detalhe->cde_tipo = $request->tipoItemCompraUp;
        if($interno = true){
        $Compras_Detalhe->cde_produto = $request->IDProdutoUp;
        $Compras_Detalhe->dim_id = $request->dimensaoItemCompraUp;
        $Compras_Detalhe->cor_id = $request->coresItemCompraUp;
        } else{
        $Compras_Detalhe->cde_produto = $request->IDProdutoUp;
        }
        $Compras_Detalhe->cde_qtde = $request->qtdeItemCompraUp;
        $Compras_Detalhe->cde_valoritem = $request->valorItemCompraUp;
        $Compras_Detalhe->cde_valortotal = $request->valorTotalItemCompraUp;
        $Compras_Detalhe->cde_descricao = $request->descricaoItemCompraUp;
        $Compras_Detalhe->save();

        $Contas_a_Pagar = Contas_a_Pagar::where('con_compra', '=', $request->IDItemCompraUp);
        $Contas_a_Pagar->con_valor_final = $request->valorfContasUp;
        $Contas_a_Pagar->save();

        if ($Compras_Detalhe) {
            return response()->json(['status' => 1, 'msg' => 'Item atualizado com sucesso!']);
        }
    }
}
