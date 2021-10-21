<?php

namespace App\Http\Controllers\Update;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContasaReceberRequest;
use App\Models\Contas_a_Receber;
use App\Models\Caixa;
use App\Models\Notificacao;
use Illuminate\Support\Facades\DB;
use App\Models\Parcelas;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class ContasaReceberUpdate extends Controller
{

    protected function editReceber($id)
    {
        $object = Contas_a_Receber::find($id);
        return response()->json($object);
    }

    /**
     * @return \App\Models\Contas_a_Receber
     */
    protected function updateReceber(Request $request)
    {
        $ontem = Carbon::now()->subDay();

        $validator = Validator::make(
            $request->all(),
            [
                'tipoPagtoReceberUp' => ['required', 'string'],
                'descricaoReceberUp' => ['required', 'string'],
                'IDVendaUp' => ['integer'],
                'valorReceberUp' => ['required'],
                'parcelasReceberUp' => ['required', 'integer'],
                'dataReceberUp' => ['required', 'date'],
                'statusReceberUp' => ['required'],
            ],
            [
                'tipoPagtoReceberUp.required' => 'Tipo de pagamento obrigatório.',
                'descricaoReceberUp.required' => 'Descrição obrigatória.',
                'valorReceberUp.required' => 'Valor obrigatório.',
                'parcelasReceberUp.required' => 'Qtde. de parcelas obrigatória.',
                'dataReceberUp.required' => 'Data do recb. obrigatória.',
                'statusReceberUp.required' => 'Status obrigatória.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()]);
        }
        $Contas_a_Receber = Contas_a_Receber::find($request->idRec);
        $Contas_a_Receber->tpg_id = $request->tipoPagtoReceberUp;
        $Contas_a_Receber->rec_descricao = $request->descricaoReceberUp;
        $Contas_a_Receber->rec_ven_id = $request->IDVendaUp;
        $Contas_a_Receber->rec_valor = $request->valorReceberUp;
        $Contas_a_Receber->rec_parcelas = $request->parcelasReceberUp;
        $Contas_a_Receber->rec_data = $request->dataReceberUp;

        if(isset($request->dataReceberUp) && $request->dataReceberUp <= $ontem){
        $Contas_a_Receber->rec_status = "Baixa";
        $Contas_a_Receber->save();

        $Caixa = Cliente::find($request->idCli);
        $Caixa->cax_descricao = "Credito $request->descricaoReceberUp";
        $Caixa->cax_operacao = 1;
        $Caixa->cax_valor =  $request->valorReceberUp;
        $Caixa->cax_ctreceber = $request->valorReceberUp;
        $Caixa->save();
        } else{
            $Contas_a_Receber->rec_status = "Aberta";
            $Contas_a_Receber->save();
        }

        $cont = 0;
        $conta_last = DB::table('contas_a_receber')->get()->last()->id;
        $contas_dados = Contas_a_Receber::find($conta_last);
        while ($cont < $request->parcelasReceberUp) {

            $Parcela = new Parcelas();
            $Parcela->tpg_id = $request->tipoPagtoReceberUp;
            $Parcela->par_venda = $conta_last;
            $Parcela->par_numero = $cont;
            $Parcela->par_valor = ($request->valorReceberUp / $request->parcelasReceberUp) * $cont;
            if(isset($request->dataReceberUp) && $request->dataReceberUp <= $ontem){
                $Parcela->par_status = "Baixa";
            }
            $Parcela->par_status = "Aberta";
            if ($contas_dados->con_data_pag <> null){
            $Parcela->par_data_pagto = ($contas_dados->con_data_pag->modify('+' . ($cont * 30) . ' days'));
            }
            $Parcela->save();
            $cont ++;
        }

        if ($Parcela) {
            return response()->json(['status' => 1, 'msg' => 'Crédito atualizado com sucesso!']);
        }
    }
}
