<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\Models\Contas_a_Receber;
use App\Models\Caixa;
use App\Models\Notificacao;
use Illuminate\Support\Facades\DB;
use App\Models\Parcelas;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Carbon\Carbon;


class ContasaReceberRegister extends Controller
{
    /**
     * @return \App\Models\Contas_a_Receber
     */
    protected function createReceber(Request $request)
    {

        $request->valorReceber = str_replace('R$ ', '', $request->valorReceber);
        $request->valorReceber = str_replace('.', '', $request->valorReceber);
        $request->valorReceber = str_replace(',', '.', $request->valorReceber);


        $ontem = Carbon::now()->subDay();

        $validator = Validator::make(
            $request->all(),
            [
                'tipoPagtoReceber' => ['required', 'string'],
                'descricaoReceber' => ['required', 'string'],
                'IDVenda' => ['integer'],
                'valorReceber' => ['required'],
                'parcelasReceber' => ['required', 'integer'],
                'dataReceber' => ['required', 'date'],
                'statusReceber' => ['required'],
            ],
            [
                'tipoPagtoReceber.required' => 'Tipo de pagamento obrigatório.',
                'descricaoReceber.required' => 'Descrição obrigatória.',
                'valorReceber.required' => 'Valor obrigatório.',
                'parcelasReceber.required' => 'Qtde. de parcelas obrigatória.',
                'dataReceber.required' => 'Data do recb. obrigatória.',
                'statusReceber.required' => 'Status obrigatória.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()]);
        }
        $Contas_a_Receber = new Contas_a_Receber;
        $Contas_a_Receber->tpg_id = $request->tipoPagtoReceber;
        $Contas_a_Receber->rec_descricao = $request->descricaoReceber;
        $Contas_a_Receber->rec_ven_id = $request->IDVenda;
        $Contas_a_Receber->rec_valor = $request->valorReceber;
        $Contas_a_Receber->rec_valor_final = $request->valorReceber;
        $Contas_a_Receber->rec_parcelas = $request->parcelasReceber;
        $Contas_a_Receber->rec_data = $request->dataReceber;

        if(isset($request->dataReceber) && $request->dataReceber <= $ontem){
        $Contas_a_Receber->rec_status = "Baixa";
        $Contas_a_Receber->save();

        $Caixa = new Caixa();
        $Caixa->cax_descricao = "Credito $request->descricaoReceber";
        $Caixa->cax_operacao = 1;
        $Caixa->cax_valor =  $request->valorReceber;
        $Caixa->cax_ctreceber = $request->valorReceber;
        $Caixa->save();
        } else{
            $Contas_a_Receber->rec_status = "Aberta";
            $Contas_a_Receber->save();
        }

        $cont = 1;
        $conta_last = DB::table('contas_a_receber')->get()->last()->id;
        $contas_dados = Contas_a_Receber::find($conta_last);
        while ($cont <= $request->parcelasReceber) {

            $Parcela = new Parcelas();
            $Parcela->tpg_id = $request->tipoPagtoReceber;
            $Parcela->par_venda = $conta_last;
            $Parcela->par_numero = $cont;
            $Parcela->par_valor = ($request->valorReceber / $request->parcelasReceber);
            if(isset($request->dataReceber) && $request->dataReceber <= $ontem){
                $Parcela->par_status = "Baixa";
            }
            $Parcela->par_status = "Aberta";
            if(isset($contas_dados->rec_data)){
                if($cont == 1){
            $Parcela->par_data_pagto = ($contas_dados->rec_data);
                } else{
                    $Parcela->par_data_pagto = ($contas_dados->rec_data->modify('+' . ($cont) . ' month'));
                }
            }
            $Parcela->save();
            $cont ++;
        }

        if ($Parcela) {
            return response()->json(['status' => 1, 'msg' => 'Crédito cadastrado com sucesso!']);
        }
    }
}
