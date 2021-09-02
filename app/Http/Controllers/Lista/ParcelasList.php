<?php

namespace App\Http\Controllers\Lista;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use App\Models\Parcelas;
use App\Transformers\ParcelasTransformer;

class ParcelasList extends Controller
{
    public function listCentroCusto(Request $request){

        if($request->ajax()){

            $data7 = Parcelas::where('con_id', '=', $request->id);

            DataTables::eloquent($data7)
            ->toJson();
        }
    }
}
