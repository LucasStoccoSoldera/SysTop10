<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Usuario;
use App\Models\Cliente;
use App\Models\Contas_a_Pagar;
use App\Models\Contas_a_Receber;
use App\Models\Venda;
use App\Models\Produto;
use App\Models\Estoque;
use App\Models\Fornecedores;
use App\Transformers\UserTransformer;
use App\Transformers\VendasTransformer;
use App\Transformers\ProdutosTransformer;
use App\Transformers\EstoqueTransformer;

class FiltroController extends Controller
{
    public function Usuario(Request $request){

        $query = Usuario::query();

        $termos = $request->only('id', 'usu_nome_completo', 'car_id');

        foreach ($termos as $nome => $valor) {
            if ($valor) {
                $query->where($nome, 'LIKE', '%' . $valor . '%');
            }
        }

        return  DataTables::eloquent($query)
        ->setTransformer(new UserTransformer)
        ->rawColumns(['action'])
        ->toJson();

    }

    public function Cliente(Request $request){

        $query = Cliente::query();

        $termos = $request->only('cli_nome', 'cli_cidade', 'created_at', 'cli_cpf_cnpj');

        foreach ($termos as $nome => $valor) {
            if ($valor) {
                $query->where($nome, 'LIKE', '%' . $valor . '%');
            }
        }

        return  DataTables::eloquent($query)
        ->addColumn('action', function($query){

            $rota = "'" .  route('admin.delete.cliente') . "'";
            $btn = '<a class="btn btn-primary alter" data-id="'.$query->id.'"  onclick="editCliente('.$query->id.');"><i
            class="tim-icons icon-pencil"></i></a>

            <button type="button" class="btn btn-primary red" id="excluir-cli"
            name="excluir-cliente"
            onclick="excluir('.$query->id.', ' . $rota .');"><i
            class="tim-icons icon-simple-remove"></i></button>';

            return $btn;
        })
        ->rawColumns(['action'])
        ->toJson();
    }

    public function Contas(Request $request){

        $query = Contas_a_Pagar::query();

        $termos = $request->only('con_data_venc', 'con_data_pag', 'cc_id');

        foreach ($termos as $nome => $valor) {
            if ($valor) {
                $query->where($nome, 'LIKE', '%' . $valor . '%');
            }
        }

        return  DataTables::eloquent($query)
        ->addColumn('action', function($query){

            $rota =  "'" . route('admin.delete.conta') . "'";
            $btn = '


            <button type="button" class="parcelas btn btn-primary visu" id="visu-con"
            name="visu-conta"
            data-id = "'.$query->id.'"
            data-valor = "'.$query->con_valor_final.'"
            data-tpg = "'.$query->tpg_id.'"
            data-cc = "'.$query->cc_id.'"
            ><i
            class="tim-icons icon-chart-pie-36"></i></button>

            <a class="btn btn-primary alter-min"><i
            class="tim-icons icon-pencil" onclick="editConta('.$query->id.');"></i></a>

            <button type="button" class="btn btn-primary red-min" id="excluir-con"
            name="excluir-contas"
             onclick="excluir('.$query->id.', ' . $rota . ');"><i
            class="tim-icons icon-simple-remove"></i></button>';

            return $btn;
        })

        ->rawColumns(['action'])
        ->toJson();
    }

    public function ContasaReceber(Request $request){

        $query = Contas_a_Receber::query();

        $termos = $request->only('rec_descricao', 'rec_data', 'rec_status');

        foreach ($termos as $nome => $valor) {
            if ($valor) {
                $query->where($nome, 'LIKE', '%' . $valor . '%');
            }
        }

            return  DataTables::eloquent($query)
            ->addColumn('action', function($query){

                $rota = "'" .  route('admin.delete.receber') . "'";
                $btn = '

                <button type="button" class="parcelas btn btn-primary visu" id="visu-rec"
                name="visu-receber"
                data-id = "'.$query->id.'"
                data-valor = "'.$query->rec_valor_final.'"
                data-tpg = "'.$query->tpg_id.'"
                data-data = "'.$query->rec_data.'"
                ><i
                class="tim-icons icon-chart-pie-36"></i></button>

                <a class="btn btn-primary alter-min"><i
                class="tim-icons icon-pencil" onclick="editReceber('.$query->id.');"></i></a>

                <button type="button" class="btn btn-primary red-min" id="excluir-rec"
                name="excluir-receber"
                onclick="excluir('.$query->id.', ' . $rota . ');"><i
                class="tim-icons icon-simple-remove"></i></button>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function Vendas(Request $request){

        $query = Venda::query();

        $termos = $request->only('cli_id', 'ven_data','txt_fil', 'ven_valor_total');

        foreach ($termos as $nome => $valor) {
            if ($valor) {
                if($nome == 'txt_fil'){
                $query->where($nome, $valor, $request->ven_valor_total);
                }
                $query->where($nome, 'LIKE', '%' . $valor . '%');
            }
        }

        return  DataTables::eloquent($query)
        ->setTransformer(new VendasTransformer)
        ->rawColumns(['action'])
        ->toJson();
    }

    public function Produto(Request $request){

        $query = Produto::query();

        $termos = $request->only('pro_nome', 'tpp_id', 'mat_id');

        foreach ($termos as $nome => $valor) {
            if ($valor) {
                $query->where($nome, 'LIKE', '%' . $valor . '%');
            }
        }

        return  DataTables::eloquent($query)
        ->setTransformer(new ProdutosTransformer)
        ->rawColumns(['action'])
        ->toJson();
    }

    public function Estoque(Request $request){

        $query = Estoque::query();

        $termos = $request->only('pro_id', 'txt_fil','est_qtde', 'dim_id');

        foreach ($termos as $nome => $valor) {
            if ($valor) {
                if($nome == 'txt_fil'){
                $query->where($nome, $valor, $request->est_qtde);
                }
                $query->where($nome, 'LIKE', '%' . $valor . '%');
            }
        }

        return  DataTables::eloquent($query)
        ->setTransformer(new EstoqueTransformer)
        ->rawColumns(['action'])
        ->toJson();
    }

    public function Fornecedores(Request $request){

        $query = Fornecedores::query();

        $termos = $request->only('for_cpf_cnpj', 'for_nome', 'for_cidade');

        foreach ($termos as $nome => $valor) {
            if ($valor) {
                $query->where($nome, 'LIKE', '%' . $valor . '%');
            }
        }

        return  DataTables::eloquent($query)
        ->addColumn('action', function($query){

            $rota = "'" . route('admin.delete.fornecedor') . "'";
            $btn = '<a class="btn btn-primary alter" data-id="'.$query->id.'" onclick="editFornecedor('.$query->id.');"><i
            class="tim-icons icon-pencil"></i></a>

            <button type="button" class="btn btn-primary red" id="excluir-for"
            name="excluir-fornecedor"
             onclick="excluir('.$query->id.', ' . $rota . ');"><i
            class="tim-icons icon-simple-remove"></i></button>';

            return $btn;
        })
        ->rawColumns(['action'])
        ->toJson();
    }
}
