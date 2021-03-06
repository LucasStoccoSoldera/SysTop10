@extends('layouts.header-footer')
@section('title', 'Fornecedores - TopSystem')
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
                <li class="active">
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
        <div class="col-12">
            <div class="row">
                <div class="card">
                    <form class="form-filtro" id="formFilter" method="POST" autocomplete="off"
                        enctype="multipart/form-data" action="{{ route('admin.filtro.fornecedor') }}">
                        @csrf
                        <div class="card-header">
                            <h2 class="card-title"> Filtrar Fornecedores</h2>
                        </div>
                        <div class="col-12">

                            <div class="col-4 float-left">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">CPF / CNPJ:</label>
                                    <input type="number" name="for_cpf_cnpj" id="txt_cpf_cnpj" maxlength="13"
                                        value="{{ old('txt_cpf_cnpj') }}" class="filtro form-control">
                                </div>
                            </div>

                            <div class="col-4 float-left">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Fornecedor:</label>
                                    <input type="text" name="for_nome" id="txt_nome" maxlength="25"
                                        value="{{ old('txt_nome') }}" class="filtro form-control">
                                </div>
                            </div>

                            <div class="col-4 float-left">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Cidade:</label>
                                    <input type="text" name="for_cidade" id="txt_cidade" value="{{ old('txt_cidade') }}"
                                        class="filtro form-control">
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
            <div class="col-12" style="padding-left: 0px; padding-right:0px;">
                <div class="card " id="card-consulta-tabela">
                    <div class="card-header" id="ch-adaptado">
                        <h2 class="card-title">Consulta de Fornecedores </h2>
                    </div>
                    <div class="card-body" id="cd-adaptado">
                        <div class="table-responsive">
                            <table class="table tablesorter " id="tb_fornecedor">
                                <thead class=" text-primary">
                                    <tr>
                                        <th class="text-center" style="width: 5%">
                                            ID
                                        </th>
                                        <th style="width: 28%">
                                            Nome / Razão
                                        </th>
                                        <th style="width: 17%">
                                            CPF / CNPJ
                                        </th>
                                        <th style="width: 15%">
                                            Telefone
                                        </th>
                                        <th style="width: 20%">
                                            Cidade
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
                    <img src="../img/dash/addbtn.png">
                </a>
                <div class="dropdown-menu" id="add-menu">
                    <a class="dropdown-item" id="no-padding" data-backdrop="static"
                        onclick="abrirModal('#modalRegisterFornecedores');"><img src="../img/dash/cadastro_fornecedor.png"
                            width="75" height="75"></a>
                </div>
            </div>
        </div>
    @endsection
    @section('modals')

        <div class="modal fade" id="modalRegisterFornecedores" style="display: none;" aria-hidden="true">
            <div class="modal-dialog">
                <form id="formRegisterFornecedores" method="POST" autocomplete="off" enctype="multipart/form-data"
                    action="{{ route('admin.create.fornecedor') }}">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Cadastrar Fornecedores</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group" id="form-group">
                                        <label class="modal-label">Nome:</label> <label
                                            style="color: red; font-size: 12px;"> * </label>
                                        <input type="text" name="nomeFornecedor" id="nomeFornecedor" maxlength="80"
                                            value="{{ old('nomeFornecedor') }}" class="form-control"
                                            placeholder="Entre com o Nome" autofocus>
                                        <div class="div-feedback">
                                            <span class="invalid-feedback nomeFornecedor_error" role="alert">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group" id="form-group">
                                        <label class="modal-label">Telefone:</label> <label
                                            style="color: red; font-size: 12px;"> * </label>
                                        <input type="text" name="telefoneFornecedor" id="telefoneFornecedor"
                                            value="{{ old('telefoneFornecedor') }}" class="telefone form-control"
                                            placeholder="Entre com o Telefone">
                                        <div class="div-feedback">
                                            <span class="invalid-feedback telefoneFornecedor_error" role="alert">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group" id="form-group">
                                        <label class="modal-label">Celular:</label> <label
                                            style="color: red; font-size: 12px;"> * </label>
                                        <input type="text" name="celularFornecedor" id="celularFornecedor"
                                            class="celular form-control" value="{{ old('celularFornecedor') }}"
                                            placeholder="Entre com o Celular">
                                        <div class="div-feedback">
                                            <span class="invalid-feedback celularFornecedor_error" role="alert">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group" id="form-group">
                                        <label class="modal-label">CPF:</label> <label
                                            style="color: red; font-size: 12px;">
                                            * </label>
                                        <input type="text" name="cpfFornecedor" id="cpfFornecedor" class="cpf form-control"
                                            value="{{ old('cpfFornecedor') }}" placeholder="Entre com o CPF">
                                        <div class="div-feedback">
                                            <span class="invalid-feedback cpfFornecedor_error" role="alert">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group" id="form-group">
                                        <label class="modal-label">CNPJ:</label> <label
                                            style="color: red; font-size: 12px;"> * </label>
                                        <input type="text" name="cnpjFornecedor" id="cnpjFornecedor"
                                            class="cnpj form-control" value="{{ old('cnpjFornecedor') }}"
                                            placeholder="Entre com o CNPJ">
                                        <div class="div-feedback">
                                            <span class="invalid-feedback cnpjFornecedor_error" role="alert">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group" id="form-group">
                                        <label class="modal-label">Produtos:</label>
                                        <input type="text" name="produtosFornecedor" id="produtosFornecedor"
                                            class="form-control" maxlength="80" value="{{ old('produtosFornecedor') }}"
                                            placeholder="Selecione com o Produto">
                                        <div class="div-feedback">
                                            <span class="invalid-feedback produtosFornecedor_error" role="alert">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group" id="form-group">
                                        <label class="modal-label"> CEP:</label> <label
                                            style="color: red; font-size: 12px;"> * </label>
                                        <input type="text" name="cepFornecedor" id="cepFornecedor" class="cep form-control"
                                            value="{{ old('cepFornecedor') }}" placeholder="Entre com o CEP">
                                        <div class="div-feedback">
                                            <span class="invalid-feedback cepFornecedor_error" role="alert">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="modal-label">Estado:</label> <label
                                            style="color: red; font-size: 12px;"> * </label>
                                        <input type="text" name="estadoFornecedor" id="estadoFornecedor"
                                            class="form-control" maxlength="2" value="{{ old('estadoFornecedor') }}"
                                            placeholder="Entre com o Estado">
                                        <div class="div-feedback">
                                            <span class="invalid-feedback estadoFornecedor_error" role="alert">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="modal-label">Cidade:</label> <label
                                            style="color: red; font-size: 12px;"> * </label>
                                        <input type="text" name="cidadeFornecedor" id="cidadeFornecedor"
                                            class="form-control" maxlength="120" value="{{ old('cidadeFornecedor') }}"
                                            placeholder="Entre com a Cidade">
                                        <div class="div-feedback">
                                            <span class="invalid-feedback cidadeFornecedor_error" role="alert">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="modal-label">Bairro:</label> <label
                                            style="color: red; font-size: 12px;"> * </label>
                                        <input type="text" name="bairroFornecedor" id="bairroFornecedor"
                                            class="form-control" maxlength="80" value="{{ old('bairroFornecedor') }}"
                                            placeholder="Entre com o Bairro">
                                        <div class="div-feedback">
                                            <span class="invalid-feedback bairroFornecedor_error" role="alert">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="modal-label">Rua:</label> <label
                                            style="color: red; font-size: 12px;"> * </label>
                                        <input type="text" name="ruaFornecedor" id="ruaFornecedor" class="form-control"
                                            maxlength="80" value="{{ old('ruaFornecedor') }}"
                                            placeholder="Entre com a Rua">
                                        <div class="div-feedback">
                                            <span class="invalid-feedback ruaFornecedor_error" role="alert">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="modal-label">Número:</label> <label
                                            style="color: red; font-size: 12px;"> * </label>
                                        <input type="number" name="ncasaFornecedor" id="ncasaFornecedor"
                                            class="form-control" maxlength="4" value="{{ old('ncasaFornecedor') }}"
                                            placeholder="Entre com o Número">
                                        <div class="div-feedback">
                                            <span class="invalid-feedback ncasaFornecedor_error" role="alert">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="cancela btn btn-secondary btn-danger"
                                data-form="formRegisterFornecedores"
                                data-modal="modalRegisterFornecedores">Cancelar</button>
                            <button type="reset" class="limpar btn btn-secondary btn-danger"
                                data-form="formRegisterFornecedores">Limpar</button>
                            <button type="submit" class="btn-register btn btn-primary">Cadastrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalUpdateFornecedores" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <form id="formUpdateFornecedores" method="PUT" autocomplete="off" enctype="multipart/form-data"
                action="{{ route('admin.update.fornecedor') }}">
                @csrf
                <input type="hidden" id="idFor" name="idFor">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Atualizar Fornecedores</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Nome:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="text" name="nomeFornecedorUp" id="nomeFornecedorUp" maxlength="80"
                                        value="{{ old('nomeFornecedorUp') }}" class="form-control"
                                        placeholder="Entre com o Nome" autofocus>
                                    <div class="div-feedback">
                                        <span class="invalid-feedback nomeFornecedorUp_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Telefone:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="text" name="telefoneFornecedorUp" id="telefoneFornecedorUp"
                                        value="{{ old('telefoneFornecedorUp') }}" class="telefone form-control"
                                        placeholder="Entre com o Telefone">
                                    <div class="div-feedback">
                                        <span class="invalid-feedback telefoneFornecedorUp_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Celular:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="text" name="celularFornecedorUp" id="celularFornecedorUp"
                                        class="celular form-control" value="{{ old('celularFornecedorUp') }}"
                                        placeholder="Entre com o Celular">
                                    <div class="div-feedback">
                                        <span class="invalid-feedback celularFornecedorUp_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">CPF:</label> <label style="color: red; font-size: 12px;">
                                        * </label>
                                    <input type="text" name="cpfFornecedorUp" id="cpfFornecedorUp" class="cpf form-control"
                                        value="{{ old('cpfFornecedorUp') }}" placeholder="Entre com o CPF">
                                    <div class="div-feedback">
                                        <span class="invalid-feedback cpfFornecedorUp_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">CNPJ:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="text" name="cnpjFornecedorUp" id="cnpjFornecedorUp"
                                        class="cnpj form-control" value="{{ old('cnpjFornecedorUp') }}"
                                        placeholder="Entre com o CNPJ">
                                    <div class="div-feedback">
                                        <span class="invalid-feedback cnpjFornecedorUp_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Produtos:</label><label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="text" name="produtosFornecedorUp" id="produtosFornecedorUp"
                                        class="form-control" maxlength="80" value="{{ old('produtosFornecedorUp') }}"
                                        placeholder="Selecione com o Produtos">
                                    <div class="div-feedback">
                                        <span class="invalid-feedback produtosFornecedorUp_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label"> CEP:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="text" name="cepFornecedorUp" id="cepFornecedorUp" class="cep form-control"
                                        value="{{ old('cepFornecedorUp') }}" placeholder="Entre com o CEP">
                                    <div class="div-feedback">
                                        <span class="invalid-feedback cepFornecedorUp_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="modal-label">Estado:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="text" name="estadoFornecedorUp" id="estadoFornecedorUp"
                                        class="form-control" maxlength="2" value="{{ old('estadoFornecedorUp') }}"
                                        placeholder="Entre com o Estado">
                                    <div class="div-feedback">
                                        <span class="invalid-feedback estadoFornecedorUp_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="modal-label">Cidade:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="text" name="cidadeFornecedorUp" id="cidadeFornecedorUp"
                                        class="form-control" maxlength="120" value="{{ old('cidadeFornecedorUp') }}"
                                        placeholder="Entre com a Cidade">
                                    <div class="div-feedback">
                                        <span class="invalid-feedback cidadeFornecedorUp_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="modal-label">Bairro:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="text" name="bairroFornecedorUp" id="bairroFornecedorUp"
                                        class="form-control" maxlength="80" value="{{ old('bairroFornecedorUp') }}"
                                        placeholder="Entre com o Bairro">
                                    <div class="div-feedback">
                                        <span class="invalid-feedback bairroFornecedorUp_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="modal-label">Rua:</label> <label style="color: red; font-size: 12px;">
                                        * </label>
                                    <input type="text" name="ruaFornecedorUp" id="ruaFornecedorUp" class="form-control"
                                        maxlength="80" value="{{ old('ruaFornecedorUp') }}"
                                        placeholder="Entre com a Rua">
                                    <div class="div-feedback">
                                        <span class="invalid-feedback ruaFornecedorUp_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="modal-label">Número:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="number" name="ncasaFornecedorUp" id="ncasaFornecedorUp"
                                        class="form-control" maxlength="4" value="{{ old('ncasaFornecedorUp') }}"
                                        placeholder="Entre com o Número">
                                    <div class="div-feedback">
                                        <span class="invalid-feedback ncasaFornecedorUp_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="cancela btn btn-secondary btn-danger"
                            data-form="formUpdateFornecedores" data-modal="modalUpdateFornecedores">Cancelar</button>
                        <button type="reset" class="limpar btn btn-secondary btn-danger"
                            data-form="formUpdateFornecedores">Limpar</button>
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


        $("#formFilter").on('submit', function(e) {
            $('#tb_fornecedor').DataTable().ajax.reload();
    });

            var table_fornecedor = $('#tb_fornecedor').DataTable({
                paging: true,
                searching: false,
                processing: true,
                serverside: true,
                ajax: "{{ route('admin.filtro.fornecedor') }}",
                columns: [{
                        data: "id",
                        className: "text-center"
                    },
                    {
                        data: "for_nome"
                    },
                    {
                        data: "for_cpf_cnpj"
                    },
                    {
                        data: "for_telefone"
                    },
                    {
                        data: "for_cidade"
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
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
                },
            });

            $(document).on('click', '[data-dismiss="modal"]',
                function() {
                    table_fornecedor.ajax.reload(null, false);
                }
            );

            $("#formRegisterFornecedores").on('submit', function(e) {
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
                            $('#formRegisterFornecedores')[0].reset();
                            demo.showNotification('top', 'right', 2, data_decoded.msg,
                                'tim-icons icon-check-2');
                        }
                        if (data_decoded.status == 0) {
                            $.each(data_decoded.error, function(prefix, val) {
                                $('span.' + prefix + '_error').text(val[0]);
                                $('#' + prefix).focus();
                            $('#' + prefix).addClass('is-invalid');
                            });
                            $.each(data_decoded.error_cpf_cnpj, function(prefix, val) {
                                $('span.' + prefix + '_error').text(val[0]);
                                $('#' + prefix).focus();
                            $('#' + prefix).addClass('is-invalid');
                            });
                            $.each(data_decoded.error_telefone_celular, function(prefix, val) {
                                $('span.' + prefix + '_error').text(val[0]);
                                $('#' + prefix).focus();
                            $('#' + prefix).addClass('is-invalid');
                            });
                        }
                    }
                });
            });


            $("#formUpdateFornecedores").on('submit', function(e) {
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
                            $('#formUpdateFornecedores')[0].reset();
                            demo.showNotification('top', 'right', 2, data_decoded.msg,
                                'tim-icons icon-check-2');
                        }
                        if (data_decoded.status == 0) {
                            $.each(data_decoded.error, function(prefix, val) {
                                $('span.' + prefix + '_error').text(val[0]);
                                $('#' + prefix).focus();
                            $('#' + prefix).addClass('is-invalid');
                            });
                            $.each(data_decoded.error_cpf_cnpj, function(prefix, val) {
                                $('span.' + prefix + '_error').text(val[0]);
                                $('#' + prefix).focus();
                            $('#' + prefix).addClass('is-invalid');
                            });
                            $.each(data_decoded.error_telefone_celular, function(prefix, val) {
                                $('span.' + prefix + '_error').text(val[0]);
                                $('#' + prefix).focus();
                            $('#' + prefix).addClass('is-invalid');
                            });
                        }
                    }
                });
            });

            $('#cpfFornecedor').on('type', function() {
                if ($('#cpfFornecedor').val() != '') {
                    $('#cnpjFornecedor').attr('disabled', 'true');
                }
            });

            $('#cnpjFornecedor').on('type', function() {
                if ($('#cnpjFornecedor').val() != '') {
                    $('#cpfFornecedor').attr('disabled', 'true');
                }
            });

            var path = "{{ route('admin.autocomplete.for.nome') }}"

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
                        $('#modalAlertDelete').modal('toggle');
                            demo.showNotification('top', 'right', 4, data_decoded.msg,
                                'tim-icons icon-alert-circle-exc');
                        }
                    if (data_decoded.status == 0) {
                        demo.showNotification('top', 'right', 3, data_decoded.msg,
                            'tim-icons icon-alert-circle-exc');
                            $('#modalAlertDelete').modal('toggle');
                        }
                    }
                });
            });

        });
    </script>
@endpush
