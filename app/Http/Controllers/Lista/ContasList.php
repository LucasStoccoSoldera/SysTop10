<?php

namespace App\Http\Controllers\Lista;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contas_a_Pagar;
use Illuminate\Support\Facades\DB;
use App\Transformers\ContasTransformer;

class ContasList extends Controller
{
    public function listContas(Request $request){

        if($request->ajax()){

            $data1 = Contas_a_Pagar::select('con_descricao', 'con_compra',
            'con_valor_final', 'con_tipo',
            DB::raw("DATE_FORMAT(contas_a_pagar.con_data_venc, '%d/%m/%Y') as con_data_venc"), 'con_status',
            'id', 'tpg_id', 'cc_id')->where('con_status', '<>', 'Pago');


            return  DataTables::eloquent($data1)
            ->addColumn('action', function($data1){

                $rota =  "'" . route('admin.delete.conta') . "'";
                $rota_parc =  "'" . route('admin.list.parcelas') . "'";
                $btn = '

                <script>function visualizar(conta, valor, pagto, centro){preencherParcelas(conta, valor, pagto, centro);$("#modalShowParcelas").modal("show");}</script>

                <script>
                function preencherParcelas(conta, valor, pagto, centro){

                        document.getElementById(`ls_par_conta`).innerHTML = conta;
                        document.getElementById(`ls_par_valor`).innerHTML = "R$" + valor;
                        document.getElementById(`ls_par_tpg`).innerHTML = pagto;
                        document.getElementById(`ls_par_cc`).innerHTML = centro;

                        var table_parcelas = $(`#tb_parcelas`).DataTable( {
                        paging: true,
                        searching: false,
                        processing: true,
                        serverside: true,
                        ajax: {
                            type: `POST`,
                            url: '. $rota_parc. ',
                            data: conta,
                        },
                        columns: [
                            {data: "par_venda", className: "text-center"},
                            {data: "par_numero", className: "text-center"},
                            {data: "par_valor", className: "text-right", render: DataTable.render.number( `.`, `,`, 2, `R$` )},
                            {data: "par_status", className: "text-center"},
                            {data: "par_data_pagto", className: "text-center"},
                        ]
                    });
                    }
    </script>

                <button type="button" class="btn btn-primary visu" id="visu-con"
                name="visu-conta"
                onclick="visualizar('.$data1->id.', '.$data1->con_valor_final.', '.$data1->tpg_id.', '.$data1->cc_id.');"><i
                class="tim-icons icon-chart-pie-36"></i></button>

                <a href="#" class="btn btn-primary alter-min"><i
                class="tim-icons icon-pencil"></i></a>

                <button type="button" class="btn btn-primary red-min" id="excluir-con"
                name="excluir-contas"
                 onclick="excluir('.$data1->id.', ' . $rota . ');"><i
                class="tim-icons icon-simple-remove"></i></button>';

                return $btn;
            })

            ->rawColumns(['action'])
            ->toJson();
        }
    }
}
