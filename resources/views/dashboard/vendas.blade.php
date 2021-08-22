@extends('layouts.header-footer')
@section('title', 'Clientes - TopSystem')
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
            <li class="active">
                <a href="{{ route('admin.financeiro') }}">
                    <i class="tim-icons icon-coins"></i>
                    <p>Financeiro</p>
                </a>
            </li>
            <li>
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
        <div class="voltar">
            <a href="{{ route('admin.ContasaReceber') }}">
                <img src="../img/dash/voltar.png" alt="" width="100px" height="100px">
            </a>
        </div>
    </div>
</div>
@endsection
@section('content')
<div class="content">
    <div class="row">
        <div class="col-12">
            <div class="card card-chart">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6 text-left">
                            <h5 class="card-category">Analise de Vendas</h5>
                            <h2 class="card-title">Vendas Online</h2>
                        </div>
                        <div class="col-sm-6 float-right">
                            <div class="btn-group btn-group-toggle float-right" data-toggle="buttons">
                                <label class="btn btn-sm btn-primary btn-simple active" id="0">
                                    <input type="radio" name="options" checked>
                                    <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block"
                                        id="btn-grafico">Teste</span>
                                    <span class="d-block d-sm-none">
                                        <i class="tim-icons icon-single-02"></i>
                                    </span>
                                </label>
                                <label class="btn btn-sm btn-primary btn-simple" id="1">
                                    <input type="radio" class="d-none d-sm-none" name="options">
                                    <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block"
                                        id="btn-grafico">Teste</span>
                                    <span class="d-block d-sm-none">
                                        <i class="tim-icons icon-gift-2"></i>
                                    </span>
                                </label>
                                <label class="btn btn-sm btn-primary btn-simple" id="2">
                                    <input type="radio" class="d-none" name="options">
                                    <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block"
                                        id="btn-grafico">Teste</span>
                                    <span class="d-block d-sm-none">
                                        <i class="tim-icons icon-tap-02"></i>
                                    </span>
                                </label>
                                <label class="btn btn-sm btn-primary btn-simple" id="3">
                                    <input type="radio" class="d-none" name="options">
                                    <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block"
                                        id="btn-grafico">Teste</span>
                                    <span class="d-block d-sm-none">
                                        <i class="tim-icons icon-tap-02"></i>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="chartBig1"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title" id="no-margin">Resumo de Vendas</h2><br>
                </div>
                <div>
                    <div class="col-auto justify-content-md-center float-left">
                        <h4 class="resumo" style="color: #2caeec;">Ven. este Ano (R$):</h4>
                        <h3 class="dados-resumo" style="color: #2caeec;">{{ $dado1 }}</h3>
                    </div>
                    <div class="col-auto justify-content-center float-left">
                        <h4 class="resumo" style="color: #2caeec;">Ven. este Mês (R$):</h4>
                        <h3 class="dados-resumo" style="color: #2caeec;">{{ $dado2 }}</h3>
                    </div>
                    <div class="col-auto justify-content-center float-left">
                        <h4 class="resumo" style="color: #2caeec;">Ven. Hoje (R$):</h4>
                        <h3 class="dados-resumo" style="color: #2caeec;">{{ $dado3 }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-12">
        <div class="row">
            <div class="card">
                    <form class="form" id="form-consulta" method="POST" action="">
                        <div class="card-header">
                            <form class="form-filtro" id="formFilterCliente" method="POST" autocomplete="off"
                            enctype="multipart/form-data" action="">
                            @csrf
                        </div>
                        <div class="col-12">

                            <div class="col-4 float-left">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Cliente:</label>
                                    <input type="text" name="txt_cliente" id="txt_cliente" maxlength="13"
                                        value="{{ old('txt_cliente') }}" class="form-control @error('txt_cliente') is-invalid @enderror">
                                        @error('txt_cliente')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors }}</strong>
                                            </span>
                                        @enderror
                                </div>
                                    </div>

                                    <div class="col-4 float-left">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Data da Venda:</label>
                                    <input type="date" name="txt_data" id="txt_data" maxlength="20"
                                        value="{{ old('txt_data') }}" class="form-control @error('txt_data') is-invalid @enderror">
                                        @error('txt_data')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-4 float-left">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Produto:</label>
                                    <select type="text" name="txt_produto" id="txt_produto" class="form-control" @error('txt_produto') is-invalid @enderror
                                    value="{{ old('txt_produto') }}"
                                   >
                                    <option value="">------------Selecione------------</option>
                                    @foreach ($produtos as $produto)
                                        <option value="{{ $produto['pro_id'] }}">{{ $produto['pro_nome'] }}
                                        </option>
                                    @endforeach
                                </select>
                                        @error('txt_produto')
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
            <div class="card " id="card-consulta-tabela">
                <div class="card-header" id="ch-adaptado">
                    <h2 class="card-title">Consulta de Vendas <button class="btn btn-primary btn-block"
                            id="btn-form-consulta-imprimir">Imprimir</button></h2>
                </div>
                <div class="card-body" id="cd-adaptado">
                    <div class="table-responsive">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                                <tr>
                                    <th style="width: 30%">
                                        Cliente
                                    </th>
                                    <th style="width: 20%">
                                        Valor Total
                                    </th>
                                    <th style="width: 15%">
                                        Status
                                    </th>
                                    <th class="text-center" style="width: 15%">
                                        Data da Venda
                                    </th>
                                    <th class="text-right" style="width: 20%">
                                        Ações
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vendas as $venda)
                                    <tr>
                                        <td>
                                            {{ $venda['cli_id'] }}
                                        </td>
                                        <td>
                                            {{ $venda['ven_valor_total'] }}
                                        </td>
                                        <td>
                                            {{ $venda['tpg_id'] }}
                                        </td>
                                        <td>
                                            {{ $venda['ven_status'] }}
                                        </td>
                                        <td class="text-center">
                                            {{ $venda['ven_data'] }}
                                        </td>
                                        <td class="text-right">
                                            <a href="#" class="btn btn-primary" id="alter"><i
                                                    class="tim-icons icon-pencil"></i></a>
                                            <a href="{{ route('admin.Vendas') }}" class="btn btn-primary"
                                                id="{{ $venda['ven_id'] }}"><i
                                                    class="tim-icons icon-map-big"></i></a>
                                            <button href="#" class="btn btn-primary red" id="excluir-ven"
                                                name="excluir-venda" data-id="{{ $venda['ven_id'] }}" data-rota="{{ route('admin.delete.venda') }}"
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
            <div class="card " id="card-consulta-tabela">
                <div class="card-header" id="ch-adaptado">
                    <h2 class="card-title">Itens Venda <button class="btn btn-primary btn-block"
                        id="btn-form-consulta-imprimir" style="width:auto;"><i  class="tim-icons icon-paper"></i></button></h2>
                </div>
                <div class="card-body" id="cd-adaptado">
                    <div class="table-responsive">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                                <tr>
                                    <th style="width: 10%">
                                        Venda
                                    </th>
                                    <th style="width: 35%">
                                        Produto
                                    </th>
                                    <th style="width: 10%">
                                        Qtde
                                    </th>
                                    <th style="width: 35%">
                                        Valor Total
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($itensvenda)
                                    @foreach ($itensvenda as $itemvenda)
                                        <tr>
                                            <td>
                                                {{ $itemvenda['ven_id'] }}
                                            </td>
                                            <td>
                                                {{ $itemvenda['pro_id'] }}
                                            </td>
                                            <td>
                                                {{ $itemvenda['det_qtde'] }}
                                            </td>
                                            <td class="text-right">
                                                {{ $itemvenda['det_valor_total'] }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endisset
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
            <a href="#" onclick="changeImage();" data-toggle="dropdown">
                <img id="imgsub" src="../img/dash/addbtn.png">
            </a>
            <div class="dropdown-menu" id="add-menu">
                <a class="dropdown-item" id="no-padding" data-toggle="modal" data-backdrop="static" data-target="#modalRegisterVenda"> <img
                        src="../img/dash/cadastro_receber.png" width="75" height="75"></a>
            </div>
        </div>
    </div>
@endsection

@section('modals')

    <div class="modal fade" id="modalRegisterVenda" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <form id="formRegisterVenda" method="POST" autocomplete="off" enctype="multipart/form-data"
                action="{{ route('admin.create.venda') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Cadastrar Nova Venda</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">ID da Venda:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="text" name="IDVenda" id="IDVenda" maxlength="80" class="form-control"
                                        value="{{ old('IDVenda') }}" placeholder="ID Automático" autofocus>
                                        <div class="div-feedback">
                                    <span class="invalid-feedback IDVenda_error" role="alert">
                                    </span>
                                        </div>
                                </div>
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Cliente:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="text" name="IDCliente" id="IDCliente" maxlength="80"
                                        class="form-control" value="{{ old('IDCliente') }}"
                                        placeholder="Entre com o Cliente">
                                        <div class="div-feedback">
                                    <span class="invalid-feedback IDCliente_error" role="alert">
                                    </span>
                                        </div>
                                </div>
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Valor:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="text" name="VTVenda" id="VTVenda" class="dinheiro form-control"
                                        disabled maxlength="11" value="{{ old('VTVenda') }}">
                                        <div class="div-feedback">
                                    <span class="invalid-feedback VTVenda_error" role="alert">
                                    </span>
                                        </div>
                                </div>
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Desconto:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="text" name="descontoVenda" id="descontoVenda"
                                        class="porcentagem form-control" maxlength="11"
                                        value="{{ old('descontoVenda') }}" placeholder="Entre com o Desconto">
                                        <div class="div-feedback">
                                    <span class="invalid-feedback descontoVenda_error" role="alert">
                                    </span>
                                        </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Tipo de Pagamento:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <select type="text" name="IDTipoPagamento" id="IDTipoPagamento" maxlength="25"
                                        class="form-control" value="{{ old('IDTipoPagamento') }}"
                                        placeholder="Selecione com o Tipo de Pagamento">
                                        <option value="">------------Selecione------------</option>
                                        @foreach ($pagamentos as $pagamento)
                                            <option value="{{ $pagamento['tpg_id'] }}">
                                                {{ $pagamento['tpg_descricao'] }}</option>
                                        @endforeach
                                    </select>
                                    <div class="div-feedback">
                                    <span class="invalid-feedback IDTipoPagamento_error" role="alert">
                                    </span>
                                    </div>
                                </div>
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Qtde. Parcelas:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <select type="text" name="parcelasVenda" id="parcelasVenda" class="form-control"
                                        maxlength="25" value="{{ old('parcelasVendas') }}"
                                        placeholder="Selecione a Qtde de Parcelas">
                                        <option value="">------------Selecione------------</option>
                                        <option value="1">A Vista</option>
                                        <option value="2">2x</option>
                                        <option value="3">3x</option>
                                        <option value="4">4x</option>
                                        <option value="5">5x</option>
                                        <option value="6">6x</option>
                                        <option value="7">7x</option>
                                        <option value="8">8x</option>
                                        <option value="9">9x</option>
                                        <option value="10">10x</option>
                                        <option value="11">11x</option>
                                        <option value="12">12x</option>
                                    </select>
                                    <div class="div-feedback">
                                    <span class="invalid-feedback parcelasVenda_error" role="alert">
                                    </span>
                                    </div>
                                </div>
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Logistica:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <select type="text" name="IDLogistica" id="IDLogistica" maxlength="25"
                                        class="form-control" value="{{ old('IDLogistica') }}"
                                        placeholder="Selecione a Logistica">
                                        <option value="">------------Selecione------------</option>
                                        @foreach ($logisticas as $logistica)
                                            <option value="{{ $logistica['log_id'] }}">
                                                {{ $logistica['log_descricao'] }}</option>
                                        @endforeach
                                    </select>
                                    <div class="div-feedback">
                                    <span class="invalid-feedback IDLogistica_error" role="alert">
                                    </span>
                                    </div>
                                </div>
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Status:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <select type="text" name="statusVenda" id="statusVenda" class="form-control"
                                        maxlength="25" value="{{ old('statusVenda') }}"
                                        placeholder="Selecione o Status">
                                        <option value="">------------Selecione------------</option>
                                        <option value="1">Em Aberto</option>
                                        <option value="2">Fechada</option>
                                        <option value="3">Cancelada</option>
                                    </select>
                                    <div class="div-feedback">
                                    <span class="invalid-feedback statusVenda_error" role="alert">
                                    </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-12">
                                <div class="card" id="card-consulta-tabela">
                                    <div class="card-header" id="ch-adaptado">
                                        <h2 class="card-title">Itens da Venda
                                            <a class="btn btn-primary btn-block"
                                            id="btn-form-consulta-imprimir" data-toggle="modal"
                                            data-backdrop="static" data-target="#modalRegisterItemVenda">
                                            + Add</a> </h2>
                                    </div>
                                    <div class="card-body" id="cd-adaptado">
                                        <div class="table-responsive">
                                            <table class="table tablesorter " id="">
                                                <thead class=" text-primary">
                                                    <tr>
                                                        <th style="width: 25%">
                                                            Produto
                                                        </th>
                                                        <th style="width: 10%">
                                                            Qtde
                                                        </th>
                                                        <th style="width: 20%">
                                                            Dimensão
                                                        </th>
                                                        <th style="width: 5%">
                                                            Cor
                                                        </th>
                                                        <th style="width: 20%">
                                                            Valor Total
                                                        </th>
                                                        <th class="text-right" style="width: 20%">
                                                            <div id="acao">Ações</div>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($itens_ato as $item_ato)
                                                        <tr>
                                                            <td>
                                                                {{ $item_ato['pro_id'] }}
                                                            </td>
                                                            <td>
                                                                {{ $item_ato['det_qtde'] }}
                                                            </td>
                                                            <td>
                                                                {{ $item_ato['dim_id'] }}
                                                            </td>
                                                            <td>
                                                                {{ $item_ato['cor_id'] }}
                                                            </td>
                                                            <td class="text-right">
                                                                {{ $item_ato['det_valor_total'] }}
                                                            </td>
                                                            <td class="text-right">
                                                                <a href="#" class="btn btn-primary" id="alter"><i
                                                                        class="tim-icons icon-pencil"></i></a>
                                                                <button href="#" class="btn btn-primary red"
                                                                    id="excluir-det" name="excluir-item-venda"
                                                                    data-id="{{ $item_ato['det_id'] }}" data-rota="{{ route('admin.delete.itemvenda') }}"
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
                        <div class="row">
                            <div class="modal-footer" style="width: 100%; padding: 24px 15px 16px 15px;">
                                <button type="button" class="cancela btn btn-secondary btn-danger"
                                    data-form="formRegisterVenda" data-modal="modalRegisterVenda">Cancelar</button>
                                              <button  type="button" class="limpar btn btn-secondary btn-danger"  data-form="formRegisterVenda">Limpar</button>
                <button type="submit" class="btn-register btn btn-primary">Cadastrar</button>
                            </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>

<div class="modal fade" id="modalRegisterItemVenda" style="display:none;" aria-hidden="true">
    <div class="modal-dialog">
        <form class="form-cadastro" id="formRegisterItemVenda" method="POST" autocomplete="off"
            enctype="multipart/form-data" action="{{ route('admin.create.itemvenda') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Cadastrar Itens da Venda</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group" id="form-group">
                                <label class="modal-label">ID da Venda:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="text" name="IDItemVenda" id="IDItemVenda" maxlength="2"
                                    value="{{ old('IDItemVenda') }}" onloadstart="pegaCodigo(IDItemVenda, IDVenda)"
                                    disabled class="form-control">
                                    <div class="div-feedback">
                                <span class="invalid-feedback IDItemVenda_error" role="alert">
                                </span>
                                    </div>
                            </div>
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Descrição:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="text" name="descricaoItemVenda" id="descricaoItemVenda"
                                    class="form-control" maxlength="80" value="{{ old('descricaoItemVenda') }}"
                                    placeholder="Entre com a Descrição" autofocus>
                                    <div class="div-feedback">
                                <span class="invalid-feedback descricaoItemVenda_error" role="alert">
                                </span>
                                    </div>
                            </div>
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Cor:</label> <label style="color: red; font-size: 12px;"> *
                                </label>
                                <select type="text" name="IDCor" id="IDCor" class="form-control" maxlength="25"
                                    value="{{ old('IDCor') }}" placeholder="Selecione com a Cor">
                                    <option value="">------------Selecione------------</option>
                                    @foreach ($cores as $cor)
                                        <option value="{{ $cor['cor_id'] }}">{{ $cor['cor_nome'] }}</option>
                                    @endforeach
                                </select>
                                <div class="div-feedback">
                                <span class="invalid-feedback IDCor_error" role="alert">
                                </span>
                                </div>
                            </div>
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Dimensão:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <select type="text" name="IDDimensao" id="IDDimensao" class="form-control"
                                    onkeypress="mascara(this, '### x ### x ###')" maxlength="15"
                                    value="{{ old('IDDimensao') }}" placeholder="Selecione com a Dimensão">
                                    <option value="">------------Selecione------------</option>
                                    @foreach ($dimensoes as $dimensao)
                                        <option value="{{ $dimensao['dim_id'] }}">{{ $dimensao['dim_descricao'] }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="div-feedback">
                                <span class="invalid-feedback IDDimensao_error" role="alert">
                                </span>
                                </div>
                            </div>
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Produto:</label> <label style="color: red; font-size: 12px;">
                                    * </label>
                                <select type="text" name="IDProduto" id="IDProduto" class="form-control" maxlength="50"
                                    value="{{ old('IDProduto') }}" placeholder="Selecione com o Produto">
                                    <option value="">------------Selecione------------</option>
                                    @foreach ($produtos as $produto)
                                        <option value="{{ $produto['pro_id'] }}">{{ $produto['pro_nome'] }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="div-feedback">
                                <span class="invalid-feedback IDProduto_error" role="alert">
                                </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Quantidade:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="number" name="qtdeItemVenda" id="qtdeItemVenda" class="form-control"
                                    maxlength="6" value="{{ old('qtdeItemVenda') }}"
                                    placeholder="Entre com a Quantidade">
                                    <div class="div-feedback">
                                <span class="invalid-feedback qtdeItemVenda_error" role="alert">
                                </span>
                                    </div>
                            </div>
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Anexo / Arte:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="file" name="anexoItemVenda" id="anexoItemVenda" class="form-control"
                                    placeholder="Entre com o Anexo" value="{{ old('anexoItemVenda') }}">
                                    <div class="div-feedback">
                                <span class="invalid-feedback anexoItemVenda_error" role="alert">
                                </span>
                                    </div>
                            </div>
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Valor Unitário:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="text" name="VUItemVenda" id="VUItemVenda" class="dinheiro form-control"
                                    maxlength="11" value="{{ old('VUItemVenda') }}"
                                    placeholder="Entre com o Valor Unit.">
                                    <div class="div-feedback">
                                <span class="invalid-feedback VUItemVenda_error" role="alert">
                                </span>
                                    </div>
                            </div>
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Valor Total:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="text" name="VTItemVenda" id="VTItemVenda" class="dinheiro form-control"
                                    disabled maxlength="11" value="{{ old('VTItemVenda') }}">
                                    <div class="div-feedback">
                                <span class="invalid-feedback VTItemVenda_error" role="alert">
                                </span>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="cancela btn btn-secondary btn-danger"
                            data-form="formRegisterItemVenda" data-modal="modalRegisterItemVenda">Cancelar</button>
                                      <button  type="button" class="limpar btn btn-secondary btn-danger"  data-form="formRegisterItemVenda">Limpar</button>
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

        $("#formRegisterVenda").on('submit', function(e) {

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
                        $('#formRegisterVenda')[0].reset();
                        $('#mensagem').attr(data_decoded.msg);
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

        $("#formRegisterItemVenda").on('submit', function(e) {

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
                        $('#formRegisterItemVenda')[0].reset();
                        $('#mensagem').attr(data_decoded.msg);
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


    $('#qtdeItemVenda, #VUItemVenda').on('change blur keyup', function() {
        $('#qtdeItemVenda, #VUItemVenda').each(function() { //percorre todos os campos de quantidade
            //quantidade
            var qtd = $('#qtdeItemVenda').val();
            //pega o valor unitário
            var vlr = $('#VUItemVenda').val();
            // coloca o resultado no valor total
            $('#VTItemVenda').val(qtd * vlr);
        });
    });

    $(document).on('click', '[data-dismiss="modal"]',
            function(e) {
        e.preventDefault();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                url: "{{ route('admin.list.detalhe') }}",
                processData: false,
                dataType: 'json',
                success: function(data_decoded) {
                    $vendas = data_decoded.$vendas;
                    $itensvenda = data_decoded.$itensvenda;
                    $itens_ato = data_decoded.$itens_ato;
                }
            });
        }
    );

    $('#modalAlertRegistrar').modal('hide',
        function() {
             //auto implementa o valor total da compra puxando todos os itens
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                url: "{{ route('admin.contas.soma') }}",
                processData: false,
                dataType: 'json',
                success: function(data_decoded) {
                    $('#VTVenda').val(data_decoded.total - $('#descontoVenda').val());
                }
            });
          }
    );

    var path = "{{route ('admin.autocomplete.ven.cliente')}}"

$('input#txt_cliente').typeahead({
    source: function (terms,process){
        return $.get(path, {terms:terms}, function(data){
            return process(data);
        });
    }
});

function abrirItem {
    $('#modalRegisterItemVenda').modal('show');
}

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
            $('#modalReturnDelete').modal('show');
    }
});
});
});
</script>
@endpush
