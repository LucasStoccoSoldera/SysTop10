<?php

namespace App\Http\Controllers\Lista;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use App\Models\Compras_Detalhe;
use App\Transformers\ItemCompraTransformer;

class ItemCompraList extends Controller
{
    public function listItemCompra(Request $request){

        if($request->ajax()){

            $data4 = Compras_Detalhe::where('com_id', $request->IDCompra);

            return DataTables::eloquent($data4)
                ->addColumn('action', function($data4){

                $btn = '<a href="#" class="btn btn-primary" id="alter"><i
                class="tim-icons icon-pencil"></i></a>

                <button class="btn btn-primary red" id="excluir-cli"
                name="excluir-cliente" data-id=" '.$data4.' " data-rota=" '. route('admin.delete.itemcompra') .'"
                style="padding: 11px 25px;"><i
                class="tim-icons icon-simple-remove"></i></button>';

                return $btn;
            })

            ->rawColumns(['action'])
            ->toJson();
        }
    }
}
