@extends('layouts.header-footer')
@section('title', 'Estoque - TopSystem')
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
                <li>
                    <a href="{{ route('admin.produto') }}">
                        <i class="tim-icons icon-components"></i>
                        <p>Produtos</p>
                    </a>
                </li>
                <li class="active">
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
        <div class="col-12">
            <div class="row">
                <div class="card">
                    <form class="form-filtro" id="formFilter" method="POST" autocomplete="off"
                        enctype="multipart/form-data" action="{{ route('admin.filtro.estoque') }}">
                        @csrf
                        <div class="card-header">
                            <h2 class="card-title">Filtrar Produtos no Estoque</h2>
                        </div>
                        <div class="col-12">

                            <div class="col-4 float-left">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Produto:</label>
                                    <input type="text" name="txt_produto" id="txt_produto" maxlength="25"
                                        value="{{ old('txt_produto') }}" class="filtro form-control">
                                </div>
                            </div>

                            <div class="col-4 float-left">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label"
                                        style="float: left; margin-right: 100%;   ">Quantidade:</label>
                                    <select type="text" name="txt_fil" id="txt_fil" class="filtro form-control"
                                        value="{{ old('txt_fil') }}"
                                        style="width: 15% !important; float:left;margin-bottom: 0px;padding: 0px 0px 0px 0px;">
                                        <option value="">...</option>
                                        <option value="1">
                                            <=< /option>
                                        <option value="2"> =</option>
                                        <option value="3">>=</option>
                                    </select>
                                    <input type="number" name="txt_qtde" id="txt_qtde" maxlength="6"
                                        value="{{ old('txt_qtde') }}" class="filtro form-control"
                                        style="width: 80% !important;float:right;">
                                </div>
                            </div>

                            <div class="col-4 float-left">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Dimensão:</label>
                                    <select type="text" name="txt_dimensao" id="txt_dimensao" class="filtro form-control"
                                        value="{{ old('txt_centro') }}">
                                        <option value="">Selecione</option>
                                        @foreach ($dimensoes as $dimensao)
                                            <option value="{{ $dimensao['id'] }}">{{ $dimensao['dim_descricao'] }}
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
    </div>

    <div class="col-12 justify-content-center">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title" id="no-margin">Resumo de Estoque</h2><br>
                </div>
                <div>
                    <div class="col-auto justify-content-md-center float-left">
                        <h4 class="resumo" style="color: #2caeec;">Total de Itens:</h4>
                        <h3 class="dados-resumo" style="color: #2caeec;">{{ $dado1 }}</h3>
                    </div>
                    <div class="col-auto justify-content-center float-left">
                        <h4 class="resumo" style="color: #2caeec;">Maior Quantidade:</h4>
                        <h3 class="dados-resumo" style="color: #2caeec;">{{ $dado2 }}</h3>
                    </div>
                    <div class="col-auto justify-content-center float-left">
                        <h4 class="resumo" style="color: #2caeec;">Maior Entrada (Mês):</h4>
                        <h3 class="dados-resumo" style="color: #2caeec;">{{ $dado3 }}</h3>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card " id="card-consulta-tabela" style="border-color: #2CAEEC !important;
                                border-color: white;
                                border-width: medium;
                                border-style: double;">
                        <div class="card-header" id="ch-adaptado">
                            <h2 class="card-title">Todos os Produtos
                        </div>
                        <div class="card-body" id="cd-adaptado">
                            <div class="table-responsive">
                                <table class="table tablesorter " id="tb_produto_estoque">
                                    <thead class=" text-primary">
                                        <tr>
                                            <th class="text-center" style="width: 20%">
                                                ID Produto
                                            </th>
                                            <th style="width: 40%">
                                                Nome Produto
                                            </th>
                                            <th style="width: 15%">
                                                Qtde.
                                            </th>
                                            <th style="width: 25%">
                                                Status
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

    <div class="row">
        <div class="col-12">
            <div class="card " id="card-consulta-tabela">
                <div class="card-header" id="ch-adaptado">
                    <h2 class="card-title">Movimentação do Estoque</h2>
                </div>
                <div class="card-body" id="cd-adaptado">
                    <div class="table-responsive">
                        <table class="table tablesorter " id="tb_estoque">
                            <thead class=" text-primary">
                                <tr>
                                    <th class="text-center" style="width: 15%">
                                        Produto
                                    </th>
                                    <th style="width: 10%">
                                        Qtde
                                    </th>
                                    <th style="width: 15%">
                                        Dimensão
                                    </th>
                                    <th style="width: 15%">
                                        Cor
                                    </th>
                                    <th class="text-center" style="width: 10%">
                                        Data
                                    </th>
                                    <th class="text-center" style="width: 5%">
                                        Horário
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
                    onclick="abrirModal('#modalRegisterEstoque');"> <img src="../img/dash/materia_prima.png" width="75"
                        height="75"></a>
            </div>
        </div>
    </div>
@endsection

@section('modals')

    <div class="modal fade" id="modalRegisterEstoque" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <form id="formRegisterEstoque" method="POST" autocomplete="off" enctype="multipart/form-data"
                action="{{ route('admin.create.estoque') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Cadastrar Entrada de Estoque</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Quantidade (Saídas = -):</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="number" name="qtdeEstoque" id="qtdeEstoque" class="form-control"
                                        maxlength="6" value="{{ old('qtdeEstoque') }}"
                                        placeholder="Entre com a Quantidade" autofocus>
                                    <div class="div-feedback">
                                        <span class="invalid-feedback qtdeEstoque_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Data:</label> <label style="color: red; font-size: 12px;">
                                        * </label>
                                    <input type="date" name="dataEstoque" id="dataEstoque" class="form-control"
                                        value="{{ old('dataEstoque') }}" placeholder="Entre com a Data" autofocus>
                                    <div class="div-feedback">
                                        <span class="invalid-feedback dataEstoque_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Horário:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="time" name="timeEstoque" id="timeEstoque" class="form-control"
                                        value="{{ old('timeEstoque') }}" placeholder="Entre com o Horário" autofocus>
                                    <div class="div-feedback">
                                        <span class="invalid-feedback timeEstoque_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Status:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <select type="text" name="statusEstoque" id="statusEstoque" class="form-control"
                                        maxlength="25" value="{{ old('statusEstoque') }}"
                                        placeholder="Selecione o Status">
                                        <option value="1">Entrada</option>
                                        <option value="2">Faturada</option>
                                        <option value="3">Fechada</option>
                                        <option value="4">Cancelada</option>
                                    </select>
                                    <div class="div-feedback">
                                        <span class="invalid-feedback statusEstoque_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Produto:</label> <label
                                        style="color: red; font-size: 12px;"> *
                                    </label>
                                    <select type="text" name="produtoEstoque" id="produtoEstoque" class="form-control"
                                        maxlength="80" value="{{ old('produtoEstoque') }}"
                                        placeholder="Selecione com o Produto">
                                        <option value="">------------Selecione------------</option>
                                        @foreach ($produtos as $produto)
                                            <option value="{{ $produto['id'] }}">{{ $produto['pro_nome'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="div-feedback">
                                        <span class="invalid-feedback produtoEstoque_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Dimensão do Produto:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <select type="text" name="IDDimensao" id="IDDimensao" class="form-control"
                                        value="{{ old('IDDimensao') }}" placeholder="Selecione com a Dimensão">
                                        <option value="">------------Selecione------------</option>
                                        @foreach ($dimensoes as $dimensao)
                                            <option value="{{ $dimensao['id'] }}">
                                                {{ $dimensao['dim_descricao'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="div-feedback">
                                        <span class="invalid-feedback IDDimensao_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Cor do Produto:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <select type="text" name="IDCor" id="IDCor" class="form-control"
                                        value="{{ old('IDCor') }}" placeholder="Selecione com a Cor">
                                        <option value="">------------Selecione------------</option>
                                        @foreach ($cores as $cor)
                                            <option value="{{ $cor['id'] }}">{{ $cor['cor_nome'] }}</option>
                                        @endforeach
                                    </select>
                                    <div class="div-feedback">
                                        <span class="invalid-feedback IDCor_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="cancela btn btn-secondary btn-danger" data-form="formRegisterEstoque"
                            data-modal="modalRegisterEstoque">Cancelar</button>
                        <button type="reset" class="limpar btn btn-secondary btn-danger"
                            data-form="formRegisterEstoque">Limpar</button>
                        <button type="submit" class="btn-register btn btn-primary">Cadastrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="modalUpdateEstoque" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <form id="formUpdateEstoque" method="PUT" autocomplete="off" enctype="multipart/form-data"
                action="{{ route('admin.update.estoque') }}">
                @csrf
                <input type="hidden" id="idEst" name="idEst">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Atualizar Entrada de Estoque</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Quantidade (Saídas = -):</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="number" name="qtdeEstoqueUp" id="qtdeEstoqueUp" class="form-control"
                                        maxlength="6" value="{{ old('qtdeEstoqueUp') }}"
                                        placeholder="Entre com a Quantidade" autofocus>
                                    <div class="div-feedback">
                                        <span class="invalid-feedback qtdeEstoqueUp_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Data:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="date" name="dataEstoqueUp" id="dataEstoqueUp" class="form-control"
                                        value="{{ old('dataEstoqueUp') }}" placeholder="Entre com a Data" autofocus>
                                    <div class="div-feedback">
                                        <span class="invalid-feedback dataEstoqueUp_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Horário:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="time" name="timeEstoqueUp" id="timeEstoqueUp" class="form-control"
                                        value="{{ old('timeEstoqueUp') }}" placeholder="Entre com o Horário" autofocus>
                                    <div class="div-feedback">
                                        <span class="invalid-feedback timeEstoqueUp_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Status:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <select type="text" name="statusEstoqueUp" id="statusEstoqueUp" class="form-control"
                                        maxlength="25" value="{{ old('statusEstoqueUp') }}"
                                        placeholder="Selecione o Status">
                                        <option value="1">Entrada</option>
                                        <option value="2">Faturada</option>
                                        <option value="3">Fechada</option>
                                        <option value="4">Cancelada</option>
                                    </select>
                                    <div class="div-feedback">
                                        <span class="invalid-feedback statusEstoqueUp_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Produto:</label> <label
                                        style="color: red; font-size: 12px;"> *
                                    </label>
                                    <select type="text" name="produtoEstoqueUp" id="produtoEstoqueUp"
                                        class="form-control" maxlength="80" value="{{ old('produtoEstoqueUp') }}"
                                        placeholder="Selecione com o Produto">
                                        <option value="">------------Selecione------------</option>
                                        @foreach ($produtos as $produto)
                                            <option value="{{ $produto['id'] }}">{{ $produto['pro_nome'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="div-feedback">
                                        <span class="invalid-feedback produtoEstoqueUp_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Dimensão do Produto:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <select type="text" name="IDDimensaoUp" id="IDDimensaoUp" class="form-control"
                                        value="{{ old('IDDimensaoUp') }}" placeholder="Selecione com a Dimensão">
                                        <option value="">------------Selecione------------</option>
                                        @foreach ($dimensoes as $dimensao)
                                            <option value="{{ $dimensao['id'] }}">
                                                {{ $dimensao['dim_descricao'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="div-feedback">
                                        <span class="invalid-feedback IDDimensaoUp_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Cor do Produto:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <select type="text" name="IDCorUp" id="IDCorUp" class="form-control"
                                        value="{{ old('IDCorUp') }}" placeholder="Selecione com a Cor">
                                        <option value="">------------Selecione------------</option>
                                        @foreach ($cores as $cor)
                                            <option value="{{ $cor['id'] }}">{{ $cor['cor_nome'] }}</option>
                                        @endforeach
                                    </select>
                                    <div class="div-feedback">
                                        <span class="invalid-feedback IDCorUp_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="cancela btn btn-secondary btn-danger" data-form="formUpdateEstoque"
                            data-modal="modalUpdateEstoque">Cancelar</button>
                        <button type="reset" class="limpar btn btn-secondary btn-danger"
                            data-form="formUpdateEstoque">Limpar</button>
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

            var table_estoque = $('#tb_estoque').DataTable({
                paging: true,
                searching: false,
                processing: true,
                serverside: true,
                ajax: "{{ route('admin.list.estoque') }}",
                columns: [{
                        data: "pro_id",
                        className: "text-center"
                    },
                    {
                        data: "est_qtde"
                    },
                    {
                        data: "dim_descricao"
                    },
                    {
                        data: "cor_nome"
                    },
                    {
                        data: "est_data",
                        className: "text-center"
                    },
                    {
                        data: "est_time",
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
            var table_produto_estoque = $('#tb_produto_estoque').DataTable({
                paging: false,
                searching: false,
                processing: true,
                serverside: true,
                ajax: "{{ route('admin.list.estoqueproduto') }}",
                columns: [{
                        data: "pro_id",
                        className: "text-center"
                    },
                    {
                        data: "pro_nome"
                    },
                    {
                        data: "est_qtde"
                    },
                    {
                        data: "est_status",
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

            $(document).on('click', '[data-dismiss="modal"]',
                function() {
                    table_estoque.ajax.reload(null, false);
                    table_produto_estoque.ajax.reload(null, false);
                }
            );

            $("#formRegisterEstoque").on('submit', function(e) {

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
                            $('#formRegisterEstoque')[0].reset();
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

            $("#formUpdateEstoque").on('submit', function(e) {

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
                            $('#formUpdateEstoque')[0].reset();
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
                        var table_estoque = data_decoded;
                        table_estoque.ajax.reload(null, false);
                    }
                });
            });

        });
    </script>
@endpush
