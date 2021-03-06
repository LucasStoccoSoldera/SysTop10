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
                'datapagtoVendas' => ['required'],
                'statusVenda' => ['required', 'string'],
            ],
            [
                'IDVenda.required' => 'ID obrigatório.',
                'IDVenda.unique' => 'ID da venda ja existe.',
                'IDTipoPagamento.required' => 'Tipo de pagamento obrigatório.',
                'IDLogistica.required' => 'Logistica obrigatória.',
                'IDCliente.required' => 'Cliente obrigatório.',
                'parcelasVenda.required' => 'Qtde. de parcelas obrigatória.',
                'datapagtoVendas' => ['required'],
                'statusVenda.required' => 'Status da venda obrigatório.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()]);
        }
        $Venda = new Venda;
        $Venda->id = $request->IDVenda;
        $Venda->tpg_id = $request->IDTipoPagamento;
        $Venda->log_id = $request->IDLogistica;
        $Venda->cli_id = $request->IDCliente;
        $Venda->ven_parcelas = $request->parcelasVenda;
        $Venda->ven_data_pagto = $request->datapagtoVendas;
        $Venda->ven_status = $request->statusVenda;
        $Venda->ven_desconto = $request->descontoVenda;
        $Venda->save();

        $soma_total = DB::table('vendas_detalhe')->where('ven_id', '=', $request->IDVenda)->sum('det_valor_total');
        $qtde = DB::table('vendas_detalhe')->where('ven_id', '=', $request->IDVenda)->first('det_qtde');

        $Total = $soma_total * $qtde;

        if(isset($request->descontoVenda) and $request->descontoVenda <> 0){
        $Final = $Total - ( $Total * ($request->descontoVenda / 100));
        }else{
            $Final = $Total;
        }

        $Receber = new Contas_a_Receber();
        $Receber->tpg_id = $request->IDTipoPagamento;
        $Receber->rec_descricao = "Venda para $request->IDCliente";
        $Receber->rec_ven_id = $request->IDVenda;
        $Receber->rec_valor = $Total;
        $Receber->rec_valor_final = $Final;
        $Receber->rec_parcelas = $request->parcelasVenda;
        if(isset($request->datapagtoVendas)){
        $Receber->rec_data = $request->datapagtoVendas;
        }
        $Receber->rec_status = $request->statusVenda;
        $Receber->save();

        if(isset($request->statusVenda) && $request->statusVenda == "Faturada"){
        $Caixa = new Caixa();
        $Caixa->cax_descricao = "Venda";
        $Caixa->cax_operacao = 1;
        $Caixa->cax_valor =   $Final;
        $Caixa->cax_ctreceber =  $Final;
        $Caixa->save();
        }

        $cont = 1;
        $conta_last = DB::table('contas_a_receber')->get()->last()->id;
        $venda_dados = Venda::find($request->IDVenda);
        while ($cont <= $request->parcelasVenda) {

            $Parcela = new Parcelas();
            $Parcela->tpg_id = $request->IDTipoPagamento;
            $Parcela->par_conta = $conta_last;
            $Parcela->par_numero = $cont;
            if($request->parcelasVendaUp <> 0 and $Final <> 0){
            $Parcela->par_valor = ($Final / $request->parcelasVenda);
            }else{
            $Parcela->par_valor = $Final;
            }
            $Parcela->par_status = $request->statusVenda;
            if ($venda_dados->ven_data_pagto <> null){
                if($cont == 1){
                    $Parcela->par_data_pagto = ($venda_dados->ven_data_pagto);
                        } else{
                            $Parcela->par_data_pagto = ($venda_dados->ven_data_pagto->modify('+' . ($cont) . ' month'));
                        }
            }
            $Parcela->save();
            $cont ++;
        }

        if ($Parcela) {
            return response()->json(['status' => 1, 'msg' => 'Venda cadastrada com sucesso!']);
        }
    }

    protected function createItemVenda(Request $request)
    {

        $request->VUItemVenda = str_replace('R$ ', '', $request->VUItemVenda);
        $request->VUItemVenda = str_replace('.', '', $request->VUItemVenda);
        $request->VUItemVenda = str_replace(',', '.', $request->VUItemVenda);

        $request->VTItemVenda = str_replace('R$ ', '', $request->VTItemVenda);
        $request->VTItemVenda = str_replace('.', '', $request->VTItemVenda);
        $request->VTItemVenda = str_replace(',', '.', $request->VTItemVenda);

        $validator = Validator::make(
            $request->all(),
            [
                'IDCor' => ['required', 'integer'],
                'IDDimensao' => ['required', 'integer'],
                'IDProduto' => ['required', 'integer'],
                'IDItemVenda' => ['required', 'integer'],
                'qtdeItemVenda' => ['required', 'integer'],
                'descricaoItemVenda' => ['required', 'string'],
                'anexoItemVenda' => ['max:25600', 'mimes:jpg,bmp,png,jpeg,pdf,ico'],
                'VUItemVenda' => ['required'],
            ],
            [
                'IDCor.required' => 'Cor obrigatória.',
                'IDDimensao.required' => 'Dimensão obrigatória.',
                'IDProduto.required' => 'Produto obrigatório.',
                'IDItemVenda.required' => 'ID da venda obrigatório.',
                'qtdeItemVenda.required' => 'Quantidade obrigatória.',
                'descricaoItemVenda.required' => 'Descrição obrigatória.',
                'anexoItemVenda.max' => 'Limite de 25 Mb.',
                'anexoItemVenda.mimes' => 'Tipos: jpg,bmp,png, jpeg, pdf, ico.',
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

        $Contas_a_Receber = Contas_a_Receber::where('rec_ven_id', '=', $request->IDItemVenda);
        $Contas_a_Receber->rec_valor_final = $request->VTItemVenda;
        $Contas_a_Receber->save();


        $upload = $request->anexoItemVenda->storeAs('artes_vendas', $nameFile);

        if ($Venda_Detalhe) {
            return response()->json(['status' => 1, 'msg' => 'Item cadastrado com sucesso!']);
        }
    }


}
