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

            DataTables::eloquent($data4)
            ->setTransformer(new PacoteTransformer)
            ->addColumn('action', function($data4){

                $btn = '<a href="#" class="btn btn-primary" id="alter"><i
                class="tim-icons icon-pencil"></i></a>';
                $btn = ' <button class="btn btn-primary red" id="excluir-cli"
                name="excluir-cliente" data-id=" '.$data4->id.' " data-rota=" '. route('admin.delete.pacote') .'"
                style="padding: 11px 25px;"><i
                class="tim-icons icon-simple-remove"></i></button>';

                return $btn;
            })

            ->rawColumns(['action'])
            ->toJson();
        }
    }
}
