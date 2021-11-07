@extends('layouts.header-footer', [$add="no"])
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
                <li class="active">
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
                                <h5 class="card-category">Análise Geral</h5>
                                <h2 class="card-title">Clientes</h2>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="chartCli"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 justify-content-center">
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title" id="no-margin">Resumo de Clientes</h2><br>
                    </div>
                    <div>
                        <div class="col-auto justify-content-md-center float-left">
                            <h4 class="resumo" style="color: #2caeec;">Quantidade de Clientes:</h4>
                            <h3 class="dados-resumo" style="color: #2caeec;">{{ $dado1 }}</h3>
                        </div>
                        <div class="col-auto justify-content-center float-left">
                            <h4 class="resumo" style="color: #2caeec;">Clientes Hoje:</h4>
                            <h3 class="dados-resumo" style="color: #2caeec;">{{ $dado2 }}</h3>
                        </div>
                        <div class="col-auto justify-content-center float-left">
                            <h4 class="resumo" style="color: #2caeec;">Clientes Hoje:</h4>
                            <h3 class="dados-resumo" style="color: #2caeec;">{{ $dado3 }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form class="form-filtro" id="formFilter" method="POST" autocomplete="off"
                        enctype="multipart/form-data" action="{{ route('admin.filtro.cliente') }}">
                        @csrf
                        <div class="card-header">
                            <h2 class="card-title">Filtrar Clientes</h2> <br>
                        </div>
                        <div class="col-12">

                            <div class="col-4 float-left">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label" for="filtro_nome">Nome:</label>
                                    <input type="text" name="filtro_nome" id="filtro_nome" maxlength="13" data-column="0"
                                        class="filtro form-control filter-input">
                                </div>
                            </div>

                            <div class="col-4 float-left">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label" for="filtro_cidade">Cidade:</label>
                                    <input type="text" name="filtro_cidade" id="filtro_cidade" data-column="3"
                                        class="filtro form-control filter-input">
                                </div>
                            </div>

                            <div class="col-4 float-left">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label" for="filtro_data">Data:</label>
                                    <input type="date" name="filtro_data" id="filtro_data" data-column="4"
                                        class="filtro form-control filter-input">
                                </div>

                            </div>
                            <div class="row">
                            <div class="col-4 float-left">
                                <div class="form-group" id="form-group" style="margin-left: 15px;">
                                    <label class="modal-label" for="filtro_doc">Documento:</label>
                                    <input type="text" name="filtro_doc" id="filtro_doc" data-column="1"
                                        class="filtro form-control filter-input">
                                </div>
                            </div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary" id="btn-form-consulta">Filtrar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card " id="card-consulta-tabela">
                    <div class="card-header" id="ch-adaptado">
                        <h2 class="card-title">Consulta de Clientes</h2>
                    </div>
                    <div class="card-body" id="cd-adaptado">
                        <div class="table-responsive">
                            <table class="table tablesorter " id="tb_cliente">
                                <thead class=" text-primary">
                                    <tr>
                                        <th style="width: 20%">
                                            Nome Completo
                                        </th>
                                        <th style="width: 15%">
                                            Documento
                                        </th>
                                        <th style="width: 15%">
                                            Celular
                                        </th>
                                        <th style="width: 15%">
                                            Cidade
                                        </th>
                                        <th style="width: 15%">
                                            Data Cadastro
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

    @section('sub-menu')
        <div class="add">
            <div class="dropup show-dropdown">
                <a href="#" data-toggle="dropdown">
                    <img id="imgsub" src="../img/dash/addbtn.png">
                </a>
                <div class="dropdown-menu" id="add-menu">
                    <a class="dropdown-item" id="no-padding" data-backdrop="static"
                        onclick="abrirModal('#modalRegisterCliente');"> <img src="../img/dash/cadastro_pessoa.png"
                            width="75" height="75"></a>
                </div>
            </div>
        </div>
    </div>
@endsection
@endsection

@section('modals')
<div class="modal fade" id="modalRegisterCliente" style="display:none;" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formRegisterCliente" method="POST" autocomplete="off" enctype="multipart/form-data"
            action="{{ route('admin.create.cliente.admin') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Cadastrar Cliente</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-3">
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Nome Completo:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="text" name="nomeCliente" id="nomeCliente" class="form-control"
                                    maxlength="25" value="{{ old('nomeCliente') }}" placeholder="Entre com o Nome"
                                    autofocus>
                                <div class="div-feedback">
                                    <span class="invalid-feedback nomeCliente_error" role="alert">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Email para Login:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="text" name="usuarioCliente" id="usuarioCliente" class="form-control"
                                    value="{{ old('usuarioCliente') }}" placeholder="Entre com o Login">
                                <div class="div-feedback">
                                    <span class="invalid-feedback usuarioCliente_error" role="alert">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group" id="form-group">
                                <label class="modal-label">CPF:</label> <label style="color: red; font-size: 12px;">
                                    *
                                </label>
                                <input type="text" name="cpfCliente" id="cpfCliente" class="cpf form-control"
                                    value="{{ old('cpfCliente') }}" placeholder="Entre com o CPF">
                                <div class="div-feedback">
                                    <span class="invalid-feedback cpfCliente_error" role="alert">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group" id="form-group">
                                <label class="modal-label">CNPJ:</label> <label
                                    style="color: red; font-size: 12px;"> *
                                </label>
                                <input type="text" name="cnpjCliente" id="cnpjCliente" class="cnpj form-control"
                                    value="{{ old('cnpjCliente') }}" placeholder="Entre com o CNPJ">
                                <div class="div-feedback">
                                    <span class="invalid-feedback cnpjCliente_error" role="alert">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Telefone:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="text" name="telefoneCliente" id="telefoneCliente"
                                    class="telefone form-control" value="{{ old('telefoneCliente') }}"
                                    placeholder="Entre com o Telefone">
                                <div class="div-feedback">
                                    <span class="invalid-feedback telefoneCliente_error" role="alert">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Celular:</label> <label
                                    style="color: red; font-size: 12px;">
                                    * </label>
                                <input type="text" name="celularCliente" id="celularCliente"
                                    class="celular form-control" value="{{ old('celularCliente') }}"
                                    placeholder="Entre com o Celular">
                                <div class="div-feedback">
                                    <span class="invalid-feedback celularCliente_error" role="alert">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Senha:</label> <label
                                    style="color: red; font-size: 12px;"> *
                                </label>
                                <input type="password" name="senhaCliente" id="senhaCliente" class="form-control"
                                    value="{{ old('senhaCliente') }}" placeholder="Entre com a Senha">
                                <div class="div-feedback">
                                    <span class="invalid-feedback senhaCliente_error" role="alert">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Confirmar Senha:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="password" name="senhaCliente_confirmation" id="senhaCliente_confirmation"
                                    class="form-control" placeholder="Confirmação da Senha">
                                <div class="div-feedback">
                                    <span class="invalid-feedback senhaCliente_error" role="alert">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group" id="form-group">
                                <label class="modal-label"> CEP:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="text" name="cepCliente" id="cepCliente" class="cep form-control"
                                    value="{{ old('cepCliente') }}" placeholder="Entre com o CEP">
                                <div class="div-feedback">
                                    <span class="invalid-feedback cepCliente_error" role="alert">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="modal-label">Estado:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="text" name="estadoCliente" id="estadoCliente" class="form-control"
                                    maxlength="2" value="{{ old('estadoCliente') }}"
                                    placeholder="Entre com o Estado">
                                <div class="div-feedback">
                                    <span class="invalid-feedback estadoCliente_error" role="alert">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="modal-label">Cidade:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="text" name="cidadeCliente" id="cidadeCliente" class="form-control"
                                    maxlength="120" value="{{ old('cidadeCliente') }}"
                                    placeholder="Entre com a Cidade">
                                <div class="div-feedback">
                                    <span class="invalid-feedback cidadeCliente_error" role="alert">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="modal-label">Bairro:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="text" name="bairroCliente" id="bairroCliente" class="form-control"
                                    maxlength="80" value="{{ old('bairroCliente') }}"
                                    placeholder="Entre com o Bairro">
                                <div class="div-feedback">
                                    <span class="invalid-feedback bairroCliente_error" role="alert">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-03">
                            <div class="form-group">
                                <label class="modal-label">Rua:</label> <label style="color: red; font-size: 12px;">
                                    * </label>
                                <input type="text" name="ruaCliente" id="ruaCliente" class="form-control"
                                    maxlength="80" value="{{ old('ruaCliente') }}" placeholder="Entre com a Rua">
                                <div class="div-feedback">
                                    <span class="invalid-feedback ruaCliente_error" role="alert">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="modal-label">Número:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="number" name="ncasaCliente" id="ncasaCliente" class="form-control"
                                    maxlength="4" value="{{ old('ncasaCliente') }}" placeholder="Entre com o Número">
                                <div class="div-feedback">
                                    <span class="invalid-feedback ncasaCliente_error" role="alert">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="modal-label">Complemento:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="text" name="complementoCliente" id="complementoCliente"
                                    class="form-control" maxlength="4" value="{{ old('complementoCliente') }}"
                                    placeholder="Entre com o Complemento">
                                <div class="div-feedback">
                                    <span class="invalid-feedback complementoCliente_error" role="alert">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="modal-label">Status:</label> <label
                                    style="color: red; font-size: 12px;">
                                    * </label><br>
                                <div class="switch__container">
                                    <input id="switch-shadow" name="statusCliente" value={{ 'Ativo' ?? 'Inativo' }}
                                        class="switch switch--shadow" type="checkbox">
                                    <label for="switch-shadow"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="cancela btn btn-secondary btn-danger"
                            data-form="formRegisterCliente" data-modal="modalRegisterCliente">Cancelar</button>
                        <button type="reset" class="limpar btn btn-secondary btn-danger"
                            data-form="formRegisterCliente">Limpar</button>
                        <button type="submit" class="btn-register btn btn-primary">Cadastrar</button>
                    </div>
                </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modalUpdateCliente" style="display:none;" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formUpdateCliente" method="PUT" autocomplete="off" enctype="multipart/form-data"
            action="{{ route('admin.update.cliente') }}">
            @csrf
            <input type="hidden" id="idCli" name="idCli">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Atualizar Cliente</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-3">
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Nome Completo:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="text" name="nomeClienteUp" id="nomeClienteUp" class="form-control"
                                    maxlength="25" value="{{ old('nomeClienteUp') }}" placeholder="Entre com o Nome"
                                    autofocus>
                                <div class="div-feedback">
                                    <span class="invalid-feedback nomeClienteUp_error" role="alert">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Email para Login:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="text" name="usuarioClienteUp" id="usuarioClienteUp" class="form-control"
                                    value="{{ old('usuarioClienteUp') }}" placeholder="Entre com o Login">
                                <div class="div-feedback">
                                    <span class="invalid-feedback usuarioClienteUp_error" role="alert">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group" id="form-group">
                                <label class="modal-label">CPF:</label> <label style="color: red; font-size: 12px;">
                                    *
                                </label>
                                <input type="text" name="cpfClienteUp" id="cpfClienteUp" class="cpf form-control"
                                    value="{{ old('cpfClienteUp') }}" placeholder="Entre com o CPF">
                                <div class="div-feedback">
                                    <span class="invalid-feedback cpfClienteUp_error" role="alert">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group" id="form-group">
                                <label class="modal-label">CNPJ:</label> <label
                                    style="color: red; font-size: 12px;"> *
                                </label>
                                <input type="text" name="cnpjClienteUp" id="cnpjClienteUp" class="cnpj form-control"
                                    value="{{ old('cnpjClienteUp') }}" placeholder="Entre com o CNPJ">
                                <div class="div-feedback">
                                    <span class="invalid-feedback cnpjClienteUp_error" role="alert">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Telefone:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="text" name="telefoneClienteUp" id="telefoneClienteUp"
                                    class="telefone form-control" value="{{ old('telefoneClienteUp') }}"
                                    placeholder="Entre com o Telefone">
                                <div class="div-feedback">
                                    <span class="invalid-feedback telefoneClienteUp_error" role="alert">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Celular:</label> <label
                                    style="color: red; font-size: 12px;">
                                    * </label>
                                <input type="text" name="celularClienteUp" id="celularClienteUp"
                                    class="celular form-control" value="{{ old('celularClienteUp') }}"
                                    placeholder="Entre com o Celular">
                                <div class="div-feedback">
                                    <span class="invalid-feedback celularClienteUp_error" role="alert">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Senha:</label> <label
                                    style="color: red; font-size: 12px;"> *
                                </label>
                                <input type="password" name="senhaClienteUp" id="senhaClienteUp" class="form-control"
                                    value="{{ old('senhaClienteUp') }}" placeholder="Entre com a Senha">
                                <div class="div-feedback">
                                    <span class="invalid-feedback senhaClienteUp_error" role="alert">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Confirmar Senha:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="password" name="senhaClienteUp_confirmation"
                                    id="senhaClienteUp_confirmation" class="form-control"
                                    placeholder="Confirmação da Senha">
                                <div class="div-feedback">
                                    <span class="invalid-feedback senhaClienteUp_error" role="alert">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group" id="form-group">
                                <label class="modal-label"> CEP:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="text" name="cepClienteUp" id="cepClienteUp" class="cep form-control"
                                    value="{{ old('cepClienteUp') }}" placeholder="Entre com o CEP">
                                <div class="div-feedback">
                                    <span class="invalid-feedback cepClienteUp_error" role="alert">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="modal-label">Estado:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="text" name="estadoClienteUp" id="estadoClienteUp" class="form-control"
                                    maxlength="2" value="{{ old('estadoClienteUp') }}"
                                    placeholder="Entre com o Estado">
                                <div class="div-feedback">
                                    <span class="invalid-feedback estadoClienteUp_error" role="alert">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="modal-label">Cidade:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="text" name="cidadeClienteUp" id="cidadeClienteUp" class="form-control"
                                    maxlength="120" value="{{ old('cidadeClienteUp') }}"
                                    placeholder="Entre com a Cidade">
                                <div class="div-feedback">
                                    <span class="invalid-feedback cidadeClienteUp_error" role="alert">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="modal-label">Bairro:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="text" name="bairroClienteUp" id="bairroClienteUp" class="form-control"
                                    maxlength="80" value="{{ old('bairroClienteUp') }}"
                                    placeholder="Entre com o Bairro">
                                <div class="div-feedback">
                                    <span class="invalid-feedback bairroClienteUp_error" role="alert">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-03">
                            <div class="form-group">
                                <label class="modal-label">Rua:</label> <label style="color: red; font-size: 12px;">
                                    * </label>
                                <input type="text" name="ruaClienteUp" id="ruaClienteUp" class="form-control"
                                    maxlength="80" value="{{ old('ruaClienteUp') }}" placeholder="Entre com a Rua">
                                <div class="div-feedback">
                                    <span class="invalid-feedback ruaClienteUp_error" role="alert">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="modal-label">Número:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="number" name="ncasaClienteUp" id="ncasaClienteUp" class="form-control"
                                    maxlength="4" value="{{ old('ncasaClienteUp') }}"
                                    placeholder="Entre com o Número">
                                <div class="div-feedback">
                                    <span class="invalid-feedback ncasaClienteUp_error" role="alert">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="modal-label">Complemento:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <input type="text" name="complementoClienteUp" id="complementoClienteUp"
                                    class="form-control" maxlength="4" value="{{ old('complementoClienteUp') }}"
                                    placeholder="Entre com o Complemento">
                                <div class="div-feedback">
                                    <span class="invalid-feedback complementoClienteUp_error" role="alert">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="modal-label">Status:</label> <label
                                    style="color: red; font-size: 12px;">
                                    * </label><br>
                                <div class="switch__container">
                                    <input id="switch-shadow" name="statusClienteUp" value={{ 'Ativo' ?? 'Inativo' }}
                                        class="switch switch--shadow" type="checkbox">
                                    <label for="switch-shadow"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="cancela btn btn-secondary btn-danger"
                            data-form="formUpdateCliente" data-modal="modalUpdateCliente">Cancelar</button>
                        <button type="reset" class="limpar btn btn-secondary btn-danger"
                            data-form="formUpdateCliente">Limpar</button>
                        <button type="submit" class="btn-register btn btn-primary">Cadastrar</button>
                    </div>
                </div>
        </form>
    </div>
</div>
</div>
@endsection

@push('ajax')
<script>
    $(document).ready(function() {

        var table_cliente = $('#tb_cliente').DataTable({
            paging: true,
            searching: false,
            processing: true,
            serverside: true,
            ajax: "{{ route('admin.list.cliente') }}",
            columns: [{
                    data: 'cli_nome'
                },
                {
                    data: 'cli_cpf_cnpj'
                },
                {
                    data: 'cli_celular'
                },
                {
                    data: 'cli_cidade'
                },
                {
                    data: 'created_at',
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

        $('.filter-input').keyup(function() {
            table.column($(this).data('column')).search($(this).val()).draw();
        });

        $(document).on('click', '[data-dismiss="modal"]',
            function() {
                table_cliente.ajax.reload(null, false);
            }
        );

        $("#formRegisterCliente").on('submit', function(e) {
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
                        $('#formRegisterCliente')[0].reset();
                        demo.showNotification('top', 'right', 2, data_decoded.msg,
                            'tim-icons icon-check-2');
                    }
                    if (data_decoded.status == 0) {

                        $.each(data_decoded.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                            $('#' + prefix).addClass('is-invalid');
                            $('#' + prefix + '_confirmation').addClass(
                                'is-invalid');
                        });
                        $.each(data_decoded.error_cpf_cnpj, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                            $('#' + prefix).addClass('is-invalid');
                        });
                        $.each(data_decoded.error_telefone_celular, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                            $('#' + prefix).addClass('is-invalid');
                        });
                    }
                }
            });
        });

        $("#formUpdateCliente").on('submit', function(e) {
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
                        $('#formUpdateCliente')[0].reset();
                        demo.showNotification('top', 'right', 2, data_decoded.msg,
                            'tim-icons icon-check-2');
                    }
                    if (data_decoded.status == 0) {

                        $.each(data_decoded.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                            $('#' + prefix).addClass('is-invalid');
                            $('#' + prefix + '_confirmation').addClass(
                                'is-invalid');
                        });
                        $.each(data_decoded.error_cpf_cnpj, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                            $('#' + prefix).addClass('is-invalid');
                        });
                        $.each(data_decoded.error_telefone_celular, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                            $('#' + prefix).addClass('is-invalid');
                        });
                    }
                }
            });
        });

        $('#cpfCliente').on('type', function() {
            if ($('#cpfCliente').val() != '') {
                $('#cnpjCliente').attr('disabled', 'true');
            }
            if ($('#cnpjCliente').val() != '') {
                $('#cpfCliente').attr('disabled', 'true');
            }
        });

        $('#cnpjCliente').on('type', function() {
            if ($('#cpfCliente').val() != '') {
                $('#cnpjCliente').attr('disabled', 'true');
            }
            if ($('#cnpjCliente').val() != '') {
                $('#cpfCliente').attr('disabled', 'true');
            }
        });

        var path = "{{ route('admin.autocomplete.cli.nome') }}"

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
                    var table_cliente = data_decoded;
                    table_cliente.ajax.reload(null, false);
                }
            });
        });

    });
</script>
@endpush
