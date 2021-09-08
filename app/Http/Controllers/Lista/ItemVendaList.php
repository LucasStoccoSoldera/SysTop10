<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use App\Models\Venda_Detalhe;
use App\Transformers\ItemVendaTransformer;

class ItemVendaList extends Controller
{
    public function listItemVenda(Request $request){

        if($request->ajax()){

            $data5 = Venda_Detalhe::where('ven_id', '=', $request->id);

            return DataTables::eloquent($data5)
            ->toJson();
        }
    }
}
