<?php

namespace App\Http\Controllers\Lista;

use App\Http\Controllers\Controller;
use App\Models\Centro_Custo;
use App\Models\TipoPagto;
use Illuminate\Support\Facades\DB;

class DetalhesList extends Controller
{
    public function listDetalhe() {

        $centros = DB::table('centro_custo')->select('cc_descricao')->get();
        $pagamentos = DB::table('tipopagto')->select('tpg_descricao')->get();

        return response()->json(['centros' => $centros, 'pagamentos' => $pagamentos]);
    }
}
