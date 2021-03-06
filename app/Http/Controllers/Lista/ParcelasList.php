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

        if(empty($request->id)){
            $data7 = Parcelas::select('par_conta', 'par_numero',
            'par_valor', 'par_status',
            'par_data_pagto')->where('par_conta', '=', -1);

            return DataTables::eloquent($data7)
            ->toJson();
        }


                $data7 = Parcelas::select('par_conta', 'par_numero',
                'par_valor', 'par_status',
                'par_data_pagto')->where('par_conta', '=', $request->id);
            return DataTables::eloquent($data7)
            ->toJson();

        }

        public function listParcelasOpen(Request $request){

            if(empty($request->id)){
                $data7 = Parcelas::select('par_venda', 'par_numero',
                'par_valor', 'par_status',
                'par_data_pagto')->where('par_venda', '=', -1);

                return DataTables::eloquent($data7)
                ->toJson();
            }

                    $data7 = Parcelas::select('par_venda', 'par_numero',
                    'par_valor', 'par_status',
                    'par_data_pagto')->where('par_venda', '=', $request->id);
                return DataTables::eloquent($data7)
                ->toJson();

            }
    }
