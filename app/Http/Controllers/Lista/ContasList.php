<?php

namespace App\Http\Controllers\Lista;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contas_a_Pagar;
use App\Models\TipoPagto;
use App\Models\Centro_Custo;
use App\Models\Parcelas;
use App\Models\Produto;
use App\Models\Fornecedores;
use App\Models\Compras_Detalhe;

class ContasList extends Controller
{
    public function listContas(Request $request){

        $dado1 = 'teste';
        $dado2 = 'teste';
        $dado3 = 'teste';

        $data1 = Contas_a_Pagar::all();
        $data4 = Compras_Detalhe::where('com_id', $request->IDCompra);
        $data7 = Parcelas::all();


        if($request->ajax()){

            $data1 = Contas_a_Pagar::all();
            $data4 = Compras_Detalhe::where('com_id', $request->IDCompra);
            $data7 = Parcelas::all();

            return  [DataTables::of ($data1)->addColumn('Ações', function($data1){

                $btn = '<a href="#" class="btn btn-primary" id="alter"><i
                class="tim-icons icon-pencil"></i></a>';
                $btn = ' <button class="btn btn-primary red" id="excluir-cli"
                name="excluir-cliente" data-id=" '.$data1->id.' " data-rota=" '. route('admin.delete.conta') .'"
                style="padding: 11px 25px;"><i
                class="tim-icons icon-simple-remove"></i></button>';

                return $btn;
            })

            ->rawColumns(['action'])
            ->make(true)

            ,

                DataTables::of ($data4)->addColumn('Ações', function($data4){

                $btn = '<a href="#" class="btn btn-primary" id="alter"><i
                class="tim-icons icon-pencil"></i></a>';
                $btn = ' <button class="btn btn-primary red" id="excluir-cli"
                name="excluir-cliente" data-id=" '.$data4.' " data-rota=" '. route('admin.delete.itemcompra') .'"
                style="padding: 11px 25px;"><i
                class="tim-icons icon-simple-remove"></i></button>';

                return $btn;
            })

            ->rawColumns(['action'])
            ->make(true)

            ,

            DataTables::of ($data7)
            ->make(true)
        ];
        }
    }
}
