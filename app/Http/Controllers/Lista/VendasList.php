<?php

namespace App\Http\Controllers\Lista;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Venda;
use App\Models\Venda_Detalhe;
use App\Transformers\VendasTransformer;
use App\Transformers\ItemVendaTransformer;

class VendasList extends Controller
{
    public function listVendas(Request $request){

        $dado1 = 'teste';
        $dado2 = 'teste';
        $dado3 = 'teste';

        $data = Venda::all();
        $data6 = Venda_Detalhe::where('ven_id', $request->IDVenda);

        if(isset($id)){
            if($request->ajax()){

                $data = Venda::all();
                $data6 = Venda_Detalhe::where('ven_id', $request->IDVenda);
                $data5 = Venda_Detalhe::where('ven_id', $id);

                return  [DataTables::eloquent($data)
                ->setTransformer(new VendasTransformer)
                ->addColumn('Ações', function($data){

                    $btn = '<a href="#" class="btn btn-primary" id="alter"><i
                    class="tim-icons icon-pencil"></i></a>';
                    $btn = ' <button class="btn btn-primary red" id="excluir-cli"
                    name="excluir-cliente" data-id=" '.$data->id.' " data-rota=" '. route('admin.delete.venda') .'"
                    style="padding: 11px 25px;"><i
                    class="tim-icons icon-simple-remove"></i></button>';

                    return $btn;
                })

                ->rawColumns(['action'])
                ->make(true)

                ,

                    DataTables::eloquent($data5)
                    ->setTransformer(new ItemVendaTransformer)
                    ->addColumn('Ações', function($data5){

                    $btn = '<a href="#" class="btn btn-primary" id="alter"><i
                    class="tim-icons icon-pencil"></i></a>';
                    $btn = ' <button class="btn btn-primary red" id="excluir-cli"
                    name="excluir-cliente" data-id=" '.$data5.' " data-rota=" '. route('admin.delete.itemvenda') .'"
                    style="padding: 11px 25px;"><i
                    class="tim-icons icon-simple-remove"></i></button>';

                    return $btn;
                })

                ->rawColumns(['action'])
                ->make(true)

                ,

                DataTables::eloquent($data6)
                ->setTransformer(new ItemVendaTransformer)
                ->addColumn('Ações', function($data6){

                    $btn = '<a href="#" class="btn btn-primary" id="alter"><i
                    class="tim-icons icon-pencil"></i></a>';
                    $btn = ' <button class="btn btn-primary red" id="excluir-cli"
                    name="excluir-cliente" data-id=" '.$data6.' " data-rota=" '. route('admin.delete.itemvenda') .'"
                    style="padding: 11px 25px;"><i
                    class="tim-icons icon-simple-remove"></i></button>';

                    return $btn;
                })

                ->rawColumns(['action'])
                ->make(true)
                ];
            }
        } else{
            return  [DataTables::eloquent($data)
            ->setTransformer(new VendasTransformer)
            ->addColumn('Ações', function($data){

                $btn = '<a href="#" class="btn btn-primary" id="alter"><i
                class="tim-icons icon-pencil"></i></a>';
                $btn = ' <button class="btn btn-primary red" id="excluir-cli"
                name="excluir-cliente" data-id=" '.$data->id.' " data-rota=" '. route('admin.delete.venda') .'"
                style="padding: 11px 25px;"><i
                class="tim-icons icon-simple-remove"></i></button>';

                return $btn;
            })

            ->rawColumns(['action'])
            ->make(true)

            ,

            DataTables::eloquent($data6)
            ->setTransformer(new ItemVendaTransformer)
            ->addColumn('Ações', function($data6){

                $btn = '<a href="#" class="btn btn-primary" id="alter"><i
                class="tim-icons icon-pencil"></i></a>';
                $btn = ' <button class="btn btn-primary red" id="excluir-cli"
                name="excluir-cliente" data-id=" '.$data6.' " data-rota=" '. route('admin.delete.itemvenda') .'"
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
