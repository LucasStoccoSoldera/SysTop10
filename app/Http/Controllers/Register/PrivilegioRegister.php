<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\Models\Privilegio;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrivilegioRegister extends Controller
{
    protected function createPrivilegio(Request $request)
    {
        $request->usuarioPrivilegio = (!isset($request->usuarioPrivilegio))? 0 : 1;
        $request->clientePrivilegio = (!isset($request->clientePrivilegio))? 0 : 1;
        $request->financeiroPrivilegio = (!isset($request->financeiroPrivilegio))? 0 : 1;
        $request->produtoPrivilegio = (!isset($request->produtoPrivilegio))? 0 : 1;
        $request->estoquePrivilegio = (!isset($request->estoquePrivilegio))? 0 : 1;
        $request->fornecedorPrivilegio = (!isset($request->fornecedorPrivilegio))? 0 : 1;
        $request->detalhePrivilegio = (!isset($request->detalhePrivilegio))? 0 : 1;
        $request->logisticaPrivilegio = (!isset($request->logisticaPrivilegio))? 0 : 1;

        $validator = Validator::make(
            $request->all(),
            [
                'cargoPrivilegio' => ['required'],
            ],
            [
                'cargoPrivilegio.required' => 'Cargo obrigatório.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()]);
        }

        $car_priv = DB::table('cargo')
            ->select('pri_id')
            ->where('cargo.id', '=', $request->cargoPrivilegio)
            ->get();

        $Privilegio = new Privilegio;
        $Privilegio->pri_usuarios = $request->usuarioPrivilegio;
        $Privilegio->pri_clientes = $request->clientePrivilegio;
        $Privilegio->pri_financeiro = $request->financeiroPrivilegio;
        $Privilegio->pri_produtos = $request->produtoPrivilegio;
        $Privilegio->pri_estoque = $request->estoquePrivilegio;
        $Privilegio->pri_fornecedores = $request->fornecedorPrivilegio;
        $Privilegio->pri_detalhes = $request->detalhePrivilegio;
        $Privilegio->pri_logistica = $request->logisticaPrivilegio;
        $Privilegio->save();

        $last_priv = Privilegio::all()->last()->id;

        DB::update("update cargo set pri_id = $last_priv where id = $request->cargoPrivilegio");

        return response()->json(['status' => 1, 'msg' => 'Privilegios Atualizados com sucesso!']);
    }
}
