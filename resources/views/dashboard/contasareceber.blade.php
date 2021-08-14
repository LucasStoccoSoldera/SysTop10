@extends('layouts.header-footer')
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
                <img src="../img/dash/voltar.png" alt="" width="100px" height="100px">
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
                            <h5 class="card-category">Analise de Contas a Receber</h5>
                            <h2 class="card-title">Contas a Receber</h2>
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
                    <h2 class="card-title" id="no-margin">Resumo de Créditos</h2><br>
                </div>
                <div>
                    <div class="col-auto justify-content-md-center float-left">
                        <h4 class="resumo" style="color: #2caeec;">A Rec. este Ano (R$):</h4>
                        <h3 class="dados-resumo" style="color: #2caeec;">{{ $dado1 }}</h3>
                    </div>
                    <div class="col-auto justify-content-center float-left">
                        <h4 class="resumo" style="color: #2caeec;">A Rec.r este Mês (R$):</h4>
                        <h3 class="dados-resumo" style="color: #2caeec;">{{ $dado2 }}</h3>
                    </div>
                    <div class="col-auto justify-content-center float-left">
                        <h4 class="resumo" style="color: #2caeec;">A Rec. Hoje (R$):</h4>
                        <h3 class="dados-resumo" style="color: #2caeec;">{{ $dado3 }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-12">
        <div class="row">
            <div class="card">
                <div>
                    <form class="form" id="form-consulta" method="POST" action="">
                        <div class="card-header">
                            <h2 class="card-title"> Filtrar Contas a Receber</h2>
                        </div>
                        <div class="">
                            <div class="campo">
                                <label for="origem" class="campos">Origem</label>

                                <div class="input" id="nome">
                                    <input name="txt_origem" id="nome" type="text"
                                        class="form-control-filtro @error('txt_origem') is-invalid @enderror">

                                    @error('txt_origem')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="campo">
                                <label for="data" class="campos">Data Contabilizada</label>

                                <div class="input" id="data">
                                    <input name="txt_data" id="data" type="date"
                                        class="form-control-filtro @error('txt_data') is-invalid @enderror">

                                    @error('txt_data')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="campo">
                                <label for="status" class="campos">Status</label>

                                <div class="input" id="nome">
                                    <input name="txt_status" id="data" type="text"
                                        class="form-control-filtro @error('txt_status') is-invalid @enderror">

                                    @error('txt_status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="campo float-right" id="botao">
                                <button class="btn btn-primary btn-block float-right"
                                    id="btn-form-consulta">Filtrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card " id="card-consulta-tabela">
                <div class="card-header" id="ch-adaptado">
                    <h2 class="card-title">Consulta de Contas a Receber <button class="btn btn-primary btn-block"
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
                                        Origem
                                    </th>
                                    <th>
                                        Valor (R$)
                                    </th>
                                    <th>
                                        Tipo de Pagamento
                                    </th>
                                    <th class="text-center">
                                        Data Contabilizada
                                    </th>
                                    <th class="text-center">
                                        Status
                                    </th>
                                    <th class="text-right">
                                        <div id="acao">Ações</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($creditos as $credito)
                                    <tr>
                                        <td>
                                            {{ $credito['rec_id'] }}
                                        </td>
                                        <td>
                                            {{ $credito['rec_descricao'] }}
                                        </td>
                                        <td>
                                            {{ $credito['rec_valor'] }}
                                        </td>
                                        <td>
                                            {{ $credito['tipo_pagto'] }}
                                        </td>
                                        <td class="text-center">
                                            {{ $credito['rec_data'] }}
                                        </td>
                                        <td class="text-center">
                                            {{ $credito['rec_status'] }}
                                        </td>
                                        <td class="text-right">
                                            <a href="#" class="btn btn-primary" id="alter"><i
                                                    class="tim-icons icon-pencil"></i></a>
                                            <button href="#" class="btn btn-primary red" id="excluir-rec"
                                                name="excluir-receber" data-id="{{ $credito['rec_id'] }}"
                                                onclick="showDelete({{ $credito['rec_id'] }}, `{{ route('admin.delete.receber') }}`);"
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
                <a class="dropdown-item" id="no-padding" data-toggle="modal" data-target="#modalRegisterContasaReceber">
                    <img src="../img/dash/cadastro_receber.png" width="75" height="75"></a>
                <a class="dropdown-item" id="no-padding" href="{{ route('admin.Vendas') }}"> <img
                        src="../img/dash/vendas.png" width="75" height="75"></a>
            </div>
        </div>
    </div>
@endsection
@endsection
@section('modals')

<div class="modal fade" id="modalRegisterContasaReceber" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formRegisterContasaReceber" method="POST" autocomplete="off" enctype="multipart/form-data"
            action="{{ route('admin.create.receber') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Cadastrar Conta a Receber</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Descrição:</label><label style="color: red; font-size: 12px;">
                                     * </label>
                                <input type="text" name="descricaoReceber" id="descricaoReceber" maxlength="80"
                                    value="{{ old('descricaoReceber') }}" class="form-control"
                                    placeholder="Entre com a Descricao">
                                    <div class="div-feedback">
                                <span class="invalid-feedback descricaoReceber_error" role="alert">
                                </span>
                                    </div>
                            </div>
                            <div class="form-group" id="form-group">
                                <label class="modal-label">Tipo de Pagamento:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <select type="text" name="tipoPagtoReceber" id="tipoPagtoReceber" maxlength="25"
                                    value="{{ old('tipoPagtoReceber') }}" class="form-control"
                                    placeholder="Selecione com o Tipo de Pagamento">
                                    <option value="">------------Selecione------------</option>
                                    @foreach ($pagamentos as $pagamento)
                                        <option value="{{ $pagamento['tpg_id'] }}">
                                            {{ $pagamento['tpg_descricao'] }}</option>
                                    @endforeach
                                </select>
                                <div class="div-feedback">
                                <span class="invalid-feedback tipoPagtoReceber_error" role="alert">
                                </span>
                                </div>
                            </div>

                            <div class="form-group" id="form-group">
                                <label class="modal-label">Status:</label> <label
                                    style="color: red; font-size: 12px;"> * </label>
                                <select type="text" name="statusReceber" id="statusReceber" class="form-control"
                                    maxlength="25" value="{{ old('statusReceber') }}"
                                    placeholder="Selecione o Status">
                                    <option value="">------------Selecione------------</option>
                                    <option value="1">Em Aberto</option>
                                    <option value="2">Fechada</option>
                                    <option value="3">Cancelada</option>
                                </select>
                                <div class="div-feedback">
                                <span class="invalid-feedback statusReceber_error" role="alert">
                                </span>
                                </div>
                            </div>
                        </div>
                            <div class="col-6">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Valor a Receber:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="text" name="valorReceber" id="valorReceber"
                                        class="dinheiro form-control" maxlength="11"
                                        value="{{ old('valorReceber') }}" placeholder="Entre com o Valor">
                                        <div class="div-feedback">
                                    <span class="invalid-feedback valorReceber_error" role="alert">
                                    </span>
                                        </div>
                                </div>
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Qtde. Parcelas:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <select type="text" name="parcelasReceber" id="parcelasReceber"
                                        class="form-control" maxlength="25" value="{{ old('parcelasReceber') }}"
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
                                    <span class="invalid-feedback parcelasReceber_error" role="alert">
                                    </span>
                                    </div>
                                </div>
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Data de Recebimento:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="date" name="dataReceber" id="dataReceber"
                                        onkeypress="mascara(this, '##/##/####')" maxlength="10"
                                        value="{{ old('dataReceber') }}" class="form-control"
                                        placeholder="Entre com a Data">
                                        <div class="div-feedback">
                                    <span class="invalid-feedback dataReceber_error" role="alert">
                                    </span>
                                        </div>
                                </div>
                            </div>
                        </div>
                </div>
                        <div class="modal-footer">
                            <button type="button" class="cancela btn btn-secondary btn-danger"
                                data-form="formRegisterContasaReceber"
                                data-modal="modalRegisterContasaReceber">Cancelar</button>
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

        $("#formRegisterContasaReceber").on('submit', function(e) {

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
                        $('#formRegisterContasaReceber')[0].reset();
                        $('#mensagem').text(data_decoded.msg);
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
    });
</script>
@endpush
