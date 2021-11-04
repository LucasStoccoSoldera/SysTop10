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
        $where = '';

        if(isset($request->filtro_id)){
        $id = $request->filtro_id;
        $where += "->where('usuario.id','=',$id)";
        }

        if(isset($request->filtro_id) && isset($request->filtro_nome)){
            $where += ' and ';
        }

        if(isset($request->filtro_nome)){
        $nome = $request->filtro_nome;
        $where += "->where('usu_nome_completo', 'like', '%$nome%')";
        }

        if(isset($request->filtro_nome) && isset($request->filtro_cargo)){
            $where += ' and ';
        }

        if(isset($request->filtro_cargo)){
        $cargo = $request->filtro_cargo;
        $where += "->where('car_id', '=' ,$cargo)";
        }


        $data = Usuario::select('usuario.id', 'usu_nome_completo', 'car_descricao', 'usu_celular',
        DB::raw("DATE_FORMAT(usuario.usu_data_cadastro, '%d/%m/%Y') as usu_data_cadastro "))
        ->join('cargo', 'usuario.car_id', '=', 'cargo.id') . $where;

        return  DataTables::eloquent($data)
        ->setTransformer(new UserTransformer)
        ->rawColumns(['action'])
        ->toJson();

    }

    public function Cliente(Request $request){

        $where = '';


        if(isset($request->filtro_nome)){
        $nome = $request->filtro_nome;
        $where += "->where('cli_nome', 'like', '%$nome%')";
        }

        if(isset($request->filtro_nome) && isset($request->filtro_doc)){
            $where += ' and ';
        }

        if(isset($request->filtro_doc)){
        $documento = $request->filtro_doc;
        $where += "->where('cli_cpf_cnpj', 'like', '%$documento%')";
        }

        if(isset($request->filtro_doc) && isset($request->filtro_cidade)){
            $where += ' and ';
        }

        if(isset($request->filtro_cidade)){
        $cidade = $request->filtro_cidade;
        $where += "->where('cli_cidade', 'like', '% $cidade%')";
        }

        if(isset($request->filtro_cidade) && isset($request->filtro_cidade)){
            $where += ' and ';
        }

        if(isset($request->filtro_cidade)){
        $data_create = $request->filtro_data;
        $where += "->where('created_at', '=', $cidade)";
        }

        $data = Cliente::select('id', 'cli_nome', 'cli_cpf_cnpj', 'cli_celular', 'cli_cidade', 'created_at') . $where;

        return  DataTables::eloquent($data)
        ->addColumn('action', function($data){

            $rota = "'" .  route('admin.delete.cliente') . "'";
            $btn = '<a class="btn btn-primary alter" data-id="'.$data->id.'"><i
            class="tim-icons icon-pencil" onclick="editCliente('.$data->id.');"></i></a>

            <button type="button" class="btn btn-primary red" id="excluir-cli"
            name="excluir-cliente"
            onclick="excluir('.$data->id.', ' . $rota .');"><i
            class="tim-icons icon-simple-remove"></i></button>';

            return $btn;
        })
        ->rawColumns(['action'])
        ->toJson();
    }

    public function Contas(Request $request){

        $where = '';

        if(isset($request->txt_data_venc)){
        $vencimento = $request->txt_data_venc;
        $where += "->where('con_data_venc', '=', $vencimento)";
        }

        if(isset($request->txt_data_venc) && isset($request->txt_data_pag)){
            $where += ' and ';
        }

        if(isset($request->txt_data_pag)){
        $pagamento = $request->txt_data_pag;
        $where += "->where('con_data_pag', '=', $pagamento)";
        }

        if(isset($request->txt_data_pag) && isset($request->txt_centro)){
            $where += ' and ';
        }

        if(isset($request->txt_centro)){
        $centro_custo = $request->txt_centro;
        $where += "->where('cc_id', '=', $centro_custo)";
        }

        $data1 = Contas_a_Pagar::select('con_descricao', 'con_compra',
        'con_valor_final', 'con_tipo',
        DB::raw("DATE_FORMAT(contas_a_pagar.con_data_venc, '%d/%m/%Y') as con_data_venc"), 'con_status',
        'id', 'tpg_id', 'cc_id')->where('con_status', '<>', 'Pago') . $where;


        return  DataTables::eloquent($data1)
        ->addColumn('action', function($data1){

            $rota =  "'" . route('admin.delete.conta') . "'";
            $btn = '


            <button type="button" class="parcelas btn btn-primary visu" id="visu-con"
            name="visu-conta"
            data-id = "'.$data1->id.'"
            data-valor = "'.$data1->con_valor_final.'"
            data-tpg = "'.$data1->tpg_id.'"
            data-cc = "'.$data1->cc_id.'"
            ><i
            class="tim-icons icon-chart-pie-36"></i></button>

            <a class="btn btn-primary alter-min"><i
            class="tim-icons icon-pencil" onclick="editConta('.$data1->id.');"></i></a>

            <button type="button" class="btn btn-primary red-min" id="excluir-con"
            name="excluir-contas"
             onclick="excluir('.$data1->id.', ' . $rota . ');"><i
            class="tim-icons icon-simple-remove"></i></button>';

            return $btn;
        })

        ->rawColumns(['action'])
        ->toJson();
    }

    public function ContasaReceber(Request $request){

        $where = '';


        if(isset($request->txt_descricao)){
        $descricao = $request->txt_descricao;
        $where += "->where('rec_descricao', 'like', '%$descricao%')";
        }

        if(isset($request->txt_descricao) && isset($request->txt_data)){
            $where += ' and ';
        }

        if(isset($request->txt_data)){
        $data_create = $request->txt_data;
        $where += "->where('rec_data', '=', $data_create)";
        }

        if(isset($request->txt_data) && isset($request->txt_status)){
            $where += ' and ';
        }

        if(isset($request->txt_status)){
        $status = $request->txt_status;
        $where += "->where('rec_status', 'like', '%$status%')";
        }

        $data = Contas_a_Receber::select('contas_a_receber.id', 'rec_descricao', 'rec_ven_id', 'rec_parcelas', 'rec_valor',
            DB::raw("DATE_FORMAT(contas_a_receber.rec_data, '%d/%m/%Y') as rec_data"), 'rec_status',
            'id', 'tpg_id')->where('rec_status', '<>', 'Baixa') . $where;

            return  DataTables::eloquent($data)
            ->addColumn('action', function($data){

                $rota = "'" .  route('admin.delete.receber') . "'";
                $btn = '

                <button type="button" class="parcelas btn btn-primary visu" id="visu-rec"
                name="visu-receber"
                data-id = "'.$data->id.'"
                data-valor = "'.$data->con_valor_final.'"
                data-tpg = "'.$data->tpg_id.'"
                data-data = "'.$data->rec_data.'"
                ><i
                class="tim-icons icon-chart-pie-36"></i></button>

                <a class="btn btn-primary alter-min"><i
                class="tim-icons icon-pencil" onclick="editReceber('.$data->id.');"></i></a>

                <button type="button" class="btn btn-primary red-min" id="excluir-rec"
                name="excluir-receber"
                onclick="excluir('.$data->id.', ' . $rota . ');"><i
                class="tim-icons icon-simple-remove"></i></button>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function Vendas(Request $request){

        $where = '';

        if(isset($request->txt_cliente)){
        $cliente = $request->txt_cliente;
        $where += "->where('cliente.cli_nome', 'like', '%$cliente%')";
        }

        if(isset($request->txt_cliente) && isset($request->txt_data)){
            $where += ' and ';
        }

        if(isset($request->txt_data)){
        $data_create = $request->txt_data;
        $where += "->where('ven_data', '=', $data_create)";
        }

        if(isset($request->txt_data) && isset($request->txt_valor)){
            $where += ' and ';
        }

        if(isset($request->txt_valor)){
        $operacao = $request->txt_fil;
        $valor = $request->txt_valor;
        $where += "->where('ven_valor_total', $operacao, '%$valor%')";
        }

        $data = Venda::query();
        $data = Venda::select('vendas.id', 'cliente.cli_nome', '(vendas_detalhe.det_valor_total * vendas_detalhe.det_qtde) AS ven_valor_total', 'ven_status', 'ven_parcelas',
        DB::raw("DATE_FORMAT(vendas.ven_data, '%d/%m/%Y %H:%i') as ven_data"))
        ->join('cliente', 'vendas.cli_id', '=', 'cliente.id')
        ->join('vendas_detalhe', 'vendas.id', '=', 'vendas_detalhe.ven_id') . $where;

        return  DataTables::eloquent($data)
        ->setTransformer(new VendasTransformer)
        ->rawColumns(['action'])
        ->toJson();
    }

    public function Produto(Request $request){


        $where = '';

        if(isset($request->txt_nome)){
        $nome = $request->txt_nome;
        $where += "->where('pro_nome', 'like', '%$nome%')";
        }

        if(isset($request->txt_nome) && isset($request->txt_tpp)){
            $where += ' and ';
        }

        if(isset($request->txt_tpp)){
        $tipo = $request->txt_tpp;
        $where += "->where('tpp_id', '=', $tipo)";
        }

        if(isset($request->txt_tpp) && isset($request->txt_material)){
            $where += ' and ';
        }

        if(isset($request->txt_material)){
        $material = $request->txt_material;
        $where += "->where('mat_id', '=', $material)";
        }

        $data = Produto::select('produto.id', 'pro_nome', 'tpp_descricao',
        'pro_precocusto',
        'pro_precovenda')
        ->join('tipoproduto', 'produto.tpp_id', '=', 'tipoproduto.id') . $where;

        return  DataTables::eloquent($data)
        ->setTransformer(new ProdutosTransformer)
        ->rawColumns(['action'])
        ->toJson();
    }

    public function Estoque(Request $request){


        $where = '';

        if(isset($request->txt_produto)){
        $produto = $request->txt_produto;
        $where += "->where('pro_id', '=', $produto)";
        }

        if(isset($request->txt_produto) && isset($request->txt_qtde)){
            $where += ' and ';
        }

        if(isset($request->txt_qtde)){
        $operacao = $request->txt_fil;
        $qtde = $request->txt_qtde;
        $where += "->where('est_qtde', $operacao, $qtde)";
        }

        if(isset($request->txt_qtde) && isset($request->txt_dimensao)){
            $where += ' and ';
        }

        if(isset($request->txt_dimensao)){
        $dimensao = $request->txt_dimensao;
        $where += "->where('dim_id', '=', $dimensao)";
        }

        $data = Estoque::select('pro_id', 'est_qtde', 'dim_descricao', 'cor_nome',
        DB::raw("DATE_FORMAT(estoque.est_data, '%d/%m/%Y') as est_data"),
        'est_time')
        ->join('produto', 'estoque.pro_id', '=', 'produto.id')
        ->join('dimensoes', 'estoque.dim_id', '=', 'dimensoes.id')
        ->join('cores', 'estoque.cor_id', '=', 'cores.id') . $where;

        return  DataTables::eloquent($data)
        ->setTransformer(new EstoqueTransformer)
        ->rawColumns(['action'])
        ->toJson();
    }

    public function Fornecedores(Request $request){


        $where = '';

        if(isset($request->txt_cpf_cnpj)){
        $documento = $request->txt_cpf_cnpj;
        $where += "->where('for_cpf_cnpj', 'like', '%$documento%')";
        }

        if(isset($request->txt_cpf_cnpj) && isset($request->txt_nome)){
            $where += ' and ';
        }

        if(isset($request->txt_nome)){
        $nome = $request->txt_nome;
        $where += "->where('for_nome', 'like', '%$nome%')";
        }

        if(isset($request->txt_nome) && isset($request->txt_cidade)){
            $where += ' and ';
        }

        if(isset($request->txt_cidade)){
        $cidade = $request->txt_cidade;
        $where += "->where('for_cidade', 'like', '%$cidade%')";
        }

        $data = Fornecedores::query() . $where;

        return  DataTables::eloquent($data)
        ->addColumn('action', function($data){

            $rota = "'" . route('admin.delete.fornecedor') . "'";
            $btn = '<a class="btn btn-primary alter" data-id="'.$data->id.'"><i
            class="tim-icons icon-pencil" onclick="editFornecedor('.$data->id.');"></i></a>

            <button type="button" class="btn btn-primary red" id="excluir-for"
            name="excluir-fornecedor"
             onclick="excluir('.$data->id.', ' . $rota . ');"><i
            class="tim-icons icon-simple-remove"></i></button>';

            return $btn;
        })
        ->rawColumns(['action'])
        ->toJson();
    }
}
