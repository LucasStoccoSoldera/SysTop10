<?php

namespace App\Http\Controllers\Update;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContasaReceberRequest;
use App\Models\Contas_a_Receber;
use App\Models\Caixa;
use App\Models\Notificacao;
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
        $Contas_a_Receber->rec_parcelas = $request->parcelasReceber;
        $Contas_a_Receber->rec_data = $request->dataReceber;
        $Contas_a_Receber->rec_status = $request->statusReceber;
        $Contas_a_Receber->save();

        $Caixa = new Caixa();
        $Caixa->cax_descricao = "Credito $request->descricaoReceber";
        $Caixa->cax_operacao = 1;
        $Caixa->cax_valor =  $request->valorReceber;
        $Caixa->cax_ctpagar = "";
        $Caixa->cax_ctreceber = $request->valorReceber;
        $Caixa->save();

        if ($Contas_a_Receber) {
            return response()->json(['status' => 1, 'msg' => 'Crédito cadastrado com sucesso!']);
        }
    }
}
