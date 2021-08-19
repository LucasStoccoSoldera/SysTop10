<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Contas_a_Receber;
use App\Models\Fornecedores;
use App\Models\Produto;
use App\Models\Usuario;
use App\Models\Venda;
use Illuminate\Support\Facades\DB;

class AutocompleteController extends Controller
{
    public function Cli_Nome(Request $request){
        $dados = Cliente::select("cli_nome")
                                                                                ->where("cli_nome", "LIKE", "%{$request->txt_nome}%")
                                                                                ->get();
        return response()->json($dados);
    }

    public function Rec_Descricao(Request $request){
        $dados = Contas_a_Receber::select("rec_descricao")
                                                                                ->where("rec_descricao", "LIKE", "%{$request->txt_descricao}%")
                                                                                ->get();
        return response()->json($dados);
    }

    public function For_Nome(Request $request){
        $dados = Fornecedores::select("for_nome")
                                                                                ->where("for_nome", "LIKE", "%{$request->txt_nome}%")
                                                                                ->get();
        return response()->json($dados);
    }

    public function Pro_Nome(Request $request){
        $dados = Produto::select("pro_descricao")
                                                                                ->where("pro_descricao", "LIKE", "%{$request->txt_nome}%")
                                                                                ->get();
        return response()->json($dados);
    }

    public function Usu_Nome(Request $request){
        $dados = Usuario::select("usu_nome_completo")
                                                                                ->where("usu_nome_completo", "LIKE", "%{$request->txt_nome}%")
                                                                                ->get();
        return response()->json($dados);
    }

    public function Ven_Cliente(Request $request){
        $dados = DB::table('vendas')
        ->join('cliente', 'vendas.cli_id', '=', 'cliente.cli_id')
        ->select('cliente.cli_nome')
        ->where("cliente.cli_nome", "LIKE", "%{$request->txt_cliente}%")
        ->get();
        return response()->json($dados);
    }
}
