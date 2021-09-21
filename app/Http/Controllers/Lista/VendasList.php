<?php

namespace App\Http\Controllers\Lista;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Venda;
use App\Transformers\VendasTransformer;

class VendasList extends Controller
{
    public function listVendas(Request $request){

            if($request->ajax()){

                $data = Venda::query();
                $data = Venda::select('venda.id', 'cli_nome', 'ven_valor_total', 'ven_status', 'ven_parcelas', 'ven_data')
                ->join('cliente', 'venda.cli_id', '=', 'cliente.id');

                return  DataTables::eloquent($data)
                ->setTransformer(new VendasTransformer)
                ->rawColumns(['action'])
                ->toJson();
        }
    }
}
