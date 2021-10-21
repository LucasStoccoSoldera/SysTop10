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
                'IDVendaUp' => ['required', 'integer'],
                'IDTipoPagamentoUp' => ['required', 'integer'],
                'IDLogisticaUp' => ['required', 'integer'],
                'IDClienteUp' => ['required', 'integer'],
                'VTVendaUp' => ['required'],
                'parcelasVendaUp' => ['required', 'integer'],
                'statusVendaUp' => ['required', 'string'],
            ],
            [
                'IDVendaUp.required' => 'ID obrigatório.',
                'IDTipoPagamentoUp.required' => 'Tipo de pagamento obrigatório.',
                'IDLogisticaUp.required' => 'Logistica obrigatória.',
                'IDClienteUp.required' => 'Cliente obrigatório.',
                'VTVendaUp.required' => 'Valor total obrigatório.',
                'parcelasVendaUp.required' => 'Qtde. de parcelas obrigatória.',
                'statusVendaUp.required' => 'Status da venda obrigatório.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()]);
        }
        $Venda = new Venda;
        $Venda->ven_id = $request->IDVendaUp;
        $Venda->tpg_id = $request->IDTipoPagamentoUp;
        $Venda->log_id = $request->IDLogisticaUp;
        $Venda->cli_id = $request->IDClienteUp;
        $Venda->ven_valor_total = $request->VTVendaUp;
        $Venda->ven_parcelas = $request->parcelasVendaUp;
        $Venda->ven_status = $request->statusVendaUp;
        $Venda->ven_desconto = $request->descontoVendaUp;
        $Venda->save();

        $Caixa = new Caixa();
        $Caixa->cax_descricao = "Venda";
        $Caixa->cax_operacao = 1;
        $Caixa->cax_valor =  $request->VTVendaUp;
        $Caixa->cax_ctreceber = $request->VTVendaUp;
        $Caixa->save();

        $cont = 0;
        $venda_dados = Venda::find($request->IDVendaUp);
        while ($cont < $request->parcelasVendaUp) {

            $Receber = new Contas_a_Receber();
            $Receber->tpg_id = $request->IDTipoPagamentoUp;
            $Receber->rec_descricao = "Venda para $request->IDClienteUp";
            $Receber->rec_ven_id = $request->IDVendaUp;
            $Receber->rec_valor = ($request->VTVendaUp / $request->parcelasVendaUp) * $cont;
            $Receber->rec_parcelas = $request->parcelasVendaUp;
            $Receber->rec_data = ($venda_dados->ven_data->modify('+' . ($cont * 30) . ' days'));
            $Receber->rec_status = $request->statusVendaUp;
            $Receber->save();
        }
        if ($Receber) {
            return response()->json(['status' => 1, 'msg' => 'Venda cadastrada com sucesso!']);
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

        $Estoque = new Estoque();
        $Estoque->pro_id = $request->IDProduto;
        $Estoque->dim_id = $request->IDDimensao;
        $Estoque->cor_id =  $request->IDCor;
        $Estoque->est_qtde = $request->qtdeItemVenda * -1;
        $Estoque->save();

        $upload = $request->anexoItemVenda->storeAs('artes_vendas', $nameFile);

        if ($Venda_Detalhe) {
            return response()->json(['status' => 1, 'msg' => 'Item cadastrado com sucesso!']);
        }
    }
}
