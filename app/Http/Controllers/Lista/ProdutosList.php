<?php

namespace App\Http\Controllers\Lista;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Produto;
use App\Models\Material_Base;
use App\Models\TipoProduto;
use App\Models\Pacote;
use App\Models\Cor;
use App\Models\Dimensao;
use App\Transformers\ProdutosTransformer;
use App\Transformers\TipoProdutoTransformer;
use App\Transformers\MaterialTransformer;
use App\Transformers\DimensaoTransformer;
use App\Transformers\CorTransformer;
use App\Transformers\PacoteTransformer;

class ProdutosList extends Controller
{
    public function listProduto(Request $request){

        $dado1 = 'teste';
        $dado2 = 'teste';
        $dado3 = 'teste';

        $data = Produto::all();
        $data2 = TipoProduto::all();
        $data3 = Material_Base::all();
        $data4 = Pacote::all();
        $data5 = Dimensao::all();
        $data6 = Cor::all();



        if($request->ajax()){

            $data = Produto::all();
            $data2 = TipoProduto::all();
            $data3 = Material_Base::all();
            $data4 = Pacote::all();
            $data5 = Dimensao::all();
            $data6 = Cor::all();

            return  [DataTables::eloquent($data)
            ->setTransformer(new ProdutosTransformer)
            ->addColumn('Ações', function($data){

                $btn = '<a href="#" class="btn btn-primary" id="alter"><i
                class="tim-icons icon-pencil"></i></a>';
                $btn = ' <button class="btn btn-primary red" id="excluir-cli"
                name="excluir-cliente" data-id=" '.$data->id.' " data-rota=" '. route('admin.delete.produto') .'"
                style="padding: 11px 25px;"><i
                class="tim-icons icon-simple-remove"></i></button>';

                return $btn;
            })

            ->rawColumns(['action'])
            ->make(true)

            ,

                DataTables::eloquent($data2)
                ->setTransformer(new TipoProdutoTransformer)
                ->addColumn('Ações', function($data2){

                $btn = '<a href="#" class="btn btn-primary" id="alter"><i
                class="tim-icons icon-pencil"></i></a>';
                $btn = ' <button class="btn btn-primary red" id="excluir-cli"
                name="excluir-cliente" data-id=" '.$data2->id.' " data-rota=" '. route('admin.delete.tipoproduto') .'"
                style="padding: 11px 25px;"><i
                class="tim-icons icon-simple-remove"></i></button>';

                return $btn;
            })

            ->rawColumns(['action'])
            ->make(true)

            ,

            DataTables::eloquent($data3)
            ->setTransformer(new MaterialTransformer)
            ->addColumn('Ações', function($data3){

                $btn = '<a href="#" class="btn btn-primary" id="alter"><i
                class="tim-icons icon-pencil"></i></a>';
                $btn = ' <button class="btn btn-primary red" id="excluir-cli"
                name="excluir-cliente" data-id=" '.$data3->id.' " data-rota=" '. route('admin.delete.material') .'"
                style="padding: 11px 25px;"><i
                class="tim-icons icon-simple-remove"></i></button>';

                return $btn;
            })

            ->rawColumns(['action'])
            ->make(true)

            ,

            DataTables::eloquent($data4)
            ->setTransformer(new DimensaoTransformer)
            ->addColumn('Ações', function($data4){

                $btn = '<a href="#" class="btn btn-primary" id="alter"><i
                class="tim-icons icon-pencil"></i></a>';
                $btn = ' <button class="btn btn-primary red" id="excluir-cli"
                name="excluir-cliente" data-id=" '.$data4->id.' " data-rota=" '. route('admin.delete.pacote') .'"
                style="padding: 11px 25px;"><i
                class="tim-icons icon-simple-remove"></i></button>';

                return $btn;
            })

            ->rawColumns(['action'])
            ->make(true)

            ,

            DataTables::eloquent($data5)
            ->setTransformer(new CorTransformer)
            ->addColumn('Ações', function($data5){

                $btn = '<a href="#" class="btn btn-primary" id="alter"><i
                class="tim-icons icon-pencil"></i></a>';
                $btn = ' <button class="btn btn-primary red" id="excluir-cli"
                name="excluir-cliente" data-id=" '.$data5->id.' " data-rota=" '. route('admin.delete.dimensao') .'"
                style="padding: 11px 25px;"><i
                class="tim-icons icon-simple-remove"></i></button>';

                return $btn;
            })

            ->rawColumns(['action'])
            ->make(true)

            ,

            DataTables::eloquent($data6)
            ->setTransformer(new PacoteTransformer)
            ->addColumn('Ações', function($data6){

                $btn = '<a href="#" class="btn btn-primary" id="alter"><i
                class="tim-icons icon-pencil"></i></a>';
                $btn = ' <button class="btn btn-primary red" id="excluir-cli"
                name="excluir-cliente" data-id=" '.$data6->id.' " data-rota=" '. route('admin.delete.cor') .'"
                style="padding: 11px 25px;"><i
                class="tim-icons icon-simple-remove"></i></button>';

                return $btn;
            })

            ->rawColumns(['action'])
            ->make(true)
        ];
        }
    }
}
