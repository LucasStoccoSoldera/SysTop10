<?php

namespace App\Http\Controllers\Lista;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contas_a_Pagar;
use App\Models\Compras;
use Illuminate\Support\Facades\DB;
use App\Transformers\ContasTransformer;

class ContasList extends Controller
{
    public function listContas(Request $request){

        if($request->ajax()){

            $data1 = Contas_a_Pagar::select('con_descricao', 'con_compra',
            'con_valor_final', 'con_tipo',
            DB::raw("DATE_FORMAT(contas_a_pagar.con_data_venc, '%d/%m/%Y') as con_data_venc"), 'con_status',
            'id', 'tpg_id', 'cc_id')->where('con_status', '<>', 'Pago');


            return  DataTables::eloquent($data1)
            ->addColumn('action', function($data1){

                $rota =  "'" . route('admin.delete.conta') . "'";
                $btn = '


                <button type="button" class="parcelas btn btn-primary visu" id="visu-con"
                name="visu-conta"
                data-id = "'.$data1->id.'"
                data-valor = "'.$data1->con_valor_final.'"
                data-tpg = "'.$data1->tpg_id.'"
                data-cc = "'.$data1->cc_id.'"
                ><i
                class="tim-icons icon-chart-pie-36"></i></button>

                <a class="btn btn-primary alter-min"><i
                class="tim-icons icon-pencil" onclick="editConta('.$data1->id.');"></i></a>

                <button type="button" class="btn btn-primary red-min" id="excluir-con"
                name="excluir-contas"
                 onclick="excluir('.$data1->id.', ' . $rota . ');"><i
                class="tim-icons icon-simple-remove"></i></button>';

                return $btn;
            })

            ->rawColumns(['action'])
            ->toJson();
        }
    }
    public function postContas(Request $request){



    }
    public function getLastIDContas(Request $request){
        $object = Compras::all()->last()->id();
        if(isset($object)){
            return response()->json(['id' => $object->id]);
            }
            return response()->json(['id' => '1000']);
        }
}
