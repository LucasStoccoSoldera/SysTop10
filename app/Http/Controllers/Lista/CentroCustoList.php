<?php

namespace App\Http\Controllers\Lista;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use App\Models\Centro_Custo;
use App\Transformers\CentroCustoTransformer;

class CentroCustoList extends Controller
{
    public function listCentroCusto(Request $request){

        if($request->ajax()){


        }
    }
}
