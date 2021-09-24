<?php

namespace App\Http\Controllers\Lista;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contas_a_Pagar;
use Illuminate\Support\Facades\DB;
use App\Transformers\ContasTransformer;

class ContasList extends Controller
{
    public function listContas(Request $request){

        if($request->ajax()){

            $data1 = Contas_a_Pagar::select('con_descricao', 'con_compra',
            'con_valor_final', 'con_tipo',
            DB::raw("DATE_FORMAT(contas_a_pagar.con_data_venc, '%d/%m/%Y') as con_data_venc"), 'con_status');


            return  DataTables::eloquent($data1)
            ->addColumn('action', function($data1){

                $rota = "`{{route('admin.delete.conta')}}`";
                $btn = '<button type="button" class="btn btn-primary visu" id="visu-con"
                name="visu-conta"
                onclick="visualizar('.$data1->id.', '.$data1->con_valor_final.', '.$data1->tpg_id.', '.$data1->cc_id.');"><i
                class="tim-icons icon-chart-pie-36"></i></button>

                <a href="#" class="btn btn-primary alter-min"><i
                class="tim-icons icon-pencil"></i></a>

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
}
