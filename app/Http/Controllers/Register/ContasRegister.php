<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use App\Models\Contas_a_Pagar;
use App\Models\Caixa;
use App\Models\Parcelas;
use App\Models\Notificacao;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class ContasRegister extends Controller
{

    /**
     * @return \App\Models\Contas_a_Pagar
     */
    protected function createPagar(Request $request)
    {
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
        $Contas_a_Pagar->save();

        $Caixa = new Caixa();
        $Caixa->cax_descricao = "Conta $request->descricaoContas";
        $Caixa->cax_operacao = 0;
        $Caixa->cax_valor =  $request->valorfContas;
        $Caixa->cax_ctpagar = $request->valorfContas;
        $Caixa->cax_ctreceber = "";
        $Caixa->save();

        if ($Contas_a_Pagar) {
            return response()->json(['status' => 1, 'msg' => 'Conta cadastrada com sucesso!']);
        }
    }
}
