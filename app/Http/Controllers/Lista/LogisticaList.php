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

        $data = Transportadora::all();

        $data2 = Logistica::all();
        $data3 = Pacote::all();

        if($request->ajax()){

            $data = Transportadora::all();
            $data2 = Logistica::all();
            $data3 = Pacote::all();

            return  [DataTables::eloquent($data)
            ->setTransformer(new TransportadoraTransformer)
            ->addColumn('Ações', function($data){

                $btn = '<a href="#" class="btn btn-primary" id="alter"><i
                class="tim-icons icon-pencil"></i></a>';
                $btn = ' <button class="btn btn-primary red" id="excluir-cli"
                name="excluir-cliente" data-id=" '.$data->id.' " data-rota=" '. route('admin.delete.transportadora') .'"
                style="padding: 11px 25px;"><i
                class="tim-icons icon-simple-remove"></i></button>';

                return $btn;
            })

            ->rawColumns(['action'])
            ->make(true)

            ,

                DataTables::eloquent($data2)
                ->setTransformer(new LogisticaTransformer)
                ->addColumn('Ações', function($data2){

                $btn = '<a href="#" class="btn btn-primary" id="alter"><i
                class="tim-icons icon-pencil"></i></a>';
                $btn = ' <button class="btn btn-primary red" id="excluir-cli"
                name="excluir-cliente" data-id=" '.$data2->id.' " data-rota=" '. route('admin.delete.logistica') .'"
                style="padding: 11px 25px;"><i
                class="tim-icons icon-simple-remove"></i></button>';

                return $btn;
            })

            ->rawColumns(['action'])
            ->make(true)

            ,

            DataTables::eloquent($data3)
            ->setTransformer(new PacoteTransformer)
            ->addColumn('Ações', function($data3){

                $btn = '<a href="#" class="btn btn-primary" id="alter"><i
                class="tim-icons icon-pencil"></i></a>';
                $btn = ' <button class="btn btn-primary red" id="excluir-cli"
                name="excluir-cliente" data-id=" '.$data3->id.' " data-rota=" '. route('admin.delete.pacote') .'"
                style="padding: 11px 25px;"><i
                class="tim-icons icon-simple-remove"></i></button>';

                return $btn;
            })

            ->rawColumns(['action'])
            ->make(true)
        ];
        }
    }
}
