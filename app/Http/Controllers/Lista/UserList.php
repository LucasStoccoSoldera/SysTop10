<?php

namespace App\Http\Controllers\Lista;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cargo;
use App\Models\Privilegio;
use App\Models\Usuario;
use App\Transformers\UserTransformer;
use App\Transformers\CargoTransformer;

class UserList extends Controller
{
    public function listUser(Request $request){

        $dado1 = Usuario::count();
        $dado2 = Usuario::where('car_id', '1')->count();
        $dado3 = Usuario::where('car_id', '2' && '3')->count();

        $data = Usuario::all();
        $data2 = Cargo::all();
        $data3 = Privilegio::all();


        if($request->ajax()){

            $data = Usuario::all();
            $data2 = Cargo::all();

            return  [DataTables::eloquent($data)
            ->setTransformer(new UserTransformer)
            ->addColumn('Ações', function($data){

                $btn = '<a href="#" class="btn btn-primary" id="alter"><i
                class="tim-icons icon-pencil"></i></a>';
                $btn = ' <button class="btn btn-primary red" id="excluir-cli"
                name="excluir-cliente" data-id=" '.$data->id.' " data-rota=" '. route('admin.delete.user') .'"
                style="padding: 11px 25px;"><i
                class="tim-icons icon-simple-remove"></i></button>';

                return $btn;
            })

            ->rawColumns(['action'])
            ->make(true)

            ,

                DataTables::eloquent($data2)
                ->setTransformer(new CargoTransformer)
                ->addColumn('Ações', function($data2){

                $btn = '<a href="#" class="btn btn-primary" id="alter"><i
                class="tim-icons icon-pencil"></i></a>';
                $btn = ' <button class="btn btn-primary red" id="excluir-cli"
                name="excluir-cliente" data-id=" '.$data2->id.' " data-rota=" '. route('admin.delete.cargo') .'"
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
