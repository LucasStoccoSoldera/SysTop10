<?php

namespace App\Http\Controllers\Lista;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use App\Models\Contas_a_Pagar;
use App\Models\Parcelas;
use App\Transformers\ParcelasTransformer;

class ParcelasList extends Controller
{
    public function listParcelas(Request $request){

        if($request->ajax()){

            $data7 = Parcelas::where('par_conta', '=', $request->id);

            return DataTables::eloquent($data7)
            ->toJson();
        }
    }
}
