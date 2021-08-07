<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItemVendaRequest;
use App\Http\Requests\VendaRequest;
use App\Models\Venda;
use App\Models\Venda_Detalhe;
use App\Models\Contas_a_Receber;
use App\Models\Parcelas;
use App\Models\Notificacao;
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
                'IDVenda' => ['required', 'integer'],
                'IDTipoPagamento' => ['required', 'integer'],
                'IDLogistica' => ['required', 'integer'],
                'IDCliente' => ['required', 'integer'],
                'VTVenda' => ['required'],
                'parcelasVenda' => ['required', 'integer'],
                'statusVenda' => ['required', 'string'],
            ],
            [
                'IDVenda.required' => 'ID obrigatório.',
                'IDTipoPagamento.required' => 'Tipo de pagamento obrigatório.',
                'IDLogistica.required' => 'Logistica obrigatória.',
                'IDCliente.required' => 'Cliente obrigatório.',
                'parcelasVenda.required' => 'Quantidade de parcelas obrigatória.',
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
        $Venda->ven_valor_total = $request->VTVenda;
        $Venda->ven_parcelas = $request->parcelasVenda;
        $Venda->ven_status = $request->statusVenda;
        $Venda->ven_desconto = $request->descontoVenda;
        $Venda->save();

        $cont = 1;
        $venda_dados = Venda::find($request->IDVenda);
        while ($cont < $request->parcelasVenda) {

            $Receber = new Contas_a_Receber();
            $Receber->tpg_id = $request->IDTipoPagamento;
            $Receber->rec_descricao = "Venda para $request->IDCliente";
            $Receber->rec_ven_id = $request->IDVenda;
            $Receber->rec_valor = ($request->VTVenda / $request->parcelasVenda) * $cont;
            $Receber->rec_parcelas = $request->parcelasVenda;
            $Receber->rec_data = ($venda_dados->ven_data->modify('+' . ($cont * 30) . ' days'));
            $Receber->rec_status = $request->statusVenda;
            $Venda->save();
        }
        if ($Receber) {
            return response()->json(['status' => 1, 'msg' => 'Venda cadastrada com sucesso!']);
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
                'anexoItemVenda' => ['image'],
                'VUItemVenda' => ['required'],
            ],
            [
                'IDCor.required' => 'Cor obrigatória.',
                'IDDimensao.required' => 'Dimensão obrigatória.',
                'IDProduto.required' => 'Produto obrigatório.',
                'IDItemVenda.required' => 'ID da venda obrigatório.',
                'qtdeItemVenda.required' => 'Quantidade obrigatória.',
                'descricaoItemVenda.required' => 'Descrição obrigatório.',
                'anexoItemVenda.image' => 'O arquivo precisa ser uma imagem.',
                'VUItemVenda.required' => 'Valor unitário obrigatório.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()]);
        }
        $Venda_Detalhe = new Venda_Detalhe;
        $Venda_Detalhe->cor_id = $request->IDCor;
        $Venda_Detalhe->dim_id = $request->IDDimensao;
        $Venda_Detalhe->pro_id = $request->IDProduto;
        $Venda_Detalhe->ven_id = $request->IDItemVenda;
        $Venda_Detalhe->det_qtde = $request->qtdeItemVenda;
        $Venda_Detalhe->det_descricao = $request->descricaoItemVenda;
        $Venda_Detalhe->det_anexo_path = $request->anexoItemVenda;
        $Venda_Detalhe->det_valor_unitario = $request->VUItemVenda;
        $Venda_Detalhe->det_valor_total = $request->VTItemVenda;
        $Venda_Detalhe->save();

        if ($Venda_Detalhe) {
            return response()->json(['status' => 1, 'msg' => 'Item cadastrado com sucesso!']);
        }
    }
}
