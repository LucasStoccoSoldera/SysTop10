<?php

namespace App\Http\Controllers\Lista;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use App\Models\Venda_Detalhe;
use App\Transformers\ItemVendaTransformer;

class ItemVendaAtoList extends Controller
{
    public function listItemVendaAto(Request $request){

        if($request->ajax()){

            $data6 = Venda_Detalhe::where('ven_id', $request->IDVenda);


            DataTables::eloquent($data6)
            ->setTransformer(new ItemVendaTransformer)
            ->addColumn('action', function($data6){

                $btn = '<a href="#" class="btn btn-primary" id="alter"><i
                class="tim-icons icon-pencil"></i></a>';
                $btn = ' <button class="btn btn-primary red" id="excluir-cli"
                name="excluir-cliente" data-id=" '.$data6.' " data-rota=" '. route('admin.delete.itemvenda') .'"
                style="padding: 11px 25px;"><i
                class="tim-icons icon-simple-remove"></i></button>';

                return $btn;
            })

            ->rawColumns(['action'])
            ->toJson();
        }
    }
}
