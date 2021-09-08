<?php

namespace App\Http\Controllers\Lista;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Logistica;
use App\Models\Pacote;
use App\Models\Transportadora;
use App\Transformers\LogisticaTransformer;
use App\Transformers\TransportadoraTransformer;
use App\Transformers\PacoteTransformer;

class LogisticaList extends Controller
{
    public function listLogistica(Request $request){

        if($request->ajax()){

            $data2 = Logistica::query();

            return DataTables::eloquent($data2)
                ->addColumn('action', function($data2){

                $btn = '<a href="#" class="btn btn-primary" id="alter"><i
                class="tim-icons icon-pencil"></i></a>

                <button class="btn btn-primary red" id="excluir-cli"
                name="excluir-cliente" data-id=" '.$data2->id.' " data-rota=" '. route('admin.delete.logistica') .'"
                style="padding: 11px 25px;"><i
                class="tim-icons icon-simple-remove"></i></button>';

                return $btn;
            })

            ->rawColumns(['action'])
            ->toJson();
        }
    }
}
