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
    Route::get('/admin/Logistica', [App\Http\Controllers\LogisticaController::class, 'Logistica'])->name('admin.logistica');

    Route::get('/admin/Autocomplete_cli_cli', [App\Http\Controllers\AutocompleteController::class, 'Cli_Nome'])->name('admin.autocomplete.cli.nome');
    Route::get('/admin/Autocomplete_rec_des', [App\Http\Controllers\AutocompleteController::class, 'Rec_Descricao'])->name('admin.autocomplete.rec.descricao');
    Route::get('/admin/Autocomplete_for_for', [App\Http\Controllers\AutocompleteController::class, 'For_Nome'])->name('admin.autocomplete.for.nome');
    Route::get('/admin/Autocomplete_pro_pro', [App\Http\Controllers\AutocompleteController::class, 'Pro_Nome'])->name('admin.autocomplete.pro.nome');
    Route::get('/admin/Autocomplete_usu_usu', [App\Http\Controllers\AutocompleteController::class, 'Usu_Nome'])->name('admin.autocomplete.usu.nome');
    Route::get('/admin/Autocomplete_ven_cli', [App\Http\Controllers\AutocompleteController::class, 'Ven_Cliente'])->name('admin.autocomplete.ven.cliente');

    Route::get('/admin/List_Usuario', [App\Http\Controllers\Lista\UserList::class, 'listUser'])->name('admin.list.user');
    Route::get('/admin/List_Cargo', [App\Http\Controllers\Lista\CargoList::class, 'listCargo'])->name('admin.list.cargo');
    Route::get('/admin/List_Cliente', [App\Http\Controllers\Lista\ClienteList::class, 'listCliente'])->name('admin.list.cliente');
    Route::get('/admin/List_Financeiro', [App\Http\Controllers\Lista\FinanceiroList::class, 'listFinanceiro'])->name('admin.list.financeiro');
    Route::get('/admin/List_Contas', [App\Http\Controllers\Lista\ContasList::class, 'listContas'])->name('admin.list.contas');
    Route::get('/admin/List_Parcelas', [App\Http\Controllers\Lista\ParcelasList::class, 'listParcelas'])->name('admin.list.parcelas');
    Route::get('/admin/List_Compra', [App\Http\Controllers\Lista\CompraList::class, 'listCompra'])->name('admin.list.compra');
    Route::get('/admin/List_ItemCompra', [App\Http\Controllers\Lista\ItemCompraList::class, 'listItemCompra'])->name('admin.list.itemcompra');
    Route::get('/admin/List_ContasaReceber', [App\Http\Controllers\Lista\ContasaReceberList::class, 'listContasaReceber'])->name('admin.list.contasareceber');
    Route::get('/admin/List_Vendas', [App\Http\Controllers\Lista\VendasList::class, 'listVendas'])->name('admin.list.vendas');
    Route::get('/admin/List_ItemVenda', [App\Http\Controllers\Lista\ItemVendaList::class, 'listItemVenda'])->name('admin.list.itemvenda');
    Route::get('/admin/List_ItemVendaAto', [App\Http\Controllers\Lista\ItemVendaAtoList::class, 'listItemVendaAto'])->name('admin.list.itemvendaato');
    Route::get('/admin/List_Produto', [App\Http\Controllers\Lista\ProdutosList::class, 'listProduto'])->name('admin.list.produto');
    Route::get('/admin/List_Material', [App\Http\Controllers\Lista\MaterialList::class, 'listMaterial'])->name('admin.list.material');
    Route::get('/admin/List_TipoProduto', [App\Http\Controllers\Lista\TipoProdutoList::class, 'listTipoProduto'])->name('admin.list.tipoproduto');
    Route::get('/admin/List_Dimensao', [App\Http\Controllers\Lista\DimensaoList::class, 'listDimensao'])->name('admin.list.dimensao');
    Route::get('/admin/List_Cor', [App\Http\Controllers\Lista\CorList::class, 'listCor'])->name('admin.list.cor');
    Route::get('/admin/List_Pacote', [App\Http\Controllers\Lista\PacoteList::class, 'listPacote'])->name('admin.list.pacote');
    Route::get('/admin/List_Estoque', [App\Http\Controllers\Lista\EstoqueList::class, 'listEstoque'])->name('admin.list.estoque');
    Route::get('/admin/List_EstoqueProduto', [App\Http\Controllers\Lista\EstoqueProdutoList::class, 'listEstoqueProduto'])->name('admin.list.estoqueproduto');
    Route::get('/admin/List_Fornecedor', [App\Http\Controllers\Lista\FornecedoresList::class, 'listFornecedores'])->name('admin.list.fornecedor');
    Route::get('/admin/List_CentroCusto', [App\Http\Controllers\Lista\CentroCustoList::class, 'listCentroCusto'])->name('admin.list.centrocusto');
    Route::get('/admin/List_TipoPagto', [App\Http\Controllers\Lista\TipoPagtoList::class, 'listTipoPagto'])->name('admin.list.tipopagto');
    Route::get('/admin/List_Transportadora', [App\Http\Controllers\Lista\TransportadoraList::class, 'listTransportadora'])->name('admin.list.transportadora');
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
    Route::post('/admin/Produto/Registrar_cor', [App\Http\Controllers\Register\CoresRegister::class, 'createCor'])->name('admin.create.cor');
    Route::post('/admin/Produto/Registrar_cor_produto', [App\Http\Controllers\Register\CoresRegister::class, 'createCorProduto'])->name('admin.create.corproduto');
    Route::post('/admin/Produto/Registrar_dimensao', [App\Http\Controllers\Register\DimensoesRegister::class, 'createDimensao'])->name('admin.create.dimensao');
    Route::post('/admin/Produto/Registrar_dimensao_produto', [App\Http\Controllers\Register\DimensoesRegister::class, 'createDimensaoProduto'])->name('admin.create.dimensaoproduto');
    Route::post('/admin/Estoque/Registrar_estoque', [App\Http\Controllers\Register\EstoqueRegister::class, 'createEstoque'])->name('admin.create.estoque');
    Route::post('/admin/Fornecedor/Registrar_fornecedor', [App\Http\Controllers\Register\FornecedorRegister::class, 'createFornecedor'])->name('admin.create.fornecedor');
    Route::post('/admin/Detalhe/Registrar_centro_custo', [App\Http\Controllers\Register\CentroCustoRegister::class, 'createCentroCusto'])->name('admin.create.centrocusto');
    Route::post('/admin/Detalhe/Registrar_tipo_pagamento', [App\Http\Controllers\Register\TipoPagtoRegister::class, 'createTipoPagto'])->name('admin.create.tpgpagto');
    Route::post('/admin/Logistica/Registrar_transportadora', [App\Http\Controllers\Register\TransportadoraRegister::class, 'createTransportadora'])->name('admin.create.transportadora');
    Route::post('/admin/Logistica/Registrar_logistica', [App\Http\Controllers\Register\LogisticaRegister::class, 'createLogistica'])->name('admin.create.logistica');

    Route::delete('/admin/Usuario/Delete_usuario', [App\Http\Controllers\Delete\UserDelete::class, 'deleteUser'])->name('admin.delete.user');
    Route::delete('/admin/Usuario/Delete_cargo', [App\Http\Controllers\Delete\CargoDelete::class, 'deleteCargo'])->name('admin.delete.cargo');
    Route::delete('/admin/Usuario/Delete_privilegio', [App\Http\Controllers\Delete\PrivilegioDelete::class, 'deletePrivilegio'])->name('admin.delete.privilegio');
    Route::delete('/admin/Cliente/Delete_cliente', [App\Http\Controllers\Delete\ClienteDelete::class, 'deleteCliente'])->name('admin.delete.cliente');
    Route::delete('/admin/Financeiro/Delete_conta', [App\Http\Controllers\Delete\ContasDelete::class, 'deleteConta'])->name('admin.delete.conta');
    Route::delete('/admin/Financeiro/Delete_compra', [App\Http\Controllers\Delete\ContasDelete::class, 'deleteCompra'])->name('admin.delete.compra');
    Route::delete('/admin/Financeiro/Delete_item_compra', [App\Http\Controllers\Delete\ContasDelete::class, 'deleteItemCompra'])->name('admin.delete.itemcompra');
    Route::delete('/admin/Financeiro/Delete_credito', [App\Http\Controllers\Delete\ContasaReceberDelete::class, 'deleteReceber'])->name('admin.delete.receber');
    Route::delete('/admin/Financeiro/Delete_item_venda', [App\Http\Controllers\Delete\VendasDelete::class, 'deleteItemVenda'])->name('admin.delete.itemvenda');
    Route::delete('/admin/Financeiro/Delete_venda', [App\Http\Controllers\Delete\VendasDelete::class, 'deleteVenda'])->name('admin.delete.venda');
    Route::delete('/admin/Produto/Delete_produto', [App\Http\Controllers\Delete\ProdutoDelete::class, 'deleteProduto'])->name('admin.delete.produto');
    Route::delete('/admin/Produto/Delete_material', [App\Http\Controllers\Delete\MaterialBaseDelete::class, 'deleteMaterialBase'])->name('admin.delete.material');
    Route::delete('/admin/Produto/Delete_tipo_produto', [App\Http\Controllers\Delete\TipoProdutoDelete::class, 'deleteTipoProduto'])->name('admin.delete.tipoproduto');
    Route::delete('/admin/Produto/Delete_pacote', [App\Http\Controllers\Delete\PacoteDelete::class, 'deletePacote'])->name('admin.delete.pacote');
    Route::delete('/admin/Produto/Delete_cor', [App\Http\Controllers\Delete\CorDelete::class, 'deleteCor'])->name('admin.delete.cor');
    Route::delete('/admin/Produto/Delete_dimensao', [App\Http\Controllers\Delete\DimensaoDelete::class, 'deleteDimensao'])->name('admin.delete.dimensao');
    Route::delete('/admin/Estoque/Delete_estoque', [App\Http\Controllers\Delete\EstoqueDelete::class, 'deleteEstoque'])->name('admin.delete.estoque');
    Route::delete('/admin/Fornecedor/Delete_fornecedor', [App\Http\Controllers\Delete\FornecedorDelete::class, 'deleteFornecedor'])->name('admin.delete.fornecedor');
    Route::delete('/admin/Detalhe/Delete_centro_custo', [App\Http\Controllers\Delete\CentroCustoDelete::class, 'deleteCentroCusto'])->name('admin.delete.centrocusto');
    Route::delete('/admin/Detalhe/Delete_tipo_pagamento', [App\Http\Controllers\Delete\TipoPagtoDelete::class, 'deleteTipoPagto'])->name('admin.delete.tpgpagto');
    Route::delete('/admin/Logistica/Delete_transportadora', [App\Http\Controllers\Delete\LogisticaDelete::class, 'deleteTransportadora'])->name('admin.delete.transportadora');
    Route::delete('/admin/Logistica/Delete_logistica', [App\Http\Controllers\Delete\LogisticaDelete::class, 'deleteLogistica'])->name('admin.delete.logistica');

    Route::get('/admin/Usuario/Editar_usuario', [App\Http\Controllers\Update\UserUpdate::class, 'editUser'])->name('admin.edit.user');
    Route::get('/admin/Usuario/Editar_cargo', [App\Http\Controllers\Update\CargoUpdate::class, 'editCargo'])->name('admin.edit.cargo');
    Route::get('/admin/Usuario/Editar_privilegio', [App\Http\Controllers\Update\PrivilegioUpdate::class, 'editPrivilegio'])->name('admin.edit.privilegio');
    Route::get('/admin/Financeiro/Editar_conta', [App\Http\Controllers\Update\ContasUpdate::class, 'editPagar'])->name('admin.edit.conta');
    Route::get('/admin/Financeiro/Editar_compra', [App\Http\Controllers\Update\CompraUpdate::class, 'editCompra'])->name('admin.edit.compra');
    Route::get('/admin/Financeiro/Editar_itemcompra', [App\Http\Controllers\Update\CompraUpdate::class, 'editItemCompra'])->name('admin.edit.itemcompra');
    Route::get('/admin/Financeiro/Editar_credito', [App\Http\Controllers\Update\ContasaReceberUpdate::class, 'editReceber'])->name('admin.edit.receber');
    Route::get('/admin/Financeiro/Editar_venda', [App\Http\Controllers\Update\VendasUpdate::class, 'editVenda'])->name('admin.edit.venda');
    Route::get('/admin/Financeiro/Editar_item_venda', [App\Http\Controllers\Update\VendasUpdate::class, 'editItemVenda'])->name('admin.edit.itemvenda');
    Route::get('/admin/Produto/Editar_produto', [App\Http\Controllers\Update\ProdutoUpdate::class, 'editProduto'])->name('admin.edit.produto');
    Route::get('/admin/Produto/Editar_material_base', [App\Http\Controllers\Update\MaterialBaseUpdate::class, 'editMaterialBase'])->name('admin.edit.material');
    Route::get('/admin/Produto/Editar_tipo_produto', [App\Http\Controllers\Update\TipoProdutoUpdate::class, 'editTipoProduto'])->name('admin.edit.tipoproduto');
    Route::get('/admin/Produto/Editar_pacote', [App\Http\Controllers\Update\PacoteUpdate::class, 'editPacote'])->name('admin.edit.pacote');
    Route::get('/admin/Produto/Editar_cor', [App\Http\Controllers\Update\CoresUpdate::class, 'editCor'])->name('admin.edit.cor');
    Route::get('/admin/Produto/Editar_dimensao', [App\Http\Controllers\Update\DimensoesUpdate::class, 'editDimensao'])->name('admin.edit.dimensao');
    Route::get('/admin/Estoque/Editar_estoque', [App\Http\Controllers\Update\EstoqueUpdate::class, 'editEstoque'])->name('admin.edit.estoque');
    Route::get('/admin/Fornecedor/Editar_fornecedor', [App\Http\Controllers\Update\FornecedorUpdate::class, 'editFornecedor'])->name('admin.edit.fornecedor');
    Route::get('/admin/Detalhe/Editar_centro_custo', [App\Http\Controllers\Update\CentroCustoUpdate::class, 'editCentroCusto'])->name('admin.edit.centrocusto');
    Route::get('/admin/Detalhe/Editar_tipo_pagamento', [App\Http\Controllers\Update\TipoPagtoUpdate::class, 'editTipoPagto'])->name('admin.edit.tpgpagto');
    Route::get('/admin/Logistica/Editar_transportadora', [App\Http\Controllers\Update\TransportadoraUpdate::class, 'editTransportadora'])->name('admin.edit.transportadora');
    Route::get('/admin/Logistica/Editar_logistica', [App\Http\Controllers\Update\LogisticaUpdate::class, 'editLogistica'])->name('admin.edit.logistica');

    Route::put('/admin/Usuario/Atualizar_usuario', [App\Http\Controllers\Update\UserUpdate::class, 'createUser'])->name('admin.update.user');
    Route::put('/admin/Usuario/Atualizar_cargo', [App\Http\Controllers\Update\CargoUpdate::class, 'updateCargo'])->name('admin.update.cargo');
    Route::put('/admin/Usuario/Atualizar_privilegio', [App\Http\Controllers\Update\PrivilegioUpdate::class, 'updatePrivilegio'])->name('admin.update.privilegio');
    Route::put('/admin/Financeiro/Atualizar_conta', [App\Http\Controllers\Update\ContasUpdate::class, 'updatePagar'])->name('admin.update.conta');
    Route::put('/admin/Financeiro/Atualizar_compra', [App\Http\Controllers\Update\CompraUpdate::class, 'updateCompra'])->name('admin.update.compra');
    Route::put('/admin/Financeiro/Atualizar_itemcompra', [App\Http\Controllers\Update\CompraUpdate::class, 'updateItemCompra'])->name('admin.update.itemcompra');
    Route::put('/admin/Financeiro/Atualizar_credito', [App\Http\Controllers\Update\ContasaReceberUpdate::class, 'updateReceber'])->name('admin.update.receber');
    Route::put('/admin/Financeiro/Atualizar_venda', [App\Http\Controllers\Update\VendasUpdate::class, 'updateVenda'])->name('admin.update.venda');
    Route::put('/admin/Financeiro/Atualizar_item_venda', [App\Http\Controllers\Update\VendasUpdate::class, 'updateItemVenda'])->name('admin.update.itemvenda');
    Route::put('/admin/Produto/Atualizar_produto', [App\Http\Controllers\Update\ProdutoUpdate::class, 'updateProduto'])->name('admin.update.produto');
    Route::put('/admin/Produto/Atualizar_material_base', [App\Http\Controllers\Update\MaterialBaseUpdate::class, 'updateMaterialBase'])->name('admin.update.material');
    Route::put('/admin/Produto/Atualizar_tipo_produto', [App\Http\Controllers\Update\TipoProdutoUpdate::class, 'updateTipoProduto'])->name('admin.update.tipoproduto');
    Route::put('/admin/Produto/Atualizar_pacote', [App\Http\Controllers\Update\PacoteUpdate::class, 'updatePacote'])->name('admin.update.pacote');
    Route::put('/admin/Produto/Atualizar_cor', [App\Http\Controllers\Update\CoresUpdate::class, 'updateCor'])->name('admin.update.cor');
    Route::put('/admin/Produto/Atualizar_dimensao', [App\Http\Controllers\Update\DimensoesUpdate::class, 'updateDimensao'])->name('admin.update.dimensao');
    Route::put('/admin/Estoque/Atualizar_estoque', [App\Http\Controllers\Update\EstoqueUpdate::class, 'updateEstoque'])->name('admin.update.estoque');
    Route::put('/admin/Fornecedor/Atualizar_fornecedor', [App\Http\Controllers\Update\FornecedorUpdate::class, 'updateFornecedor'])->name('admin.update.fornecedor');
    Route::put('/admin/Detalhe/Atualizar_centro_custo', [App\Http\Controllers\Update\CentroCustoUpdate::class, 'updateCentroCusto'])->name('admin.update.centrocusto');
    Route::put('/admin/Detalhe/Atualizar_tipo_pagamento', [App\Http\Controllers\Update\TipoPagtoUpdate::class, 'updateTipoPagto'])->name('admin.update.tpgpagto');
    Route::put('/admin/Logistica/Atualizar_transportadora', [App\Http\Controllers\Update\TransportadoraUpdate::class, 'updateTransportadora'])->name('admin.update.transportadora');
    Route::put('/admin/Logistica/Atualizar_logistica', [App\Http\Controllers\Update\LogisticaUpdate::class, 'updateLogistica'])->name('admin.update.logistica');

});


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/Registrar_cliente', [App\Http\Controllers\Register\ClienteRegister::class, 'createCliente'])->name('admin.create.cliente');
Route::get('/admin/login', [App\Http\Controllers\LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login/do', [App\Http\Controllers\LoginController::class, 'login'])->name('admin.login.do');
