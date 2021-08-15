<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['auth']], function () {

    Route::get('/admin', [App\Http\Controllers\LoginController::class, 'dashboard'])->name('admin');
    Route::post('/admin/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('admin.logout');

    Route::get('/admin/Usuario', [App\Http\Controllers\UserController::class, 'Usuario'])->name('admin.usuario');
    Route::get('/admin/Cliente', [App\Http\Controllers\ClienteController::class, 'Cliente'])->name('admin.cliente');
    Route::get('/admin/Financeiro', [App\Http\Controllers\FinanceiroController::class, 'Financeiro'])->name('admin.financeiro');
    Route::get('/admin/Contas', [App\Http\Controllers\ContasController::class, 'Contas'])->name('admin.Contas');
    Route::get('/admin/Contas_soma', [App\Http\Controllers\ContasController::class, 'SomaItens'])->name('admin.contas.soma');
    Route::get('/admin/ContasaReceber', [App\Http\Controllers\ContasaReceberController::class, 'ContasaReceber'])->name('admin.ContasaReceber');
    Route::get('/admin/Vendas', [App\Http\Controllers\VendasController::class, 'Vendas'])->name('admin.Vendas');
    Route::get('/admin/Produto', [App\Http\Controllers\ProdutosController::class, 'Produto'])->name('admin.produto');
    Route::get('/admin/Estoque', [App\Http\Controllers\EstoqueController::class, 'Estoque'])->name('admin.estoque');
    Route::get('/admin/Fornecedor', [App\Http\Controllers\FornecedoresController::class, 'Fornecedores'])->name('admin.fornecedor');
    Route::get('/admin/Detalhe', [App\Http\Controllers\DetalhesController::class, 'Detalhe'])->name('admin.detalhe');
    Route::get('/admin/Logistica', [App\Http\Controllers\LogisticaController::class, 'Logistica'])->name('admin.Logistica');

    Route::get('/admin/List_Usuario', [App\Http\Controllers\Lista\UserList::class, 'listUser'])->name('admin.list.user');
    Route::get('/admin/List_Cliente', [App\Http\Controllers\Lista\ClienteList::class, 'listCliente'])->name('admin.list.cliente');
    Route::get('/admin/List_Financeiro', [App\Http\Controllers\Lista\FinanceiroList::class, 'listFinanceiro'])->name('admin.list.financeiro');
    Route::get('/admin/List_Contas', [App\Http\Controllers\Lista\ContasList::class, 'listContas'])->name('admin.list.contas');
    Route::get('/admin/List_ContasaReceber', [App\Http\Controllers\Lista\ContasaReceberList::class, 'listContasaReceber'])->name('admin.list.contasareceber');
    Route::get('/admin/List_Vendas', [App\Http\Controllers\Lista\VendasList::class, 'listVendas'])->name('admin.list.vendas');
    Route::get('/admin/List_Produto', [App\Http\Controllers\Lista\ProdutosList::class, 'listProduto'])->name('admin.list.produto');
    Route::get('/admin/List_Estoque', [App\Http\Controllers\Lista\EstoqueList::class, 'listEstoque'])->name('admin.list.estoque');
    Route::get('/admin/List_Fornecedor', [App\Http\Controllers\Lista\FornecedoresList::class, 'listFornecedores'])->name('admin.list.fornecedor');
    Route::get('/admin/List_Detalhe', [App\Http\Controllers\Lista\DetalhesList::class, 'listDetalhe'])->name('admin.list.detalhe');
    Route::get('/admin/List_Logistica', [App\Http\Controllers\Lista\LogisticaList::class, 'listLogistica'])->name('admin.list.logistica');

    Route::post('/admin/Usuario/Registrar_usuario', [App\Http\Controllers\Register\UserRegister::class, 'createUser'])->name('admin.create.user');
    Route::post('/admin/Usuario/Registrar_cargo', [App\Http\Controllers\Register\CargoRegister::class, 'createCargo'])->name('admin.create.cargo');
    Route::post('/admin/Usuario/Registrar_privilegio', [App\Http\Controllers\Register\PrivilegioRegister::class, 'createPrivilegio'])->name('admin.create.privilegio');
    Route::post('/admin/Financeiro/Registrar_conta', [App\Http\Controllers\Register\ContasRegister::class, 'createPagar'])->name('admin.create.conta');
    Route::post('/admin/Financeiro/Registrar_compra', [App\Http\Controllers\Register\CompraRegister::class, 'createCompra'])->name('admin.create.compra');
    Route::post('/admin/Financeiro/Registrar_itemcompra', [App\Http\Controllers\Register\CompraRegister::class, 'createItemCompra'])->name('admin.create.itemcompra');
    Route::post('/admin/Financeiro/Registrar_credito', [App\Http\Controllers\Register\ContasaReceberRegister::class, 'createReceber'])->name('admin.create.receber');
    Route::post('/admin/Financeiro/Registrar_venda', [App\Http\Controllers\Register\VendasRegister::class, 'createVenda'])->name('admin.create.venda');
    Route::post('/admin/Financeiro/Registrar_item_venda', [App\Http\Controllers\Register\VendasRegister::class, 'createItemVenda'])->name('admin.create.itemvenda');
    Route::post('/admin/Produto/Registrar_produto', [App\Http\Controllers\Register\ProdutoRegister::class, 'createProduto'])->name('admin.create.produto');
    Route::post('/admin/Produto/Registrar_material_base', [App\Http\Controllers\Register\MaterialBaseRegister::class, 'createMaterialBase'])->name('admin.create.material');
    Route::post('/admin/Produto/Registrar_tipo_produto', [App\Http\Controllers\Register\TipoProdutoRegister::class, 'createTipoProduto'])->name('admin.create.tipoproduto');
    Route::post('/admin/Produto/Registrar_pacote', [App\Http\Controllers\Register\PacoteRegister::class, 'createPacote'])->name('admin.create.pacote');
    Route::post('/admin/Produto/Registrar_cor', [App\Http\Controllers\Register\CorRegister::class, 'createCor'])->name('admin.create.cor');
    Route::post('/admin/Produto/Registrar_dimensao', [App\Http\Controllers\Register\DimensaoRegister::class, 'createDimensao'])->name('admin.create.dimensao');
    Route::post('/admin/Estoque/Registrar_estoque', [App\Http\Controllers\Register\EstoqueRegister::class, 'createEstoque'])->name('admin.create.estoque');
    Route::post('/admin/Fornecedor/Registrar_fornecedor', [App\Http\Controllers\Register\FornecedorRegister::class, 'createFornecedor'])->name('admin.create.fornecedor');
    Route::post('/admin/Detalhe/Registrar_centro_custo', [App\Http\Controllers\Register\CentroCustoRegister::class, 'createCentroCusto'])->name('admin.create.centrocusto');
    Route::post('/admin/Detalhe/Registrar_tipo_pagamento', [App\Http\Controllers\Register\TipoPagtoRegister::class, 'createTipoPagto'])->name('admin.create.tpgpagto');
    Route::post('/admin/Logistica/Registrar_transportadora', [App\Http\Controllers\Register\TransportadoraRegister::class, 'createTransportadora'])->name('admin.create.transportadora');
    Route::post('/admin/Logistica/Registrar_logistica', [App\Http\Controllers\Register\LogisticaRegister::class, 'createLogistica'])->name('admin.create.logistica');

    Route::post('/admin/Usuario/Delete_usuario', [App\Http\Controllers\Delete\UserDelete::class, 'deleteUser'])->name('admin.delete.user');
    Route::post('/admin/Usuario/Delete_cargo', [App\Http\Controllers\Delete\CargoDelete::class, 'deleteCargo'])->name('admin.delete.cargo');
    Route::post('/admin/Usuario/Delete_privilegio', [App\Http\Controllers\Delete\PrivilegioDelete::class, 'deletePrivilegio'])->name('admin.delete.privilegio');
    Route::post('/admin/Cliente/Delete_cliente', [App\Http\Controllers\Delete\ClienteDelete::class, 'deleteCliente'])->name('admin.delete.cliente');
    Route::post('/admin/Financeiro/Delete_conta', [App\Http\Controllers\Delete\ContasDelete::class, 'deleteConta'])->name('admin.delete.conta');
    Route::post('/admin/Financeiro/Delete_compra', [App\Http\Controllers\Delete\ContasDelete::class, 'deleteCompra'])->name('admin.delete.compra');
    Route::post('/admin/Financeiro/Delete_item_compra', [App\Http\Controllers\Delete\ContasDelete::class, 'deleteItemCompra'])->name('admin.delete.itemcompra');
    Route::post('/admin/Financeiro/Delete_credito', [App\Http\Controllers\Delete\ContasaReceberDelete::class, 'deleteReceber'])->name('admin.delete.receber');
    Route::post('/admin/Financeiro/Delete_item_venda', [App\Http\Controllers\Delete\VendasDelete::class, 'deleteItemVenda'])->name('admin.delete.itemvenda');
    Route::post('/admin/Financeiro/Delete_venda', [App\Http\Controllers\Delete\VendasDelete::class, 'deleteVenda'])->name('admin.delete.venda');
    Route::post('/admin/Produto/Delete_produto', [App\Http\Controllers\Delete\ProdutoDelete::class, 'deleteProduto'])->name('admin.delete.produto');
    Route::post('/admin/Produto/Delete_material', [App\Http\Controllers\Delete\MaterialBaseDelete::class, 'deleteMaterialBase'])->name('admin.delete.material');
    Route::post('/admin/Produto/Delete_tipo_produto', [App\Http\Controllers\Delete\TipoProdutoDelete::class, 'deleteTipoProduto'])->name('admin.delete.tipoproduto');
    Route::post('/admin/Produto/Delete_pacote', [App\Http\Controllers\Delete\PacoteDelete::class, 'deletePacote'])->name('admin.delete.pacote');
    Route::post('/admin/Produto/Delete_cor', [App\Http\Controllers\Delete\CorDelete::class, 'deleteCor'])->name('admin.delete.cor');
    Route::post('/admin/Produto/Delete_dimensao', [App\Http\Controllers\Delete\DimensaoDelete::class, 'deleteDimensao'])->name('admin.delete.dimensao');
    Route::post('/admin/Estoque/Delete_estoque', [App\Http\Controllers\Delete\EstoqueDelete::class, 'deleteEstoque'])->name('admin.delete.estoque');
    Route::post('/admin/Fornecedor/Delete_fornecedor', [App\Http\Controllers\Delete\FornecedorDelete::class, 'deleteFornecedor'])->name('admin.delete.fornecedor');
    Route::post('/admin/Detalhe/Delete_centro_custo', [App\Http\Controllers\Delete\CentroCustoDelete::class, 'deleteCentroCusto'])->name('admin.delete.centrocusto');
    Route::post('/admin/Detalhe/Delete_tipo_pagamento', [App\Http\Controllers\Delete\TipoPagtoDelete::class, 'deleteTipoPagto'])->name('admin.delete.tpgpagto');
    Route::post('/admin/Logistica/Delete_transportadora', [App\Http\Controllers\Delete\LogisticaDelete::class, 'deleteTransportadora'])->name('admin.delete.transportadora');
    Route::post('/admin/Logistica/Delete_logistica', [App\Http\Controllers\Delete\LogisticaDelete::class, 'deleteLogistica'])->name('admin.delete.logistica');

    Route::put('/admin/Usuario/Update', [App\Http\Controllers\Update\UserUpdate::class, 'updateUser'])->name('admin.update.user');
    Route::put('/admin/Usuario/Cargo', [App\Http\Controllers\Update\CargoUpdate::class, 'updateCargo'])->name('admin.update.cargo');
    Route::put('/admin/Usuario/Privilegio', [App\Http\Controllers\Update\PrivilegioUpdate::class, 'updatePrivilegio'])->name('admin.update.privilegio');
    Route::put('/admin/Cliente/Update', [App\Http\Controllers\Update\ClienteUpdate::class, 'updateCliente'])->name('admin.update.cliente');
    Route::put('/admin/Financeiro/Update', [App\Http\Controllers\Update\ContasUpdate::class, 'updateConta'])->name('admin.update.conta');
    Route::put('/admin/Financeiro/Update', [App\Http\Controllers\Update\ContasaReceberUpdate::class, 'updateReceber'])->name('admin.update.receber');
    Route::put('/admin/Financeiro/Update', [App\Http\Controllers\Update\VendasUpdate::class, 'updateVenda'])->name('admin.update.venda');
    Route::put('/admin/Produto/Update', [App\Http\Controllers\Update\ProdutoUpdate::class, 'updateProduto'])->name('admin.update.produto');
    Route::put('/admin/Produto/Update', [App\Http\Controllers\Update\MaterialBaseUpdate::class, 'updateMaterialBase'])->name('admin.update.material');
    Route::put('/admin/Produto/Update', [App\Http\Controllers\Update\TipoProdutoUpdate::class, 'updateTipoProduto'])->name('admin.update.tipoproduto');
    Route::put('/admin/Produto/Update', [App\Http\Controllers\Update\PacoteUpdate::class, 'updatePacote'])->name('admin.update.pacote');
    Route::put('/admin/Produto/Update', [App\Http\Controllers\Update\CorUpdate::class, 'updateCor'])->name('admin.update.cor');
    Route::put('/admin/Produto/Update', [App\Http\Controllers\Update\DimensaoUpdate::class, 'updateDimensao'])->name('admin.update.dimensao');
    Route::put('/admin/Estoque/Update', [App\Http\Controllers\Update\EstoqueUpdate::class, 'updateEstoque'])->name('admin.update.estoque');
    Route::put('/admin/Fornecedor/Update', [App\Http\Controllers\Update\FornecedorUpdate::class, 'updateFornecedor'])->name('admin.update.fornecedor');
    Route::put('/admin/Detalhe/Update', [App\Http\Controllers\Update\CentroCustoUpdate::class, 'updateCentroCusto'])->name('admin.update.centrocusto');
    Route::put('/admin/Detalhe/Update', [App\Http\Controllers\Update\TipoPagtoUpdate::class, 'updateTipoPagto'])->name('admin.update.tpgpagto');
    Route::put('/admin/Logistica/Update', [App\Http\Controllers\Update\TransportadoraUpdate::class, 'updateTransportadora'])->name('admin.update.transportadora');
    Route::put('/admin/Logistica/Update', [App\Http\Controllers\Update\LogisticaUpdate::class, 'updateLogistica'])->name('admin.update.logistica');
});


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/Registrar_cliente', [App\Http\Controllers\Register\ClienteRegister::class, 'createCliente'])->name('admin.create.cliente');
Route::get('/admin/login', [App\Http\Controllers\LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login/do', [App\Http\Controllers\LoginController::class, 'login'])->name('admin.login.do');
