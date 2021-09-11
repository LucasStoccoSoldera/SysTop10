@extends('layouts.header-footer')
@section('title', 'Logística - TopSystem')
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
            <li class="active">
                <a href="{{ route('admin.detalhe') }}">
                    <i class="tim-icons icon-pin"></i>
                    <p>Gerenciamento Geral</p>
                </a>
                <a href="{{ route('admin.logistica') }}" hidden  id="logistica"></a>
            </li>
        </ul>
        <div class="voltar">
            <a href="{{ route('admin.detalhe') }}">
                <img src="../img/dash/voltar.png" alt="" width="100px" height="100px">
        </div>
    </div>
</div>
@endsection
@section('content')
<div class="content">
    <div class="row">
        <div class="col-6">
            <div class="card " id="card-consulta-tabela">
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
                                        Dimensão
                                    </th>
                                    <th style="width: 60%">
                                        Descrição
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


        <div class="col-6">
            <div class="card " id="card-consulta-tabela">
                <div class="card-header" id="ch-adaptado">
                    <h2 class="card-title">Consulta de Transp.</h2>
                </div>
                <div class="card-body" id="cd-adaptado">
                    <div class="table-responsive">
                        <table class="table tablesorter " id="tb_transportadora">
                            <thead class=" text-primary">
                                <tr>
                                    <th class="text-center" style="width: 10%">
                                        ID
                                    </th>
                                    <th style="width: 35%">
                                        Nome
                                    </th>
                                    <th style="width: 25%">
                                        Telefone
                                    </th>
                                    <th style="width: 10%">
                                        Limite
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

    <div class="row">
        <div class="col-12">
            <div class="card " id="card-consulta-tabela">
                <div class="card-header" id="ch-adaptado">
                    <h2 class="card-title">Consulta de Relações Logísticas <button class="btn btn-primary btn-block"
                            id="btn-form-consulta-imprimir">Imprimir</button></h2>
                </div>
                <div class="card-body" id="cd-adaptado">
                    <div class="table-responsive">
                        <table class="table tablesorter " id="tb_logistica">
                            <thead class=" text-primary">
                                <tr>
                                    <th class="text-center" style="width: 10%">
                                        ID
                                    </th>
                                    <th style="width: 35%">
                                        Pacote
                                    </th>
                                    <th style="width: 35%">
                                        Transportadora
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
                <a class="dropdown-item" id="no-padding" data-backdrop="static" onclick="abrirModal('#modalRegisterTransportadora');">
                    <img src="../img/dash/transporte.png" width="75" height="75"></a>
                <a class="dropdown-item" id="no-padding" data-backdrop="static" onclick="abrirModal('#modalRegisterLogistica');"> <img
                        src="../img/dash/logistica_log.png" width="75" height="75"></a>
            </div>
        </div>
    </div>
@endsection
@endsection
@section('modals')

<div class="modal fade" id="modalRegisterLogistica" style="display:none;" aria-hidden="true">
    <div class="modal-dialog">
        <form class="form-cadastro" id="formRegisterLogistica" method="POST" autocomplete="off"
            enctype="multipart/form-data" action="{{ route('admin.create.logistica') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Cadastrar Relação Logística</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Pacote</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <select type="text" name="pacoteLogistica" id="pacoteLogistica" class="form-control"
                                    maxlength="25" value="{{ old('pacoteLogistica') }}"
                                    placeholder="Selecione com um Pacote" autofocus>
                                    <option value="">------------Selecione------------</option>
                                    @foreach ($pacotes as $pacote)
                                        <option value="{{ $pacote['id'] }}">{{ $pacote['pac_descricao'] }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="invalid-feedback pacoteLogistica_error" role="alert">
                                </span>
                            </div>
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Transportadora:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <select type="text" name="transLogistica" id="transLogistica" class="form-control"
                                    maxlength="50" value="{{ old('transLogistica') }}"
                                    placeholder="Selecione com uma Transportadora">
                                    <option value="">------------Selecione------------</option>
                                    @foreach ($transportadoras as $transportadora)
                                        <option value="{{ $transportadora['id'] }}">
                                            {{ $transportadora['trans_nome'] }}</option>
                                    @endforeach
                                </select>
                                <span class="invalid-feedback transLogistica_error" role="alert">
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="cancela btn btn-secondary btn-danger"
                        data-form="formRegisterLogistica" data-modal="modalRegisterLogistica">Cancelar</button>

                <button type="submit" class="btn-register btn btn-primary">Cadastrar</button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
<div class="modal fade" id="modalRegisterTransportadora" style="display:none;" aria-hidden="true">
<div class="modal-dialog">
    <form class="form-cadastro" id="formRegisterTransportadora" method="POST" autocomplete="off"
        enctype="multipart/form-data" action="{{ route('admin.create.transportadora') }}">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cadastrar Transportadora</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group" id="form-group">
                            <label class="modal-label">Nome:</label> <label style="color: red; font-size: 12px;"> *
                            </label>
                            <input type="text" name="nomeTrans" id="nomeTrans" class="form-control" maxlength="50"
                                value="{{ old('nomeTrans') }}" placeholder="Entre com o Nome" autofocus>
                                <div class="div-feedback">
                            <span class="invalid-feedback nomeTrans_error" role="alert">
                            </span>
                                </div>
                        </div>
                        <div class="form-group" id="form-group">
                            <label class="modal-label">Limite de Transporte:</label> <label
                                style="color: red; font-size: 12px;"> * </label>
                            <input type="text" name="limitetransTrans" id="limitetransTrans" class="form-control"
                                maxlength="50" value="{{ old('limitetransTrans') }}"
                                placeholder="Entre com o Limite de Pacote">
                                <div class="div-feedback">
                            <span class="invalid-feedback limitetransTrans_error" role="alert">
                            </span>
                                </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group" id="form-group">
                            <label class="modal-label">Telefone</label> <label style="color: red; font-size: 12px;">
                                * </label>
                            <input type="text" name="telefoneTrans" id="telefoneTrans" class="telefone form-control"
                                value="{{ old('telefoneTrans') }}" placeholder="Entre com o Telefone">
                                <div class="div-feedback">
                            <span class="invalid-feedback telefoneTrans_error" role="alert">
                            </span>
                                </div>
                        </div>
                        <div class="form-group" id="form-group">
                            <label class="modal-label">Celular</label> <label style="color: red; font-size: 12px;">
                                * </label>
                            <input type="text" name="telefoneTrans" id="telefoneTrans" class="celular form-control"
                                value="{{ old('telefoneTrans') }}" placeholder="Entre com o Telefone">
                                <div class="div-feedback">
                            <span class="invalid-feedback telefoneTrans_error" role="alert">
                            </span>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="cancela btn btn-secondary btn-danger"
                        data-form="formRegisterTransportadora"
                        data-modal="modalRegisterTransportadora">Cancelar</button>
                                  <button  type="button" class="limpar btn btn-secondary btn-danger"  data-form="formRegisterTransportadora">Limpar</button>
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

        var table_pacote = $('#tb_pacote').DataTable( {
            paging: true,
            searching: false,
            processing: true,
            serverside: true,
            ajax: "{{ route('admin.list.pacote') }}",
            columns: [
                {data: "id", className: "text-center"},
                {data: "pac_dimensao"},
                {data: "pac_descricao"},
                {data: "action", className: "text-right"},
            ]
        });
        var table_transportadora = $('#tb_transportadora').DataTable( {
            paging: true,
            searching: false,
            processing: true,
            serverside: true,
            ajax: "{{ route('admin.list.transportadora') }}",
            columns: [
                {data: "id", className: "text-center"},
                {data: "trans_nome"},
                {data: "trans_telefone"},
                {data: "trans_limite_transporte"},
                {data: "action", className: "text-right"},
            ]
        });
        var table_logistica = $('#tb_logistica').DataTable( {
            paging: true,
            searching: false,
            processing: true,
            serverside: true,
            ajax: "{{ route('admin.list.logistica') }}",
            columns: [
                {data: "id", className: "text-center"},
                {data: "pac_id"},
                {data: "trans_id"},
                {data: "action", className: "text-right"},
            ]
        });

        $(document).on('click', '[data-dismiss="modal"]',
            function() {
                table_pacote.ajax.reload(null, false);
                table_transportadora.ajax.reload(null, false);
                table_logistica.ajax.reload(null, false);
        }
    );

        $("#formRegisterLogistica").on('submit', function(e) {

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
                        $('#formRegisterLogistica')[0].reset();
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

        $("#formRegisterTransportadora").on('submit', function(e) {

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
                        $('#formRegisterTransportadora')[0].reset();
                        $('#mensagem').text(data_decoded.msg);
                        var rota_reload = $('#logistica').attr('href');
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
    });
</script>
@endpush
