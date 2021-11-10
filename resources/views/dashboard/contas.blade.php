@extends('layouts.header-footer')
@section('title', 'Contas - TopSystem')
@section('menu-principal')
    <div class="sidebar">
        <!--
                                Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red"
                            -->
        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="{{ route('admin.financeiro') }}" class="simple-text logo-mini">
                        <img src="../img/dash/voltar_vermelho.png" alt="" class="voltar">
                </a>
                <a href="javascript:void(0)" class="simple-text logo-normal">
                    SysTop10
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
                        <i class="tim-icons icon-settings"></i>
                        <p>Administração</p>
                    </a>
                </li>
            </ul>
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

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="chartCon"></canvas>
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
                    <form class="form-filtro" id="formFilter" method="POST" autocomplete="off"
                        enctype="multipart/form-data" action="{{ route('admin.filtro.contas') }}">
                        @csrf
                        <div class="card-header">
                            <h2 class="card-title">Filtrar Contas</h2>
                        </div>
                        <div class="col-12">

                            <div class="col-4 float-left">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Data de Vencimento:</label>
                                    <input type="date" name="txt_data_venc" id="txt_data_venc"
                                        value="{{ old('txt_data_venc') }}" class="filtro form-control">
                                </div>
                            </div>

                            <div class="col-4 float-left">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Data de Pagamento:</label>
                                    <input type="date" name="txt_data_pag" id="txt_data_pag"
                                        value="{{ old('txt_data_pag') }}" class="filtro form-control">
                                </div>
                            </div>

                            <div class="col-4 float-left">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Centro de Custo:</label>
                                    <select type="text" name="txt_centro" id="txt_centro" class="filtro form-control"
                                        maxlength="25" value="{{ old('txt_centro') }}">
                                        <option value="">Selecione</option>
                                        @foreach ($centros as $centro)
                                            <option value="{{ $centro['id'] }}">{{ $centro['cc_descricao'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <button class="btn btn-primary" id="btn-form-consulta">Filtrar</button>
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
                        <h2 class="card-title">Consulta de Contas</h2>
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
                    <a class="dropdown-item" id="no-padding" data-backdrop="static"
                        onclick="abrirModal('#modalRegisterContas');"><img src="../img/dash/cadastro_contas.png" width="75"
                            height="75"></a>
                    <a class="dropdown-item" id="no-padding" data-backdrop="static"
                        onclick="abrirModal('#modalRegisterCompras');"><img src="../img/dash/compras.png" width="75"
                            height="75"></a>
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
                                    <input type="text" name="descricaoContas" id="descricaoContas"
                                        class="form-control" maxlength="80" value="{{ old('descricaoContas') }}"
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
                                    <input type="text" name="valorContas" id="valorContas"
                                        class="dinheiro form-control" maxlength="11"
                                        value="{{ old('valorContas') }}" placeholder="Entre com o Valor da Conta">
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
                                    <select type="text" name="parcelasContas" id="parcelasContas"
                                        class="form-control" maxlength="25" value="{{ old('parcelasContas') }}"
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
                                    <select type="text" name="tpgpagtoContas" id="tpgpagtoContas"
                                        class="form-control" maxlength="25" value="{{ old('tpgpagtoContas') }}"
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
                        <button type="reset" class="limpar btn btn-secondary btn-danger"
                            data-form="formRegisterContas">Limpar</button>
                        <button type="submit" class="btn-register btn btn-primary">Cadastrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="modal fade" id="modalRegisterCompras" style="display:none;" aria-hidden="true">
        <div class="modal-dialog">
            <form class="form-cadastro" name="formRegisterCompras" id="formRegisterCompras" method="POST"
                autocomplete="off" enctype="multipart/form-data" action="{{ route('admin.create.compra') }}">
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
                                    <input type="number" name="IDCompras" id="IDCompras" class="form-control id"
                                        maxlength="10" value="{{ old('IDCompras') }}" placeholder="ID" autofocus>
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
                                    <select type="text" name="tpgpagtoCompras" id="tpgpagtoCompras"
                                        class="form-control" maxlength="25" value="{{ old('tpgpagtoCompras') }}"
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
                                    <select type="text" name="parcelasCompras" id="parcelasCompras"
                                        class="form-control" maxlength="25" value="{{ old('parcelasCompras') }}"
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
                                    <label class="modal-label">Observações:</label>
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
                            <div class="modal-footer" style="width: 100%; padding: 24px 15px 16px 15px;">
                                <button type="button" class="btn btn-secondary btn-danger cancela"
                                    data-form="formRegisterCompras" data-modal="modalRegisterCompras">Cancelar</button>
                                <button type="reset" class="limpar btn btn-secondary btn-danger"
                                    data-form="formRegisterCompras">Limpar</button>
                                <button type="submit" class="btn-register btn btn-primary">Cadastrar</button>
                            </div>
                        </div>
            </form>

            <br>

            <div class="row">
                <div class="col-12">
                    <div class="card" id="card-consulta-tabela">
                        <div class="card-header" id="ch-adaptado">
                            <h2 class="card-title">Itens da Compra
                                <a class="btn btn-primary btn-block" id="btn-form-consulta-imprimir"
                                    data-backdrop="static"
                                    onclick="abrirModal('#modalRegisterItemCompra', '#IDCompras', '#IDItemCompra');">
                                    + Add</a>
                            </h2>
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group" id="form-group">
                                <label class="modal-label">ID da Compra:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="number" name="IDItemCompra" id="IDItemCompra" class="form-control id">
                                <div class="div-feedback">
                                    <span class="invalid-feedback IDItemCompra_error" role="alert">
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
                                    placeholder="Selecione o Tipo">
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
                                <input type="text" name="valorItemCompra" id="valorItemCompra"
                                    class="dinheiro form-control" value="{{ old('valorItemCompra') }}"
                                    placeholder="Entre com a Valor">
                                <div class="div-feedback">
                                    <span class="invalid-feedback valorItemCompra_error" role="alert">
                                    </span>
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
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Valor Total Item:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="text" name="valorTotalItemCompra" id="valorTotalItemCompra"
                                    class="valor dinheiro form-control auto"
                                    value="{{ old('valorTotalItemCompra') }}">
                                <div class="div-feedback">
                                    <span class="invalid-feedback valorTotalItemCompra_error" role="alert">
                                    </span>
                                </div>
                            </div>

                            <div id="interno">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Produto:</label> <label
                                        style="color: red; font-size: 12px;">
                                        * </label>
                                    <select type="text" name="IDProdutoI" id="IDProdutoI" class="form-control"
                                        maxlength="50" value="{{ old('IDProdutoI') }}"
                                        placeholder="Selecione com o Produto">
                                        <option value="">------------Selecione------------</option>
                                        @foreach ($produtos as $produto)
                                            <option value="{{ $produto['id'] }}">{{ $produto['pro_nome'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="div-feedback">
                                        <span class="invalid-feedback IDProdutoI_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="modal-label">Dimensão:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <select type="text" name="dimensaoItemCompra" id="dimensaoItemCompra"
                                        class="form-control" onkeypress="mascara(this, '### x ### x ###')"
                                        maxlength="15" value="{{ old('dimensaoItemCompra') }}"
                                        placeholder="Selecione com o Dimensão">
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
                                    <select type="text" name="coresItemCompra" id="coresItemCompra"
                                        class="form-control" maxlength="25" value="{{ old('coresItemCompra') }}"
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
                                    <label class="modal-label">Produto:</label> <label
                                        style="color: red; font-size: 12px;">
                                        * </label>
                                    <input type="text" name="IDProdutoE" id="IDProdutoE" class="form-control"
                                        maxlength="50" value="{{ old('IDProdutoE') }}"
                                        placeholder="Selecione com o Produto">
                                    <div class="div-feedback">
                                        <span class="invalid-feedback IDProdutoE_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="cancela btn btn-secondary btn-danger"
                        data-form="formRegisterItemCompra" data-modal="modalRegisterItemCompra">Cancelar</button>
                    <button type="reset" class="limpar btn btn-secondary btn-danger"
                        data-form="formRegisterItemCompra">Limpar</button>
                    <button type="submit" class="btn-register btn btn-primary">Cadastrar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modalUpdateContas" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formUpdateContas" autocomplete="off" enctype="multipart/form-data" method="PUT"
            action="{{ route('admin.update.conta') }}">
            @csrf
            <input type="hidden" id="idCon" name="idCon">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Atualizar Contas a Pagar</h4>
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
                                <input type="text" name="descricaoContasUp" id="descricaoContasUp"
                                    class="form-control" maxlength="80" value="{{ old('descricaoContasUp') }}"
                                    placeholder="Entre com a Descrição" autofocus>
                                <div class="div-feedback">
                                    <span class="invalid-feedback descricaoContasUp_error" role="alert">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Tipo:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <select type="text" name="tipoContasUp" id="tipoContasUp" class="form-control"
                                    maxlength="25" value="{{ old('tipoContasUp') }}"
                                    placeholder="Selecione o Tipo da Conta">
                                    <option value="">------------Selecione------------</option>
                                    <option value="Fixa">Fixa</option>
                                    <option value="Variável">Variável</option>
                                </select>
                                <div class="div-feedback">
                                    <span class="invalid-feedback tipoContasUp_error" role="alert">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Valor:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="text" name="valorContasUp" id="valorContasUp"
                                    class="dinheiro form-control" maxlength="11" value="{{ old('valorContasUp') }}"
                                    placeholder="Entre com o Valor da Conta">
                                <div class="div-feedback">
                                    <span class="invalid-feedback valorContasUp_error" role="alert">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Valor Final:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="text" name="valorfContasUp" id="valorfContasUp"
                                    class="dinheiro form-control auto" maxlength="11"
                                    value="{{ old('valorfContasUp') }}"
                                    placeholder="Entre com o Valor Final da Conta">
                                <div class="div-feedback">
                                    <span class="invalid-feedback valorfContasUp_error" role="alert">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Qtde. Parcelas:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <select type="text" name="parcelasContasUp" id="parcelasContasUp"
                                    class="form-control" maxlength="25" value="{{ old('parcelasContasUp') }}"
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
                                    <span class="invalid-feedback parcelasContasUp_error" role="alert">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="modal-label">Data de Vencimento:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="date" name="datavContasUp" id="datavContasUp" class="form-control"
                                    onkeypress="mascara(this, '##/##/####')" maxlength="10"
                                    value="{{ old('datavContasUp') }}" placeholder="Entre com a Data de Vencimento">
                                <div class="div-feedback">
                                    <span class="invalid-feedback datavContasUp_error" role="alert">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="modal-label">Data de Pagamento:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="date" name="datapContasUp" id="datapContasUp" class="form-control"
                                    onkeypress="mascara(this, '##/##/####')" maxlength="10"
                                    value="{{ old('datapContasUp') }}" placeholder="Entre com a Data de Pagamento">
                                <div class="div-feedback">
                                    <span class="invalid-feedback datapContasUp_error" role="alert">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="modal-label">Tipo de Pagamento:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <select type="text" name="tpgpagtoContasUp" id="tpgpagtoContasUp"
                                    class="form-control" maxlength="25" value="{{ old('tpgpagtoContasUp') }}"
                                    placeholder="Selecione com o Tipo de Pagamento">
                                    <option value="">------------Selecione------------</option>
                                    @foreach ($pagamentos as $pagamento)
                                        <option value="{{ $pagamento['id'] }}">
                                            {{ $pagamento['tpg_descricao'] }}</option>
                                    @endforeach
                                </select>
                                <div class="div-feedback">
                                    <span class="invalid-feedback tpgpagtoContasUp_error" role="alert">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="modal-label">Centro de Custo:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <select type="text" name="centrocustoContasUp" id="centrocustoContasUp"
                                    class="form-control" maxlength="25" value="{{ old('centrocustoContasUp') }}"
                                    placeholder="Selecione com o Centro de Custo">
                                    <option value="">------------Selecione------------</option>
                                    @foreach ($centros as $centro)
                                        <option value="{{ $centro['id'] }}">{{ $centro['cc_descricao'] }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="div-feedback">
                                    <span class="invalid-feedback centrocustoContasUp_error" role="alert">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="cancela btn btn-secondary btn-danger" data-form="formUpdateContas"
                        data-modal="modalUpdateContas">Cancelar</button>
                    <button type="reset" class="limpar btn btn-secondary btn-danger"
                        data-form="formUpdateContas">Limpar</button>
                    <button type="submit" class="btn-register btn btn-primary">Cadastrar</button>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="modal fade" id="modalUpdateCompras" style="display:none;" aria-hidden="true">
    <div class="modal-dialog">
        <form class="form-cadastro" name="formUpdateCompras" id="formUpdateCompras" method="PUT" autocomplete="off"
            enctype="multipart/form-data" action="{{ route('admin.update.compra') }}">
            @csrf
            <input type="hidden" id="idCom" name="idCom">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Atualizar Compras</h4>
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
                                <input type="number" name="IDComprasUp" id="IDComprasUp" class="form-control id"
                                    maxlength="80" value="{{ old('IDComprasUp') }}" placeholder="ID" autofocus>
                                <div class="div-feedback">
                                    <span class="invalid-feedback IDComprasUp_error" role="alert">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Descrição da Compra:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="text" name="descricaoComprasUp" id="descricaoComprasUp"
                                    class="form-control" maxlength="80" value="{{ old('descricaoComprasUp') }}"
                                    placeholder="Entre com a Descrição da Compra">
                                <div class="div-feedback">
                                    <span class="invalid-feedback descricaoComprasUp_error" role="alert">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Desconto:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="text" name="descontoComprasUp" id="descontoComprasUp"
                                    class="porcentagem form-control" value="{{ old('descontoComprasUp') }}">
                                <div class="div-feedback">
                                    <span class="invalid-feedback descontoComprasUp_error" role="alert">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Centro de Custo:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <select type="text" name="ccComprasUp" id="ccComprasUp" class="form-control"
                                    maxlength="25" value="{{ old('ccComprasUp') }}"
                                    placeholder="Selecione com o Centro de Custo">
                                    <option value="">------------Selecione------------</option>
                                    @foreach ($centros as $centro)
                                        <option value="{{ $centro['id'] }}">{{ $centro['cc_descricao'] }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="div-feedback">
                                    <span class="invalid-feedback ccComprasUp_error" role="alert">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Tipo de Pagamento Utilizado:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <select type="text" name="tpgpagtoComprasUp" id="tpgpagtoComprasUp"
                                    class="form-control" maxlength="25" value="{{ old('tpgpagtoComprasUp') }}"
                                    placeholder="Selecione com o Tipo de Pagamento">
                                    <option value="">------------Selecione------------</option>
                                    @foreach ($pagamentos as $pagamento)
                                        <option value="{{ $pagamento['id'] }}">
                                            {{ $pagamento['tpg_descricao'] }}</option>
                                    @endforeach
                                </select>
                                <div class="div-feedback">
                                    <span class="invalid-feedback tpgpagtoComprasUp_error" role="alert">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Qtde. Parcelas:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <select type="text" name="parcelasComprasUp" id="parcelasComprasUp"
                                    class="form-control" maxlength="25" value="{{ old('parcelasComprasUp') }}"
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
                                    <span class="invalid-feedback parcelasComprasUp_error" role="alert">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Data da Compra:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="date" name="dataComprasUp" id="dataComprasUp" class="form-control"
                                    onkeypress="mascara(this, '##/##/####')" maxlength="10"
                                    value="{{ old('dataComprasUp') }}" placeholder="Entre com a Data da Compra">
                                <div class="div-feedback">
                                    <span class="invalid-feedback dataComprasUp_error" role="alert">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Data Pag Limite:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="date" name="datapagComprasUp" id="datapagComprasUp" class="form-control"
                                    onkeypress="mascara(this, '##/##/####')" maxlength="10"
                                    value="{{ old('datapagComprasUp') }}" placeholder="Entre com a data Limite">
                                <div class="div-feedback">
                                    <span class="invalid-feedback datapagComprasUp_error" role="alert">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Observações:</label>
                                <input type="textarea" name="obsComprasUp" id="obsComprasUp" class="form-control"
                                    maxlength="255" value="{{ old('obsComprasUp') }}"
                                    placeholder="Caso tenha alguma Observação">
                                <div class="div-feedback">
                                    <span class="invalid-feedback obsComprasUp_error" role="alert">
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
                                        <a class="btn btn-primary btn-block" id="btn-form-consulta-imprimir"
                                            data-backdrop="static"
                                            onclick="abrirModal('#modalUpdateItemCompra', '#IDCompras', '#IDItemCompra');">
                                            + Add</a>
                                    </h2>
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
                                data-form="formUpdateCompras" data-modal="modalUpdateCompras">Cancelar</button>
                            <button type="reset" class="limpar btn btn-secondary btn-danger"
                                data-form="formUpdateCompras">Limpar</button>
                            <button type="submit" class="btn-register btn btn-primary">Cadastrar</button>
                        </div>
                    </div>
        </form>
    </div>
</div>
</div>
</div>

<div class="modal fade" id="modalUpdateItemCompra" style="display:none;" aria-hidden="true">
    <div class="modal-dialog">
        <form class="form-cadastro" id="formUpdateItemCompra" method="PUT" autocomplete="off"
            enctype="multipart/form-data" action="{{ route('admin.update.itemcompra') }}">
            @csrf
            <input type="hidden" id="idIteCom" name="idIteCom">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Atualizar Itens da Compra</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group" id="form-group">
                                <label class="modal-label">ID da Compra:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="number" name="IDItemCompraUp" id="IDItemCompraUp"
                                    value="{{ old('IDItemCompraUp') }}" class="form-control id">
                                <div class="div-feedback">
                                    <span class="invalid-feedback IDItemCompraUp_error" role="alert">
                                    </span>
                                </div>
                            </div>

                            <div class="form-group" id="form-group">
                                <label class="modal-label">Descrição:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="textarea" name="descricaoItemCompraUp" id="descricaoItemCompraUp"
                                    class="form-control" maxlength="80" value="{{ old('descricaoItemCompraUp') }}"
                                    placeholder="Coloque uma Descrição">
                                <div class="div-feedback">
                                    <span class="invalid-feedback descricaoItemCompraUp_error" role="alert">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Fornecedor:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <select type="text" name="IDFornecedorUp" id="IDFornecedorUp" class="form-control"
                                    maxlength="50" value="{{ old('IDFornecedorUp') }}"
                                    placeholder="Selecione com o Fornecedor" autofocus>
                                    <option value="">------------Selecione------------</option>
                                    @foreach ($fornecedores as $fornecedor)
                                        <option value="{{ $fornecedor['id'] }}">{{ $fornecedor['for_nome'] }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="div-feedback">
                                    <span class="invalid-feedback IDFornecedorUp_error" role="alert">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Tipo:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <select type="text" name="tipoItemCompraUp" id="tipoItemCompraUp"
                                    class="form-control" maxlength="25" value="{{ old('tipoItemCompraUp') }}"
                                    placeholder="Selecione o Tipo">
                                    <option value="1">Produto Interno</option>
                                    <option value="2">Produto Externo</option>
                                </select>
                                <div class="div-feedback">
                                    <span class="invalid-feedback tipoItemCompraUp_error" role="alert">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Valor Item:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="text" name="valorItemCompraUp" id="valorItemCompraUp"
                                    class="dinheiro form-control" value="{{ old('valorItemCompraUp') }}"
                                    placeholder="Entre com a Valor">
                                <div class="div-feedback">
                                    <span class="invalid-feedback valorItemCompraUp_error" role="alert">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Quantidade:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="text" name="qtdeItemCompraUp" id="qtdeItemCompraUp" class="form-control"
                                    maxlength="5" value="{{ old('qtdeItemCompraUp') }}"
                                    placeholder="Entre com a Quantidade">
                                <div class="div-feedback">
                                    <span class="invalid-feedback qtdeItemCompraUp_error" role="alert">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Valor Total Item:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="text" name="valorTotalItemCompraUp" id="valorTotalItemCompraUp"
                                    class="valor dinheiro form-control"
                                    value="{{ old('valorTotalItemCompraUp') }}">
                                <div class="div-feedback">
                                    <span class="invalid-feedback valorTotalItemCompraUp_error" role="alert">
                                    </span>
                                </div>
                            </div>

                            <div id="interno">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Produto:</label> <label
                                        style="color: red; font-size: 12px;">
                                        * </label>
                                    <select type="text" name="IDProdutoIUp" id="IDProdutoIUp" class="form-control"
                                        maxlength="50" value="{{ old('IDProdutoI') }}"
                                        placeholder="Selecione com o Produto">
                                        <option value="">------------Selecione------------</option>
                                        @foreach ($produtos as $produto)
                                            <option value="{{ $produto['id'] }}">{{ $produto['pro_nome'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="div-feedback">
                                        <span class="invalid-feedback IDProdutoIUp_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="modal-label">Dimensão:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <select type="text" name="dimensaoItemCompraUp" id="dimensaoItemCompraUp"
                                        class="form-control" onkeypress="mascara(this, '### x ### x ###')"
                                        maxlength="15" value="{{ old('dimensaoItemCompraUp') }}"
                                        placeholder="Selecione com o Dimensão">
                                        <option value="">------------Selecione------------</option>
                                        @foreach ($dimensoes as $dimensao)
                                            <option value="{{ $dimensao['id'] }}">
                                                {{ $dimensao['dim_descricao'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="div-feedback">
                                        <span class="invalid-feedback dimensaoItemCompraUp_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="modal-label">Cores: </label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <select type="text" name="coresItemCompraUp" id="coresItemCompraUp"
                                        class="form-control" maxlength="25"
                                        value="{{ old('coresItemCompraUp') }}" placeholder="Selecione com o Cores">
                                        <option value="">------------Selecione------------</option>
                                        @foreach ($cores as $cor)
                                            <option value="{{ $cor['id'] }}">{{ $cor['cor_nome'] }}</option>
                                        @endforeach
                                    </select>
                                    <div class="div-feedback">
                                        <span class="invalid-feedback coresItemCompraUp_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div id="externo">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Produto:</label> <label
                                        style="color: red; font-size: 12px;">
                                        * </label>
                                    <select type="text" name="IDProdutoEUp" id="IDProdutoEUp" class="form-control"
                                        maxlength="50" value="{{ old('IDProdutoEUp') }}"
                                        placeholder="Selecione com o Produto">
                                        <option value="">------------Selecione------------</option>
                                        @foreach ($produtos as $produto)
                                            <option value="{{ $produto['id'] }}">{{ $produto['pro_nome'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="div-feedback">
                                        <span class="invalid-feedback IDProdutoEUp_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="cancela btn btn-secondary btn-danger" data-form="formUpdateItemCompra"
                        data-modal="modalUpdateItemCompra">Cancelar</button>
                    <button type="reset" class="limpar btn btn-secondary btn-danger"
                        data-form="formUpdateItemCompra">Limpar</button>
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
                            <label class="modal-label">Valor Final: </label>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group" id="form-direita">
                            <label class="modal-label" id="ls_par_conta"></label> <br><br>
                            <label class="modal-label" id="ls_par_valor"></label><br>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group" id="form-direita">
                            <label class="modal-label">Pagto: </label><br><br>
                            <label class="modal-label">Centro: </label><br>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group" id="form-direita">
                            <label class="modal-label" id="ls_par_tpg"></label><br><br><br>
                            <label class="modal-label" id="ls_par_cc"></label><br>
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
                                    <table class="table tablesorter " id="table_parcelas">
                                        <thead class=" text-primary">
                                            <tr>
                                                <th class="text-center" style="width: 10%">
                                                    Conta
                                                </th>
                                                <th class="text-center" style="width: 10%">
                                                    Parc.
                                                </th>
                                                <th class="text-right" style="width: 30%">
                                                    Valor
                                                </th>
                                                <th class="text-center" style="width: 15%">
                                                    Status
                                                </th>
                                                <th class="text-center" style="width: 30%">
                                                    Pagto.
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
                        <button type="button" class=" btn btn-secondary btn-danger" data-dismiss="modal"
                            style="width: 100%">Cancelar</button>
                    </div>
                </div>
            </div>
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

    $('#tipoItemCompra').on('blur', function() {
        var valor = $("#tipoItemCompra").val();

        if (valor == "1") {
            $("#externo").hide();
            $("#interno").show();
            $('.div-feedback').hide();
            $('.is-invalid').removeClass('is-invalid');
        } else {
            $("#externo").show();
            $("#interno").hide();
            $('.div-feedback').hide();
            $('.is-invalid').removeClass('is-invalid');
        }
        $('.div-feedback').show();
    });

    $('#IDCompras').on('blur', function() {
        var idcompra = $("#IDCompras").val();
        table_item_compra_ato.ajax.reload(null, false);
    });



    $('#modalRegisterItemCompra').on('[data-dismiss="modal"]', function() {
        $("#modalRegisterCompras").show()
    });

    $('#valorItemCompra').on('blur', function() {
        var valor = $("#valorItemCompra").val();
    });

    $('#valorItemCompra').on('blur', function() {
        var qtde = $("#qtdeItemCompra").val();
        var valor = $("#valorItemCompra").val();
        var total = qtde * valor;

        $("#valorTotalItemCompra").val(total);
    });

    $('#qtdeItemCompra').on('blur', function() {
        var qtde = $("#qtdeItemCompra").val();
        var valor = $("#valorItemCompra").val();
        var total = qtde * valor;

        $("#valorTotalItemCompra").val(total);
    });

    $(document).ready(function() {

        var lista_parcelas = false;

        var table_conta = $('#tb_conta').DataTable({
            paging: true,
            searching: false,
            processing: true,
            serverside: true,
            ajax: "{{ route('admin.list.contas') }}",
            columns: [{
                    data: "con_descricao"
                },
                {
                    data: "con_compra",
                    className: "text-center"
                },
                {
                    data: "con_valor_final",
                    className: "text-right",
                    render: DataTable.render.number('.', ',', 2, 'R$')
                },
                {
                    data: "con_tipo",
                    className: "text-center"
                },
                {
                    data: "con_data_venc",
                    className: "text-center"
                },
                {
                    data: "con_status",
                    className: "text-center"
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

        var table_item_compra_ato = $('#tb_item_compra_ato').DataTable({
            paging: true,
            searching: false,
            processing: true,
            serverside: true,
            ajax: {
                type: 'GET',
                url: '/admin/List_ItemCompraAto/' + $('#IDCompras').val('id'),
            },
            columns: [{
                    data: "cde_produto"
                },
                {
                    data: "cde_qtde"
                },
                {
                    data: "cde_valoritem",
                    className: "text-right",
                    render: DataTable.render.number('.', ',', 2, 'R$')
                },
                {
                    data: "cde_valortotal",
                    className: "text-right",
                    render: DataTable.render.number('.', ',', 2, 'R$')
                },
                {
                    data: "action",
                    className: "text-right"
                },
            ]
        });

        $(document).on('click', '[data-dismiss="modal"]',
            function() {
                table_conta.ajax.reload(null, false);
                table_item_compra_ato.ajax.reload(null, false);
                console.log(lista_parcelas);
                if (lista_parcelas == true) {
                    table_parcelas.ajax.reload(null, false);
                }
            }
        );

        $("#modalRegisterCompras").on("shown.bs.modal", function() {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'GET',
                url: '/admin/Get_Last_Compra/',
                processData: false,
                success: function(data_decoded) {
                    $('#IDCompras').val(data_decoded.id);
                    $('#IDComprasUp').val(data_decoded.id);
                }
            });
        });

        $("#modalUpdateCompras").on("shown.bs.modal", function() {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'GET',
                url: '/admin/Get_Last_Compra/',
                processData: false,
                success: function(data_decoded) {
                    $('#IDCompras').val(data_decoded.id);
                    $('#IDComprasUp').val(data_decoded.id);
                }
            });
        });

        $('body').on('click', 'button.parcelas', function() {
            var table_parcelas = $('#table_parcelas').DataTable({
                paging: true,
                searching: false,
                processing: true,
                serverside: true,
                ajax: {
                    type: 'GET',
                    url: '/admin/List_Parcelas/' + $(this).data('id'),
                },
                columns: [{
                        data: "par_conta",
                        className: "text-center"
                    },
                    {
                        data: "par_numero",
                        className: "text-center"
                    },
                    {
                        data: "par_valor",
                        className: "text-right",
                        render: DataTable.render.number('.', ',', 2, 'R$')
                    },
                    {
                        data: "par_status",
                        className: "text-center"
                    },
                    {
                        data: "par_data_pagto",
                        className: "text-center"
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
            $("#modalShowParcelas").modal('toggle');
        });

        $("#modalShowParcelas").on("shown.bs.modal", function() {
            var conta = $(this).data('id');
            var valor = $(this).data('valor');
            var pagto = $(this).data('tpg');
            var centro = $(this).data('cc');
            $('#ls_par_conta').val(conta);
            $('#ls_par_valor').val(valor);
            $('#ls_par_tpg').val(pagto);
            $('#ls_par_cc').val(centro);
        });


        $('#modalRegisterItemCompra').on('show', function() {
            $("#modalRegisterCompras").hide();
            $("#IDItemCompra").val(idcompra);
            console.log($("#IDItemCompra").val());
        });

        $("#modalRegisterItemVenda").on("shown.bs.modal", function() {
            $("modalRegisterVenda").modal('hide');
        });

        $("#modalRegisterItemCompra").on("hidden.bs.modal", function() {
            $("body").addClass("modal-open");
            $("modalRegisterVenda").modal('show');
        });

        $(document).on('click', '[data-dismiss="modal"]',
            function() {
                document.getElementById('imgsub').src = "../img/dash/addbtn.png";

            }
        );

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
                        $('#IDCompras').val(data_decoded.codigo);
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
                        demo.showNotification('top', 'right', 2, data_decoded.msg,
                            'tim-icons icon-check-2');
                    }
                    if (data_decoded.status == 0) {
                        $.each(data_decoded.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                            $('#' + prefix).focus();
                            $('#' + prefix).addClass('is-invalid');
                        });
                        $.each(data_decoded.error_interno, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                            $('#' + prefix).focus();
                            $('#' + prefix).addClass('is-invalid');
                        });
                    }
                }
            });
        });

        $("#formUpdateContas").on('submit', function(e) {

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

        $("#formUpdateCompras").on('submit', function(e) {
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

        $("#formUpdateItemCompra").on('submit', function(e) {

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
                        $('#formUpdateItemCompra')[0].reset();
                        demo.showNotification('top', 'right', 2, data_decoded.msg,
                            'tim-icons icon-check-2');
                    }
                    if (data_decoded.status == 0) {
                        $.each(data_decoded.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                            $('#' + prefix).focus();
                            $('#' + prefix).addClass('is-invalid');
                        });
                        $.each(data_decoded.error_interno, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                            $('#' + prefix).focus();
                            $('#' + prefix).addClass('is-invalid');
                        });
                    }
                }
            });
        });

        $('#qtdeCompras, #valorItemCompra').on('change blur keyup', function() {
            $('#qtdeCompras, #valorItemCompra').each(
        function() { //percorre todos os campos de quantidade
                //quantidade
                var qtd = $('#qtdeCompras').val();
                //pega o valor unitário
                var vlr = $('#valorItemCompra').val();
                // coloca o resultado no valor total
                $('#valorTotalItemCompra').val(qtd * vlr);
            });
        });

        function abrirItem() {
            $('#modalRegisterItemCompra').modal('show');
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
                    if (data_decoded.status == 1) {
                        $('#formExcluir')[0].reset();
                        $('#modalAlertDelete').modal('toggle');
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
                    var table_conta = data_decoded;
                    table_conta.ajax.reload(null, false);
                }
            });
        });
    });
</script>
@endpush
