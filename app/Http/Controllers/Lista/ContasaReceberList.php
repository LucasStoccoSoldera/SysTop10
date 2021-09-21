<?php

namespace App\Http\Controllers\Lista;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contas_a_Receber;
use Illuminate\Support\Facades\DB;
use App\Transformers\ContasaReceberTransformer;

class ContasaReceberList extends Controller
{
    public function listContasaReceber(Request $request){

        $data = Contas_a_Receber::query();

        if($request->ajax()){

            $data = Contas_a_Receber::select('contas_a_receber.id', 'rec_descricao', 'rec_ven_id', 'rec_parcelas', 'rec_valor',
            DB::raw("DATE_FORMAT(contas_a_receber.rec_data, '%d/%m/%Y %H:%i') as rec_data"), 'rec_status');

            return  DataTables::eloquent($data)
            ->addColumn('action', function($data){

                $btn = '<button type="button" class="btn btn-primary visu" id="visu-rec"
                name="visu-receber" data-id="'.$data->id.'" data-valor="'.$data->rec_valor.'" data-tpg="'.$data->tpg_id.'" data-data="'.$data->created_at.'"
               ><i
                class="tim-icons icon-chart-pie-36"></i></button>

                <a href="#" class="btn btn-primary alter-min"><i
                class="tim-icons icon-pencil"></i></a>

                <button type="button" class="btn btn-primary red-min" id="excluir-rec"
                name="excluir-receber" data-id="'.$data->id.'" data-rota="'. route('admin.delete.receber') .'"
               ><i
                class="tim-icons icon-simple-remove"></i></button>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->toJson();
        }
    }
}
