@extends('layouts.header-footer')
@section('title', 'Produtos - TopSystem')
@section('menu-principal')
<div class="sidebar">
    <!--
                Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red"
            -->
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="javascript:void(0)" class="simple-text logo-mini">
                10
            </a>
            <a href="javascript:void(0)" class="simple-text logo-normal">
                Top System
            </a>
        </div>
        <ul class="nav">
            <li>
                <a href="{{ route('admin') }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>Página Inicial</p>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.usuario') }}">
                    <i class="tim-icons icon-single-02"></i>
                    <p>Usuários</p>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.cliente') }}">
                    <i class="tim-icons icon-satisfied"></i>
                    <p>Clientes</p>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.financeiro') }}">
                    <i class="tim-icons icon-coins"></i>
                    <p>Financeiro</p>
                </a>
            </li>
            <li class="active">
                <a href="{{ route('admin.produto') }}">
                    <i class="tim-icons icon-components"></i>
                    <p>Produtos</p>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.estoque') }}">
                    <i class="tim-icons icon-bag-16"></i>
                    <p>Estoque</p>
                </a>
            </li>
            <li>
            <li>
                <a href="{{ route('admin.fornecedor') }}">
                    <i class="tim-icons icon-badge"></i>
                    <p>Fornecedores</p>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.detalhe') }}">
                    <i class="tim-icons icon-pin"></i>
                    <p>Gerenciamento Geral</p>
                </a>
            </li>
        </ul>
    </div>
</div>
@endsection
@section('content')
<div class="content">
    <div class="col-12">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title" id="no-margin">Resumo de Produtos</h2><br>
                </div>
                <div>
                    <div class="col-auto justify-content-md-center float-left">
                        <h4 class="resumo" style="color: #2caeec;">Qtde. de Produtos:</h4>
                        <h3 class="dados-resumo" style="color: #2caeec;">{{ $dado1 }}</h3>
                    </div>
                    <div class="col-auto justify-content-center float-left">
                        <h4 class="resumo" style="color: #2caeec;">Mais Vendido:</h4>
                        <h3 class="dados-resumo" style="color: #2caeec;">{{ $dado2 }}</h3>
                    </div>
                    <div class="col-auto justify-content-center float-left">
                        <h4 class="resumo" style="color: #2caeec;">Qtde. em Promoção:</h4>
                        <h3 class="dados-resumo" style="color: #2caeec;">{{ $dado3 }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="row">
            <div class="card">
                    <form class="form-filtro" id="formFilterCliente" method="POST" autocomplete="off"
                    enctype="multipart/form-data" action="">
                    @csrf
                        <div class="card-header">
                            <h2 class="card-title"> Filtrar Produtos</h2>
                        </div>
                        <div class="col-12">

                            <div class="col-4 float-left">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Produto:</label>
                                    <input type="text" name="txt_nome" id="txt_nome" maxlength="20"
                                        value="{{ old('txt_nome') }}" class="filtro form-control @error('txt_nome') is-invalid @enderror">
                                        @error('txt_nome')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                    <div class="col-4 float-left">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Material:</label>
                                    <select type="text" name="txt_material" id="txt_material" class="filtro form-control" @error('txt_material') is-invalid @enderror
                                    value="{{ old('txt_material') }}"
                                   >
                                    <option value="">------------Selecione------------</option>
                                    @foreach ($materiais as $material)
                                        <option value="{{ $material['id'] }}">{{ $material['mat_descricao'] }}
                                        </option>
                                    @endforeach
                                </select>
                                        @error('txt_material')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-4 float-left">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Dimensão:</label>
                                    <select type="text" name="txt_dimensao" id="txt_dimensao" class="filtro form-control" @error('txt_dimensao') is-invalid @enderror
                                    value="{{ old('txt_centro') }}"
                                   >
                                    <option value="">------------Selecione------------</option>
                                    @foreach ($dimensoes as $dimensao)
                                        <option value="{{ $dimensao['id'] }}">{{ $dimensao['dim_descricao'] }}
                                        </option>
                                    @endforeach
                                </select>
                                        @error('txt_dimensao')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                        <div>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <button class="btn btn-primary"
                                        id="btn-form-consulta">Filtrar</button>
                            </div>
                            </div>
                            </div>
                        </form>
                </div>
        </div>
    </div>

    <div class="row">
        <div class="col-8" style="padding-left: 0px;">
            <div class="card" id="card-consulta-tabela">
                <div class="card-header" id="ch-adaptado">
                    <h2 class="card-title">Consulta de Produtos <button class="btn btn-primary btn-block"
                            id="btn-form-consulta-imprimir">Imprimir</button></h2>
                </div>
                <div class="card-body" id="cd-adaptado">
                    <div class="table-responsive">
                        <table class="table tablesorter " id="tb_produto">
                            <thead class=" text-primary">
                                <tr>
                                    <th style="width: 25%">
                                        Nome
                                    </th>
                                    <th style="width: 15%">
                                        Tipo
                                    </th>
                                    <th class="text-right" style="width: 20%">
                                        Preço Custo
                                    </th>
                                    <th class="text-right" style="width: 20%">
                                        Preço Venda
                                    </th>
                                    <th class="text-right" style="width: 20%">
                                        <div id="acao">Ações</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produtos as $produto)
                                    <tr>
                                        <td>
                                            {{ $produto['pro_nome'] }}
                                        </td>
                                        <td>
                                            {{ $produto['tpp_id'] }}
                                        </td>
                                        <td>
                                            {{ $produto['pro_pedidominimo'] }}
                                        </td>
                                        <td class="text-right">
                                            {{ $produto['pro_precocusto'] }}
                                        </td>
                                        <td class="text-right">
                                            {{ $produto['pro_precovenda'] }}
                                        </td>
                                        <td class="text-right">
                                            <a href="#" class="btn btn-primary" id="alter"><i
                                                    class="tim-icons icon-pencil"></i></a>
                                            <button href="#" class="btn btn-primary red" id="excluir-pro"
                                                name="excluir-produto" data-id="{{ $produto['pro_id'] }}"  data-rota="{{ route('admin.delete.produto') }}"
                                                style="padding: 11px 25px;"><i
                                                    class="tim-icons icon-simple-remove"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-4" style="padding-right: 0px;">
            <div class="card" id="card-consulta-tabela">
                <div class="card-header" id="ch-adaptado">
                    <h2 class="card-title">Detalhes do Produto </h2>
                </div>
                <div class="card-body" id="cd-adaptado">
                    <div class="table-responsive">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                                <tr>
                                    <th style="width: 20%">
                                        Material
                                    </th>
                                    <th style="width: 30%">
                                        Dimensões
                                    </th>
                                    <th style="width: 30%">
                                        Cores
                                    </th>
                                    <th class="text-center" style="width: 10%">
                                        Gravura?
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produtos as $produto)
                                    <tr>
                                        <td>
                                            {{ $produto['mat_id'] }}
                                        </td>
                                        <td>
                                            {{ $dimensoes }}
                                        </td>
                                        <td>
                                            {{ $cores }}
                                        </td>
                                        <td class="text-center">
                                            {{ $gravura }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('sub-menu')
    <div class="add">
        <div class="dropup show-dropdown">
            <a href="#" data-toggle="dropdown">
                <img src="../img/dash/addbtn.png">
            </a>
            <div class="dropdown-menu" id="add-menu">
                <a class="dropdown-item" id="no-padding" data-toggle="modal" data-backdrop="static" data-target="#modalRegisterProdutos"><img
                        src="../img/dash/cadastro_produtos.png" width="75" height="75"></a>
                <a class="dropdown-item" id="no-padding" data-toggle="modal" data-backdrop="static"
                    data-target="#modalRegisterTipoProduto"><img src="../img/dash/logistica.png" width="75"
                        height="75"></a>
                <a class="dropdown-item" id="no-padding" data-toggle="modal" data-backdrop="static" data-target="#modalRegisterMaterial"><img
                        src="../img/dash/materia_prima.png" width="75" height="75"></a>
                <a class="dropdown-item" id="no-padding" data-toggle="modal" data-backdrop="static" data-target="#modalRegisterDimensao"><img
                        src="../img/dash/dimensao.png" width="75" height="75"></a>
                <a class="dropdown-item" id="no-padding" data-toggle="modal" data-backdrop="static" data-target="#modalRegisterCores"><img
                        src="../img/dash/cores.png" width="75" height="75"></a>
                <a class="dropdown-item" id="no-padding" data-toggle="modal" data-backdrop="static" data-target="#modalRegisterPacotes"><img
                        src="../img/dash/pacote.png" width="75" height="75"></a>
            </div>
        </div>
    </div>
@endsection
@section('modals')
    <div class="modal fade" id="modalRegisterProdutos" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <form id="formRegisterProdutos" method="POST" autocomplete="off" enctype="multipart/form-data"
                action="{{ route('admin.create.produto') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Cadastrar Produtos</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">ID:</label> <label style="color: red; font-size: 12px;">
                                        * </label>
                                    <input type="text" name="IDProduto" id="IDProduto" class="form-control"
                                        maxlength="6" value="{{ old('IDProduto') }}" placeholder="ID do Produto"
                                        autofocus>
                                    <div class="div-feedback">
                                    <span class="invalid-feedback IDProduto_error" role="alert">
                                    </span>
                                </div>
                                </div>
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Nome do Produto:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="text" name="NomeProduto" id="NomeProduto" class="form-control"
                                        maxlength="80" value="{{ old('NomeProduto') }}"
                                        placeholder="Entre com o Nome">
                                        <div class="div-feedback">
                                    <span class="invalid-feedback NomeProduto_error" role="alert">
                                    </span>
                                        </div>
                                </div>
                                <div class="form-group">
                                    <label class="modal-label">Tipo de Produto:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <select type="text" name="TipoProduto" id="TipoProduto" class="form-control"
                                        maxlength="50" value="{{ old('TipoProduto') }}"
                                        placeholder="Selecione com o Tipo do Produto">
                                        <option value="">------------Selecione------------</option>
                                        @foreach ($tipos as $tipo)
                                            <option value="{{ $tipo['id'] }}">{{ $tipo['tpp_descricao'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="div-feedback">
                                    <span class="invalid-feedback TipoProduto_error" role="alert">
                                    </span>
                                    </div>
                                </div>
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Preço de Custo:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="text" name="PCProduto" id="PCProduto" class="form-control"
                                        onkeypress="mascara(this, 'R$####,##')" maxlength="9"
                                        value="{{ old('PCProduto') }}" placeholder="Entre com o Preço de Custo">
                                        <div class="div-feedback">
                                    <span class="invalid-feedback PCProduto_error" role="alert">
                                    </span>
                                        </div>
                                </div>
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Preço de Venda:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="text" name="PVProduto" id="PCVenda" class="form-control"
                                        onkeypress="mascara(this, 'R$####,##')" maxlength="9"
                                        value="{{ old('PVProduto') }}" placeholder="Entre com o Preço de Venda">
                                        <div class="div-feedback">
                                    <span class="invalid-feedback PCVenda_error" role="alert">
                                    </span>
                                        </div>
                                </div>
                                    <div class="form-group" id="form-group">
                                        <label class="modal-label">Foto do Produto:</label> <label
                                            style="color: red; font-size: 12px;"> * </label>
                                        <input type="file" name="FotoProduto" id="FotoProduto" class="form-control"
                                            value="{{ old('FotoProduto') }}">
                                            <div class="div-feedback">
                                        <span class="invalid-feedback FotoProduto_error" role="alert">
                                        </span>
                                            </div>
                                    </div>
                                </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="modal-label">Material:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <select type="text" name="MaterialProduto" id="MaterialProduto" class="form-control"
                                        maxlength="50" value="{{ old('MaterialProduto') }}"
                                        placeholder="Selecione com a Material Base">
                                        <option value="">------------Selecione------------</option>
                                        @foreach ($materiais as $material)
                                            <option value="{{ $material['id'] }}">
                                                {{ $material['mat_descricao'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="div-feedback">
                                    <span class="invalid-feedback MaterialProduto_error" role="alert">
                                    </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="modal-label">Pacote:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <select type="text" name="PacoteProduto" id="PacoteProduto" class="form-control"
                                        maxlength="15" value="{{ old('PacoteProduto') }}"
                                        placeholder="Selecione com o Pacote">
                                        <option value="">------------Selecione------------</option>
                                        @foreach ($pacotes as $pacote)
                                            <option value="{{ $pacote['id'] }}">{{ $pacote['pac_descricao'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="div-feedback">
                                    <span class="invalid-feedback PacoteProduto_error" role="alert">
                                    </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="modal-label">Dimensão:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <select type="text" name="DimensaoProduto" id="DimensaoProduto" class="form-control"
                                        onkeypress="mascara(this, '### x ### x ###')" maxlength="15"
                                        value="{{ old('DimensaoProduto') }}" placeholder="Selecione com o Dimensão">
                                        <option value="">------------Selecione------------</option>
                                        @foreach ($dimensoes as $dimensao)
                                            <option value="{{ $dimensao['id'] }}">
                                                {{ $dimensao['dim_descricao'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="div-feedback">
                                    <span class="invalid-feedback DimensaoProduto_error" role="alert">
                                    </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="modal-label">Cores: </label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <select type="text" name="CoresProduto" id="CoresProduto" class="form-control"
                                        maxlength="25" value="{{ old('CoresProduto') }}"
                                        placeholder="Selecione com o Cores">
                                        <option value="">------------Selecione------------</option>
                                        @foreach ($cores as $cor)
                                            <option value="{{ $cor['id'] }}">{{ $cor['cor_nome'] }}</option>
                                        @endforeach
                                    </select>
                                    <div class="div-feedback">
                                    <span class="invalid-feedback CoresProduto_error" role="alert">
                                    </span>
                                    </div>
                                </div>
                                <div class="form-group" id="form-group">
                                    <label class="modal-label"> Personalizável?</label>
                                    <div class="switch__container">
                                        <input id="switch-shadow" name="PersoProduto" value={{ 'Sim' ?? 'Não' }}
                                            class="switch switch--shadow" type="checkbox">
                                        <label for="switch-shadow"></label>
                                        <span class="invalid-feedback PersoProduto_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                                    <div class="form-group" id="form-group">
                                        <label class="modal-label"> Terceirizado?</label>
                                        <div class="switch__container">
                                            <input id="switch-shadow-2" name="TerceProduto"
                                                value={{ 'Sim' ?? 'Não' }} class="switch switch--shadow"
                                                type="checkbox">
                                            <label for="switch-shadow-2"></label>
                                            <span class="invalid-feedback TerceProduto_error" role="alert">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group" id="form-group">
                                        <label class="modal-label"> Promoção?</label>
                                        <div class="switch__container">
                                            <input id="switch-shadow" name="PromocaoProduto" value={{ 'Sim' ?? 'Não' }}
                                                class="switch switch--shadow" type="checkbox">
                                            <label for="switch-shadow"></label>
                                            <span class="invalid-feedback PromocaoProduto_error" role="alert">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="cancela btn btn-secondary btn-danger"
                                data-form="formRegisterProdutos" data-modal="modalRegisterProdutos">Cancelar</button>
                                          <button  type="button" class="limpar btn btn-secondary btn-danger"  data-form="formRegisterProdutos">Limpar</button>
                <button type="submit" class="btn-register btn btn-primary">Cadastrar</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalRegisterTipoProduto" style="display:none;" aria-hidden="true">
    <div class="modal-dialog">
        <form class="form-cadastro" id="formRegisterTipoProduto" method="POST" autocomplete="off"
            enctype="multipart/form-data" action="{{ route('admin.create.tipoproduto') }}">
            @csrf
            <div class="modal-content" style="width: 150%">
                <div class="modal-header">
                    <h4 class="modal-title">Cadastrar Tipo de Produto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group" id="form-direita" style="width: 100%;">
                                <label class="modal-label">Tipo de Produto: </label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="text" name="NomeTipoProduto" id="NomeTipoProduto"style="width: 100%; margin-right: 0px;" class="form-control"
                                    maxlength="50" value="{{ old('NomeTipoProduto') }}"
                                    placeholder="Entre com o Tipo de Produto">
                                <span class="invalid-feedback NomeTipoProduto_error" role="alert">
                                </span>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="modal-footer" style="width: 100%; padding: 24px 15px 16px 15px;">
                            <button type="button" class="cancela btn btn-secondary btn-danger"
                                data-form="formRegisterTipoProduto"
                                data-modal="modalRegisterTipoProduto">Cancelar</button>

                <button type="submit" class="btn-register btn btn-primary">Cadastrar</button>
                        </div>
        </form>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card" id="card-consulta-tabela">
                <div class="card-header" id="ch-adaptado">
                    <h2 class="card-title">Consulta de Tipos de Produto</h2>
                </div>
                <div class="card-body" id="cd-adaptado">
                    <div class="table-responsive">
                        <table class="table tablesorter " id="tb_tipo_produto">
                            <thead class=" text-primary">
                                <tr>
                                    <th style="width: 10%">
                                        ID
                                    </th>
                                    <th style="width: 50%">
                                        Descrição
                                    </th>
                                    <th class="text-right" style="width: 40%">
                                        <div id="acao">Ações</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tipos as $tipo)
                                    <tr>
                                        <td>
                                            {{ $tipo['tpp_id'] }}
                                        </td>
                                        <td>
                                            {{ $tipo['tpp_descricao'] }}
                                        </td>
                                        <td class="text-right">
                                            <a href="#" class="btn btn-primary" id="alter"><i
                                                    class="tim-icons icon-pencil"></i></a>
                                            <button href="#" class="btn btn-primary red" id="excluir-tpp"
                                                name="excluir-tipo-produto" data-id="{{ $tipo['id'] }}" data-rota="{{ route('admin.delete.tipoproduto') }}"
                                                style="padding: 11px 25px;"><i
                                                    class="tim-icons icon-simple-remove"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>

<div class="modal fade" id="modalRegisterMaterial" style="display:none;" aria-hidden="true">
    <div class="modal-dialog">
        <form class="form-cadastro" id="formRegisterMaterial" method="POST" autocomplete="off"
            enctype="multipart/form-data" action="{{ route('admin.create.material') }}">
            @csrf
            <div class="modal-content" style="width: 150%">
                <div class="modal-header">
                    <h4 class="modal-title">Cadastrar Materiais dos Produtos</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group" id="form-direita">
                                <label class="modal-label">Material de Fabricação: </label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="text" name="NomeMaterial" id="NomeMaterial" style="width: 100%; margin-right: 0px;" class="form-control"
                                    maxlength="50" value="{{ old('NomeMaterial') }}"
                                    placeholder="Entre com o Material de Fabricação">
                                <span class="invalid-feedback NomeMaterial_error" role="alert">
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="modal-footer" style="width: 100%; padding: 24px 15px 16px 15px;">
                            <button type="button" class="cancela btn btn-secondary btn-danger"
                                data-form="formRegisterMaterial" data-modal="modalRegisterMaterial">Cancelar</button>

                <button type="submit" class="btn-register btn btn-primary">Cadastrar</button>
                        </div>
        </form>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card" id="card-consulta-tabela">
                <div class="card-header" id="ch-adaptado">
                    <h2 class="card-title">Consulta de Materiais</h2>
                </div>
                <div class="card-body" id="cd-adaptado">
                    <div class="table-responsive">
                        <table class="table tablesorter " id="tb_material">
                            <thead class=" text-primary">
                                <tr>
                                    <th style="width: 10%">
                                        ID
                                    </th>
                                    <th style="width: 50%">
                                        Descrição
                                    </th>
                                    <th class="text-right" style="width: 40%">
                                        <div id="acao">Ações</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($materiais as $material)
                                    <tr>
                                        <td>
                                            {{ $material['mat_id'] }}
                                        </td>
                                        <td>
                                            {{ $material['mat_descricao'] }}
                                        </td>
                                        <td class="text-right">
                                            <a href="#" class="btn btn-primary" id="alter"><i
                                                    class="tim-icons icon-pencil"></i></a>
                                            <button href="#" class="btn btn-primary red" id="excluir-mat"
                                                name="excluir-material" data-id="{{ $material['id'] }}" data-rota="{{ route('admin.delete.material') }}"
                                                style="padding: 11px 25px;"><i
                                                    class="tim-icons icon-simple-remove"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
<div class="modal fade" id="modalRegisterDimensao" style="display:none;" aria-hidden="true">
    <div class="modal-dialog">
        <form class="form-cadastro" id="formRegisterDimensao" method="POST" autocomplete="off"
            enctype="multipart/form-data" action="{{ route('admin.create.dimensao') }}">
            @csrf
            <div class="modal-content" style="width: 150%">
                <div class="modal-header">
                    <h4 class="modal-title">Cadastrar Dimensões de Produtos</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="modal-label">Nome e Dimensão <br>(Sacola Grande ZZZ X ZZZ X ZZZ): </label><label style="color: red; font-size: 12px;">
                                     * </label>
                                <input type="text" name="NomeDimensao" id="NomeDimensao" style="width: 100%; margin-right: 0px;" class="form-control"
                                    value="{{ old('NomeDimensao') }}" placeholder="Entre com a Nova Dimensão">
                                <span class="invalid-feedback NomeDimensao_error" role="alert">
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="modal-footer" style="width: 100%; padding: 24px 15px 16px 15px;">
                            <button type="button" class="cancela btn btn-secondary btn-danger"
                                data-form="formRegisterDimensao" data-modal="modalRegisterDimensao">Cancelar</button>

                <button type="submit" class="btn-register btn btn-primary">Cadastrar</button>
                        </div>
        </form>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card" id="card-consulta-tabela">
                <div class="card-header" id="ch-adaptado">
                    <h2 class="card-title">Consulta de Dimensões</h2>
                </div>
                <div class="card-body" id="cd-adaptado">
                    <div class="table-responsive">
                        <table class="table tablesorter " id="tb_dimensao">
                            <thead class=" text-primary">
                                <tr>
                                    <th style="width: 10%">
                                        ID
                                    </th>
                                    <th style="width: 50%">
                                        Tamanho
                                    </th>
                                    <th class="text-right" style="width: 40%">
                                        <div id="acao">Ações</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dimensoes as $dimensao)
                                    <tr>
                                        <td>
                                            {{ $dimensao['dim_id'] }}
                                        </td>
                                        <td>
                                            {{ $dimensao['dim_descricao'] }}
                                        </td>
                                        <td class="text-right">
                                            <a href="#" class="btn btn-primary" id="alter"><i
                                                    class="tim-icons icon-pencil"></i></a>
                                            <button href="#" class="btn btn-primary red" id="excluir-dim"
                                                name="excluir-dimensao" data-id="{{ $dimensao['id'] }}" data-rota="{{ route('admin.delete.dimensao') }}"
                                                style="padding: 11px 25px;"><i
                                                    class="tim-icons icon-simple-remove"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>

<div class="modal fade" id="modalRegisterCores" style="display:none;" aria-hidden="true">
    <div class="modal-dialog">
        <form class="form-cadastro" id="formRegisterCores" method="POST" autocomplete="off"
            enctype="multipart/form-data" action="{{ route('admin.create.cor') }}">
            @csrf
            <div class="modal-content" style="width: 150%">
                <div class="modal-header">
                    <h4 class="modal-title">Cadastrar Cores dos Produtos</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="modal-label">Nome da Cor:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="text" name="NomeCores" id="NomeCores" style="width: 100%; margin-right: 0px;" class="form-control"
                                    maxlength="25" value="{{ old('NomeCores') }}"
                                    placeholder="Entre com o Nome da Cor">
                                <span class="invalid-feedback NomeCores_error" role="alert">
                                </span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="modal-label">Código de Cor:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="color" name="CodigoCores" id="CodigoCores" style="width: 100%; margin-right: 0px;" class="form-control"
                                    placeholder="Entre com o Codigo da Cor">
                                <span class="invalid-feedback CodigoCores_error" role="alert">
                                </span>
                            </div>
                            <div class="form-group">
                                <label class="modal-label">Cor Especial:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="text" name="EspecialCores" id="EspecialCores" style="width: 100%; margin-right: 0px;" class="form-control"
                                    value="{{ old('EspecialCores') }}" placeholder="Entre com a Cor Especial">
                                <span class="invalid-feedback EspecialCores_error" role="alert">
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="modal-footer" style="width: 100%; padding: 24px 15px 16px 15px;">
                            <button type="button" class="cancela btn btn-secondary btn-danger"
                                data-form="formRegisterCores" data-modal="modalRegisterCores">Cancelar</button>

                <button type="submit" class="btn-register btn btn-primary">Cadastrar</button>
                        </div>
        </form>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card" id="card-consulta-tabela">
                <div class="card-header" id="ch-adaptado">
                    <h2 class="card-title">Consulta de Cores</h2>
                </div>
                <div class="card-body" id="cd-adaptado">
                    <div class="table-responsive">
                        <table class="table tablesorter " id="tb_cor">
                            <thead class=" text-primary">
                                <tr>
                                    <th style="width: 10%">
                                        ID
                                    </th>
                                    <th style="width: 30%">
                                        Nome
                                    </th>
                                    <th style="width: 20%">
                                        HEX
                                    </th>
                                    <th class="text-right" style="width: 40%">
                                        <div id="acao">Ações</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cores as $cor)
                                    <tr>
                                        <td>
                                            {{ $cor['cor_id'] }}
                                        </td>
                                        <td>
                                            {{ $cor['cor_nome'] }}
                                        </td>
                                        <td>
                                            {{ $cor['cor_hex'] }}
                                        </td>
                                        <td class="text-right">
                                            <a href="#" class="btn btn-primary" id="alter"><i
                                                    class="tim-icons icon-pencil"></i></a>
                                            <button href="#" class="btn btn-primary red" id="excluir-cor"
                                                name="excluir-cor" data-id="{{ $cor['id'] }}" data-rota="{{ route('admin.delete.cor') }}"
                                                style="padding: 11px 25px;"><i
                                                    class="tim-icons icon-simple-remove"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>

<div class="modal fade" id="modalRegisterPacotes" style="display:none;" aria-hidden="true">
    <div class="modal-dialog">
        <form class="form-cadastro" id="formRegisterPacotes" method="POST" autocomplete="off"
            enctype="multipart/form-data" action="{{ route('admin.create.pacote') }}">
            @csrf
            <div class="modal-content" style="width: 100%">
                <div class="modal-header">
                    <h4 class="modal-title">Cadastrar Pacotes para Envio</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Dimensão da Caixa:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="text" name="DimensaoPacotes" id=" dimensao DimensaoPacotes"
                                    class="dimensao form-control" value="{{ old('DimensaoPacotes') }}"
                                    placeholder="Entre com a Dimensão da Caixa">
                                <span class="invalid-feedback DimensaoPacotes_error" role="alert">
                                </span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Descrição da Caixa:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="text" name="DescricaoPacotes" id="DescricaoPacotes" class="form-control"
                                    maxlength="80" value="{{ old('DescricaoPacotes') }}"
                                    placeholder="Entre com a Descrição">
                                <span class="invalid-feedback DescricaoPacotes_error" role="alert">
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="cancela btn btn-secondary btn-danger" data-form="formRegisterPacotes"
                        data-modal="modalRegisterPacotes">Cancelar</button>

                <button type="submit" class="btn-register btn btn-primary">Cadastrar</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@push('ajax')
<script>
    $(document).ready(function() {

        $('#tb_produto').DataTable( {
            paging: true,
            searching: false,
            processing: true,
            serverside: true,
            ajax: "{{ route('admin.list.user') }}",
            columns: [
                {"data": "usu_id"},
                {"data": "usu_nome_completo"},
                {"data": "car_descricao"},
                {"data": "usu_telefone"},
                {"data": "usu_data_cadastro"},
            ]
        } );
        $('#tb_tipo_produto').DataTable( {
            paging: true,
            searching: false,
            processing: true,
            serverside: true,
            ajax: "{{ route('admin.list.user') }}",
            columns: [
                {"data": "usu_id"},
                {"data": "usu_nome_completo"},
                {"data": "car_descricao"},
                {"data": "usu_telefone"},
                {"data": "usu_data_cadastro"},
            ]
        } );
        $('#tb_material').DataTable( {
            paging: true,
            searching: false,
            processing: true,
            serverside: true,
            ajax: "{{ route('admin.list.user') }}",
            columns: [
                {"data": "usu_id"},
                {"data": "usu_nome_completo"},
                {"data": "car_descricao"},
                {"data": "usu_telefone"},
                {"data": "usu_data_cadastro"},
            ]
        } );
        $('#tb_dimensao').DataTable( {
            paging: true,
            searching: false,
            processing: true,
            serverside: true,
            ajax: "{{ route('admin.list.user') }}",
            columns: [
                {"data": "usu_id"},
                {"data": "usu_nome_completo"},
                {"data": "car_descricao"},
                {"data": "usu_telefone"},
                {"data": "usu_data_cadastro"},
            ]
        } );
        $('#tb_cor').DataTable( {
            paging: true,
            searching: false,
            processing: true,
            serverside: true,
            ajax: "{{ route('admin.list.user') }}",
            columns: [
                {"data": "usu_id"},
                {"data": "usu_nome_completo"},
                {"data": "car_descricao"},
                {"data": "usu_telefone"},
                {"data": "usu_data_cadastro"},
            ]
        } );

        $("#formRegisterProdutos").on('submit', function(e) {

            e.preventDefault();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: $(this).serialize(),
                processData: false,
                dataType: 'json',
                beforeSend: function() {
                    $(document).find('span.invalid-feedback').text('');

                },
                success: function(data_decoded) {
                    if (data_decoded.status == 1) {
                        $('#formRegisterProdutos')[0].reset();
                        $('#mensagem').text(data_decoded.msg);
                        $('#modalAlertRegistrar').modal('show');
                    }
                    if (data_decoded.status == 0) {
                        $.each(data_decoded.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                             $('#' + prefix).addClass('is-invalid');
                        });
                    }
                }
            });
        });

        $("#formRegisterTipoProduto").on('submit', function(e) {

            e.preventDefault();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: $(this).serialize(),
                processData: false,
                dataType: 'json',
                beforeSend: function() {
                    $(document).find('span.invalid-feedback').text('');

                },
                success: function(data_decoded) {
                    if (data_decoded.status == 1) {
                        $('#formRegisterTipoProduto')[0].reset();
                        $('#mensagem').text(data_decoded.msg);
                        $('#modalAlertRegistrar').modal('show');
                    }
                    if (data_decoded.status == 0) {
                        $.each(data_decoded.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                             $('#' + prefix).addClass('is-invalid');
                        });
                    }
                }
            });
        });

        $("#formRegisterMaterial").on('submit', function(e) {

            e.preventDefault();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: $(this).serialize(),
                processData: false,
                dataType: 'json',
                beforeSend: function() {
                    $(document).find('span.invalid-feedback').text('');

                },
                success: function(data_decoded) {
                    if (data_decoded.status == 1) {
                        $('#formRegisterMaterial')[0].reset();
                        $('#mensagem').text(data_decoded.msg);
                        $('#modalAlertRegistrar').modal('show');
                    }
                    if (data_decoded.status == 0) {
                        $.each(data_decoded.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                             $('#' + prefix).addClass('is-invalid');
                        });
                    }
                }
            });
        });

        $("#formRegisterDimensao").on('submit', function(e) {

            e.preventDefault();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: $(this).serialize(),
                processData: false,
                dataType: 'json',
                beforeSend: function() {
                    $(document).find('span.invalid-feedback').text('');

                },
                success: function(data_decoded) {
                    if (data_decoded.status == 1) {
                        $('#formRegisterDimensao')[0].reset();
                        $('#mensagem').text(data_decoded.msg);
                        $('#modalAlertRegistrar').modal('show');
                    }
                    if (data_decoded.status == 0) {
                        $.each(data_decoded.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                             $('#' + prefix).addClass('is-invalid');
                        });
                    }
                }
            });
        });

        $("#formRegisterCores").on('submit', function(e) {

            e.preventDefault();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: $(this).serialize(),
                processData: false,
                dataType: 'json',
                beforeSend: function() {
                    $(document).find('span.invalid-feedback').text('');
                },
                success: function(data_decoded) {
                    if (data_decoded.status == 1) {
                        $('#formRegisterCores')[0].reset();
                        $('#mensagem').text(data_decoded.msg);
                        $('#modalAlertRegistrar').modal('show');
                    }
                    if (data_decoded.status == 0) {
                        $.each(data_decoded.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                             $('#' + prefix).addClass('is-invalid');
                            });
                             $.each(data_decoded.error_cor_especial, function(prefix, val) {
                                 $('span.' + prefix + '_error').text(val[0]);
                                $('#' + prefix).addClass('is-invalid');
                             });
                    }
                }
            });
        });

        $("#formRegisterPacotes").on('submit', function(e) {

            e.preventDefault();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: $(this).serialize(),
                processData: false,
                dataType: 'json',
                beforeSend: function() {
                    $(document).find('span.invalid-feedback').text('');

                },
                success: function(data_decoded) {
                    if (data_decoded.status == 1) {
                        $('#formRegisterPacotes')[0].reset();
                        $('#mensagem').text(data_decoded.msg);
                        $('#modalAlertRegistrar').modal('show');
                    }
                    if (data_decoded.status == 0) {
                        $.each(data_decoded.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                             $('#' + prefix).addClass('is-invalid');
                        });
                    }
                }
            });
        });
        $(document).on('click', '[data-dismiss="modal"]',
            function(e) {
        e.preventDefault();
        $('#tb_produto').DataTable( {
            paging: true,
            searching: false,
            processing: true,
            serverside: true,
            ajax: "{{ route('admin.list.user') }}",
            columns: [
                {"data": "usu_id"},
                {"data": "usu_nome_completo"},
                {"data": "car_descricao"},
                {"data": "usu_telefone"},
                {"data": "usu_data_cadastro"},
            ]
        } );
        $('#tb_tipo_produto').DataTable( {
            paging: true,
            searching: false,
            processing: true,
            serverside: true,
            ajax: "{{ route('admin.list.user') }}",
            columns: [
                {"data": "usu_id"},
                {"data": "usu_nome_completo"},
                {"data": "car_descricao"},
                {"data": "usu_telefone"},
                {"data": "usu_data_cadastro"},
            ]
        } );
        $('#tb_material').DataTable( {
            paging: true,
            searching: false,
            processing: true,
            serverside: true,
            ajax: "{{ route('admin.list.user') }}",
            columns: [
                {"data": "usu_id"},
                {"data": "usu_nome_completo"},
                {"data": "car_descricao"},
                {"data": "usu_telefone"},
                {"data": "usu_data_cadastro"},
            ]
        } );
        $('#tb_dimensao').DataTable( {
            paging: true,
            searching: false,
            processing: true,
            serverside: true,
            ajax: "{{ route('admin.list.user') }}",
            columns: [
                {"data": "usu_id"},
                {"data": "usu_nome_completo"},
                {"data": "car_descricao"},
                {"data": "usu_telefone"},
                {"data": "usu_data_cadastro"},
            ]
        } );
        $('#tb_cor').DataTable( {
            paging: true,
            searching: false,
            processing: true,
            serverside: true,
            ajax: "{{ route('admin.list.user') }}",
            columns: [
                {"data": "usu_id"},
                {"data": "usu_nome_completo"},
                {"data": "car_descricao"},
                {"data": "usu_telefone"},
                {"data": "usu_data_cadastro"},
            ]
        } );
        }
    );


    $('#CodigoCores').on('type', function(){
        if ($('#CodigoCores').val() != '#000000') {
            $('#EspecialCores').attr('disabled',  'true');
        }
    });

    $('#EspecialCores').on('type', function(){
        if ($('#EspecialCores').val() != '') {
            $('#CodigoCores').attr('disabled', 'true');
        }
    });

        var path = "{{route ('admin.autocomplete.pro.nome')}}"

$('input#txt_nome').typeahead({
    source: function (terms,process){
        return $.get(path, {terms:terms}, function(data){
            return process(data);
        });
    }
});

$("#formExcluir").on('submit', function(e) {

e.preventDefault();

var rota = $('#rotaDelete').val();

$.ajax({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    type: 'DELETE',
    url: rota,
    data: $(this).serialize(),
    processData: false,
    dataType: 'json',
    success: function(data_decoded) {
            $('#formExcluir')[0].reset();
            $('#mensagem_delete').text(data_decoded.msg);
            $('#modalAlertDelete').hide();
            $('#modalReturnDelete').modal('show');
    }
});
});
    });
</script>
@endpush
