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
                    <h2 class="card-title">Consulta de Pacotes<button class="btn btn-primary btn-block"
                            id="btn-form-consulta-imprimir">Imprimir</button></h2>
                </div>
                <div class="card-body" id="cd-adaptado">
                    <div class="table-responsive">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                                <tr>
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Dimensão
                                    </th>
                                    <th>
                                        Descrição
                                    </th>
                                    <th class="text-right">
                                        <div id="acao">Ações</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pacotes as $pacote)
                                    <tr>
                                        <td>
                                            {{ $pacote['pac_id'] }}
                                        </td>
                                        <td>
                                            {{ $pacote['pac_dimensao'] }}
                                        </td>
                                        <td>
                                            {{ $pacote['pac_descricao'] }}
                                        </td>
                                        <td class="text-right">
                                            <a href="#" class="btn btn-primary" id="alter"><i
                                                    class="tim-icons icon-pencil"></i></a>
                                            <button href="#" class="btn btn-primary red" id="excluir-pac"
                                                name="excluir-pacote" data-id="{{ $pacote['pac_id'] }}"
                                                onclick="showDelete({{ $pacote['pac_id'] }}, `{{ route('admin.delete.pacote') }}`);"
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


        <div class="col-6">
            <div class="card " id="card-consulta-tabela">
                <div class="card-header" id="ch-adaptado">
                    <h2 class="card-title">Consulta de Transportadoras <button class="btn btn-primary btn-block"
                            id="btn-form-consulta-imprimir">Imprimir</button></h2>
                </div>
                <div class="card-body" id="cd-adaptado">
                    <div class="table-responsive">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                                <tr>
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Nome
                                    </th>
                                    <th>
                                        Telefone
                                    </th>
                                    <th>
                                        Limite de Transporte
                                    <th class="text-right">
                                        <div id="acao">Ações</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transportadoras as $transportadora)
                                    <tr>
                                        <td>
                                            {{ $transportadora['trans_id'] }}
                                        </td>
                                        <td>
                                            {{ $transportadora['trans_nome'] }}
                                        </td>
                                        <td>
                                            {{ $transportadora['trans_telefone'] }}
                                        </td>
                                        <td>
                                            {{ $transportadora['trans_limite_transporte'] }}
                                        </td>
                                        <td class="text-right">
                                            <a href="#" class="btn btn-primary" id="alter"><i
                                                    class="tim-icons icon-pencil"></i></a>
                                            <button href="#" class="btn btn-primary red" id="excluir-trans"
                                                name="excluir-transportadora"
                                                data-id="{{ $transportadora['trans_id'] }}"
                                                onclick="showDelete({{ $transportadora['trans_id'] }}, `{{ route('admin.delete.transportadora') }}`);"
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

    <div class="col-12">
        <div class="row">
            <div class="card " id="card-consulta-tabela">
                <div class="card-header" id="ch-adaptado">
                    <h2 class="card-title">Consulta de Relações Logísticas <button class="btn btn-primary btn-block"
                            id="btn-form-consulta-imprimir">Imprimir</button></h2>
                </div>
                <div class="card-body" id="cd-adaptado">
                    <div class="table-responsive">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                                <tr>
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Pacote
                                    </th>
                                    <th>
                                        Transportadora
                                    </th>
                                    <th class="text-right">
                                        <div id="acao">Ações</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($logisticas as $logistica)
                                    <tr>
                                        <td>
                                            {{ $logistica['log_id'] }}
                                        </td>
                                        <td>
                                            {{ $logistica['log_pacote'] }}
                                        </td>
                                        <td>
                                            {{ $logistica['log_transportadora'] }}
                                        </td>
                                        <td class="text-right">
                                            <a href="#" class="btn btn-primary" id="alter"><i
                                                    class="tim-icons icon-pencil"></i></a>
                                            <button href="#" class="btn btn-primary red" id="excluir-log"
                                                name="excluir-logistica" data-id="{{ $logistica['log_id'] }}"
                                                onclick="showDelete({{ $logistica['log_id'] }}, `{{ route('admin.delete.logistica') }}`);"
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
@section('sub-menu')
    <div class="add">
        <div class="dropup show-dropdown">
            <a href="#" onclick="changeImage();" data-toggle="dropdown">
                <img id="imgsub" src="../img/dash/addbtn.png">
            </a>
            <div class="dropdown-menu" id="add-menu">
                <a class="dropdown-item" id="no-padding" data-toggle="modal" data-target="#modalRegisterTransportadora">
                    <img src="../img/dash/transporte.png" width="75" height="75"></a>
                <a class="dropdown-item" id="no-padding" data-toggle="modal" data-target="#modalRegisterLogistica"> <img
                        src="../img/dash/logistica_log.png" width="75" height="75"></a>
            </div>
        </div>
    </div>
@endsection
@endsection
@section('modals')

@isset($msgRegistrar)
    <x-alert-register :msgRegistrar="$msgRegistrar" />
@endisset

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
                                        <option value="{{ $pacote['pac_id'] }}">{{ $pacote['pac_descricao'] }}
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
                                        <option value="{{ $transportadora['trans_id'] }}">
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
                    <button type="submit" class="btn btn-primary btn-register">Cadastrar</button>
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
                            <span class="invalid-feedback nomeTrans_error" role="alert">
                            </span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group" id="form-group">
                            <label class="modal-label">Telefone</label> <label style="color: red; font-size: 12px;">
                                * </label>
                            <input type="text" name="telefoneTrans" id="telefoneTrans" class="telefone form-control"
                                onkeypress="mascara(this, '## ####-####')" maxlength="12"
                                value="{{ old('telefoneTrans') }}" placeholder="Entre com o Telefone">
                            <span class="invalid-feedback telefoneTrans_error" role="alert">
                            </span>
                        </div>
                        <div class="form-group" id="form-group">
                            <label class="modal-label">Limite de Transporte:</label> <label
                                style="color: red; font-size: 12px;"> * </label>
                            <input type="text" name="limitetransTrans" id="limitetransTrans" class="form-control"
                                maxlength="50" value="{{ old('limitetransTrans') }}"
                                placeholder="Entre com o Limite de Pacote">
                            <span class="invalid-feedback limitetransTrans_error" role="alert">
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="cancela btn btn-secondary btn-danger"
                        data-form="formRegisterTransportadora"
                        data-modal="modalRegisterTransportadora">Cancelar</button>
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

                },
                success: function(data_decoded) {
                    if (data_decoded.status == 1) {
                        $('#formRegisterLogistica')[0].reset();
                        $('#mensagem').text(data_decoded.msg);
                        $('#modalAlertRegistrar').modal('show');
                    }
                    if (data_decoded.status == 0) {
                        $.each(data_decoded.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                            $('input#' + prefix).addClass('is-invalid');
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

                },
                success: function(data_decoded) {
                    if (data_decoded.status == 1) {
                        $('#formRegisterTransportadora')[0].reset();
                        $('#mensagem').text(data_decoded.msg);
                        $('#modalAlertRegistrar').modal('show');
                    }
                    if (data_decoded.status == 0) {
                        $.each(data_decoded.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                            $('input#' + prefix).addClass('is-invalid');
                        });
                    }
                }
            });
        });
    });
</script>
@endpush
