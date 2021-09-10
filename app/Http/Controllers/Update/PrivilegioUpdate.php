<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\Models\Privilegio;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrivilegioUpdate extends Controller
{

    protected function  editCargo(Request $request)
    {
        $object = Privilegio::find($request->IDEdit)->get();
        return response()->json(compact('object'));
    }

    protected function updateCargo(Request $request)
    {
        $dataForm = $request->all();
        $dataForm['usuarioPrivilegio'] = (!isset($dataForm['usuarioPrivilegio'])) ? 0 : 1;
        $dataForm['clientePrivilegio'] = (!isset($dataForm['clientePrivilegio'])) ? 0 : 1;
        $dataForm['financeiroPrivilegio'] = (!isset($dataForm['financeiroPrivilegio'])) ? 0 : 1;
        $dataForm['produtoPrivilegio'] = (!isset($dataForm['produtoPrivilegio'])) ? 0 : 1;
        $dataForm['estoquePrivilegio'] = (!isset($dataForm['estoquePrivilegio'])) ? 0 : 1;
        $dataForm['fornecedorPrivilegio'] = (!isset($dataForm['fornecedorPrivilegio'])) ? 0 : 1;
        $dataForm['detalhePrivilegio'] = (!isset($dataForm['detalhePrivilegio'])) ? 0 : 1;
        $dataForm['logisticaPrivilegio'] = (!isset($dataForm['logisticaPrivilegio'])) ? 0 : 1;

        $validator = Validator::make(
            $dataForm,
            [
                'cargoPrivilegio' => ['required'],
                'usuarioPrivilegio' => ['required'],
                'clientePrivilegio' => ['required'],
                'financeiroPrivilegio' => ['required'],
                'produtoPrivilegio' => ['required'],
                'estoquePrivilegio' => ['required'],
                'fornecedorPrivilegio' => ['required'],
                'detalhePrivilegio' => ['required'],
                'logisticaPrivilegio' => ['required'],
            ],
            [
                'cargoPrivilegio.required' => 'Cargo obrigatório.',
                'usuarioPrivilegio.required' => 'Usuário precisa de valor.',
                'clientePrivilegio.required' => 'Cliente precisa de valor.',
                'financeiroPrivilegio.required' => 'Financeiro precisa de valor.',
                'produtoPrivilegio.required' => 'Produto precisa de valor.',
                'estoquePrivilegio.required' => 'Estoque precisa de valor.',
                'fornecedorPrivilegio.required' => 'Fornecedor precisa de valor.',
                'detalhePrivilegio.required' => 'Detalhe precisa de valor.',
                'logisticaPrivilegio.required' => 'Logistica precisa de valor.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()]);
        }

        $car_priv = DB::table('privilegio')
            ->join('cargo', 'privilegio.pri_id', '=', 'cargo.pri_id')
            ->select('privilegio.*')
            ->where('privilegio.pri_id', '=', $request->cargoPrivilegio)
            ->get();

        DB::inset("insert into privilegio (pri_usuarios, pri_clientes, pri_financeiro,
        pri_produtos, pri_estoque, pri_fornecedores, pri_detalhes, pri_logistica)
        values ($request->usuarioPrivilegio, $request->clientePrivilegio, $request->financeiroPrivilegio,
        $request->produtoPrivilegio, $request->estoquePrivilegio, $request->fornecedorPrivilegio,
        $request->detalhePrivilegio, $request->logisticaPrivilegio) where pri_id = $car_priv");

        return response()->json(['status' => 1, 'msg' => 'Privilegios Atualizados com sucesso!']);
    }
}
