<?php

namespace App\Http\Controllers\Lista;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use App\Models\Pacote;
use App\Transformers\PacoteTransformer;

class PacoteList extends Controller
{
    public function listPacote(Request $request){

        if($request->ajax()){

            $data4 = Pacote::query();

            return DataTables::eloquent($data4)
            ->addColumn('action', function($data4){

                $rota = "`{{route('admin.delete.pacote')}}`";
                $btn = '<a href="#" class="btn btn-primary alter-min" data-id="'.$data4->id.'"><i
                class="tim-icons icon-pencil"></i></a>

               <button type="button" class="btn btn-primary red-min" id="excluir-pac"
                name="excluir-pacote"
                 onclick="excluir('.$data4->id.', ' . $rota . ');"><i
                class="tim-icons icon-simple-remove"></i></button>';

                return $btn;
            })

            ->rawColumns(['action'])
            ->toJson();
        }
    }
}
