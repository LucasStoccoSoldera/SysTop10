<?php

namespace App\Http\Controllers\Register;

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

class VendasRegister extends Controller
{

    /**
     * @return \App\Models\Venda
     */
    protected function createVenda(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'IDVenda' => ['required','unique:vendas,id'],
                'IDTipoPagamento' => ['required', 'integer'],
                'IDLogistica' => ['required', 'integer'],
                'IDCliente' => ['required', 'integer'],
                'parcelasVenda' => ['required', 'integer'],
                'statusVenda' => ['required', 'string'],
            ],
            [
                'IDVenda.required' => 'ID obrigatório.',
                'IDVenda.unique' => 'ID da venda ja existe.',
                'IDTipoPagamento.required' => 'Tipo de pagamento obrigatório.',
                'IDLogistica.required' => 'Logistica obrigatória.',
                'IDCliente.required' => 'Cliente obrigatório.',
                'parcelasVenda.required' => 'Qtde. de parcelas obrigatória.',
                'statusVenda.required' => 'Status da venda obrigatório.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()]);
        }
        $Venda = new Venda;
        $Venda->ven_id = $request->IDVenda;
        $Venda->tpg_id = $request->IDTipoPagamento;
        $Venda->log_id = $request->IDLogistica;
        $Venda->cli_id = $request->IDCliente;
        $Venda->ven_parcelas = $request->parcelasVenda;
        $Venda->ven_status = $request->statusVenda;
        $Venda->ven_desconto = $request->descontoVenda;
        $Venda->save();

        $soma_total = DB::table('vendas_detalhe')->where('ven_id', '=', $request->IDVenda)->sum('det_valor_total');
        $qtde = DB::table('vendas_detalhe')->where('ven_id', '=', $request->IDVenda)->first('det_qtde');

        $Total = $soma_total * $qtde;

        $Final = $Total - ( $Total * ($request->descontoVendaUp / 100));

        $Receber = new Contas_a_Receber();
        $Receber->tpg_id = $request->IDTipoPagamento;
        $Receber->rec_descricao = "Venda para $request->IDCliente";
        $Receber->rec_ven_id = $request->IDVenda;
        $Receber->rec_valor = $Total;
        $Receber->rec_parcelas = $request->parcelasVenda;
        if(isset($request->datapagtoVendas)){
        $Receber->rec_data = $request->datapagtoVendas;
        }
        $Receber->rec_status = $request->statusVenda;
        $Receber->save();

        if(isset($request->datapagtoVendas)){
        $Caixa = new Caixa();
        $Caixa->cax_descricao = "Venda";
        $Caixa->cax_operacao = 1;
        $Caixa->cax_valor =   $Final;
        $Caixa->cax_ctreceber =  $Final;
        $Caixa->save();
    }

        $cont = 0;
        $conta_last = DB::table('contas_a_pagar')->get()->last()->id;
        $venda_dados = Venda::find($request->IDVenda);
        while ($cont < $request->parcelasVenda) {

            $Parcela = new Parcelas();
            $Parcela->tpg_id = $request->IDTipoPagamentoUp;
            $Parcela->par_conta = $conta_last;
            $Parcela->par_numero = $cont;
            $Parcela->par_valor = ($Final / $request->parcelasVendaUp) * $cont;
            $Parcela->par_status = $request->statusVendaUp;
            if ($venda_dados->ven_data_pagto <> null){
            $Parcela->par_data_pagto = ($venda_dados->ven_data_pagto->modify('+' . ($cont * 30) . ' days'));
            }
        }

        if ($Parcela) {
            return response()->json(['status' => 1, 'msg' => 'Venda cadastrada com sucesso!', 'codigo' => $request->IDVenda]);
        }
    }

    protected function createItemVenda(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'IDCor' => ['required', 'integer'],
                'IDDimensao' => ['required', 'integer'],
                'IDProduto' => ['required', 'integer'],
                'IDItemVenda' => ['required', 'integer'],
                'qtdeItemVenda' => ['required', 'integer'],
                'descricaoItemVenda' => ['required', 'string'],
                'VUItemVenda' => ['required'],
            ],
            [
                'IDCor.required' => 'Cor obrigatória.',
                'IDDimensao.required' => 'Dimensão obrigatória.',
                'IDProduto.required' => 'Produto obrigatório.',
                'IDItemVenda.required' => 'ID da venda obrigatório.',
                'qtdeItemVenda.required' => 'Quantidade obrigatória.',
                'descricaoItemVenda.required' => 'Descrição obrigatório.',
                'VUItemVenda.required' => 'Valor unitário obrigatório.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()]);
        }

        $random = rand(1,1000);
        $nameFile =  $request->IDItemVenda . "$random" . strtotime("now") . $request->anexoItemVenda->extension();

        $Venda_Detalhe = new Venda_Detalhe;
        $Venda_Detalhe->cor_id = $request->IDCor;
        $Venda_Detalhe->dim_id = $request->IDDimensao;
        $Venda_Detalhe->pro_id = $request->IDProduto;
        $Venda_Detalhe->ven_id = $request->IDItemVenda;
        $Venda_Detalhe->det_qtde = $request->qtdeItemVenda;
        $Venda_Detalhe->det_descricao = $request->descricaoItemVenda;
        $Venda_Detalhe->det_anexo_path = $nameFile;
        $Venda_Detalhe->det_valor_unitario = $request->VUItemVenda;
        $Venda_Detalhe->det_valor_total = $request->VTItemVenda;
        $Venda_Detalhe->save();


        $upload = $request->anexoItemVenda->storeAs('artes_vendas', $nameFile);

        if ($Venda_Detalhe) {
            return response()->json(['status' => 1, 'msg' => 'Item cadastrado com sucesso!']);
        }
    }


}
