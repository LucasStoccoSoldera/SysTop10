<?php

namespace App\Http\Controllers\Update;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use App\Models\Contas_a_Pagar;
use App\Models\Caixa;
use App\Models\Parcelas;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Notificacao;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class ContasUpdate extends Controller
{

    protected function editPagar($id)
    {
        $object = Contas_a_Pagar::find($id);
        return response()->json($object);
    }

    /**
     * @return \App\Models\Contas_a_Pagar
     */
    protected function updatePagar(Request $request)
    {
        $ontem = Carbon::now()->subDay();

        $validator = Validator::make(
            $request->all(),
            [
                'descricaoContasUp' => ['required', 'string'],
                'tipoContasUp' => ['required', 'string'],
                'valorContasUp' => ['required'],
                'valorfContasUp' => ['required'],
                'parcelasContasUp' => ['required', 'integer'],
                'datavContasUp' => ['required', 'date'],
                'tpgpagtoContasUp' => ['required', 'string'],
                'centrocustoContasUp' => ['required', 'string'],
            ],
            [
                'descricaoContasUp.required' => 'Descrição obrigatória.',
                'tipoContasUp.required' => 'Tipo obrigatório.',
                'valorContasUp.required' => 'Valor obrigatório.',
                'valorfContasUp.required' => 'Valor final obrigatório.',
                'parcelasContasUp.required' => 'Qtde. de parcelas obrigatória.',
                'datavContasUp.required' => 'Data de venc. obrigatória.',
                'tpgpagtoContasUp.required' => 'Tipo de Pagamento obrigatório.',
                'centrocustoContasUp.required' => 'Centro de custo obrigatório.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()]);
        }
        $Contas_a_Pagar = Contas_a_Pagar::find($request->idCon);
        $Contas_a_Pagar->con_descricao = $request->descricaoContasUp;
        $Contas_a_Pagar->con_tipo = $request->tipoContasUp;
        $Contas_a_Pagar->con_valor = $request->valorContasUp;
        $Contas_a_Pagar->con_valor_final = $request->valorfContasUp;
        $Contas_a_Pagar->con_parcelas = $request->parcelasContasUp;
        $Contas_a_Pagar->con_data_venc = $request->datavContasUp;
        $Contas_a_Pagar->con_data_pag = $request->datapContasUp;
        $Contas_a_Pagar->tpg_id = $request->tpgpagtoContasUp;
        $Contas_a_Pagar->cc_id = $request->centrocustoContasUp;
        $Contas_a_Pagar->con_compra= "Conta";

        if(isset($request->datapContasUp) && $request->datapContasdatapContasUp <= $ontem){
        $Contas_a_Pagar->con_status= "Pago";
        $Contas_a_Pagar->save();

        $Caixa = new Caixa();
        $Caixa->cax_descricao = "Conta $request->descricaoContasUp";
        $Caixa->cax_operacao = 0;
        $Caixa->cax_valor =  $request->valorfContasUp;
        $Caixa->cax_ctpagar = $request->valorfContasUp;
        $Caixa->save();
        }else{
            $Contas_a_Pagar->con_status= "Aberto";
            $Contas_a_Pagar->save();
        }

        if($request->tipoContasUp == 'Fixa'){


        } else{

        $cont = 1;
        $conta_last = DB::table('contas_a_pagar')->get()->last()->id;
        $contas_dados = Contas_a_Pagar::find($request->idCon);

        $Parcelas_delete = Parcelas::where('par_conta', '=', $request->idCon);
        $Parcelas_delete->delete();

        while ($cont <= $request->parcelasContasUp) {

            $Parcela = new Parcelas();
            $Parcela->tpg_id = $request->tpgpagtoContasUp;
            $Parcela->par_conta = $request->idCon;
            $Parcela->par_numero = $cont;
            $Parcela->par_valor = $request->valorfContasUp / $request->parcelasContasUp;
            if(isset($request->datapContasUp) && $request->datapContasUp <= $ontem){
            $Parcela->par_status = "Em Aberto";
            }
            $Parcela->par_status = "Em Aberto";
            if(isset($contas_dados->con_data_pag)){
                if($cont == 1){
            $Parcela->par_data_pagto = ($contas_dados->con_data_pag);
                } else{
                    $Parcela->par_data_pagto = ($contas_dados->con_data_pag->modify('+' . ($cont) . ' month'));
                }
            }
            $Parcela->save();
            $cont ++;
        }
    }
    if ($Parcela) {
            return response()->json(['status' => 1, 'msg' => 'Conta atualizada com sucesso!']);
        }
    }
}
