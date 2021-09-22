<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use App\Models\Venda_Detalhe;
use Illuminate\Support\Facades\DB;
use App\Transformers\ItemVendaTransformer;

class ItemVendaList extends Controller
{
    public function listItemVenda(Request $request){

        if($request->ajax()){

            $data = Venda_Detalhe::select('vendas_detalhe.id', 'pro_nome', 'det_qtde',
            'det_valor_total')
            ->join('produto', 'vendas_detalhe.pro_id', '=', 'produto.id')->where('ven_id', '=', $request->id);

            return DataTables::eloquent($data)
            ->setTransformer(new ItemVendaTransformer)
            ->toJson();
        }
    }
}
