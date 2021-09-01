<?php

namespace App\Http\Controllers\Lista;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use App\Models\TipoPagto;
use App\Transformers\TipoPagtoTransformer;

class TipoPagtoList extends Controller
{
    public function listTipoPagto(Request $request){

        if($request->ajax()){


        }
    }
}
