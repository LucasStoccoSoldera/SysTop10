function editCliente(id)
{
    $.get('/admin/Cliente/Editar_cliente/' + id, function (cliente) {
        $("#idCli").val(cliente.id);
        $("#nomeClienteUp").val(cliente.cli_nome);
        $("#usuarioClienteUp").val(cliente.cli_usuario);
        $("#cpfClienteUp").val(cliente.cli_cpf_cnpj);
        $("#cnpjClienteUp").val(cliente.cli_cpf_cnpj);
        $("#telefoneClienteUp").val(cliente.cli_telefone);
        $("#celularClienteUp").val(cliente.cli_celular);
        $("#senhaClienteUp").val(cliente.cli_senha);
        $("#cepClienteUp").val(cliente.cli_cep);
        $("#estadoClienteUp").val(cliente.cli_uf);
        $("#cidadeClienteUp").val(cliente.cli_cidade);
        $("#bairroClienteUp").val(cliente.cli_bairro);
        $("#ruaClienteUp").val(cliente.cli_logradouro);
        $("#ncasaClienteUp").val(cliente.cli_n_casa);
        $("#complementoClienteUp").val(cliente.cli_complemento);
        $("#statusClienteUp").val(cliente.cli_status);
        $("#modalUpdateCliente").modal('toggle');

    });
}

function editConta(id)
{
    $.get('/admin/Financeiro/Editar_conta/' + id, function (conta) {
        $("#idCon").val(conta.id);
        $("#descricaoContasUp").val(conta.con_descricao);
        $("#tipoContasUp").val(conta.con_tipo);
        $("#valorContasUp").val(conta.con_valor);
        $("#valorfContasUp").val(conta.con_valor_final);
        $("#parcelasContasUp").val(conta.con_parcelas);
        $("#datavContasUp").val(conta.con_data_venc);
        $("#datapContasUp").val(conta.con_data_pag);
        $("#tpgpagtoContasUp").val(conta.tpg_id);
        $("#centrocustoContasUp").val(conta.cc_id);
        $("#modalUpdateContas").modal('toggle');

    });
}

function editCompra(id)
{
    $.get('/admin/Financeiro/Editar_compra/' + id, function (compra) {
        $("#idCom").val(compra.id);
        $("#IDComprasUp").val(compra.id);
        $("#descricaoComprasUp").val(compra.com_descricao);
        $("#descontoComprasUp").val(compra.com_desconto);
        $("#ccComprasUp").val(compra.cc_id);
        $("#tpgpagtoComprasUp").val(compra.tpg_id);
        $("#parcelasComprasUp").val(compra.com_parcelas);
        $("#dataComprasUp").val(compra.com_data_compra);
        $("#datapagComprasUp").val(compra.com_data_pagto);
        $("#obsComprasUp").val(compra.com_observacoes);
        $("#modalUpdateCompras").modal('toggle');

    });
}

function editItemCompra(id)
{
    $.get('/admin/Financeiro/Editar_item_compra/' + id, function (itemcompra) {
        $("#idIteCom").val(itemcompra.id);
        $("#IDItemCompraUp").val(itemcompra.com_id);
        $("#descricaoItemCompraUp").val(itemcompra.cde_descricao);
        $("#IDFornecedorUp").val(itemcompra.for_id);
        $("#tipoItemCompraUp").val(itemcompra.cde_tipo);
        $("#valorItemCompraUp").val(itemcompra.cde_valoritem);
        $("#qtdeItemCompraUp").val(itemcompra.cde_qtde);
        $("#valorTotalItemCompraUp").val(itemcompra.cde_valortotal);
        $("#IDProdutoIUp").val(itemcompra.cde_produto);
        $("#dimensaoItemCompraUp").val(itemcompra.dim_id);
        $("#coresItemCompraUp").val(itemcompra.cor_id);
        $("#IDProdutoEUp").val(itemcompra.cde_produto);
        $("#modalUpdateItemCompra").modal('toggle');

    });
}


function editReceber(id)
{
    $.get('/admin/Financeiro/Editar_credito/' + id, function (receber) {
        $("#idRec").val(receber.id);
        $("#descricaoReceberUp").val(receber.rec_descricao);
        $("#tipoPagtoReceberUp").val(receber.tpg_id);
        $("#statusReceberUp").val(receber.rec_status);
        $("#valorReceberUp").val(receber.rec_valor);
        $("#parcelasReceberUp").val(receber.rec_parcelas);
        $("#dataReceberUp").val(receber.rec_data);
        $("#modalUpdateContasaReceber").modal('toggle');

    });
}

function editCentroCusto(id)
{
    $.get('/admin/Detalhe/Editar_centro_custo/' + id, function (centrocusto) {
        $("#idCC").val(centrocusto.id);
        $("#NomeCentroCustoUp").val(centrocusto.cc_descricao);
        $("#modalUpdateCentroCusto").modal('toggle');

    });
}

function editTpgPagto(id)
{
    $.get('/admin/Detalhe/Editar_tipo_pagamento/' + id, function (tpgpagto) {
        $("#idPag").val(tpgpagto.id);
        $("#TPTipoPagtoUp").val(tpgpagto.tpg_descricao);
        $("#modalUpdateTpgPagto").modal('toggle');

    });
}

function editEstoque(id)
{
    $.get('/admin/Estoque/Editar_estoque/' + id, function (estoque) {
        $("#idEst").val(estoque.id);
        $("#qtdeEstoqueUp").val(estoque.est_qtde);
        $("#dataEstoqueUp").val(estoque.est_data);
        $("#timeEstoqueUp").val(estoque.est_time);
        $("#statusEstoqueUp").val(estoque.est_status);
        $("#produtoEstoqueUp").val(estoque.pro_id);
        $("#IDDimensaoUp").val(estoque.dim_id);
        $("#IDCorUp").val(estoque.cor_id);
        $("#modalUpdateEstoque").modal('toggle');

    });
}

function editFornecedor(id)
{
    $.get('/admin/Fornecedor/Editar_fornecedor/' + id, function (fornecedor) {
        $("#idFor").val(fornecedor.id);
        $("#nomeFornecedorUp").val(fornecedor.for_nome);
        $("#telefoneFornecedorUp").val(fornecedor.for_telefone);
        $("#celularFornecedorUp").val(fornecedor.for_celular);
        $("#cpfFornecedorUp").val(fornecedor.for_cpf_cnpj);
        $("#cnpjFornecedorUp").val(fornecedor.for_cpf_cnpj);
        $("#produtosFornecedorUp").val(fornecedor.for_produto);
        $("#cepFornecedorUp").val(fornecedor.for_cep);
        $("#estadoFornecedorUp").val(fornecedor.for_estado);
        $("#cidadeFornecedorUp").val(fornecedor.for_cidade);
        $("#bairroFornecedorUp").val(fornecedor.for_bairro);
        $("#ruaFornecedorUp").val(fornecedor.for_rua);
        $("#ncasaFornecedorUp").val(fornecedor.for_numero);
        $("#modalUpdateFornecedores").modal('toggle');

    });
}

function editLogistica(id)
{
    $.get('/admin/Logistica/Editar_logistica/' + id, function (logistica) {
        $("#idLog").val(logistica.id);
        $("#pacoteLogisticaUp").val(logistica.pac_id);
        $("#transLogisticaUp").val(logistica.trans_id);
        $("#modalUpdateLogistica").modal('toggle');

    });
}

function editTransportadora(id)
{
    $.get('/admin/Logistica/Editar_transportadora/' + id, function (transportadora) {
        $("#idTrans").val(transportadora.id);
        $("#nomeTransUp").val(transportadora.trans_nome);
        $("#limitetransTransUp").val(transportadora.trans_limite_transporte);
        $("#telefoneTransUp").val(transportadora.trans_telefone);
        $("#celularTransUp").val(transportadora.trans_celular);
        $("#modalUpdateTransportadora").modal('toggle');

    });
}

function editProduto(id)
{
    $.get('/admin/Produto/Editar_produto/' + id, function (produto) {
        $("#idPro").val(produto.id);
        $("#IDProdutoUp").val(produto.id);
        $("#NomeProdutoUp").val(produto.pro_nome);
        $("#TipoProdutoUp").val(produto.tpp_id);
        $("#PCProdutoUp").val(produto.pro_precocusto);
        $("#PVProdutoUp").val(produto.pro_precovenda);
        $("#MaterialProdutoUp").val(produto.mat_id);
        $("#LogisticaProdutoUp").val(produto.log_id);
        $("#PromocaoProdutoUp").val(produto.pro_promocao);
        $("#PedidoMinimoProdutoUp").val(produto.pro_pedidominimo);
        $("#PersoProdutoUp").val(produto.pro_personalizacao);
        $("#TerceProdutoUp").val(produto.pro_terceirizacao);
        $("#FotoProdutoUp").val(produto.pro_foto_path);
        $("#modalUpdateProdutos").modal('toggle');

    });
}

function editTipoProduto(id)
{
    $.get('/admin/Produto/Editar_tipo_produto/' + id, function (tipoproduto) {
        $("#idTpp").val(tipoproduto.id);
        $("#NomeTipoProdutoUp").val(tipoproduto.tpp_descricao);
        $("#modalUpdateTipoProduto").modal('toggle');

    });
}

function editMaterial(id)
{
    $.get('/admin/Produto/Editar_material_base/' + id, function (material) {
        $("#idMat").val(material.id);
        $("#NomeMaterialUp").val(material.mat_descricao);
        $("#modalUpdateMaterial").modal('toggle');

    });
}

function editDimensao(id)
{
    $.get('/admin/Produto/Editar_dimensao/' + id, function (dimensao) {
        $("#idDim").val(dimensao.id);
        $("#NomeDimensaoUp").val(dimensao.dim_descricao);
        $("#modalUpdateDimensao").modal('toggle');

    });
}

function editCor(id)
{
    $.get('/admin/Produto/Editar_cor/' + id, function (cor) {
        $("#idCor").val(cor.id);
        $("#NomeCoresUP").val(cor.cor_nome);
        $("#CodigoCoresUp").val(cor.cor_hex_especial);
        $("#EspecialCoresUp").val(cor.cor_hex_especial);
        $("#modalUpdateCores").modal('toggle');

    });
}

function editPacote(id)
{
    $.get('/admin/Produto/Editar_pacote/' + id, function (pacote) {
        $("#idPac").val(pacote.id);
        $("#DimensaoPacotesUp").val(pacote.pac_descricao);
        $("#DescricaoPacotesUp").val(pacote.pac_dimensao);
        $("#modalUpdatePacotes").modal('toggle');

    });
}

function editUser(id)
{
    $.get('/admin/Usuario/Editar_usuario/' + id, function (usuario) {
        $("#idUse").val(usuario.id);
        $("#nomeUserUp").val(usuario.usu_nome_completo);
        $("#usu_usuarioUp").val(usuario.usu_usuario);
        $("#cpfUserUp").val(usuario.usu_cpf);
        $("#celularUserUp").val(usuario.usu_celularid);
        $("#senhaUserUp").val(usuario.usu_senha);
        $("#cargoUserUp").val(usuario.car_id);
        $("#statusUserUp").val(usuario.usu_status);
        $("#modalUpdateUser").modal('toggle');

    });
}

function editCargo(id)
{
    $.get('/admin/Usuario/Editar_cargo/' + id, function (cargo) {
        $("#idCar").val(cargo.id);
        $("#descricaoCargoUp").val(cargo.car_descricao);
        $("#modalUpdateCargo").modal('toggle');

    });
}

/*   function editPrivilegio(id)
{
    $.get('/admin/Usuario/Editar_privilegio/' + id, function (privilegio) {
        $("#idPri").val(privilegio.id);
        $("#cargoPrivilegio").val(privilegio.id)
        $("#usuarioPrivilegio").val(privilegio.id)
        $("#privilegioPrivilegio").val(privilegio.id)
        $("#financeiroPrivilegio").val(privilegio.id)
        $("#produtoPrivilegio").val(privilegio.id)
        $("#estoquePrivilegio").val(privilegio.id)
        $("#fornecedorPrivilegio").val(privilegio.id)
        $("#detalhePrivilegio").val(privilegio.id)
        $("#logisticaPrivilegio").val(privilegio.id)
        $("#modalUpdatePrivilegio").modal('toggle');

    });
} */

function editVenda(id)
{
    $.get('/admin/Financeiro/Editar_venda/' + id, function (venda) {
        $("#idVen").val(venda.id);
        $("#IDVendaUp").val(venda.id);
        $("#IDClienteUp").val(venda.cli_id);
        $("#VTVendaUp").val(venda.ven_valor_total);
        $("#descontoVendaUp").val(venda.ven_desconto);
        $("#IDTipoPagamentoUp").val(venda.tpg_id);
        $("#parcelasVendaUp").val(venda.ven_parcelas);
        $("#IDLogisticaUp").val(venda.log_id);
        $("#statusVendaUp").val(venda.ven_status);
        $("#modalUpdateVenda").modal('toggle');

    });
}

function editItemVenda(id)
{
    $.get('/admin/Financeiro/Editar_item_venda/' + id, function (itemvenda) {
        $("#idIteVen").val(itemvenda.id);
        $("#IDItemVendaUp").val(itemvenda.ven_id);
        $("#descricaoItemVendaUp").val(itemvenda.det_descricao);
        $("#IDCorUp").val(itemvenda.cor_id);
        $("#IDDimensaoUp").val(itemvenda.dim_id);
        $("#IDProdutoUp").val(itemvenda.pro_id);
        $("#qtdeItemVendaUp").val(itemvenda.det_qtde);
        $("#anexoItemVendaUp").val(itemvenda.det_anexo_path);
        $("#VUItemVendaUp").val(itemvenda.det_valor_unitario);
        $("#VTItemVendaUp").val(itemvenda.det_valor_total);
        $("#modalUpdateItemVenda").modal('toggle');

    });
}
