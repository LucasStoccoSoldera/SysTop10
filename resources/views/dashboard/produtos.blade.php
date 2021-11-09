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
                    <a href="{{ route('admin.produto') }}" id="produtos">
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
                        <p>Administração</p>
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
                    <form class="form-filtro" id="formFilter" method="POST" autocomplete="off"
                        enctype="multipart/form-data" action="{{ route('admin.filtro.produto') }}">
                        @csrf
                        <div class="card-header">
                            <h2 class="card-title"> Filtrar Produtos</h2>
                        </div>
                        <div class="col-12">

                            <div class="col-4 float-left">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Produto:</label>
                                    <input type="text" name="txt_nome" id="txt_nome" maxlength="20"
                                        value="{{ old('txt_nome') }}" class="filtro form-control">
                                </div>
                            </div>

                            <div class="col-4 float-left">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Tipo Produto:</label>
                                    <select type="text" name="txt_tpp" id="txt_tpp" class="filtro form-control"
                                        value="{{ old('txt_tpp') }}">
                                        <option value="">Selecione
                                        </option>
                                        @foreach ($tipos as $tipo)
                                            <option value="{{ $tipo['id'] }}">{{ $tipo['tpp_descricao'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-4 float-left">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Material:</label>
                                    <select type="text" name="txt_material" id="txt_material" class="filtro form-control"
                                        value="{{ old('txt_material') }}">
                                        <option value="">Selecione
                                        </option>
                                        @foreach ($materiais as $material)
                                            <option value="{{ $material['id'] }}">{{ $material['mat_descricao'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-primary"
                                            id="btn-form-consulta">Filtrar</button>
                                    </div>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-12" style="padding-left: 0px;padding-right: 0px;">
                <div class="card" id="card-consulta-tabela">
                    <div class="card-header" id="ch-adaptado">
                        <h2 class="card-title">Consulta de Produtos</h2>
                    </div>
                    <div class="card-body" id="cd-adaptado">
                        <div class="table-responsive">
                            <table class="table tablesorter " id="tb_produto">
                                <thead class=" text-primary">
                                    <tr>
                                        <th style="width: 10%">
                                            ID
                                        </th>
                                        <th style="width: 20%">
                                            Nome
                                        </th>
                                        <th style="width: 15%">
                                            Tipo
                                        </th>
                                        <th class="text-right" style="width: 15%">
                                            Preço Custo
                                        </th>
                                        <th class="text-right" style="width: 15%">
                                            Preço Venda
                                        </th>
                                        <th class="text-right" style="width: 20%">
                                            <div id="acao">Ações</div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- DataTables --}}
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
                    <img id="imgsub" src="../img/dash/addbtn.png">
                </a>
                <div class="dropdown-menu" id="add-menu">
                    <a class="dropdown-item" id="no-padding" data-backdrop="static"
                        onclick="abrirModal('#modalRegisterProdutos');"><img src="../img/dash/cadastro_produtos.png"
                            width="65" height="65"></a>
                    <a class="dropdown-item" id="no-padding" data-backdrop="static"
                        onclick="abrirModal('#modalRegisterTipoProduto');"><img src="../img/dash/logistica.png" width="65"
                            height="65"></a>
                    <a class="dropdown-item" id="no-padding" data-backdrop="static"
                        onclick="abrirModal('#modalRegisterMaterial');"><img src="../img/dash/materia_prima.png" width="65"
                            height="65"></a>
                    <a class="dropdown-item" id="no-padding" data-backdrop="static"
                        onclick="abrirModal('#modalRegisterDimensao');"><img src="../img/dash/dimensao.png" width="65"
                            height="65"></a>

                    <a class="dropdown-item" id="no-padding" data-backdrop="static"
                        onclick="abrirModal('#modalRegisterCores');"><img src="../img/dash/cores.png" width="65"
                            height="65"></a>

                    <a class="dropdown-item" id="no-padding" data-backdrop="static"
                        onclick="abrirModal('#modalRegisterPacotes');"><img src="../img/dash/pacote.png" width="65"
                            height="65"></a>
                </div>
                <div class="btn-group dropleft" id="add-menu">
                    <a class="dropdown-item" id="no-padding" data-backdrop="static"
                        onclick="abrirModal('#modalRegisterDimensaoProduto');"><img src="../img/dash/dimensao.png"
                            width="55" height="55"></a>
                    <a class="dropdown-item" id="no-padding" data-backdrop="static"
                        onclick="abrirModal('#modalRegisterCorProduto');"><img src="../img/dash/cores.png" width="55"
                            height="55"></a>
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
                                        <label class="modal-label">ID:</label> <label
                                            style="color: red; font-size: 12px;">
                                            * </label>
                                        <input type="number" name="IDProduto" id="IDProduto" class="form-control id"
                                            value="{{ old('IDProduto') }}" placeholder="ID do Produto" autofocus>
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
                                        <input type="text" name="PCProduto" id="PCProduto" class="dinheiro form-control"
                                            maxlength="9" value="{{ old('PCProduto') }}"
                                            placeholder="Entre com o Preço de Custo">
                                        <div class="div-feedback">
                                            <span class="invalid-feedback PCProduto_error" role="alert">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group" id="form-group">
                                        <label class="modal-label">Preço de Venda:</label> <label
                                            style="color: red; font-size: 12px;"> * </label>
                                        <label style="color: blueviolet; font-size: 14px;"
                                            onclick="abrirModal('#modalPreenchePV');"> Calcular... </label>
                                        <input type="text" name="PVProduto" id="PVProduto" class=" dinheiro form-control"
                                            maxlength="9" value="{{ old('PVProduto') }}"
                                            placeholder="Entre com o Preço de Venda">
                                        <div class="div-feedback">
                                            <span class="invalid-feedback PVProduto_error" role="alert">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="modal-label">Material:</label> <label
                                            style="color: red; font-size: 12px;"> * </label>
                                        <select type="text" name="MaterialProduto" id="MaterialProduto"
                                            class="form-control" maxlength="50" value="{{ old('MaterialProduto') }}"
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
                                        <label class="modal-label">Logística:</label> <label
                                            style="color: red; font-size: 12px;"> * </label>
                                        <select type="text" name="LogisticaProduto" id="LogisticaProduto"
                                            class="form-control" maxlength="15" value="{{ old('LogisticaProduto') }}"
                                            placeholder="Selecione com o Pacote">
                                            <option value="">------------Selecione------------</option>
                                            @foreach ($logisticas as $logistica)
                                                <option value="{{ $logistica['id'] }}">
                                                    {{ $logistica['log_pacote'] + $logistica['log_transportadora'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="div-feedback">
                                            <span class="invalid-feedback LogisticaProduto_error" role="alert">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="modal-label">Promoção: </label>
                                        <input type="text" name="PromocaoProduto" id="PromocaoProduto"
                                            class=" form-control" maxlength="9" value="{{ old('PromocaoProduto') }}"
                                            placeholder="Promoção?">
                                        <div class="div-feedback">
                                            <span class="invalid-feedback PromocaoProduto_error" role="alert">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="modal-label">Pedido Mínimo: </label> <label
                                            style="color: red; font-size: 12px;"> * </label>
                                        <input type="number" name="PedidoMinimoProduto" id="PedidoMinimoProduto"
                                            class=" form-control" maxlength="9"
                                            value="{{ old('PedidoMinimoProduto') }}" placeholder="Pedido Mínimo">
                                        <div class="div-feedback">
                                            <span class="invalid-feedback PedidoMinimoProduto_error" role="alert">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group" id="form-group">
                                        <label class="modal-label"> Personalizável?</label>
                                        <div class="switch__container">
                                            <input id="switch-shadow" name="PersoProduto" value={{ 'Sim' }}
                                                class="switch switch--shadow" type="checkbox">
                                            <label for="switch-shadow"></label>
                                            <span class="invalid-feedback PersoProduto_error" role="alert">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group" id="form-group">
                                        <label class="modal-label"> Terceirizado?</label>
                                        <div class="switch__container">
                                            <input id="switch-shadow-2" name="TerceProduto" value={{ 'Sim' }}
                                                class="switch switch--shadow" type="checkbox">
                                            <label for="switch-shadow-2"></label>
                                            <span class="invalid-feedback TerceProduto_error" role="alert">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
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
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group" id="form-group">
                                        <label class="modal-label">Descrição:</label> <label
                                            style="color: red; font-size: 12px;"> * </label>
                                        <textarea name="DescricaoProduto" id="DescricaoProduto" class="form-control"
                                            value="{{ old('DescricaoProduto') }}" rows="5" style="white-space: pre-wrap; height: 100px;"></textarea>
                                        <div class="div-feedback">
                                            <span class="invalid-feedback DescricaoProduto_error" role="alert">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="cancela btn btn-secondary btn-danger"
                                data-form="formRegisterProdutos" data-modal="modalRegisterProdutos">Cancelar</button>
                            <button type="reset" class="limpar btn btn-secondary btn-danger"
                                data-form="formRegisterProdutos">Limpar</button>
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
                                    <input type="text" name="NomeTipoProduto" id="NomeTipoProduto"
                                        style="width: 100%; margin-right: 0px;" class="form-control" maxlength="50"
                                        value="{{ old('NomeTipoProduto') }}" placeholder="Entre com o Tipo de Produto">
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
                                        <th class="text-center" style="width: 10%">
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
                                    {{-- DataTables --}}
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
                                    <input type="text" name="NomeMaterial" id="NomeMaterial"
                                        style="width: 100%; margin-right: 0px;" class="form-control" maxlength="50"
                                        value="{{ old('NomeMaterial') }}"
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
                                        <th class="text-center" style="width: 10%">
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
                                    {{-- DataTables --}}
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
                                    <label class="modal-label">Nome e Dimensão <br>(Sacola Grande ZZZ X ZZZ X ZZZ):
                                    </label><label style="color: red; font-size: 12px;">
                                        * </label>
                                    <input type="text" name="NomeDimensao" id="NomeDimensao"
                                        style="width: 100%; margin-right: 0px;" class="form-control"
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
                                        <th class="text-center" style="width: 10%">
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
                                    {{-- DataTables --}}
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

    <div class="modal fade" id="modalRegisterDimensaoProduto" style="display:none;" aria-hidden="true">
        <div class="modal-dialog">
            <form class="form-cadastro" id="formRegisterDimensaoProduto" method="POST" autocomplete="off"
                enctype="multipart/form-data" action="{{ route('admin.create.dimensaoproduto') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Relação Dimensão Produto</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Produto:</label> <label
                                        style="color: red; font-size: 12px;"> *
                                    </label>
                                    <select type="text" name="produtoDimensaoProduto" id="produtoDimensaoProduto"
                                        class="form-control" maxlength="80"
                                        value="{{ old('produtoDimensaoProduto') }}"
                                        placeholder="Selecione com o Produto">
                                        <option value="">------------Selecione------------</option>
                                        @foreach ($produtos as $produto)
                                            <option value="{{ $produto['id'] }}">{{ $produto['pro_nome'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="invalid-feedback produtoDimensaoProduto_error" role="alert">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <hr class="visible-xs-block">
                        <h4 class="modal-label" style="font-weight: bold; color: black;text-align: -webkit-center;">
                            Dimensões:</h4>
                        <hr class="visible-xs-block">
                        <div class="row" style="margin-top: 15px">
                            @php
                                $cont = 0;
                            @endphp

                            <div class="col-12" style="text-align: -webkit-center;">
                                @foreach ($dimensoes as $dimensao)
                                    <div class="form-group">
                                        <label class="modal-label">{{ $dimensao['dim_descricao'] }}</label><br>
                                        <div style="float: unset">
                                            <input id="{{ 'switch-shadow' . "$cont" }}"
                                                name="dimensoes[dd{{ $dimensao['id'] }}]"
                                                value={{ 1 ?? 0 }} type="checkbox">
                                        </div>
                                    </div>
                                    <hr class="visible-xs-block">
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="cancela btn btn-secondary btn-danger"
                            data-form="formRegisterDimensaoProduto"
                            data-modal="modalRegisterDimensaoProduto">Cancelar</button>
                        <button type="submit" class="btn-register btn btn-primary">Salvar</button>
                    </div>
                </div>
            </form>
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
                                    <input type="text" name="NomeCores" id="NomeCores"
                                        style="width: 100%; margin-right: 0px;" class="form-control" maxlength="25"
                                        value="{{ old('NomeCores') }}" placeholder="Entre com o Nome da Cor">
                                    <span class="invalid-feedback NomeCores_error" role="alert">
                                    </span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="modal-label">Código de Cor:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="color" name="CodigoCores" id="CodigoCores"
                                        style="width: 100%; margin-right: 0px;" class="form-control"
                                        placeholder="Entre com o Codigo da Cor">
                                    <span class="invalid-feedback CodigoCores_error" role="alert">
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label class="modal-label">Cor Especial:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="text" name="EspecialCores" id="EspecialCores"
                                        style="width: 100%; margin-right: 0px;" class="form-control"
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
                                        <th class="text-center" style="width: 5%">
                                            ID
                                        </th>
                                        <th style="width: 20%">
                                            Nome
                                        </th>
                                        <th style="width: 20%">
                                            Cód / Pal
                                        </th>
                                        <th class="text-right" style="width: 20%">
                                            <div id="acao">Ações</div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- DataTables --}}
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

    <div class="modal fade" id="modalRegisterCorProduto" style="display:none;" aria-hidden="true">
        <div class="modal-dialog">
            <form class="form-cadastro" id="formRegisterCorProduto" method="POST" autocomplete="off"
                enctype="multipart/form-data" action="{{ route('admin.create.corproduto') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Relação Cor Produto</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Produto:</label> <label
                                        style="color: red; font-size: 12px;"> *
                                    </label>
                                    <select type="text" name="produtoCorProduto" id="produtoCorProduto"
                                        class="form-control" maxlength="80" value="{{ old('produtoCorProduto') }}"
                                        placeholder="Selecione com o Produto">
                                        <option value="">------------Selecione------------</option>
                                        @foreach ($produtos as $produto)
                                            <option value="{{ $produto['id'] }}">{{ $produto['pro_nome'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="invalid-feedback produtoCorProduto_error" role="alert">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <hr class="visible-xs-block">
                        <h4 class="modal-label" style="font-weight: bold; color: black;text-align: -webkit-center;">
                            Cores:</h4>
                        <hr class="visible-xs-block">
                        <div class="row" style="margin-top: 15px">
                            @php
                                $cont = 0;
                            @endphp

                            <div class="col-12" style="text-align: -webkit-center;">
                                @foreach ($cores as $cor)
                                    <div class="form-group">
                                        <label class="modal-label">{{ $cor['cor_nome'] }}</label><br>
                                        <div style="float: unset">
                                            <input id="{{ 'switch-shadow' . "$cont" }}"
                                                name="cores[{{ $cor['cor_nome'] }}]" value="1" type="checkbox">
                                        </div>
                                    </div>
                                    <hr class="visible-xs-block">
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="cancela btn btn-secondary btn-danger"
                            data-form="formRegisterCorProduto" data-modal="modalRegisterCorProduto">Cancelar</button>
                        <button type="submit" class="btn-register btn btn-primary">Salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="modalRegisterPacotes" style="display:none;" aria-hidden="true">
        <div class="modal-dialog">
            <form class="form-cadastro" id="formRegisterPacotes" method="POST" autocomplete="off"
                enctype="multipart/form-data" action="{{ route('admin.create.pacote') }}">
                @csrf
                <div class="modal-content" style="width: 150%">
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
                        <div class="row">
                            <div class="modal-footer" style="width: 100%; padding: 24px 15px 16px 15px;">
                                <button type="button" class="cancela btn btn-secondary btn-danger"
                                    data-form="formRegisterPacotes" data-modal="modalRegisterPacotes">Cancelar</button>
                                <button type="submit" class="btn-register btn btn-primary">Cadastrar</button>
                            </div>
            </form>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card" id="card-consulta-tabela">
                    <div class="card-header" id="ch-adaptado">
                        <h2 class="card-title">Consulta de Pacotes</h2>
                    </div>
                    <div class="card-body" id="cd-adaptado">
                        <div class="table-responsive">
                            <table class="table tablesorter " id="tb_pacote">
                                <thead class=" text-primary">
                                    <tr>
                                        <th class="text-center" style="width: 10%">
                                            ID
                                        </th>
                                        <th style="width: 30%">
                                            Nome
                                        </th>
                                        <th style="width: 20%">
                                            Dimensão
                                        </th>
                                        <th class="text-right" style="width: 40%">
                                            <div id="acao">Ações</div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- DataTables --}}
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

    <div class="modal fade" id="modalPreenchePV" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <form id="formPreenchePV" autocomplete="off" enctype="multipart/form-data" method="POST"
                action="{{ route('admin.preenche.pv') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Calcular Preço Venda à Vista</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Custo Mercadoria:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="text" name="custoPV" id="custoPV" class="dinheiro form-control"
                                        maxlength="11" value="{{ old('custoPV') }}" placeholder="Entre com o Custo">
                                    <div class="div-feedback">
                                        <span class="invalid-feedback custoPV_error" role="alert">
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Impostos (%):</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="text" name="impostoPV" id="impostoPV" class=" form-control"
                                        maxlength="11" value="{{ old('impostoPV') }}" placeholder="Entre com o imposto">
                                    <div class="div-feedback">
                                        <span class="invalid-feedback impostoPV_error" role="alert">
                                        </span>
                                    </div>
                                </div>

                            </div>
                            <div class="col-6">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Comissões (%):</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="text" name="comissaoPV" id="comissaoPV" class=" form-control"
                                        maxlength="11" value="{{ old('comissaoPV') }}"
                                        placeholder="Entre com a comissão">
                                    <div class="div-feedback">
                                        <span class="invalid-feedback comissaoPV_error" role="alert">
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Custo Fixo (%):</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="text" name="custofixoPV" id="custofixoPV" class=" form-control"
                                        maxlength="11" value="{{ old('custofixoPV') }}"
                                        placeholder="Entre com o custo fixo">
                                    <div class="div-feedback">
                                        <span class="invalid-feedback custofixoPV_error" role="alert">
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Lucro (%):</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="text" name="lucroPV" id="lucroPV" class="form-control" maxlength="11"
                                        value="{{ old('lucroPV') }}" placeholder="Entre com o custo fixo">
                                    <div class="div-feedback">
                                        <span class="invalid-feedback lucroPV_error" role="alert">
                                        </span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="limpar btn btn-secondary btn-danger"
                            data-form="formRegisterContas">Limpar</button>
                        <button type="submit" class="btn-register btn btn-primary">Inserir</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="modalUpdateProdutos" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <form id="formUpdateProdutos" method="PUT" autocomplete="off" enctype="multipart/form-data"
                action="{{ route('admin.update.produto') }}">
                @csrf
                <input type="hidden" id="idPro" name="idPro">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Atualizar Produtos</h4>
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
                                    <input type="number" name="IDProdutoUp" id="IDProdutoUp" class="form-control id"
                                        value="{{ old('IDProdutoUp') }}" placeholder="ID do Produto" autofocus>
                                    <div class="div-feedback">
                                        <span class="invalid-feedback IDProdutoUp_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Nome do Produto:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="text" name="NomeProdutoUp" id="NomeProdutoUp" class="form-control"
                                        maxlength="80" value="{{ old('NomeProdutoUp') }}" placeholder="Entre com o Nome">
                                    <div class="div-feedback">
                                        <span class="invalid-feedback NomeProdutoUp_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="modal-label">Tipo de Produto:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <select type="text" name="TipoProdutoUp" id="TipoProdutoUp" class="form-control"
                                        maxlength="50" value="{{ old('TipoProdutoUp') }}"
                                        placeholder="Selecione com o Tipo do Produto">
                                        <option value="">------------Selecione------------</option>
                                        @foreach ($tipos as $tipo)
                                            <option value="{{ $tipo['id'] }}">{{ $tipo['tpp_descricao'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="div-feedback">
                                        <span class="invalid-feedback TipoProdutoUp_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Preço de Custo:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="text" name="PCProdutoUp" id="PCProdutoUp" class="dinheiro form-control"
                                        maxlength="9" value="{{ old('PCProdutoUp') }}"
                                        placeholder="Entre com o Preço de Custo">
                                    <div class="div-feedback">
                                        <span class="invalid-feedback PCProdutoUp_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Preço de Venda:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <label style="color: blueviolet; font-size: 14px;"
                                        onclick="abrirModal('#modalPreenchePV');"> Calcular... </label>
                                    <input type="text" name="PVProdutoUp" id="PVProdutoUp" class=" dinheiro form-control"
                                        maxlength="9" value="{{ old('PVProdutoUp') }}"
                                        placeholder="Entre com o Preço de Venda">
                                    <div class="div-feedback">
                                        <span class="invalid-feedback PVProdutoUp_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="modal-label">Material:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <select type="text" name="MaterialProdutoUp" id="MaterialProdutoUp"
                                        class="form-control" maxlength="50" value="{{ old('MaterialProdutoUp') }}"
                                        placeholder="Selecione com a Material Base">
                                        <option value="">------------Selecione------------</option>
                                        @foreach ($materiais as $material)
                                            <option value="{{ $material['id'] }}">
                                                {{ $material['mat_descricao'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="div-feedback">
                                        <span class="invalid-feedback MaterialProdutoUp_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="modal-label">Logistica:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <select type="text" name="LogisticaProdutoUp" id="LogisticaProdutoUp"
                                        class="form-control" maxlength="15" value="{{ old('LogisticaProdutoUp') }}"
                                        placeholder="Selecione com o Pacote">
                                        <option value="">------------Selecione------------</option>
                                        @foreach ($logisticas as $logistica)
                                            <option value="{{ $logistica['id'] }}">
                                                {{ $logistica['log_pacote'] + $logistica['log_transportadora'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="div-feedback">
                                        <span class="invalid-feedback LogisticaProdutoUp_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="modal-label">Promoção: </label>
                                    <input type="text" name="PromocaoProdutoUp" id="PromocaoProdutoUp"
                                        class=" form-control" maxlength="9" value="{{ old('PromocaoProdutoUp') }}"
                                        placeholder="Promoção?">
                                    <div class="div-feedback">
                                        <span class="invalid-feedback PromocaoProdutoUp_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="modal-label">Pedido Mínimo: </label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="number" name="PedidoMinimoProdutoUp" id="PedidoMinimoProdutoUp"
                                        class=" form-control" maxlength="9" value="{{ old('PedidoMinimoProdutoUp') }}"
                                        placeholder="Pedido Mínimo">
                                    <div class="div-feedback">
                                        <span class="invalid-feedback PedidoMinimoProdutoUp_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group" id="form-group">
                                    <label class="modal-label"> Personalizável?</label>
                                    <div class="switch__container">
                                        <input id="switch-shadow" name="PersoProdutoUp" value={{ 'Sim' }}
                                            class="switch switch--shadow" type="checkbox">
                                        <label for="switch-shadow"></label>
                                        <span class="invalid-feedback PersoProdutoUp_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group" id="form-group">
                                    <label class="modal-label"> Terceirizado?</label>
                                    <div class="switch__container">
                                        <input id="switch-shadow-2" name="TerceProdutoUp" value={{ 'Sim' }}
                                            class="switch switch--shadow" type="checkbox">
                                        <label for="switch-shadow-2"></label>
                                        <span class="invalid-feedback TerceProdutoUp_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Foto do Produto:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="file" name="FotoProdutoUp" id="FotoProdutoUp" class="form-control"
                                        value="{{ old('FotoProdutoUp') }}">
                                    <div class="div-feedback">
                                        <span class="invalid-feedback FotoProduto_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Descrição:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                        <textarea name="DescricaoProdutoUp" id="DescricaoProdutoUp" class="form-control"
                                        value="{{ old('DescricaoProdutoUp') }}" rows="5" style="white-space: pre-wrap; height: 100px;"></textarea>
                                    <div class="div-feedback">
                                        <span class="invalid-feedback DescricaoProdutoUp_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="cancela btn btn-secondary btn-danger" data-form="formUpdateProdutos"
                            data-modal="modalUpdateProdutos">Cancelar</button>
                        <button type="reset" class="limpar btn btn-secondary btn-danger"
                            data-form="formUpdateProdutos">Limpar</button>
                        <button type="submit" class="btn-register btn btn-primary">Cadastrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>

    <div class="modal fade" id="modalUpdateTipoProduto" style="display:none;top: 25%" aria-hidden="true">
        <div class="modal-dialog">
            <form class="form-cadastro" id="formUpdateTipoProduto" method="PUT" autocomplete="off"
                enctype="multipart/form-data" action="{{ route('admin.update.tipoproduto') }}">
                @csrf
                <input type="hidden" id="idTpp" name="idTpp">
                <div class="modal-content" style="width: 150%">
                    <div class="modal-header">
                        <h4 class="modal-title">Atualizar Tipo de Produto</h4>
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
                                    <input type="text" name="NomeTipoProdutoUp" id="NomeTipoProdutoUp"
                                        style="width: 100%; margin-right: 0px;" class="form-control" maxlength="50"
                                        value="{{ old('NomeTipoProdutoUp') }}" placeholder="Entre com o Tipo de Produto">
                                    <span class="invalid-feedback NomeTipoProdutoUp_error" role="alert">
                                    </span>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="modal-footer" style="width: 100%; padding: 24px 15px 16px 15px;">
                                <button type="button" class="cancela btn btn-secondary btn-danger"
                                    data-form="formUpdateTipoProduto" data-modal="modalUpdateTipoProduto">Cancelar</button>

                                <button type="submit" class="btn-register btn btn-primary">Cadastrar</button>
                            </div>
            </form>
        </div>
    </div>
    </div>
    </div>
    </div>

    <div class="modal fade" id="modalUpdateMaterial" style="display:none;top: 25%" aria-hidden="true">
        <div class="modal-dialog">
            <form class="form-cadastro" id="formUpdateMaterial" method="PUT" autocomplete="off"
                enctype="multipart/form-data" action="{{ route('admin.update.material') }}">
                @csrf
                <input type="hidden" id="idMat" name="idMat">
                <div class="modal-content" style="width: 150%">
                    <div class="modal-header">
                        <h4 class="modal-title">Atualizar Materiais dos Produtos</h4>
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
                                    <input type="text" name="NomeMaterialUp" id="NomeMaterialUp"
                                        style="width: 100%; margin-right: 0px;" class="form-control" maxlength="50"
                                        value="{{ old('NomeMaterialUp') }}"
                                        placeholder="Entre com o Material de Fabricação">
                                    <span class="invalid-feedback NomeMaterialUp_error" role="alert">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="modal-footer" style="width: 100%; padding: 24px 15px 16px 15px;">
                                <button type="button" class="cancela btn btn-secondary btn-danger"
                                    data-form="formUpdateMaterial" data-modal="modalUpdateMaterial">Cancelar</button>

                                <button type="submit" class="btn-register btn btn-primary">Cadastrar</button>
                            </div>
            </form>
        </div>
    </div>
    </div>
    </div>
    </div>
    <div class="modal fade" id="modalUpdateDimensao" style="display:none;top: 25%" aria-hidden="true">
        <div class="modal-dialog">
            <form class="form-cadastro" id="formUpdateDimensao" method="PUT" autocomplete="off"
                enctype="multipart/form-data" action="{{ route('admin.update.dimensao') }}">
                @csrf
                <input type="hidden" id="idDim" name="idDim">
                <div class="modal-content" style="width: 150%">
                    <div class="modal-header">
                        <h4 class="modal-title">Atualizar Dimensões de Produtos</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="modal-label">Nome e Dimensão <br>(Sacola Grande ZZZ X ZZZ X ZZZ):
                                    </label><label style="color: red; font-size: 12px;">
                                        * </label>
                                    <input type="text" name="NomeDimensaoUp" id="NomeDimensaoUp"
                                        style="width: 100%; margin-right: 0px;" class="form-control"
                                        value="{{ old('NomeDimensaoUp') }}" placeholder="Entre com a Nova Dimensão">
                                    <span class="invalid-feedback NomeDimensaoUp_error" role="alert">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="modal-footer" style="width: 100%; padding: 24px 15px 16px 15px;">
                                <button type="button" class="cancela btn btn-secondary btn-danger"
                                    data-form="formUpdateDimensao" data-modal="modalUpdateDimensao">Cancelar</button>

                                <button type="submit" class="btn-register btn btn-primary">Cadastrar</button>
                            </div>
            </form>
        </div>
    </div>
    </div>
    </div>
    </div>

    <div class="modal fade" id="modalUpdateCores" style="display:none;top: 25%" aria-hidden="true">
        <div class="modal-dialog">
            <form class="form-cadastro" id="formUpdateCores" method="PUT" autocomplete="off" enctype="multipart/form-data"
                action="{{ route('admin.update.cor') }}">
                @csrf
                <input type="hidden" id="idCor" name="idCor">
                <div class="modal-content" style="width: 150%">
                    <div class="modal-header">
                        <h4 class="modal-title">Atualizar Cores dos Produtos</h4>
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
                                    <input type="text" name="NomeCoresUp" id="NomeCoresUp"
                                        style="width: 100%; margin-right: 0px;" class="form-control" maxlength="25"
                                        value="{{ old('NomeCoresUp') }}" placeholder="Entre com o Nome da Cor">
                                    <span class="invalid-feedback NomeCoresUp_error" role="alert">
                                    </span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="modal-label">Código de Cor:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="color" name="CodigoCoresUp" id="CodigoCoresUp"
                                        style="width: 100%; margin-right: 0px;" class="form-control"
                                        placeholder="Entre com o Codigo da Cor">
                                    <span class="invalid-feedback CodigoCoresUp_error" role="alert">
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label class="modal-label">Cor Especial:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="text" name="EspecialCoresUp" id="EspecialCoresUp"
                                        style="width: 100%; margin-right: 0px;" class="form-control"
                                        value="{{ old('EspecialCoresUp') }}" placeholder="Entre com a Cor Especial">
                                    <span class="invalid-feedback EspecialCoresUp_error" role="alert">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="modal-footer" style="width: 100%; padding: 24px 15px 16px 15px;">
                                <button type="button" class="cancela btn btn-secondary btn-danger"
                                    data-form="formUpdateCores" data-modal="modalUpdateCores">Cancelar</button>

                                <button type="submit" class="btn-register btn btn-primary">Cadastrar</button>
                            </div>
            </form>
        </div>
    </div>
    </div>
    </div>
    </div>

    <div class="modal fade" id="modalUpdatePacotes" style="display:none;top: 25%" aria-hidden="true">
        <div class="modal-dialog">
            <form class="form-cadastro" id="formUpdatePacotes" method="PUT" autocomplete="off"
                enctype="multipart/form-data" action="{{ route('admin.update.pacote') }}">
                @csrf
                <input type="hidden" id="idPac" name="idPac">
                <div class="modal-content" style="width: 150%">
                    <div class="modal-header">
                        <h4 class="modal-title">Atualizar Pacotes para Envio</h4>
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
                                    <input type="text" name="DimensaoPacotesUp" id="DimensaoPacotesUp"
                                        class="dimensao form-control" value="{{ old('DimensaoPacotesUp') }}"
                                        placeholder="Entre com a Dimensão da Caixa">
                                    <span class="invalid-feedback DimensaoPacotesUp_error" role="alert">
                                    </span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Descrição da Caixa:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="text" name="DescricaoPacotesUp" id="DescricaoPacotesUp"
                                        class="form-control" maxlength="80" value="{{ old('DescricaoPacotesUp') }}"
                                        placeholder="Entre com a Descrição">
                                    <span class="invalid-feedback DescricaoPacotesUp_error" role="alert">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="modal-footer" style="width: 100%; padding: 24px 15px 16px 15px;">
                                <button type="button" class="cancela btn btn-secondary btn-danger"
                                    data-form="formUpdatePacotes" data-modal="modalUpdatePacotes">Cancelar</button>
                                <button type="submit" class="btn-register btn btn-primary">Cadastrar</button>
                            </div>
            </form>
        </div>
    </div>
    </div>
    </div>
    </div>


@endsection

@push('ajax')
    <script>
        $(document).ready(function() {

            var table_produto = $('#tb_produto').DataTable({
                paging: true,
                searching: false,
                processing: true,
                serverside: true,
                ajax: "{{ route('admin.list.produto') }}",
                columns: [{
                        data: "id",
                        className: "text-center"
                    },
                    {
                        data: "pro_nome"
                    },
                    {
                        data: "tpp_descricao"
                    },
                    {
                        data: "pro_precocusto",
                        className: "text-right",
                        render: DataTable.render.number('.', ',', 2, 'R$')
                    },
                    {
                        data: "pro_precovenda",
                        className: "text-right",
                        render: DataTable.render.number('.', ',', 2, 'R$')
                    },
                    {
                        data: "action",
                        className: "text-right"
                    },
                ],
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ],
            });
            var table_tipo_produto = $('#tb_tipo_produto').DataTable({
                paging: true,
                searching: false,
                processing: true,
                serverside: true,
                ajax: "{{ route('admin.list.tipoproduto') }}",
                columns: [{
                        data: "id",
                        className: "text-center"
                    },
                    {
                        data: "tpp_descricao"
                    },
                    {
                        data: "action",
                        className: "text-right"
                    },
                ]
            });
            var table_material = $('#tb_material').DataTable({
                paging: true,
                searching: false,
                processing: true,
                serverside: true,
                ajax: "{{ route('admin.list.material') }}",
                columns: [{
                        data: "id",
                        className: "text-center"
                    },
                    {
                        data: "mat_descricao"
                    },
                    {
                        data: "action",
                        className: "text-right"
                    },
                ]
            });
            var table_dimensao = $('#tb_dimensao').DataTable({
                paging: true,
                searching: false,
                processing: true,
                serverside: true,
                ajax: "{{ route('admin.list.dimensao') }}",
                columns: [{
                        data: "id",
                        className: "text-center"
                    },
                    {
                        data: "dim_descricao"
                    },
                    {
                        data: "action",
                        className: "text-right"
                    },
                ]
            });
            var table_cor = $('#tb_cor').DataTable({
                paging: true,
                searching: false,
                processing: true,
                serverside: true,
                ajax: "{{ route('admin.list.cor') }}",
                columns: [{
                        data: "id",
                        className: "text-center"
                    },
                    {
                        data: "cor_nome"
                    },
                    {
                        data: "cor_hex_especial"
                    },
                    {
                        data: "action",
                        className: "text-right"
                    },
                ]
            });
            var table_pacote = $('#tb_pacote').DataTable({
                paging: true,
                searching: false,
                processing: true,
                serverside: true,
                ajax: "{{ route('admin.list.pacote') }}",
                columns: [{
                        data: "id",
                        className: "text-center"
                    },
                    {
                        data: "pac_descricao"
                    },
                    {
                        data: "pac_dimensao"
                    },
                    {
                        data: "action",
                        className: "text-right"
                    },
                ]
            });

            $(document).on('click', '[data-dismiss="modal"]',
                function() {
                    table_produto.ajax.reload(null, false);
                    table_tipo_produto.ajax.reload(null, false);
                    table_material.ajax.reload(null, false);
                    table_dimensao.ajax.reload(null, false);
                    table_cor.ajax.reload(null, false);
                    table_pacote.ajax.reload(null, false);
                }
            );

            $("#formRegisterProdutos").on('submit', function(e) {

                e.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    beforeSend: function() {
                        $(document).find('span.invalid-feedback').text('');
                        $(document).find('input').removeClass('is-invalid');

                    },
                    success: function(data_decoded) {
                        if (data_decoded.status == 1) {
                            $('#formRegisterProdutos')[0].reset();
                            demo.showNotification('top', 'right', 2, data_decoded.msg,
                                'tim-icons icon-check-2');
                        }
                        if (data_decoded.status == 0) {
                            $.each(data_decoded.error, function(prefix, val) {
                                $('span.' + prefix + '_error').text(val[0]);
                                $('#' + prefix).focus();
                            $('#' + prefix).addClass('is-invalid');
                            });
                        }
                    }
                });
            });

            $("#formPreenchePV").on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    beforeSend: function() {
                        $(document).find('span.invalid-feedback').text('');
                        $(document).find('input').removeClass('is-invalid');

                    },
                    success: function(data_decoded) {
                        if (data_decoded.status == 1) {
                            $('#formPreenchePV')[0].reset();
                            demo.showNotification('top', 'right', 2, data_decoded.msg,
                                'tim-icons icon-check-2');
                            $('#modalPreenchePV').modal('hide');
                            $("body").addClass("modal-open");
                            $('#PVProduto').val(data_decoded.PV);
                        }
                        if (data_decoded.status == 0) {
                            $.each(data_decoded.error, function(prefix, val) {
                                $('span.' + prefix + '_error').text(val[0]);
                                $('#' + prefix).focus();
                            $('#' + prefix).addClass('is-invalid');
                            });
                        }
                    }
                });
            });

            $("#modalPreenchePV").on("hidden.bs.modal", function() {
                $("body").addClass("modal-open");
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
                        $(document).find('input').removeClass('is-invalid');
                    },
                    success: function(data_decoded) {
                        if (data_decoded.status == 1) {
                            $('#formRegisterTipoProduto')[0].reset();
                            $('#mensagem').text(data_decoded.msg);
                            var rota_reload = $('#produtos').attr('href');
                            $('#modalReturnCadastro').modal('show');
                        }
                        if (data_decoded.status == 0) {
                            $.each(data_decoded.error, function(prefix, val) {
                                $('span.' + prefix + '_error').text(val[0]);
                                $('#' + prefix).focus();
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
                        $(document).find('input').removeClass('is-invalid');
                    },
                    success: function(data_decoded) {
                        if (data_decoded.status == 1) {
                            $('#formRegisterMaterial')[0].reset();
                            $('#mensagem').text(data_decoded.msg);
                            var rota_reload = $('#produtos').attr('href');
                            $('#modalReturnCadastro').modal('show');
                        }
                        if (data_decoded.status == 0) {
                            $.each(data_decoded.error, function(prefix, val) {
                                $('span.' + prefix + '_error').text(val[0]);
                                $('#' + prefix).focus();
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
                        $(document).find('input').removeClass('is-invalid');
                    },
                    success: function(data_decoded) {
                        if (data_decoded.status == 1) {
                            $('#formRegisterDimensao')[0].reset();
                            $('#mensagem').text(data_decoded.msg);
                            var rota_reload = $('#produtos').attr('href');
                            $('#modalReturnCadastro').modal('show');
                        }
                        if (data_decoded.status == 0) {
                            $.each(data_decoded.error, function(prefix, val) {
                                $('span.' + prefix + '_error').text(val[0]);
                                $('#' + prefix).focus();
                            $('#' + prefix).addClass('is-invalid');
                            });
                        }
                    }
                });
            });

            $("#formRegisterDimensaoProduto").on('submit', function(e) {

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
                        $(document).find('input').removeClass('is-invalid');
                    },
                    success: function(data_decoded) {
                        if (data_decoded.status == 1) {
                            $('#formRegisterDimensaoProduto')[0].reset();
                            demo.showNotification('top', 'right', 2, data_decoded.msg,
                                'tim-icons icon-check-2');
                        }
                        if (data_decoded.status == 0) {
                            $.each(data_decoded.error, function(prefix, val) {
                                $('span.' + prefix + '_error').text(val[0]);
                                $('#' + prefix).focus();
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
                        $(document).find('input').removeClass('is-invalid');
                    },
                    success: function(data_decoded) {
                        if (data_decoded.status == 1) {
                            $('#formRegisterCores')[0].reset();
                            $('#mensagem').text(data_decoded.msg);
                            var rota_reload = $('#produtos').attr('href');
                            $('#modalReturnCadastro').modal('show');
                        }
                        if (data_decoded.status == 0) {
                            $.each(data_decoded.error, function(prefix, val) {
                                $('span.' + prefix + '_error').text(val[0]);
                                $('#' + prefix).focus();
                            $('#' + prefix).addClass('is-invalid');
                            });
                            $.each(data_decoded.error_cor_especial, function(prefix, val) {
                                $('span.' + prefix + '_error').text(val[0]);
                                $('#' + prefix).focus();
                            $('#' + prefix).addClass('is-invalid');
                            });
                        }
                    }
                });
            });

            $("#formRegisterCorProduto").on('submit', function(e) {

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
                        $(document).find('input').removeClass('is-invalid');
                    },
                    success: function(data_decoded) {
                        if (data_decoded.status == 1) {
                            $('#formRegisterCorProduto')[0].reset();
                            demo.showNotification('top', 'right', 2, data_decoded.msg,
                                'tim-icons icon-check-2');
                        }
                        if (data_decoded.status == 0) {
                            $.each(data_decoded.error, function(prefix, val) {
                                $('span.' + prefix + '_error').text(val[0]);
                                $('#' + prefix).focus();
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
                        $(document).find('input').removeClass('is-invalid');
                    },
                    success: function(data_decoded) {
                        if (data_decoded.status == 1) {
                            $('#formRegisterPacotes')[0].reset();
                            $('#mensagem').text(data_decoded.msg);
                            var rota_reload = $('#produtos').attr('href');
                            $('#modalReturnCadastro').modal('show');
                        }
                        if (data_decoded.status == 0) {
                            $.each(data_decoded.error, function(prefix, val) {
                                $('span.' + prefix + '_error').text(val[0]);
                                $('#' + prefix).focus();
                            $('#' + prefix).addClass('is-invalid');
                            });
                        }
                    }
                });
            });

            $("#formUpdateProdutos").on('submit', function(e) {

                e.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    beforeSend: function() {
                        $(document).find('span.invalid-feedback').text('');
                        $(document).find('input').removeClass('is-invalid');

                    },
                    success: function(data_decoded) {
                        if (data_decoded.status == 1) {
                            $('#formUpdateProdutos')[0].reset();
                            demo.showNotification('top', 'right', 2, data_decoded.msg,
                                'tim-icons icon-check-2');
                        }
                        if (data_decoded.status == 0) {
                            $.each(data_decoded.error, function(prefix, val) {
                                $('span.' + prefix + '_error').text(val[0]);
                                $('#' + prefix).focus();
                            $('#' + prefix).addClass('is-invalid');
                            });
                        }
                    }
                });
            });

            $("#formUpdateTipoProduto").on('submit', function(e) {

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
                        $(document).find('input').removeClass('is-invalid');
                    },
                    success: function(data_decoded) {
                        if (data_decoded.status == 1) {
                            $('#formUpdateTipoProduto')[0].reset();
                            $('#mensagem').text(data_decoded.msg);
                            demo.showNotification('top', 'right', 2, data_decoded.msg,
                                'tim-icons icon-check-2');
                        }
                        if (data_decoded.status == 0) {
                            $.each(data_decoded.error, function(prefix, val) {
                                $('span.' + prefix + '_error').text(val[0]);
                                $('#' + prefix).focus();
                            $('#' + prefix).addClass('is-invalid');
                            });
                        }
                    }
                });
            });

            $("#formUpdateMaterial").on('submit', function(e) {

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
                        $(document).find('input').removeClass('is-invalid');
                    },
                    success: function(data_decoded) {
                        if (data_decoded.status == 1) {
                            $('#formUpdateMaterial')[0].reset();
                            $('#mensagem').text(data_decoded.msg);
                            demo.showNotification('top', 'right', 2, data_decoded.msg,
                                'tim-icons icon-check-2');
                        }
                        if (data_decoded.status == 0) {
                            $.each(data_decoded.error, function(prefix, val) {
                                $('span.' + prefix + '_error').text(val[0]);
                                $('#' + prefix).focus();
                            $('#' + prefix).addClass('is-invalid');
                            });
                        }
                    }
                });
            });

            $("#formUpdateDimensao").on('submit', function(e) {

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
                        $(document).find('input').removeClass('is-invalid');
                    },
                    success: function(data_decoded) {
                        if (data_decoded.status == 1) {
                            $('#formUpdateDimensao')[0].reset();
                            $('#mensagem').text(data_decoded.msg);
                            demo.showNotification('top', 'right', 2, data_decoded.msg,
                                'tim-icons icon-check-2');
                        }
                        if (data_decoded.status == 0) {
                            $.each(data_decoded.error, function(prefix, val) {
                                $('span.' + prefix + '_error').text(val[0]);
                                $('#' + prefix).focus();
                            $('#' + prefix).addClass('is-invalid');
                            });
                        }
                    }
                });
            });

            $("#formUpdateCores").on('submit', function(e) {

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
                        $(document).find('input').removeClass('is-invalid');
                    },
                    success: function(data_decoded) {
                        if (data_decoded.status == 1) {
                            $('#formUpdateCores')[0].reset();
                            $('#mensagem').text(data_decoded.msg);
                            demo.showNotification('top', 'right', 2, data_decoded.msg,
                                'tim-icons icon-check-2');
                        }
                        if (data_decoded.status == 0) {
                            $.each(data_decoded.error, function(prefix, val) {
                                $('span.' + prefix + '_error').text(val[0]);
                                $('#' + prefix).focus();
                            $('#' + prefix).addClass('is-invalid');
                            });
                            $.each(data_decoded.error_cor_especial, function(prefix, val) {
                                $('span.' + prefix + '_error').text(val[0]);
                                $('#' + prefix).focus();
                            $('#' + prefix).addClass('is-invalid');
                            });
                        }
                    }
                });
            });

            $("#formUpdatePacotes").on('submit', function(e) {

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
                        $(document).find('input').removeClass('is-invalid');
                    },
                    success: function(data_decoded) {
                        if (data_decoded.status == 1) {
                            $('#formRegisterPacotes')[0].reset();
                            $('#mensagem').text(data_decoded.msg);
                            demo.showNotification('top', 'right', 2, data_decoded.msg,
                                'tim-icons icon-check-2');
                        }
                        if (data_decoded.status == 0) {
                            $.each(data_decoded.error, function(prefix, val) {
                                $('span.' + prefix + '_error').text(val[0]);
                                $('#' + prefix).focus();
                            $('#' + prefix).addClass('is-invalid');
                            });
                        }
                    }
                });
            });

                    $("#exportar").on('click', function(e) {

        e.preventDefault();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: "{{route('admin.export.produto')}}",
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(data_decoded) {
                if (data_decoded.status == 1) {
                    demo.showNotification('top', 'right', 2, data_decoded.msg,
                        'tim-icons icon-check-2');
                }
                if (data_decoded.status == 0) {
                    demo.showNotification('top', 'right', 5, data_decoded.msg,
                        'tim-icons icon-check-2');
                }
            }
        });
        });


            $('#CodigoCores').on('type', function() {
                if ($('#CodigoCores').val() != '#000000') {
                    $('#EspecialCores').attr('disabled', 'true');
                }
            });

            $('#EspecialCores').on('type', function() {
                if ($('#EspecialCores').val() != '') {
                    $('#CodigoCores').attr('disabled', 'true');
                }
            });

            var path = "{{ route('admin.autocomplete.pro.nome') }}"

            $('input#txt_nome').typeahead({
                source: function(terms, process) {
                    return $.get(path, {
                        terms: terms
                    }, function(dados) {
                        return process(dados);
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
                        if (data_decoded.status == 1) {
                            $('#formExcluir')[0].reset();
                            $('#modalAlertDelete').hide();
                            demo.showNotification('top', 'right', 4, data_decoded.msg,
                                'tim-icons icon-alert-circle-exc');
                        }
                        if (data_decoded.status == 0) {
                            demo.showNotification('top', 'right', 5, data_decoded.msg,
                                'tim-icons icon-alert-circle-exc');
                        }
                    }
                });
            });

            function visualizar(conta, valor, pagto, data) {
                $('#modalShowParcelas').modal('show');
            }

            $('#modalShowParcelas').on('show', function() {
                $('#ls_par_conta').val(conta);
                $('#ls_par_valor').val(valor);
                $('#ls_par_tpg').val(pagto);
                $('#ls_par_data').val(data);
            });

            $("#formFilter").on('submit', function(e) {

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
                    success: function(data_decoded) {
                        var table_produto = data_decoded;
                        table_produto.ajax.reload(null, false);
                    }
                });
            });

        });
    </script>
@endpush
