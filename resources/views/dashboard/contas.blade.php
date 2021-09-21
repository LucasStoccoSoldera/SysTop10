@extends('layouts.header-footer')
@section('title', 'Contas - TopSystem')
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
            <a href="{{ route('admin.financeiro') }}">
                <img src="../img/dash/voltar.png" alt="" class="voltar">
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
                            <h5 class="card-category">Análise Financeira</h5>
                            <h2 class="card-title">Contas a Pagar</h2>
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

    <div class="col-12 justify-content-center">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title" id="no-margin">Resumo de Contas</h2><br>
                </div>
                <div>
                    <div class="col-auto justify-content-md-center float-left">
                        <h4 class="resumo" style="color: #2caeec;">Des. Fixas do Mês:</h4>
                        <h3 class="dados-resumo" style="color: #2caeec;">{{ $dado1 }}</h3>
                    </div>
                    <div class="col-auto justify-content-center float-left">
                        <h4 class="resumo" style="color: #2caeec;">Des. Variáveis do Mês:</h4>
                        <h3 class="dados-resumo" style="color: #2caeec;">{{ $dado2 }}</h3>
                    </div>
                    <div class="col-auto justify-content-center float-left">
                        <h4 class="resumo" style="color: #2caeec;">Total a Pagar:</h4>
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
                            <h2 class="card-title">Filtrar Contas</h2>
                        </div>
                        <div class="col-12">

                            <div class="col-4 float-left">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Data de Vencimento:</label>
                                    <input type="date" name="txt_data_venc" id="txt_data_venc"
                                        value="{{ old('txt_data_venc') }}" class="filtro form-control @error('txt_data_venc') is-invalid @enderror">
                                        @error('txt_data_venc')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors }}</strong>
                                            </span>
                                        @enderror
                                </div>
                                    </div>

                                    <div class="col-4 float-left">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Data de Pagamento:</label>
                                    <input type="date" name="txt_data_pag" id="txt_data_pag"
                                        value="{{ old('txt_data_pag') }}" class="filtro form-control @error('txt_data_pag') is-invalid @enderror">
                                        @error('txt_data_pag')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-4 float-left">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Centro de Custo:</label>
                                    <select type="text" name="txt_centro" id="txt_centro" class="filtro form-control" @error('txt_centro') is-invalid @enderror
                                    maxlength="25" value="{{ old('txt_centro') }}"
                                   >
                                    <option value="">------------Selecione------------</option>
                                    @foreach ($centros as $centro)
                                        <option value="{{ $centro['id'] }}">{{ $centro['cc_descricao'] }}
                                        </option>
                                    @endforeach
                                </select>
                                        @error('txt_centro_custo')
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
        <div class="col-12" style="padding-left: 0px;">
            <div class="card " id="card-consulta-tabela">
                <div class="card-header" id="ch-adaptado">
                    <h2 class="card-title">Consulta de Contas<button class="btn btn-primary btn-block"
                            id="btn-form-consulta-imprimir">Imprimir</button></h2>
                </div>
                <div class="card-body" id="cd-adaptado">
                    <div class="table-responsive">
                        <table class="table tablesorter " id="tb_conta">
                            <thead class=" text-primary">
                                <tr>
                                    <th style="width: 20%">
                                        Descrição
                                    </th>
                                    <th style="width: 10%">
                                        Class.
                                     </th>
                                    <th style="width: 15%">
                                        Valor Final
                                    </th>
                                    <th style="width: 12%">
                                        Tipo
                                    </th>
                                    <th style="width: 15%">
                                        Dt. Venc.
                                    </th>
                                    <th style="width: 10%">
                                        Status
                                     </th>
                                     <th style="width: 20%">
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
@section('sub-menu')
    <div class="add">
        <div class="dropup show-dropdown">
            <a href="#" data-toggle="dropdown">
                <img id="imgsub" src="../img/dash/addbtn.png">
            </a>
            <div class="dropdown-menu" id="add-menu">
                <a class="dropdown-item" id="no-padding" data-backdrop="static" onclick="abrirModal('#modalRegisterContas');"><img
                        src="../img/dash/cadastro_contas.png" width="75" height="75"></a>
                <a class="dropdown-item" id="no-padding" data-backdrop="static" onclick="abrirModal('#modalRegisterCompras');"><img
                        src="../img/dash/compras.png" width="75" height="75"></a>
            </div>
        </div>
    </div>
@endsection
@endsection
@section('modals')

<div class="modal fade" id="modalRegisterContas" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formRegisterContas" autocomplete="off" enctype="multipart/form-data" method="POST"
            action="{{ route('admin.create.conta') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Cadastrar Contas a Pagar</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Descrição:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="text" name="descricaoContas" id="descricaoContas" class="form-control"
                                    maxlength="80" value="{{ old('descricaoContas') }}"
                                    placeholder="Entre com a Descrição" autofocus>
                                    <div class="div-feedback">
                                <span class="invalid-feedback descricaoContas_error" role="alert">
                                </span>
                                    </div>
                            </div>
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Tipo:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <select type="text" name="tipoContas" id="tipoContas" class="form-control"
                                    maxlength="25" value="{{ old('tipoContas') }}"
                                    placeholder="Selecione o Tipo da Conta">
                                    <option value="">------------Selecione------------</option>
                                    <option value="Fixa">Fixa</option>
                                    <option value="Variável">Variável</option>
                                </select>
                                <div class="div-feedback">
                                <span class="invalid-feedback tipoContas_error" role="alert">
                                </span>
                                </div>
                            </div>
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Valor:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="text" name="valorContas" id="valorContas" class="dinheiro form-control"
                                    maxlength="11" value="{{ old('valorContas') }}"
                                    placeholder="Entre com o Valor da Conta">
                                    <div class="div-feedback">
                                <span class="invalid-feedback valorContas_error" role="alert">
                                </span>
                                    </div>
                            </div>
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Valor Final:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="text" name="valorfContas" id="valorfContas"
                                    class="dinheiro form-control" maxlength="11"
                                    value="{{ old('valorfContas') }}"
                                    placeholder="Entre com o Valor Final da Conta">
                                    <div class="div-feedback">
                                <span class="invalid-feedback valorfContas_error" role="alert">
                                </span>
                                    </div>
                            </div>
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Qtde. Parcelas:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <select type="text" name="parcelasContas" id="parcelasContas" class="form-control"
                                    maxlength="25" value="{{ old('parcelasContas') }}"
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
                                <span class="invalid-feedback parcelasContas_error" role="alert">
                                </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="modal-label">Data de Vencimento:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="date" name="datavContas" id="datavContas" class="form-control"
                                    onkeypress="mascara(this, '##/##/####')" maxlength="10"
                                    value="{{ old('datavContas') }}"
                                    placeholder="Entre com a Data de Vencimento">
                                    <div class="div-feedback">
                                <span class="invalid-feedback datavContas_error" role="alert">
                                </span>
                                    </div>
                            </div>
                            <div class="form-group">
                                <label class="modal-label">Data de Pagamento:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="date" name="datapContas" id="datapContas" class="form-control"
                                    onkeypress="mascara(this, '##/##/####')" maxlength="10"
                                    value="{{ old('datapContas') }}" placeholder="Entre com a Data de Pagamento">
                                    <div class="div-feedback">
                                <span class="invalid-feedback datapContas_error" role="alert">
                                </span>
                                    </div>
                            </div>
                            <div class="form-group">
                                <label class="modal-label">Tipo de Pagamento:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <select type="text" name="tpgpagtoContas" id="tpgpagtoContas" class="form-control"
                                    maxlength="25" value="{{ old('tpgpagtoContas') }}"
                                    placeholder="Selecione com o Tipo de Pagamento">
                                    <option value="">------------Selecione------------</option>
                                    @foreach ($pagamentos as $pagamento)
                                        <option value="{{ $pagamento['id'] }}">
                                            {{ $pagamento['tpg_descricao'] }}</option>
                                    @endforeach
                                </select>
                                <div class="div-feedback">
                                <span class="invalid-feedback tpgpagtoContas_error" role="alert">
                                </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="modal-label">Centro de Custo:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <select type="text" name="centrocustoContas" id="centrocustoContas"
                                    class="form-control" maxlength="25" value="{{ old('centrocustoContas') }}"
                                    placeholder="Selecione com o Centro de Custo">
                                    <option value="">------------Selecione------------</option>
                                    @foreach ($centros as $centro)
                                        <option value="{{ $centro['id'] }}">{{ $centro['cc_descricao'] }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="div-feedback">
                                <span class="invalid-feedback centrocustoContas_error" role="alert">
                                </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="cancela btn btn-secondary btn-danger"
                        data-form="formRegisterContas" data-modal="modalRegisterContas">Cancelar</button>
                                  <button  type="reset" class="limpar btn btn-secondary btn-danger"  data-form="formRegisterContas">Limpar</button>
                <button type="submit" class="btn-register btn btn-primary">Cadastrar</button>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="modal fade" id="modalRegisterCompras" style="display:none;" aria-hidden="true">
    <div class="modal-dialog">
        <form class="form-cadastro" name="formRegisterCompras" method="POST" autocomplete="off"
            enctype="multipart/form-data" action="{{ route('admin.create.compra') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Cadastrar Compras</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group" id="form-group">
                                <label class="modal-label">ID Compra:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="text" name="IDCompras" id="IDCompras" class="form-control"
                                    maxlength="80" value="{{ old('IDCompras') }}" placeholder="ID Automático"
                                    autofocus>
                                    <div class="div-feedback">
                                <span class="invalid-feedback IDCompras_error" role="alert">
                                </span>
                                    </div>
                            </div>
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Descrição da Compra:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="text" name="descricaoCompras" id="descricaoCompras"
                                    class="form-control" maxlength="80" value="{{ old('descricaoCompras') }}"
                                    placeholder="Entre com a Descrição da Compra">
                                    <div class="div-feedback">
                                <span class="invalid-feedback descricaoCompras_error" role="alert">
                                </span>
                                    </div>
                            </div>
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Quantidade:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="text" name="qtdeCompras" id="qtdeCompras" class="form-control"
                                    maxlength="5" value="{{ old('qtdeCompras') }}"
                                    placeholder="Entre com a Quantidade">
                                    <div class="div-feedback">
                                <span class="invalid-feedback qtdeCompras_error" role="alert">
                                </span>
                                    </div>
                            </div>
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Desconto:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="text" name="descontoCompras" id="descontoCompras"
                                    class="porcentagem form-control" value="{{ old('descontoCompras') }}">
                                    <div class="div-feedback">
                                <span class="invalid-feedback descontoCompras_error" role="alert">
                                </span>
                                    </div>
                            </div>
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Valor Total:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="text" name="VTCompras" id="VTCompras"
                                    class="dinheiro valor form-control" value="{{ old('VTCompras') }}" disabled>
                                    <div class="div-feedback">
                                <span class="invalid-feedback VTCompras_error" role="alert">
                                </span>
                                    </div>
                            </div>
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Centro de Custo:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <select type="text" name="ccCompras" id="ccCompras" class="form-control"
                                    maxlength="25" value="{{ old('ccCompras') }}"
                                    placeholder="Selecione com o Centro de Custo">
                                    <option value="">------------Selecione------------</option>
                                    @foreach ($centros as $centro)
                                        <option value="{{ $centro['id'] }}">{{ $centro['cc_descricao'] }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="div-feedback">
                                <span class="invalid-feedback ccCompras_error" role="alert">
                                </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Tipo de Pagamento Utilizado:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <select type="text" name="tpgpagtoCompras" id="tpgpagtoCompras" class="form-control"
                                    maxlength="25" value="{{ old('tpgpagtoCompras') }}"
                                    placeholder="Selecione com o Tipo de Pagamento">
                                    <option value="">------------Selecione------------</option>
                                    @foreach ($pagamentos as $pagamento)
                                        <option value="{{ $pagamento['id'] }}">
                                            {{ $pagamento['tpg_descricao'] }}</option>
                                    @endforeach
                                </select>
                                <div class="div-feedback">
                                <span class="invalid-feedback tpgpagtoCompras_error" role="alert">
                                </span>
                                </div>
                            </div>
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Qtde. Parcelas:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <select type="text" name="parcelasCompras" id="parcelasCompras" class="form-control"
                                    maxlength="25" value="{{ old('parcelasCompras') }}"
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
                                <span class="invalid-feedback parcelasCompras_error" role="alert">
                                </span>
                                </div>
                            </div>
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Data da Compra:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="date" name="dataCompras" id="dataCompras" class="form-control"
                                    onkeypress="mascara(this, '##/##/####')" maxlength="10"
                                    value="{{ old('dataCompras') }}" placeholder="Entre com a Data da Compra">
                                    <div class="div-feedback">
                                <span class="invalid-feedback dataCompras_error" role="alert">
                                </span>
                                    </div>
                            </div>
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Data Pag Limite:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="date" name="datapagCompras" id="datapagCompras" class="form-control"
                                    onkeypress="mascara(this, '##/##/####')" maxlength="10"
                                    value="{{ old('datapagCompras') }}" placeholder="Entre com a data Limite">
                                    <div class="div-feedback">
                                <span class="invalid-feedback datapagCompras_error" role="alert">
                                </span>
                                    </div>
                            </div>
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Observações:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="textarea" name="obsCompras" id="obsCompras" class="form-control"
                                    maxlength="255" value="{{ old('obsCompras') }}"
                                    placeholder="Caso tenha alguma Observação">
                                    <div class="div-feedback">
                                <span class="invalid-feedback obsCompras_error" role="alert">
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
                                    <h2 class="card-title">Itens da Compra
                                        <a class="btn btn-primary btn-block"
                                            id="btn-form-consulta-imprimir" data-toggle="modal"
                                            data-backdrop="static" onclick="abrirModal('#modalRegisterItemCompra');">
                                            + Add</a> </h2>
                                </div>
                                <div class="card-body" id="cd-adaptado">
                                    <div class="table-responsive">
                                        <table class="table tablesorter " id="tb_item_compra_ato">
                                            <thead class=" text-primary">
                                                <tr>
                                                    <th style="width: 30%">
                                                        Produto
                                                    </th>
                                                    <th style="width: 10%">
                                                        Qtde
                                                    </th>
                                                    <th style="width: 20%">
                                                        Valor Unit.
                                                    </th>
                                                    <th style="width: 20%">
                                                        Valor Final
                                                    </th>
                                                    <th class="text-right" style="width: 5%">
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
                    <div class="row">
                        <div class="modal-footer" style="width: 100%; padding: 24px 15px 16px 15px;">
                            <button type="button" class="btn btn-secondary btn-danger cancela"
                                data-form="formRegisterCompras" data-modal="modalRegisterCompras">Cancelar</button>
                                          <button  type="reset" class="limpar btn btn-secondary btn-danger"  data-form="formRegisterCompras">Limpar</button>
                <button type="submit" class="btn-register btn btn-primary">Cadastrar</button>
                        </div>
        </form>
    </div>
</div>
</div>
</div>
</div>

<div class="modal fade" id="modalRegisterItemCompra" style="display:none;" aria-hidden="true">
<div class="modal-dialog">
    <form class="form-cadastro" id="formRegisterItemCompra" method="POST" autocomplete="off"
        enctype="multipart/form-data" action="{{ route('admin.create.itemcompra') }}">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cadastrar Itens da Compra</h4>
                <button type="button" class="close" onclick="hideModal('modalRegisterItemCompra');" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group" id="form-group">
                            <label class="modal-label">ID da Compra:</label> <label
                                style="color: red; font-size: 12px;"> * </label>
                            <input type="text" name="IDItemCompra" id="IDCompra" maxlength="2"
                                value="{{ old('IDItemCompra') }}"
                                onloadstart="pegaCodigo(IDItemCompra, IDCompra)" disabled class="form-control">
                                <div class="div-feedback">
                            <span class="invalid-feedback IDCompra_error" role="alert">
                            </span>
                                </div>
                        </div>

                            <div class="form-group" id="form-group">
                                <label class="modal-label">Descrição:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="textarea" name="descricaoItemCompra" id="descricaoItemCompra"
                                    class="form-control" maxlength="80" value="{{ old('descricaoItemCompra') }}"
                                    placeholder="Coloque uma Descrição">
                                    <div class="div-feedback">
                                <span class="invalid-feedback descricaoItemCompra_error" role="alert">
                                </span>
                                    </div>
                            </div>
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Fornecedor:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <select type="text" name="IDFornecedor" id="IDFornecedor" class="form-control"
                                    maxlength="50" value="{{ old('IDFornecedor') }}"
                                    placeholder="Selecione com o Fornecedor" autofocus>
                                    <option value="">------------Selecione------------</option>
                                    @foreach ($fornecedores as $fornecedor)
                                        <option value="{{ $fornecedor['id'] }}">{{ $fornecedor['for_nome'] }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="div-feedback">
                                <span class="invalid-feedback IDFornecedor_error" role="alert">
                                </span>
                                </div>
                            </div>
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Tipo:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <select type="text" name="tipoItemCompra" id="tipoItemCompra" class="form-control"
                                    maxlength="25" value="{{ old('tipoItemCompra') }}"
                                    placeholder="Selecione o Status">
                                    <option value="1">Produto Interno</option>
                                    <option value="2">Produto Externo</option>
                                </select>
                                <div class="div-feedback">
                                <span class="invalid-feedback tipoItemCompra_error" role="alert">
                                </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Valor Item:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="text" name="valorItemCompra" id="valorItemCompra" class="form-control"
                                    value="{{ old('valorItemCompra') }}" placeholder="Entre com a Valor">
                                    <div class="div-feedback">
                                <span class="invalid-feedback valorItemCompra_error" role="alert">
                                </span>
                                    </div>
                            </div>
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Valor Total Item:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="text" name="valorTotalItemCompra" id="valorTotalItemCompra"
                                    class="valor form-control" disabled value="{{ old('valorTotalItemCompra') }}">
                                    <div class="div-feedback">
                                <span class="invalid-feedback valorTotalItemCompra_error" role="alert">
                                </span>
                                    </div>
                            </div>

                    <div id="interno">
                        <div class="form-group" id="form-group">
                            <label class="modal-label">Produto:</label> <label style="color: red; font-size: 12px;">
                                * </label>
                            <select type="text" name="IDProduto" id="IDProduto" class="form-control" maxlength="50"
                                value="{{ old('IDProduto') }}" placeholder="Selecione com o Produto">
                                <option value="">------------Selecione------------</option>
                                @foreach ($produtos as $produto)
                                    <option value="{{ $produto['id'] }}">{{ $produto['pro_nome'] }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="div-feedback">
                            <span class="invalid-feedback IDProduto_error" role="alert">
                            </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="modal-label">Dimensão:</label> <label
                                style="color: red; font-size: 12px;"> * </label>
                            <select type="text" name="dimensaoItemCompra" id="dimensaoItemCompra" class="form-control"
                                onkeypress="mascara(this, '### x ### x ###')" maxlength="15"
                                value="{{ old('dimensaoItemCompra') }}" placeholder="Selecione com o Dimensão">
                                <option value="">------------Selecione------------</option>
                                @foreach ($dimensoes as $dimensao)
                                    <option value="{{ $dimensao['id'] }}">
                                        {{ $dimensao['dim_descricao'] }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="div-feedback">
                            <span class="invalid-feedback dimensaoItemCompra_error" role="alert">
                            </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="modal-label">Cores: </label> <label
                                style="color: red; font-size: 12px;"> * </label>
                            <select type="text" name="coresItemCompra" id="coresItemCompra" class="form-control"
                                maxlength="25" value="{{ old('coresItemCompra') }}"
                                placeholder="Selecione com o Cores">
                                <option value="">------------Selecione------------</option>
                                @foreach ($cores as $cor)
                                    <option value="{{ $cor['id'] }}">{{ $cor['cor_nome'] }}</option>
                                @endforeach
                            </select>
                            <div class="div-feedback">
                            <span class="invalid-feedback coresItemCompra_error" role="alert">
                            </span>
                            </div>
                        </div>
                    </div>
                    <div id="externo">
                        <div class="form-group" id="form-group">
                            <label class="modal-label">Produto:</label> <label style="color: red; font-size: 12px;">
                                * </label>
                            <select type="text" name="IDProduto" id="IDProduto" class="form-control" maxlength="50"
                                value="{{ old('IDProduto') }}" placeholder="Selecione com o Produto">
                                <option value="">------------Selecione------------</option>
                                @foreach ($produtos as $produto)
                                    <option value="{{ $produto['id'] }}">{{ $produto['pro_nome'] }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="div-feedback">
                            <span class="invalid-feedback IDProduto_error" role="alert">
                            </span>
                            </div>
                        </div>
                    </div>
                        <div class="form-group" id="form-group">
                            <label class="modal-label">Quantidade:</label> <label
                                style="color: red; font-size: 12px;"> * </label>
                            <input type="text" name="qtdeItemCompra" id="qtdeItemCompra" class="form-control"
                                maxlength="5" value="{{ old('qtdeItemCompra') }}"
                                placeholder="Entre com a Quantidade">
                                <div class="div-feedback">
                            <span class="invalid-feedback qtdeItemCompra_error" role="alert">
                            </span>
                                </div>
                    </div>
                    </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="cancela btn btn-secondary btn-danger"
                        data-form="formRegisterItemCompra" data-modal="modalRegisterItemCompra">Cancelar</button>
                                  <button  type="reset" class="limpar btn btn-secondary btn-danger"  data-form="formRegisterItemCompra">Limpar</button>
                <button type="submit" class="btn-register btn btn-primary">Cadastrar</button>
                </div>
            </div>
    </form>
</div>
</div>

<div class="modal fade" id="modalShowParcelas" style="display:none;" aria-hidden="true">
    <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Visualização de Parcelas</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group" id="form-direita">
                                <label class="modal-label">Conta: </label><br><br>
                                    <label class="modal-label">Valor Final: </label><br><br>
                                </div>
                        </div>
                                <div class="col-3">
                                    <div class="form-group" id="form-direita">
                                    <label class="modal-label" id="ls_par_conta"></label> <br><br>
                                    <label class="modal-label" id="ls_par_valor"></label><br><br>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group" id="form-direita">
                                <label class="modal-label">Tipo Pagamento: </label><br><br>
                                    <label class="modal-label">Centro de Custo: </label><br><br>
                                </div>
                        </div>
                                <div class="col-3">
                                    <div class="form-group" id="form-direita">
                                    <label class="modal-label" id="ls_par_tpg"></label><br><br>
                                    <label class="modal-label" id="ls_par_cc"></label><br><br>
                            </div>
                        </div>
                    </div>
    <div class="row">
        <div class="col-12">
            <div class="card" id="card-consulta-tabela">
                <div class="card-header" id="ch-adaptado">
                    <h2 class="card-title">Consulta de Parcelas</h2>
                </div>
                <div class="card-body" id="cd-adaptado">
                    <div class="table-responsive">
                        <table class="table tablesorter " id="tb_parcelas">
                            <thead class=" text-primary">
                                <tr>
                                    <th class="text-center" style="width: 5%">
                                        Conta
                                    </th>
                                    <th class="text-center" style="width: 5%">
                                        Parc.
                                    </th>
                                    <th class="text-right" style="width: 20%">
                                        Valor
                                    </th>
                                    <th class="text-center" style="width: 15%">
                                        Status
                                    </th>
                                    <th class="text-center" style="width: 20%">
                                        Pagto.
                                    </th>
                                    <th class="text-right" style="width: 25%">
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
    
    <div id="itemcompra">
    <br>
    <br>
    <div class="row">
        <div class="col-12">
            <div class="card" id="card-consulta-tabela">
                <div class="card-header" id="ch-adaptado">
                    <h2 class="card-title">Consulta de Itens da Compra</h2>
                </div>
                <div class="card-body" id="cd-adaptado">
                    <div class="table-responsive">
                        <table class="table tablesorter " id="tb_item_compra">
                            <thead class=" text-primary">
                                <tr>
                                    <th style="width: 20%">
                                        Produto
                                    </th>
                                    <th class="text-center" style="width: 5%">
                                        Qtde.
                                    </th>
                                    <th style="width: 15%">
                                        Dimensão
                                    </th>
                                    <th style="width: 15%">
                                        Cor
                                    </th>
                                    <th class="text-right" style="width: 15%">
                                        Valor Unit.
                                    </th>
                                    <th class="text-right" style="width: 15%">
                                        Valor Total
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
    <div class="row">
    <div class="modal-footer" style="width: 100%; padding: 24px 15px 16px 15px;">
        <button type="button" class="cancela btn btn-secondary btn-danger"
            data-form="formRegisterMaterial" data-modal="modalRegisterMaterial">Cancelar</button>
</div>
</div>
</div>
</div>
</div>

@endsection


@push('ajax')
<script>

            $("#itemcompra").hide();
            $("#externo").hide();
            $("#interno").show();

    $('#tipoItemCompra').on('blur', function(){
        var valor = $("#tipoItemCompra").val();

            if(valor == "1"){
            $("#externo").hide();
            $("#interno").show();
            $('.div-feedback').val("");
            $('.is-invalid').removeClass('is-invalid');
        } else {
            $("#externo").show();
            $("#interno").hide();
            $('.div-feedback').html("");
            $('.is-invalid').removeClass('is-invalid');
        }
    });

    $(document).ready(function() {

        var table_conta = $('#tb_conta').DataTable( {
            paging: true,
            searching: false,
            processing: true,
            serverside: true,
            ajax: "{{ route('admin.list.contas') }}",
            columns: [
                {data: "con_descricao"},
                {data: "con_compra", className: "text-center"},
                {data: "con_valor_final", className: "text-right"},
                {data: "con_tipo", className: "text-center"},
                {data: "con_data_venc", className: "text-center"},
                {data: "con_status", className: "text-center"},
                {data: "action", className: "text-right"},
            ]
        });

        var table_parcelas = $('#tb_parcelas').DataTable( {
            paging: true,
            searching: false,
            processing: true,
            serverside: true,
            ajax: "{{ route('admin.list.parcelas') }}",
            columns: [
                {data: "par_conta", className: "text-center"},
                {data: "par_numero", className: "text-center"},
                {data: "par_valor", className: "text-right"},
                {data: "par_status", className: "text-center"},
                {data: "par_data_pagto", className: "text-center"},
            ]
        });

        var table_item_compra_ato = $('#tb_item_compra_ato').DataTable( {
            paging: true,
            searching: false,
            processing: true,
            serverside: true,
            ajax: "{{ route('admin.list.itemcompraato') }}",
            columns: [
                {data: "cde_produto"},
                {data: "cde_qtde"},
                {data: "cde_valoritem", className: "text-right"},
                {data: "cde_valortotal", className: "text-right"},
                {data: "action", className: "text-right"},
            ]
        });

        var table_item_compra = $('#tb_item_compra').DataTable( {
            paging: true,
            searching: false,
            processing: true,
            serverside: true,
            ajax: "{{ route('admin.list.itemcompra') }}",
            columns: [
                {data: "cde_produto"},
                {data: "cde_qtde"},
                {data: "dim_id"},
                {data: "cor_id"},
                {data: "cde_valoritem", className: "text-right"},
                {data: "cde_valortotal", className: "text-right"},
                {data: "action", className: "text-right"},
            ]
        });

        $(document).on('click', '[data-dismiss="modal"]',
            function() {
                table_conta.ajax.reload(null, false);
                table_item_compra.ajax.reload(null, false);
                table_parcelas.ajax.reload(null, false);
        }
    );

    $('button.visu').on('click', function(){
            var conta = $(this).data('id');
            var valor = $(this).data('valor');
            var pagto = $(this).data('tpg');
            var centro = $(this).data('cc');
            $('#modalShowParcelas').modal('show');
        });

        $('#modalShowParcelas').on('show', function(){
            $('#ls_par_conta').val(conta);
            $('#ls_par_valor').val(valor);
            $('#ls_par_tpg').val(pagto);
            $('#ls_par_cc').val(centro);
        });

        $("#formRegisterContas").on('submit', function(e) {

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
                    $(document).find('select').removeClass('is-invalid');

                },
                success: function(data_decoded) {
                    if (data_decoded.status == 1) {
                        $('#formRegisterContas')[0].reset();
                        $('#mensagem').text(data_decoded.msg);
                        demo.showNotification('top','right',2,data_decoded.msg, 'tim-icons icon-check-2');
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

        $("#formRegisterCompras").on('submit', function(e) {

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
                        $('#formRegisterCompras')[0].reset();
                        demo.showNotification('top','right',2,data_decoded.msg, 'tim-icons icon-check-2');
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

        $("#formRegisterItemCompra").on('submit', function(e) {

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
                        $('#formRegisterItemCompra')[0].reset();
                        demo.showNotification('top','right',2,data_decoded.msg, 'tim-icons icon-check-2');
                    }
                    if (data_decoded.status == 0) {
                        $.each(data_decoded.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                            $('#' + prefix).addClass('is-invalid');
                        });
                        $.each(data_decoded.error_interno, function(prefix, val) {
                                 $('span.' + prefix + '_error').text(val[0]);
                                $('#' + prefix).addClass('is-invalid');
                             });
                    }
                }
            });
        });
    });

    $('#qtdeCompras, #valorItemCompra').on('change blur keyup', function() {
        $('#qtdeCompras, #valorItemCompra').each(function() { //percorre todos os campos de quantidade
            //quantidade
            var qtd = $('#qtdeCompras').val();
            //pega o valor unitário
            var vlr = $('#valorItemCompra').val();
            // coloca o resultado no valor total
            $('#valorTotalItemCompra').val(qtd * vlr);
        });
    });

  //    $('#modalAlertRegistrar').modal('hide',
  //        function(e)
  //        { //autoimplementa o valor total da compra puxando todos os itens
  //            $.ajax({
  //                headers: {
  //                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //                },
  //                type: "GET",
  //                url: "{{ route('admin.contas.soma') }}",
  //                processData: false,
  //                dataType: 'json',
  //                success: function(data_decoded) {
  //                    $('#VTCompras').val(data_decoded.total - $('#descontoCompras').val());
  //                }
  //            });

            function abrirItem() {
                $('#modalRegisterItemCompra').modal('show');
            }

            function loadItem (id) {
            $id = id;
            $('#tb_parcela').DataTable( {
            paging: false,
            searching: false,
            processing: true,
            serverside: true,
            ajax: "{{ route('admin.list.parcelas') }}",
            columns: [
                {data: "par_numero"},
                {data: "par_conta"},
                {data: "tpg_id"},
                {data: "par_valor"},
                {data: "par_status"},
            ]
        });
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
            $('#modalAlertDelete').hide();
            demo.showNotification('top','right',4,data_decoded.msg, 'icon-alert-circle-exc');
    }
});
});
   //     });
</script>
@endpush
