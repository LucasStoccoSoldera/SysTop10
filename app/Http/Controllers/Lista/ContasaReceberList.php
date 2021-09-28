<?php

namespace App\Http\Controllers\Lista;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contas_a_Receber;
use Illuminate\Support\Facades\DB;
use App\Transformers\ContasaReceberTransformer;

class ContasaReceberList extends Controller
{
    public function listContasaReceber(Request $request){


        if($request->ajax()){

            $data = Contas_a_Receber::select('contas_a_receber.id', 'rec_descricao', 'rec_ven_id', 'rec_parcelas', 'rec_valor',
            DB::raw("DATE_FORMAT(contas_a_receber.rec_data, '%d/%m/%Y') as rec_data"), 'rec_status',
            'id', 'tpg_id');

            return  DataTables::eloquent($data)
            ->addColumn('action', function($data){

                $rota = "`{{route('admin.delete.receber')}}`";
                $rota_parc = "`{{route('admin.list.parcelas')}}`";
                $btn = '

                <script>function visualizar(conta, valor, pagto, data){preencherParcelas(conta, valor, pagto, data);$("#modalShowParcelas").modal("show");}</script>

                <script>
                    function preencherParcelas(conta, valor, pagto, data){

                            document.getElementById(`ls_par_conta`).innerHTML = conta;
                            document.getElementById(`ls_par_valor`).innerHTML = "R$" + valor;
                            document.getElementById(`ls_par_tpg`).innerHTML = pagto;
                        document.getElementById(`ls_par_data`).innerHTML = data;

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


                <button type="button" class="btn btn-primary visu" id="visu-rec"
                name="visu-receber"
                onclick="visualizar('.$data->id.', '.$data->rec_valor.', '.$data->tpg_id.', '.$data->rec_data.');"><i
                class="tim-icons icon-chart-pie-36"></i></button>

                <a href="#" class="btn btn-primary alter-min"><i
                class="tim-icons icon-pencil"></i></a>

                <button type="button" class="btn btn-primary red-min" id="excluir-rec"
                name="excluir-receber"
                onclick="excluir('.$data->id.', ' . $rota . ');"><i
                class="tim-icons icon-simple-remove"></i></button>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->toJson();
        }
    }
}
