<?php

namespace App\Http\Controllers\Lista;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Venda;
use Illuminate\Support\Facades\DB;
use App\Transformers\VendasTransformer;

class VendasList extends Controller
{
    public function listVendas(Request $request){

            if($request->ajax()){

                $data = Venda::query();
                $data = Venda::select('vendas.id', 'cliente.cli_nome', '(vendas_detalhe.det_valor_total * vendas_detalhe.det_qtde) AS ven_valor_total', 'ven_status', 'ven_parcelas',
                DB::raw("DATE_FORMAT(vendas.ven_data, '%d/%m/%Y %H:%i') as ven_data"))
                ->join('cliente', 'vendas.cli_id', '=', 'cliente.id')
                ->join('vendas_detalhe', 'vendas.id', '=', 'vendas_detalhe.ven_id');

                return  DataTables::eloquent($data)
                ->setTransformer(new VendasTransformer)
                ->rawColumns(['action'])
                ->toJson();
        }
    }

    public function getLastIDVendas(Request $request){
        $object = Venda::all()->last()->id();
        if(isset($object)){
        return response()->json(['id' => $object->id]);
        }
        return response()->json(['id' => '1000']);
    }
}
