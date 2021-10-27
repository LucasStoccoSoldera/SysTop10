<?php

namespace App\Http\Controllers\Update;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItemVendaRequest;
use App\Http\Requests\VendaRequest;
use App\Models\Venda;
use App\Models\Venda_Detalhe;
use App\Models\Contas_a_Receber;
use App\Models\Caixa;
use App\Models\Estoque;
use App\Models\Notificacao;
use App\Models\Parcelas;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class VendasUpdate extends Controller
{

    protected function editVenda($id)
    {
        $object = Venda::find($id);
        return response()->json($object);
    }


    protected function editItemVenda($id)
    {
        $object = Venda::find($id);
        return response()->json($object);
    }

    /**
     * @return \App\Models\Venda
     */
    protected function updateVenda(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'IDVendaUp' => ['required', 'unique:vendas,id'],
                'IDTipoPagamentoUp' => ['required', 'integer'],
                'IDLogisticaUp' => ['required', 'integer'],
                'IDClienteUp' => ['required', 'integer'],
                'parcelasVendaUp' => ['required', 'integer'],
                'statusVendaUp' => ['required', 'string'],
            ],
            [
                'IDVendaUp.required' => 'ID obrigatório.',
                'IDVendaUp.unique' => 'ID da venda ja existe.',
                'IDTipoPagamentoUp.required' => 'Tipo de pagamento obrigatório.',
                'IDLogisticaUp.required' => 'Logistica obrigatória.',
                'IDClienteUp.required' => 'Cliente obrigatório.',
                'parcelasVendaUp.required' => 'Qtde. de parcelas obrigatória.',
                'statusVendaUp.required' => 'Status da venda obrigatório.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()]);
        }
        $Venda = Venda::find($request->idVen);
        $Venda->ven_id = $request->IDVendaUp;
        $Venda->tpg_id = $request->IDTipoPagamentoUp;
        $Venda->log_id = $request->IDLogisticaUp;
        $Venda->cli_id = $request->IDClienteUp;
        $Venda->ven_parcelas = $request->parcelasVendaUp;
        $Venda->ven_status = $request->statusVendaUp;
        $Venda->ven_desconto = $request->descontoVendaUp;
        $Venda->save();

        $Total = DB::table('vendas_detalhe')->where('ven_id', '=', $request->IDVenda)->sum('det_valor_total') *
        DB::table('vendas_detalhe')->where('ven_id', '=', $request->IDVenda)->select('det_qtde')->get();

        $Final = $Total - ( $Total * ($request->descontoVendaUp / 100));

        $Receber = DB::table('contas_a_receber')->where('rec_ven_id', '=', "$request->IDVendaUp")->get();
        $Receber->tpg_id = $request->IDTipoPagamentoUp;
        $Receber->rec_descricao = "Venda para $request->IDClienteUp";
        $Receber->rec_ven_id = $request->IDVendaUp;
        $Receber->rec_valor = $Total;
        $Receber->rec_valor_final = $Final;
        $Receber->rec_parcelas = $request->parcelasVendaUp;
        if(isset($request->datapagtoVendasUp)){
        $Receber->rec_data = $request->datapagtoVendasUp;
        }
        $Receber->rec_status = $request->statusVendaUp;
        $Receber->save();


        $Caixa = new Caixa();
        $Caixa->cax_descricao = "Venda";
        $Caixa->cax_operacao = 1;
        $Caixa->cax_valor = $Final;
        $Caixa->cax_ctreceber = $Final;
        $Caixa->save();

        $cont = 0;
        $conta_last = DB::table('contas_a_pagar')->get()->last()->id;
        $venda_dados = Venda::find($request->IDVendaUp);
        while ($cont < $request->parcelasVendaUp) {

        $Parcela = new Parcelas();
        $Parcela->tpg_id = $request->IDTipoPagamentoUp;
        $Parcela->par_conta = $conta_last;
        $Parcela->par_numero = $cont;
        $Parcela->par_valor = ($Final / $request->parcelasVendaUp) * $cont;
        $Parcela->par_status = $request->statusVendaUp;
        if ($venda_dados->ven_data_pagto <> null){
        $Parcela->par_data_pagto = ($venda_dados->ven_data_pagto->modify('+' . ($cont * 30) . ' days'));
        }
        $Parcela->save();
        $cont ++;
    }
        if ($Parcela) {
            return response()->json(['status' => 1, 'msg' => 'Venda atualizada com sucesso!']);
        }
    }

    protected function updateItemVenda(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'IDCorUp' => ['required', 'integer'],
                'IDDimensaoUp' => ['required', 'integer'],
                'IDProdutoUp' => ['required', 'integer'],
                'IDItemVendaUp' => ['required', 'integer'],
                'qtdeItemVendaUp' => ['required', 'integer'],
                'descricaoItemVendaUp' => ['required', 'string'],
                'VUItemVendaUp' => ['required'],
            ],
            [
                'IDCorUp.required' => 'Cor obrigatória.',
                'IDDimensaoUp.required' => 'Dimensão obrigatória.',
                'IDProdutoUp.required' => 'Produto obrigatório.',
                'IDItemVendaUp.required' => 'ID da venda obrigatório.',
                'qtdeItemVendaUp.required' => 'Quantidade obrigatória.',
                'descricaoItemVendaUp.required' => 'Descrição obrigatório.',
                'VUItemVendaUp.required' => 'Valor unitário obrigatório.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()]);
        }

        $random = rand(1,1000);
        $nameFile =  $request->IDItemVendaUp . "$random" . strtotime("now") . $request->anexoItemVendaUp->extension();

        $Venda_Detalhe = Venda_Detalhe::find($request->idCC);
        $Venda_Detalhe->cor_id = $request->IDCorUp;
        $Venda_Detalhe->dim_id = $request->IDDimensaoUp;
        $Venda_Detalhe->pro_id = $request->IDProdutoUp;
        $Venda_Detalhe->ven_id = $request->IDItemVendaUp;
        $Venda_Detalhe->det_qtde = $request->qtdeItemVendaUp;
        $Venda_Detalhe->det_descricao = $request->descricaoItemVendaUp;
        $Venda_Detalhe->det_anexo_path = $nameFile;
        $Venda_Detalhe->det_valor_unitario = $request->VUItemVendaUp;
        $Venda_Detalhe->det_valor_total = $request->VTItemVendaUp;
        $Venda_Detalhe->save();

        $Estoque = new Estoque();
        $Estoque->pro_id = $request->IDProdutoUp;
        $Estoque->dim_id = $request->IDDimensaoUp;
        $Estoque->cor_id =  $request->IDCorUp;
        $Estoque->est_qtde = $request->qtdeItemVenda * -1;
        $Estoque->save();

        $upload = $request->anexoItemVendaUp->storeAs('artes_vendas', $nameFile);

        if ($Venda_Detalhe) {
            return response()->json(['status' => 1, 'msg' => 'Item atualizado com sucesso!']);
        }
    }
}
