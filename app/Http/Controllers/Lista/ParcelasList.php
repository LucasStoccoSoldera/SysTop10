<?php

namespace App\Http\Controllers\Lista;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use App\Models\Contas_a_Pagar;
use App\Models\Parcelas;
use Illuminate\Support\Facades\DB;
use App\Transformers\ParcelasTransformer;

class ParcelasList extends Controller
{
    public function listParcelas(Request $request){

        if($request->ajax()){
            $conta = Parcelas::where('par_conta', '=', $request->conta)->get();
            if(isset($conta)){
                $data7 = Parcelas::select('par_conta', 'par_numero',
                'par_valor', 'par_status',
                DB::raw("DATE_FORMAT(parcelas.par_data_pagto, '%d/%m/%Y') as par_data_pagto"))->where('par_conta', '=', $request->id);
            } else{
                $data7 = Parcelas::select('par_venda', 'par_numero',
                'par_valor', 'par_status',
                DB::raw("DATE_FORMAT(parcelas.par_data_pagto, '%d/%m/%Y') as par_data_pagto"))->where('par_venda', '=', $request->id);

            return DataTables::eloquent($data7)
            ->toJson();
          }
        }
    }
}
