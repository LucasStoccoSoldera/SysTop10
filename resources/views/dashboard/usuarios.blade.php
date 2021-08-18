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
                    <form class="form-filtro" id="formFilterCliente" method="POST" autocomplete="off"
                    enctype="multipart/form-data" action="">
                    @csrf
                        <div class="card-header">
                            <h2 class="card-title">Filtrar Usuários</h2>
                        </div>
                        <div class="col-12">

                            <div class="col-4 float-left">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Cargo:</label>
                                    <select type="text" name="txt_cargo" id="txt_cargo" class="form-control"
                                value="{{ old('txt_cargo') }}">
                                <option value="">------------Selecione------------</option>
                                @foreach ($cargos as $cargo)
                                    <option value="{{ $cargo['car_id'] }}">{{ $cargo['car_descricao'] }}
                                    </option>
                                @endforeach
                            </select>
                                </div>
                                    </div>

                                    <div class="col-4 float-left">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Usuario:</label>
                                    <input type="text" name="txt_usuario" id="txt_usuario" maxlength="25"
                                        value="{{ old('txt_usuario') }}" class="form-control @error('txt_usuario') is-invalid @enderror">
                                        @error('txt_usuario')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-4 float-left">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Data:</label>
                                    <input type="date" name="txt_data" id="txt_data"
                                        value="{{ old('txt_data') }}" class="form-control @error('txt_data') is-invalid @enderror">
                                        @error('txt_data')
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
            <div class="col-12"  style="padding-left: 0px; padding-right: 0px;">
            <div class="card " id="card-consulta-tabela">
                <div class="card-header" id="ch-adaptado">
                    <h2 class="card-title">Consulta de Usuários</h2>
                </div>
                <div class="card-body" id="cd-adaptado">
                    <div class="table-responsive">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                                <tr>
                                    <th style="width: 5%">
                                        ID
                                    </th>
                                    <th style="width: 25%">
                                        Nome
                                    </th>
                                    <th style="width: 15%">
                                        Cargo
                                    </th>
                                    <th style="width: 20%">
                                        Telefone
                                    </th>
                                    <th style="width: 15%">
                                        Data de Cadastro
                                    </th>
                                    <th class="text-right" style="width: 20%">
                                        <div id="acao">Ações</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usuarios as $usuario)
                                    <tr>
                                        <td>
                                            {{ $usuario['usu_id'] }}
                                        </td>
                                        <td>
                                            {{ $usuario['usu_nome_completo'] }}
                                        </td>
                                        <td>
                                            {{ $usuario['car_descricao'] }}
                                        </td>
                                        <td>
                                            {{ $usuario['usu_telefone'] }}
                                        </td>
                                        <td class="text-center">
                                            {{ $usuario['usu_data_cadastro'] }}
                                        </td>
                                        <td class="text-right">
                                            <a href="#" class="btn btn-primary" id="alter"><i
                                                    class="tim-icons icon-pencil"></i></a>
                                            <button href="#" class="btn btn-primary red" id="excluir-usu"
                                                name="excluir-usuario" data-id="{{ $usuario['usu_id'] }}"  data-rota="{{ route('admin.delete.user') }}"
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
    @endsection
@section('sub-menu')
    <div class="add">
        <div class="dropup show-dropdown">
            <a href="#" onclick="changeImage();" data-toggle="dropdown">
                <img id="imgsub" src="../img/dash/addbtn.png">
            </a>
            <div class="dropdown-menu" id="add-menu">
                <a class="dropdown-item" id="no-padding" data-toggle="modal" data-backdrop="static" data-target="#modalRegisterUser"> <img
                        src="../img/dash/cadastro_pessoa.png" width="75" height="75"></a>
                <a class="dropdown-item" id="no-padding" data-toggle="modal" data-backdrop="static" data-target="#modalRegisterCargo"> <img
                        src="../img/dash/cadastro_pessoa.png" width="75" height="75"></a>
                <a class="dropdown-item" id="no-padding" data-toggle="modal" data-backdrop="static" data-target="#modalRegisterPrivilegio">
                    <img src="../img/dash/cadastro_pessoa.png" width="75" height="75"></a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modals')
<div class="modal fade" id="modalRegisterUser" style="display:none;" aria-hidden="true">
<div class="modal-dialog">
    <form class="form-cadastro" id="formRegisterUser" method="POST" autocomplete="off" enctype="multipart/form-data"
        action="{{ route('admin.create.user') }}">
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
                            <input type="text" name="nomeUser" id="nomeUser" class="form-control" maxlength="25"
                                value="{{ old('nomeUser') }}" placeholder="Entre com o Nome" autofocus>
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
                            <label class="modal-label">CPF:</label> <label style="color: red; font-size: 12px;">
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
                            <input type="text" name="celularUser" id="celularUser"
                                class="celular form-control" value="{{ old('celularUser') }}"
                                placeholder="Entre com o Celular">
                                <div class="div-feedback">
                            <span class="invalid-feedback celularUser_error" role="alert">
                            </span>
                                </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group" id="form-group">
                            <label class="modal-label">Senha:</label> <label style="color: red; font-size: 12px;"> *
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
                            <label class="modal-label">Permissões:</label> <label style="color: red; font-size: 12px;"> *
                            </label>
                            <select type="text" name="cargoUser" id="cargoUser" class="form-control" maxlength="80"
                                value="{{ old('cargoUser') }}" placeholder="Selecione com o Cargo">
                                <option value="">------------Selecione------------</option>
                                @foreach ($cargos as $cargo)
                                    <option value="{{ $cargo['car_id'] }}">{{ $cargo['car_descricao'] }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="div-feedback">
                            <span class="invalid-feedback cargoUser_error" role="alert">
                            </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="modal-label">Status:</label> <label style="color: red; font-size: 12px;">
                                * </label><br>
                            <div class="switch__container">
                                <input id="switch-shadow" name="userStatus" value={{ 'Ativo' ?? 'Inativo' }}
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
                <button type="submit" class="btn btn-primary btn-register">Cadastrar</button>
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
                            <label class="modal-label">Cargo:</label> <label style="color: red; font-size: 12px;"> *
                            </label>
                            <input type="text" name="descricaoCargo" id="form-direita" class="form-control"
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
                        <button type="submit" class="btn btn-primary btn-register">Cadastrar</button>
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
                    <table class="table tablesorter " id="">
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
                            @foreach ($cargos as $cargo)
                                <tr>
                                    <td>
                                        {{ $cargo['car_id'] }}
                                    </td>
                                    <td>
                                        {{ $cargo['car_descricao'] }}
                                    </td>
                                    <td class="text-right">
                                        <a href="#" class="btn btn-primary" id="alter"><i
                                                class="tim-icons icon-pencil"></i></a>
                                        <button href="#" class="btn btn-primary red" id="excluir-car"
                                            name="excluir-cargo" data-id="{{ $cargo['car_id'] }}"  data-rota="{{ route('admin.delete.cargo') }}"
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
                            <label class="modal-label">Cargo:</label> <label style="color: red; font-size: 12px;"> *
                            </label>
                            <select type="text" name="cargoPrivilegio" id="cargoPrivilegio" class="form-control"
                                maxlength="80" value="{{ old('cargoPrivilegio') }}"
                                placeholder="Selecione com o Cargo">
                                <option value="">------------Selecione------------</option>
                                @foreach ($cargos as $cargo)
                                    <option value="{{ $cargo['car_id'] }}">{{ $cargo['car_descricao'] }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="invalid-feedback cargoPrivilegio_error" role="alert">
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label class="modal-label">Usuários:</label><br>
                            <div class="switch__container">
                                <input id="switch-shadow usu" name="usuarioPrivilegio" value={{ 1 ?? 0 }}
                                    class="switch switch--shadow" type="checkbox">
                                <label for="switch-shadow"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="modal-label">Clientes:</label><br>
                            <div class="switch__container">
                                <input id="switch-shadow cli" name="clientePrivilegio" value={{ 1 ?? 0 }}
                                    class="switch switch--shadow" type="checkbox">
                                <label for="switch-shadow"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="modal-label">Financeiro:</label><br>
                            <div class="switch__container">
                                <input id="switch-shadow fin" name="financeiroPrivilegio" value={{ 1 ?? 0 }}
                                    class="switch switch--shadow" type="checkbox">
                                <label for="switch-shadow"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="modal-label">Produtos:</label><br>
                            <div class="switch__container">
                                <input id="switch-shadow pro" name="produtoPrivilegio" value={{ 1 ?? 0 }}
                                    class="switch switch--shadow" type="checkbox">
                                <label for="switch-shadow"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 float-right">
                        <div class="form-group">
                            <label class="modal-label">Estoque:</label><br>
                            <div class="switch__container">
                                <input id="switch-shadow est" name="estoquePrivilegio" value={{ 1 ?? 0 }}
                                    class="switch switch--shadow" type="checkbox">
                                <label for="switch-shadow"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="modal-label">Fornecedores:</label><br>
                            <div class="switch__container">
                                <input id="switch-shadow for" name="fornecedorPrivilegio" value={{ 1 ?? 0 }}
                                    class="switch switch--shadow" type="checkbox">
                                <label for="switch-shadow"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="modal-label">Detalhes:</label><br>
                            <div class="switch__container">
                                <input id="switch-shadow det" name="detalhePrivilegio" value={{ 1 ?? 0 }}
                                    class="switch switch--shadow" type="checkbox">
                                <label for="switch-shadow"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="modal-label">Logistica:</label><br>
                            <div class="switch__container">
                                <input id="switch-shadow log" name="logisticaPrivilegio" value={{ 1 ?? 0 }}
                                    class="switch switch--shadow" type="checkbox">
                                <label for="switch-shadow"></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="cancela btn btn-secondary btn-danger"
                    data-form="formRegisterPrivilegio" data-modal="modalRegisterPrivilegio">Cancelar</button>
                <button type="submit" class="btn btn-primary btn-register">Cadastrar</button>
            </div>
        </div>
    </form>
</div>
</div>

@endsection

@push('ajax')
<script>
    $(document).ready(function() {

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

                },
                success: function(data_decoded) {
                    if (data_decoded.status == 1) {
                        $('#formRegisterUser')[0].reset();
                        $('#mensagem').attr(data_decoded.msg);
                        $('#modalAlertRegistrar').modal('show');
                    }
                    if (data_decoded.status == 0) {
                        $.each(data_decoded.error, function(prefix, val) {
                            if (val[0] = 'A confirmação da senha não corresponde.') {
                                $('span.senhaConfirm_error').text(val[0]);
                                $('input#senhaConfirm_error').addClass('is-invalid');
                            }
                            $('span.' + prefix + '_error').text(val[0]);
                             $('#' + prefix).addClass('is-invalid');
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

                },
                success: function(data_decoded) {
                    if (data_decoded.status == 1) {
                        $('#formRegisterCargo')[0].reset();
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

                },
                success: function(data_decoded) {
                    if (data_decoded.status == 1) {
                        $('#formRegisterPrivilegio')[0].reset();
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
        $(document).on('click', '[data-dismiss="modal"]',
            function(e) {
        e.preventDefault();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                url: "{{ route('admin.list.user') }}",
                processData: false,
                dataType: 'json',
                success: function(data_decoded) {
                    $usuarios = data_decoded.$usuarios;
                }
            });
        }
    );
    });
</script>
@endpush
