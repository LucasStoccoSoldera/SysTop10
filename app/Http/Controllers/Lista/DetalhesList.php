<?php

namespace App\Http\Controllers\Lista;

use App\Http\Controllers\Controller;
use App\Models\Centro_Custo;
use App\Models\TipoPagto;

class DetalhesList extends Controller
{
    public function listDetalhe() {

        $data2 = Centro_Custo::all();
        $data3 = TipoPagto::all();

        return  response()->json(['centros' => $data2, 'pagamentos' => $data3]);
    }
}
