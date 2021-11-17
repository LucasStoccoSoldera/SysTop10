<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use App\Models\Contas_a_Pagar;
use App\Models\Caixa;
use App\Models\Compras;
use App\Models\Parcelas;
use Illuminate\Support\Facades\DB;
use App\Models\Notificacao;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ContasRegister extends Controller
{

    /**
     * @return \App\Models\Contas_a_Pagar
     */
    protected function createPagar(Request $request)
    {

        $request->valorContas = str_replace('R$ ', '', $request->valorContas);
        $request->valorContas = str_replace('.', '', $request->valorContas);
        $request->valorContas = str_replace(',', '.', $request->valorContas);

        $request->valorfContas = str_replace('R$ ', '', $request->valorfContas);
        $request->valorfContas = str_replace('.', '', $request->valorfContas);
        $request->valorfContas = str_replace(',', '.', $request->valorfContas);

        $ontem = Carbon::now()->subDay();

        $validator = Validator::make(
            $request->all(),
            [
                'descricaoContas' => ['required', 'string'],
                'tipoContas' => ['required', 'string'],
                'valorContas' => ['required'],
                'valorfContas' => ['required'],
                'parcelasContas' => ['required', 'integer'],
                'datavContas' => ['required', 'date'],
                'tpgpagtoContas' => ['required', 'string'],
                'centrocustoContas' => ['required', 'string'],
            ],
            [
                'descricaoContas.required' => 'Descrição obrigatória.',
                'tipoContas.required' => 'Tipo obrigatório.',
                'valorContas.required' => 'Valor obrigatório.',
                'valorfContas.required' => 'Valor final obrigatório.',
                'parcelasContas.required' => 'Qtde. de parcelas obrigatória.',
                'datavContas.required' => 'Data de venc. obrigatória.',
                'tpgpagtoContas.required' => 'Tipo de Pagamento obrigatório.',
                'centrocustoContas.required' => 'Centro de custo obrigatório.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()]);
        }
        $Contas_a_Pagar = new Contas_a_Pagar;
        $Contas_a_Pagar->con_descricao = $request->descricaoContas;
        $Contas_a_Pagar->con_tipo = $request->tipoContas;
        $Contas_a_Pagar->con_valor = $request->valorContas;
        $Contas_a_Pagar->con_valor_final = $request->valorfContas;
        $Contas_a_Pagar->con_parcelas = $request->parcelasContas;
        $Contas_a_Pagar->con_data_venc = $request->datavContas;
        $Contas_a_Pagar->con_data_pag = $request->datapContas;
        $Contas_a_Pagar->tpg_id = $request->tpgpagtoContas;
        $Contas_a_Pagar->cc_id = $request->centrocustoContas;
        $Contas_a_Pagar->con_compra= "Conta";

        if(isset($request->datapContas) && $request->datapContasdatapContas <= $ontem){
        $Contas_a_Pagar->con_status= "Pago";
        $Contas_a_Pagar->save();

        $Caixa = new Caixa();
        $Caixa->cax_descricao = "Conta $request->descricaoContas";
        $Caixa->cax_operacao = 0;
        $Caixa->cax_valor =  $request->valorfContas;
        $Caixa->cax_ctpagar = $request->valorfContas;
        $Caixa->save();
        }else{
            $Contas_a_Pagar->con_status= "Aberto";
            $Contas_a_Pagar->save();
        }

        if($request->tipoContas == 'Fixa'){


        } else{

        $cont = 2;
        $conta_last = DB::table('contas_a_pagar')->get()->last()->id;
        $contas_dados = Contas_a_Pagar::find($conta_last);
        while ($cont <= $request->parcelasContas) {

            $Parcela = new Parcelas();
            $Parcela->tpg_id = $request->tpgpagtoContas;
            $Parcela->par_conta = $conta_last;
            $Parcela->par_numero = $cont;
            $Parcela->par_valor = $request->valorfContas / $request->parcelasContas;
            if(isset($request->datapContas) && $request->datapContas <= $ontem){
            $Parcela->par_status = "Em Aberto";
            }
            $Parcela->par_status = "Fechado";
            if(isset($contas_dados->con_data_venc)){
                if($cont <= 2){
            $Parcela->par_data_pagto = $contas_dados->con_data_venc;
                } else{
                    $Parcela->par_data_pagto = ($contas_dados->con_data_venc->modify('+' . ($cont -1) . ' month'));
                }
            }
            $Parcela->save();
            $cont ++;
        }
    }

            return response()->json(['status' => 1, 'msg' => 'Conta cadastrada com sucesso!']);
    }


}
