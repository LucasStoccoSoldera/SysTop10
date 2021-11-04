@extends('layouts.header-footer')
@section('title', 'Usuarios - TopSystem')
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
                <li class="active">
                    <a href="{{ route('admin.usuario') }}" id="usuarios">
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
        <div class="col-12">
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title" id="no-margin"> Resumo de Usuários</h2><br>
                    </div>
                    <div>
                        <div class="col-auto">
                            <h4 class="resumo" style="color: #2caeec;">Quantidade de Usuários:</h4>
                            <h3 class="dados-resumo" style="color: #2caeec;">{{ $dado1 }}</h3>
                        </div>
                        <div class="col-auto">
                            <h4 class="resumo" style="color: #2caeec;">Administradores:</h4>
                            <h3 class="dados-resumo" style="color: #2caeec;">{{ $dado2 }}</h3>
                        </div>
                        <div class="col-auto">
                            <h4 class="resumo" style="color: #2caeec;">Funcionários:</h4>
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
                        enctype="multipart/form-data" action="{{route('admin.filtro.usuario')}}">
                        @csrf
                        <div class="card-header">
                            <h2 class="card-title">Filtrar Usuários</h2>
                        </div>
                        <div class="col-12">

                            <div class="col-4 float-left">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label" for="filtro_id">ID:</label>
                                    <input type="text" name="filtro_id" id="filtro_id" data-column="0"
                                        class="filtro form-control filter-input">
                                </div>

                            </div>

                            <div class="col-4 float-left">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label" for="filtro_nome">Nome:</label>
                                    <input type="text" name="filtro_nome" id="filtro_nome" maxlength="13" data-column="3"
                                        class="filtro form-control filter-input">
                                </div>
                            </div>

                            <div class="col-4 float-left">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label" for="filtro_cargo">Cargo:</label>
                                    <select type="text" name="filtro_cargo" id="filtro_cargo"
                                        class="filtro form-control filter-select">
                                        <option value="">-------------------------Selecione-------------------------
                                        </option>
                                        @foreach ($cargos as $cargo)
                                            <option value="{{ $cargo['car_descricao'] }}">
                                                {{ $cargo['car_descricao'] }}
                                            </option>
                                        @endforeach
                                    </select>
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

            <div class="row">
                <div class="col-12" style="padding-left: 0px; padding-right: 0px;">
                    <div class="card " id="card-consulta-tabela">
                        <div class="card-header" id="ch-adaptado">
                            <h2 class="card-title">Consulta de Usuários</h2>
                        </div>
                        <div class="card-body" id="cd-adaptado">
                            <div class="table-responsive">
                                <table class="table tablesorter " id="tb_usuario">
                                    <thead class=" text-primary">
                                        <tr>
                                            <th class="text-center" style="width: 5%">
                                                ID
                                            </th>
                                            <th style="width: 25%">
                                                Nome
                                            </th>
                                            <th style="width: 15%">
                                                Cargo
                                            </th>
                                            <th style="width: 20%">
                                                Celular
                                            </th class="text-center">
                                            <th style="width: 15%">
                                                Data de Cadastro
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
                        <button class="dropdown-item" id="no-padding" data-backdrop="static"
                            onclick="abrirModal('#modalRegisterUser');"> <img src="../img/dash/cadastro_pessoa.png"
                                width="75" height="75"></button>
                        <button class="dropdown-item" id="no-padding" data-backdrop="static"
                            onclick="abrirModal('#modalRegisterCargo');"> <img src="../img/dash/cadastro_pessoa.png"
                                width="75" height="75"></button>
                        <button class="dropdown-item" id="no-padding" data-backdrop="static"
                            onclick="abrirModal('#modalRegisterPrivilegio');">
                            <img src="../img/dash/cadastro_pessoa.png" width="75" height="75"></button>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('modals')
        <div class="modal fade" id="modalRegisterUser" style="display:none;" aria-hidden="true">
            <div class="modal-dialog">
                <form class="form-cadastro" id="formRegisterUser" method="POST" autocomplete="off"
                    enctype="multipart/form-data" action="{{ route('admin.create.user') }}">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Cadastrar Usuário</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group" id="form-group">
                                        <label class="modal-label">Nome Completo:</label> <label
                                            style="color: red; font-size: 12px;"> * </label>
                                        <input type="text" name="nomeUser" id="nomeUser" class="form-control"
                                            maxlength="25" value="{{ old('nomeUser') }}" placeholder="Entre com o Nome"
                                            autofocus>
                                        <div class="div-feedback">
                                            <span class="invalid-feedback nomeUser_error" role="alert">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group" id="form-group">
                                        <label class="modal-label">Email para Login:</label> <label
                                            style="color: red; font-size: 12px;"> * </label>
                                        <input type="text" name="usu_usuario" id="usu_usuario" class="form-control"
                                            value="{{ old('usu_usuario') }}" placeholder="Entre com o Login">
                                        <div class="div-feedback">
                                            <span class="invalid-feedback usu_usuario_error" role="alert">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group" id="form-group">
                                        <label class="modal-label">CPF:</label> <label
                                            style="color: red; font-size: 12px;">
                                            * </label>
                                        <input type="text" name="cpfUser" id="cpfUser" class="cpf form-control"
                                            value="{{ old('cpfUser') }}" placeholder="Entre com o CPF">
                                        <div class="div-feedback">
                                            <span class="invalid-feedback cpfUser_error" role="alert">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group" id="form-group">
                                        <label class="modal-label">Celular:</label> <label
                                            style="color: red; font-size: 12px;"> * </label>
                                        <input type="text" name="celularUser" id="celularUser" class="celular form-control"
                                            value="{{ old('celularUser') }}" placeholder="Entre com o Celular">
                                        <div class="div-feedback">
                                            <span class="invalid-feedback celularUser_error" role="alert">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group" id="form-group">
                                        <label class="modal-label">Senha:</label> <label
                                            style="color: red; font-size: 12px;"> *
                                        </label>
                                        <input type="password" name="senhaUser" id="senhaUser" class="form-control"
                                            value="{{ old('senhaUser') }}" placeholder="Entre com a Senha">
                                        <div class="div-feedback">
                                            <span class="invalid-feedback senhaUser_error" role="alert">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group" id="form-group">
                                        <label class="modal-label">Confirmar Senha:</label> <label
                                            style="color: red; font-size: 12px;"> * </label>
                                        <input type="password" name="senhaUser_confirmation" id="senhaUser_confirmation"
                                            class="form-control" placeholder="Confirmação da Senha">
                                        <div class="div-feedback">
                                            <span class="invalid-feedback senhaUser_error" role="alert">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group" id="form-group">
                                        <label class="modal-label">Permissões:</label> <label
                                            style="color: red; font-size: 12px;"> *
                                        </label>
                                        <select type="text" name="cargoUser" id="cargoUser" class="form-control"
                                            maxlength="80" value="{{ old('cargoUser') }}"
                                            placeholder="Selecione com o Cargo">
                                            <option value="">------------Selecione------------</option>
                                            @foreach ($cargos as $cargo)
                                                <option value="{{ $cargo['id'] }}">{{ $cargo['car_descricao'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="div-feedback">
                                            <span class="invalid-feedback cargoUser_error" role="alert">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="modal-label">Status:</label> <label
                                            style="color: red; font-size: 12px;">
                                            * </label><br>
                                        <div class="switch__container">
                                            <input id="switch-shadow" name="statusUser" value={{ 'Ativo' ?? 'Inativo' }}
                                                class="switch switch--shadow" type="checkbox">
                                            <label for="switch-shadow"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="cancela btn btn-secondary btn-danger" data-form="formRegisterUser"
                                data-modal="modalRegisterUser">Cancelar</button>
                            <button type="reset" class="limpar btn btn-secondary btn-danger"
                                data-form="formRegisterUser">Limpar</button>
                            <button type="submit" class="btn-register btn btn-primary">Cadastrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal fade" id="modalRegisterCargo" style="display:none;" aria-hidden="true">
            <div class="modal-dialog">
                <form class="form-cadastro" id="formRegisterCargo" method="POST" autocomplete="off"
                    enctype="multipart/form-data" action="{{ route('admin.create.cargo') }}">
                    @csrf
                    <div class="modal-content" style="width: 150%">
                        <div class="modal-header">
                            <h4 class="modal-title">Cadastrar Cargo</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group" id="form-direita">
                                        <label class="modal-label">Cargo:</label> <label
                                            style="color: red; font-size: 12px;"> *
                                        </label>
                                        <input type="text" name="descricaoCargo" id="descricaoCargo" class="form-control"
                                            maxlength="15" value="{{ old('descricaoCargo') }}"
                                            placeholder="Entre com o Cargo">
                                        <span class="invalid-feedback descricaoCargo_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="modal-footer" style="width: 100%; padding: 24px 15px 16px 15px;">
                                    <button type="button" class="cancela btn btn-secondary btn-danger"
                                        data-form="formRegisterCargo" data-modal="modalRegisterCargo">Cancelar</button>
                                    <button type="submit" class="btn-register btn btn-primary">Cadastrar</button>
                                </div>
                </form>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card" id="card-consulta-tabela">
                        <div class="card-header" id="ch-adaptado">
                            <h2 class="card-title">Consulta de Cargos</h2>
                        </div>
                        <div class="card-body" id="cd-adaptado">
                            <div class="table-responsive">
                                <table class="table tablesorter " id="tb_cargo">
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

    <div class="modal fade" id="modalUpdateUser" style="display:none;" aria-hidden="true">
        <div class="modal-dialog">
            <form class="form-cadastro" id="formUpdateUser" method="PUT" autocomplete="off" enctype="multipart/form-data"
                action="{{ route('admin.update.user') }}">
                @csrf
                <input type="hidden" id="idUse" name="idUse">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Atualizar Usuário</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Nome Completo:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="text" name="nomeUserUp" id="nomeUserUp" class="form-control"
                                        maxlength="25" value="{{ old('nomeUserUp') }}" placeholder="Entre com o Nome"
                                        autofocus>
                                    <div class="div-feedback">
                                        <span class="invalid-feedback nomeUserUp_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Email para Login:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="text" name="usu_usuarioUp" id="usu_usuarioUp" class="form-control"
                                        value="{{ old('usu_usuarioUp') }}" placeholder="Entre com o Login">
                                    <div class="div-feedback">
                                        <span class="invalid-feedback usu_usuarioUp_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">CPF:</label> <label style="color: red; font-size: 12px;">
                                        * </label>
                                    <input type="text" name="cpfUserUp" id="cpfUserUp" class="cpf form-control"
                                        value="{{ old('cpfUserUp') }}" placeholder="Entre com o CPF">
                                    <div class="div-feedback">
                                        <span class="invalid-feedback cpfUserUp_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Celular:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="text" name="celularUserUp" id="celularUserUp" class="celular form-control"
                                        value="{{ old('celularUserUp') }}" placeholder="Entre com o Celular">
                                    <div class="div-feedback">
                                        <span class="invalid-feedback celularUserUp_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Senha:</label> <label
                                        style="color: red; font-size: 12px;"> *
                                    </label>
                                    <input type="password" name="senhaUserUp" id="senhaUserUp" class="form-control"
                                        value="{{ old('senhaUserUp') }}" placeholder="Entre com a Senha">
                                    <div class="div-feedback">
                                        <span class="invalid-feedback senhaUserUp_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Confirmar Senha:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="password" name="senhaUserUp_confirmation" id="senhaUserUp_confirmation"
                                        class="form-control" placeholder="Confirmação da Senha">
                                    <div class="div-feedback">
                                        <span class="invalid-feedback senhaUserUp_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Permissões:</label> <label
                                        style="color: red; font-size: 12px;"> *
                                    </label>
                                    <select type="text" name="cargoUserUp" id="cargoUserUp" class="form-control"
                                        maxlength="80" value="{{ old('cargoUserUp') }}"
                                        placeholder="Selecione com o Cargo">
                                        <option value="">------------Selecione------------</option>
                                        @foreach ($cargos as $cargo)
                                            <option value="{{ $cargo['id'] }}">{{ $cargo['car_descricao'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="div-feedback">
                                        <span class="invalid-feedback cargoUserUp_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="modal-label">Status:</label> <label
                                        style="color: red; font-size: 12px;">
                                        * </label><br>
                                    <div class="switch__container">
                                        <input id="switch-shadow" name="statusUserUp" value={{ 'Ativo' ?? 'Inativo' }}
                                            class="switch switch--shadow" type="checkbox">
                                        <label for="switch-shadow"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="cancela btn btn-secondary btn-danger" data-form="formUpdateUser"
                            data-modal="modalUpdateUser">Cancelar</button>
                        <button type="reset" class="limpar btn btn-secondary btn-danger"
                            data-form="formUpdateUser">Limpar</button>
                        <button type="submit" class="btn-register btn btn-primary">Cadastrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="modalUpdateCargo" style="display:none;top: 25%" aria-hidden="true">
        <div class="modal-dialog">
            <form class="form-cadastro" id="formUpdateCargo" method="PUT" autocomplete="off" enctype="multipart/form-data"
                action="{{ route('admin.update.cargo') }}">
                @csrf
                <input type="hidden" id="idCar" name="idCar">
                <div class="modal-content" style="width: 150%">
                    <div class="modal-header">
                        <h4 class="modal-title">Atualizar Cargo</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group" id="form-direita">
                                    <label class="modal-label">Cargo:</label> <label
                                        style="color: red; font-size: 12px;"> *
                                    </label>
                                    <input type="text" name="descricaoCargoUp" id="descricaoCargoUp" class="form-control"
                                        maxlength="15" value="{{ old('descricaoCargoUp') }}"
                                        placeholder="Entre com o Cargo">
                                    <span class="invalid-feedback descricaoCargoUp_error" role="alert">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="modal-footer" style="width: 100%; padding: 24px 15px 16px 15px;">
                                <button type="button" class="cancela btn btn-secondary btn-danger"
                                    data-form="formUpdateCargo" data-modal="modalUpdateCargo">Cancelar</button>
                                <button type="submit" class="btn-register btn btn-primary">Cadastrar</button>
                            </div>
            </form>
        </div>
    </div>
    </div>
    </div>
    </div>

    <div class="modal fade" id="modalRegisterPrivilegio" style="display:none;" aria-hidden="true">
        <div class="modal-dialog">
            <form class="form-cadastro" id="formRegisterPrivilegio" method="POST" autocomplete="off"
                enctype="multipart/form-data" action="{{ route('admin.create.privilegio') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Ajustar Privilégios</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Cargo:</label> <label
                                        style="color: red; font-size: 12px;"> *
                                    </label>
                                    <select type="text" name="cargoPrivilegio" id="cargoPrivilegio" class="form-control"
                                        maxlength="80" value="{{ old('cargoPrivilegio') }}"
                                        placeholder="Selecione com o Cargo">
                                        <option value="">------------Selecione------------</option>
                                        @foreach ($cargos as $cargo)
                                            <option value="{{ $cargo['id'] }}">{{ $cargo['car_descricao'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="div-feedback">
                                        <span class="invalid-feedback cargoPrivilegio_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6" style="text-align: -webkit-center;">
                                <div class="form-group switch_group">
                                    <label class="modal-label">Usuários:</label><br>
                                    <div class="switch__container">
                                        <input id="switch-shadowusu" name="usuarioPrivilegio" value="1"
                                            class="switch switch--shadow" type="checkbox">
                                        <label for="switch-shadowusu"></label>
                                    </div>
                                </div>
                                <div class="form-group switch_group">
                                    <label class="modal-label">Clientes:</label><br>
                                    <div class="switch__container">
                                        <input id="switch-shadowcli" name="clientePrivilegio" value="1"
                                            class="switch switch--shadow" type="checkbox">
                                        <label for="switch-shadowcli"></label>
                                    </div>
                                </div>
                                <div class="form-group switch_group">
                                    <label class="modal-label">Financeiro:</label><br>
                                    <div class="switch__container">
                                        <input id="switch-shadowfin" name="financeiroPrivilegio" value="1"
                                            class="switch switch--shadow" type="checkbox">
                                        <label for="switch-shadowfin"></label>
                                    </div>
                                </div>
                                <div class="form-group switch_group">
                                    <label class="modal-label">Produtos:</label><br>
                                    <div class="switch__container">
                                        <input id="switch-shadowpro" name="produtoPrivilegio" value="1"
                                            class="switch switch--shadow" type="checkbox">
                                        <label for="switch-shadowpro"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6" style="text-align: -webkit-center;">
                                <div class="form-group switch_group">
                                    <label class="modal-label">Estoque:</label><br>
                                    <div class="switch__container">
                                        <input id="switch-shadowest" name="estoquePrivilegio" value="1"
                                            class="switch switch--shadow" type="checkbox">
                                        <label for="switch-shadowest"></label>
                                    </div>
                                </div>
                                <div class="form-group switch_group">
                                    <label class="modal-label">Fornecedores:</label><br>
                                    <div class="switch__container">
                                        <input id="switch-shadowfor" name="fornecedorPrivilegio" value="1"
                                            class="switch switch--shadow" type="checkbox">
                                        <label for="switch-shadowfor"></label>
                                    </div>
                                </div>
                                <div class="form-group switch_group">
                                    <label class="modal-label">Detalhes:</label><br>
                                    <div class="switch__container">
                                        <input id="switch-shadowdet" name="detalhePrivilegio" value="1"
                                            class="switch switch--shadow" type="checkbox">
                                        <label for="switch-shadowdet"></label>
                                    </div>
                                </div>
                                <div class="form-group switch_group">
                                    <label class="modal-label">Logistica:</label><br>
                                    <div class="switch__container">
                                        <input id="switch-shadowlog" name="logisticaPrivilegio" value="1"
                                            class="switch switch--shadow" type="checkbox">
                                        <label for="switch-shadowlog"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="cancela btn btn-secondary btn-danger"
                            data-form="formRegisterPrivilegio" data-modal="modalRegisterPrivilegio">Cancelar</button>
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
            /*
            $('#cargoPrivilegio').on('blur', function(e) {
                e.preventDefault();

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "GET",
                    url: "",
                    data: $(this).serialize(),
                    processData: false,
                    dataType: 'json',
                    success: function(data_decoded) {
                        if (data_decoded.status == 1) {
                            preencher_privilegios(data_decoded.usu, data_decoded.cli,
                                data_decoded.fin,
                                data_decoded.pro, data_decoded.est, data_decoded.for,
                                data_decoded.det, data_decoded.log);
                        }
                    }
                });
            }); */

            function preencher_privilegios(usu, cli, fin, pro, est, forn, det, log) {
                $('#usuarioPrivilegio').val(usu);
                $('#clientePrivilegio').val(cli);
                $('#financeiroPrivilegio').val(fin);
                $('#produtoPrivilegio').val(pro);
                $('#estoquePrivilegio').val(est);
                $('#fornecedorPrivilegio').val(forn);
                $('#detalhePrivilegio').val(det);
                $('#logisticaPrivilegio').val(log);
            }

            var table_usuario = $('#tb_usuario').DataTable({
                paging: true,
                searching: false,
                processing: true,
                serverside: true,
                ajax: "{{ route('admin.list.user') }}",
                columns: [{
                        data: "id",
                        className: "text-center"
                    },
                    {
                        data: "usu_nome_completo"
                    },
                    {
                        data: "car_descricao"
                    },
                    {
                        data: "usu_celular"
                    },
                    {
                        data: "usu_data_cadastro",
                        className: "text-center"
                    },
                    {
                        data: "action",
                        className: "text-right"
                    },
                ]
            });
            var table_cargo = $('#tb_cargo').DataTable({
                paging: true,
                searching: false,
                processing: true,
                serverside: true,
                ajax: "{{ route('admin.list.cargo') }}",
                columns: [{
                        data: "id",
                        className: "text-center"
                    },
                    {
                        data: "car_descricao"
                    },
                    {
                        data: "action",
                        className: "text-right"
                    },
                ]
            });

            $(document).on('click', '[data-dismiss="modal"]',
                function() {
                    table_usuario.ajax.reload(null, false);
                    table_cargo.ajax.reload(null, false);
                }
            );

            $("#formRegisterUser").on('submit', function(e) {
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
                            $('#formRegisterUser')[0].reset();
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
                        }
                    }
                });
            });

            $("#formRegisterCargo").on('submit', function(e) {

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
                            $('#formRegisterCargo')[0].reset();
                            $('#mensagem').attr(data_decoded.msg);
                            var rota_reload = $('#usuarios').attr('href');
                            $('#modalReturnCadastro').modal('show');
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

            $("#formUpdateUser").on('submit', function(e) {
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
                            $('#formUpdateUser')[0].reset();
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
                        }
                    }
                });
            });

            $("#formUpdateCargo").on('submit', function(e) {

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
                            $('#formUpdateCargo')[0].reset();
                            $('#mensagem').attr(data_decoded.msg);
                            demo.showNotification('top', 'right', 2, data_decoded.msg,
                                'tim-icons icon-check-2');
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

            $("#formRegisterPrivilegio").on('submit', function(e) {

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
                            $('#formRegisterPrivilegio')[0].reset();
                            $('#mensagem').attr(data_decoded.msg);
                            demo.showNotification('top', 'right', 2, data_decoded.msg,
                                'tim-icons icon-check-2');
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

            var path = "{{ route('admin.autocomplete.usu.nome') }}"

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
                            var table_usuario = data_decoded.table;
                            table_usuario.ajax.reload(null, false);
                    }
                });
            });

        });
    </script>
@endpush
