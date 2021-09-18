<?php

namespace App\Http\Controllers\Lista;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contas_a_Pagar;
use App\Transformers\ContasTransformer;

class ContasList extends Controller
{
    public function listContas(Request $request){

        $dado1 = 'teste';
        $dado2 = 'teste';
        $dado3 = 'teste';

        if($request->ajax()){

            $data1 = Contas_a_Pagar::query();


            return  DataTables::eloquent($data1)
            ->addColumn('action', function($data1){

                $btn = '<button type="button" class="btn btn-primary visu" id="visu-con"
                name="visu-conta" data-id="'.$data1->id.'" data-valor="'.$data1->con_valor_final.'" data-tpg="'.$data1->tpg_id.'" data-cc="'.$data1->cc_id.'"
               ><i
                class="tim-icons icon-chart-pie-36"></i></button>

                <a href="#" class="btn btn-primary alter-min"><i
                class="tim-icons icon-pencil"></i></a>

                <button type="button" class="btn btn-primary red-min" id="excluir-con"
                name="excluir-contas" data-id="'.$data1->id.'" data-rota="'. route('admin.delete.conta') .'"
               ><i
                class="tim-icons icon-simple-remove"></i></button>';

                return $btn;
            })

            ->rawColumns(['action'])
            ->toJson();
        }
    }
}
