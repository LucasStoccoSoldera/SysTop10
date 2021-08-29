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
                    <form class="form-filtro" id="formFilterCliente" method="POST" autocomplete="off"
        enctype="multipart/form-data" action="">
        @csrf
                        <div class="card-header">
                            <h2 class="card-title">Filtrar Clientes</h2> <br>
                        </div>
                        <div class="col-12">

                        <div class="col-4 float-left">
                            <div class="form-group" id="form-group">
                                <label class="modal-label">CPF / CNPJ:</label>
                                <input type="number" name="txt_cpf_cnpj" id="txt_cpf_cnpj" maxlength="13"
                                    value="{{ old('txt_cpf_cnpj') }}" class="filtro form-control @error('txt_cpf_cnpj') is-invalid @enderror">
                                    @error('txt_cpf_cnpj')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors }}</strong>
                                        </span>
                                    @enderror
                            </div>
                                </div>

                                <div class="col-4 float-left">
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Nome:</label>
                                <input type="text" name="txt_nome" id="txt_nome" maxlength="20"
                                    value="{{ old('txt_nome') }}" class="filtro form-control @error('txt_nome') is-invalid @enderror typeahead">
                                    @error('txt_nome')
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
                                    value="{{ old('txt_data') }}" class="filtro form-control @error('txt_data') is-invalid @enderror">
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

    <div class="row">
        <div class="col-12">
            <div class="card " id="card-consulta-tabela">
                <div class="card-header" id="ch-adaptado">
                    <h2 class="card-title">Consulta de Clientes <button class="btn btn-primary btn-block"
                            id="btn-form-consulta-imprimir">Imprimir</button></h2>
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
        <a href="#" onclick="changeImage();" data-toggle="dropdown">
            <img id="imgsub" src="../img/dash/addbtn.png">
        </a>
        <div class="dropdown-menu" id="add-menu">
            <a class="dropdown-item" id="no-padding" data-toggle="modal" data-backdrop="static" data-backdrop="static" data-target="#modalRegisterCliente"> <img
                    src="../img/dash/cadastro_pessoa.png" width="75" height="75"></a>
        </div>
    </div>
</div>
</div>
@endsection
@endsection

@section('modals')
<div class="modal fade" id="modalRegisterCliente" style="display:none;" aria-hidden="true">
<div class="modal-dialog">
    <form class="form-cadastro" id="formRegisterCliente" method="POST" autocomplete="off"
        enctype="multipart/form-data" action="{{ route('admin.create.cliente') }}">
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
                    <div class="col-6">
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
                            <label class="modal-label">CPF:</label> <label style="color: red; font-size: 12px;"> *
                            </label>
                            <input type="text" name="cpfCliente" id="cpfCliente" class="cpf form-control"
                                value="{{ old('cpfCliente') }}" placeholder="Entre com o CPF">
                                <div class="div-feedback">
                            <span class="invalid-feedback cpfCliente_error" role="alert">
                            </span>
                                </div>
                        </div>
                        <div class="form-group" id="form-group">
                            <label class="modal-label">CNPJ:</label> <label style="color: red; font-size: 12px;"> *
                            </label>
                            <input type="text" name="cnpjCliente" id="cnpjCliente" class="cnpj form-control"
                                value="{{ old('cnpjCliente') }}" placeholder="Entre com o CNPJ">
                                <div class="div-feedback">
                            <span class="invalid-feedback cnpjCliente_error" role="alert">
                            </span>
                                </div>
                        </div>
                    </div>
                    <div class="col-6">
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
                            <label class="modal-label">Celular:</label> <label style="color: red; font-size: 12px;">
                                * </label>
                            <input type="text" name="celularCliente" id="celularCliente"
                                class="celular form-control" value="{{ old('celularCliente') }}"
                                placeholder="Entre com o Celular">
                                <div class="div-feedback">
                            <span class="invalid-feedback celular_error" role="alert">
                            </span>
                                </div>
                        </div>
                        <div class="form-group" id="form-group">
                            <label class="modal-label">Senha:</label> <label style="color: red; font-size: 12px;"> *
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
                            <span class="invalid-feedback senhaConfirm_error" role="alert">
                            </span>
                                </div>
                        </div>
                        <div class="form-group">
                            <label class="modal-label">Status:</label> <label style="color: red; font-size: 12px;">
                                * </label><br>
                            <div class="switch__container">
                                <input id="switch-shadow" name="statusCliente" value={{ 'Ativo' ?? 'Inativo' }}
                                    class="switch switch--shadow" type="checkbox">
                                <label for="switch-shadow"></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="cancela btn btn-secondary btn-danger" data-form="formRegisterCliente"
                    data-modal="modalRegisterCliente">Cancelar</button>
                <button  type="button" class="limpar btn btn-secondary btn-danger"  data-form="formRegisterCliente">Limpar</button>
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

        $('#tb_cliente').DataTable( {
            paging: true,
            searching: false,
            processing: true,
            serverside: true,
            ajax: "{{ route('admin.list.cliente') }}",
            columns: [
                {"data": "cli_nome"},
                {"data": "cli_cpf_cnpj"},
                {"data": "cli_celular"},
                {"data": "cli_cidade"},
                {"data": "created_at"},
            ]
        });

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

                },
                success: function(data_decoded) {
                    if (data_decoded.status == 1) {
                        $('#formRegisterCliente')[0].reset();
                        $('#mensagem').attr(data_decoded.msg);
                        $('#modalAlertRegistrar').modal('show');
                    }
                    if (data_decoded.status == 0) {
                        $.each(data_decoded.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                             $('#' + prefix).addClass('is-invalid');
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

        $(document).on('click', '[data-dismiss="modal"]',
            function(e) {
        e.preventDefault();
        $('#tb_cliente').DataTable({
            paging: true,
            searching: false,
            processing: true,
            serverside: true,
            ajax: "{{ route('admin.list.user') }}",
            columns: [
                {"data": "cli_nome"},
                {"data": "cli_cpf_cnpj"},
                {"data": "cli_celular"},
                {"data": "cli_cidade"},
                {"data": "created_at"},
            ]
        });
        }
    );
        $('#cpfCliente').on('type', function(){
        if ($('#cpfCliente').val() != '') {
            $('#cnpjCliente').attr('disabled', 'true');
        }
        if ($('#cnpjCliente').val() != '') {
            $('#cpfCliente').attr('disabled', 'true');
        }
    });

    $('#cnpjCliente').on('type', function(){
        if ($('#cpfCliente').val() != '') {
            $('#cnpjCliente').attr('disabled', 'true');
        }
        if ($('#cnpjCliente').val() != '') {
            $('#cpfCliente').attr('disabled', 'true');
        }
    });

        var path = "{{route ('admin.autocomplete.cli.nome')}}"

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
