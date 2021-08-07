<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContasaReceberRequest;
use App\Models\Contas_a_Receber;
use App\Models\Parcelas;
use App\Models\Notificacao;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class ContasaReceberRegister extends Controller
{
    /**
     * @return \App\Models\Contas_a_Receber
     */
    protected function createReceber(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'tipoPagtoReceber' => ['required', 'string'],
            'descricaoReceber' => ['required', 'string'],
            'IDVenda' => ['integer'],
            'valorReceber' => ['required'],
            'parcelasReceber' => ['required', 'integer'],
            'dataReceber' => ['required', 'date'],
        ],
        [
            'tipoPagtoReceber.required' => 'Tipo de pagamento obrigatório.',
            'descricaoReceber.required' => 'Descrição obrigatória.',
            'valorReceber.required' => 'Valor obrigatório.',
            'parcelasReceber.required' => 'Quantidade de parcelas obrigatória.',
            'dataReceber.required' => 'Data do recebimento obrigatória.',
       ]);

        if($validator->fails()){
            return response()->json(['status' =>0, 'error' => $validator->errors()]);
        }
        $Contas_a_Receber = new Contas_a_Receber;
        $Contas_a_Receber->tpg_id = $request->tipoPagtoReceber;
        $Contas_a_Receber->rec_descricao = $request->descricaoReceber;
        $Contas_a_Receber->rec_ven_id = $request->IDVenda;
        $Contas_a_Receber->rec_valor = $request->valorReceber;
        $Contas_a_Receber->rec_parcelas = $request->parcelasReceber;
        $Contas_a_Receber->rec_data = $request->dataReceber;
        $Contas_a_Receber->rec_status = $request->statusReceber;
        $Contas_a_Receber->save();

            if($Contas_a_Receber){
                return response()->json(['status' => 1, 'msg' => 'Crédito cadastrado com sucesso!']);
            }
    }
}


