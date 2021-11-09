@extends('layouts.header-footer')
@section('title', 'Contas a Receber - TopSystem')
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
                    <img src="../img/dash/voltar.png" alt="" class="voltar">
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

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="chartRec"></canvas>
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
                            <h4 class="resumo" style="color: #2caeec;">Rec. este Ano (R$):</h4>
                            <h3 class="dados-resumo" style="color: #2caeec;">{{ $dado1 }}</h3>
                        </div>
                        <div class="col-auto justify-content-center float-left">
                            <h4 class="resumo" style="color: #2caeec;">Rec. este Mês (R$):</h4>
                            <h3 class="dados-resumo" style="color: #2caeec;">{{ $dado2 }}</h3>
                        </div>
                        <div class="col-auto justify-content-center float-left">
                            <h4 class="resumo" style="color: #2caeec;">Rec. Hoje (R$):</h4>
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
                        enctype="multipart/form-data" action="{{ route('admin.filtro.contasareceber') }}">
                        @csrf
                        <div class="card-header">
                            <h2 class="card-title"> Filtrar Contas a Receber</h2>
                        </div>
                        <div class="col-12">

                            <div class="col-4 float-left">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Descrição:</label>
                                    <input type="text" name="txt_descricao" id="txt_descricao" maxlength="20"
                                        value="{{ old('txt_descricao') }}" class="filtro form-control ">
                                </div>
                            </div>
                            <div class="col-4 float-left">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Data Contabilizada:</label>
                                    <input type="date" name="txt_data" id="txt_data" value="{{ old('txt_data') }}"
                                        class="filtro form-control ">
                                </div>
                            </div>

                            <div class="col-4 float-left">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Status:</label>
                                    <select type="text" name="txt_status" id="txt_status" class="filtro form-control"
                                        maxlength="25" value="{{ old('txt_status') }}">
                                        <option value="">Selecione</option>
                                        <option value="1">Em Aberto</option>
                                        <option value="2">Fechada</option>
                                        <option value="3">Cancelada</option>
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

        <div class="row">
            <div class="col-12" style="padding-left: 0px; padding-right: 0px">
                <div class="card " id="card-consulta-tabela">
                    <div class="card-header" id="ch-adaptado">
                        <h2 class="card-title">Consulta de Contas a Receber </h2>
                    </div>
                    <div class="card-body" id="cd-adaptado">
                        <div class="table-responsive">
                            <table class="table tablesorter" id="tb_receber">
                                <thead class=" text-primary">
                                    <tr>
                                        <th class="text-center" style="width: 5%">
                                            ID
                                        </th>
                                        <th style="width: 25%">
                                            Origem
                                        </th>
                                        <th class="text-center" style="width: 10%">
                                            Venda
                                        </th>
                                        <th class="text-center" style="width: 5%">
                                            Parcelas
                                        </th>
                                        <th style="width: 10%">
                                            Valor (R$)
                                        </th>
                                        <th style="width: 15%">
                                            Data Contabilizada
                                        </th>
                                        <th class="text-center" style="width: 15%">
                                            Status
                                        </th>
                                        <th class="text-right" style="width: 15%">
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
                        onclick="abrirModal('#modalRegisterContasaReceber');">
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
                                    <label class="modal-label">Descrição:</label><label
                                        style="color: red; font-size: 12px;">
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
                                            <option value="{{ $pagamento['id'] }}">
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
                                        <option value="Aberta">Aberto</option>
                                        <option value="Cancelada">Cancelada</option>
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
                        <button type="reset" class="limpar btn btn-secondary btn-danger"
                            data-form="formRegisterContasaReceber">Limpar</button>
                        <button type="submit" class="btn-register btn btn-primary">Cadastrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="modalUpdateContasaReceber" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <form id="formUpdateContasaReceber" method="PUT" autocomplete="off" enctype="multipart/form-data"
                action="{{ route('admin.update.receber') }}">
                @csrf
                <input type="hidden" id="idRec" name="idRec">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Atualizar Conta a Receber</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Descrição:</label><label
                                        style="color: red; font-size: 12px;">
                                        * </label>
                                    <input type="text" name="descricaoReceberUp" id="descricaoReceberUp" maxlength="80"
                                        value="{{ old('descricaoReceberUp') }}" class="form-control"
                                        placeholder="Entre com a Descricao">
                                    <div class="div-feedback">
                                        <span class="invalid-feedback descricaoReceberUp_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Tipo de Pagamento:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <select type="text" name="tipoPagtoReceberUp" id="tipoPagtoReceberUp" maxlength="25"
                                        value="{{ old('tipoPagtoReceberUp') }}" class="form-control"
                                        placeholder="Selecione com o Tipo de Pagamento">
                                        <option value="">------------Selecione------------</option>
                                        @foreach ($pagamentos as $pagamento)
                                            <option value="{{ $pagamento['id'] }}">
                                                {{ $pagamento['tpg_descricao'] }}</option>
                                        @endforeach
                                    </select>
                                    <div class="div-feedback">
                                        <span class="invalid-feedback tipoPagtoReceberUp_error" role="alert">
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Status:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <select type="text" name="statusReceberUp" id="statusReceberUp"
                                        class="form-control" maxlength="25" value="{{ old('statusReceberUp') }}"
                                        placeholder="Selecione o Status">
                                        <option value="">------------Selecione------------</option>
                                        <option value="Aberta">Aberto</option>
                                        <option value="Cancelada">Cancelada</option>
                                    </select>
                                    <div class="div-feedback">
                                        <span class="invalid-feedback statusReceberUp_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Valor a Receber:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="text" name="valorReceberUp" id="valorReceberUp"
                                        class="dinheiro form-control" maxlength="11"
                                        value="{{ old('valorReceberUp') }}" placeholder="Entre com o Valor">
                                    <div class="div-feedback">
                                        <span class="invalid-feedback valorReceberUp_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Qtde. Parcelas:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <select type="text" name="parcelasReceberUp" id="parcelasReceberUp"
                                        class="form-control" maxlength="25" value="{{ old('parcelasReceberUp') }}"
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
                                        <span class="invalid-feedback parcelasReceberUp_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Data de Recebimento:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="date" name="dataReceberUp" id="dataReceberUp"
                                        onkeypress="mascara(this, '##/##/####')" maxlength="10"
                                        value="{{ old('dataReceberUp') }}" class="form-control"
                                        placeholder="Entre com a Data">
                                    <div class="div-feedback">
                                        <span class="invalid-feedback dataReceberUp_error" role="alert">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="cancela btn btn-secondary btn-danger"
                            data-form="formUpdateContasaReceber"
                            data-modal="modalUpdateContasaReceber">Cancelar</button>
                        <button type="reset" class="limpar btn btn-secondary btn-danger"
                            data-form="formUpdateContasaReceber">Limpar</button>
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
                                <label class="modal-label">Valor Final: </label><br>
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
                                <label class="modal-label">Pagto.: </label><br><br>
                                <label class="modal-label">Dt. Geração: </label><br>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group" id="form-direita">
                                <label class="modal-label" id="ls_par_tpg"></label><br><br>
                                <label class="modal-label" id="ls_par_data"></label><br>
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
                                        <table class="table tablesorter " id="tb_parcelas">
                                            <thead class=" text-primary">
                                                <tr>
                                                    <th class="text-center" style="width: 5%">
                                                        Conta
                                                    </th>
                                                    <th class="text-center" style="width: 5%">
                                                        Parc.
                                                    </th>
                                                    <th class="text-right" style="width: 20%">
                                                        Valor
                                                    </th>
                                                    <th class="text-center" style="width: 15%">
                                                        Status
                                                    </th>
                                                    <th class="text-center" style="width: 20%">
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
    $(document).ready(function() {

        var lista_parcelas = false;

        var table_receber = $('#tb_receber').DataTable({
            paging: true,
            searching: false,
            processing: true,
            serverside: true,
            ajax: "{{ route('admin.list.contasareceber') }}",
            columns: [{
                    data: "id",
                    className: "text-center"
                },
                {
                    data: "rec_descricao"
                },
                {
                    data: "rec_ven_id",
                    className: "text-center"
                },
                {
                    data: "rec_parcelas",
                    className: "text-center"
                },
                {
                    data: "rec_valor",
                    className: "text-right",
                    render: DataTable.render.number('.', ',', 2, 'R$')
                },
                {
                    data: "rec_data",
                    className: "text-center"
                },
                {
                    data: "rec_status",
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

        $('body').on('click', 'button.parcelas', function() {
            console.log('vai');
            var table_parcelas = $('#tb_parcelas').DataTable({
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
            var data = $(this).data('data');
            $('#ls_par_conta').val(conta);
            $('#ls_par_valor').val(valor);
            $('#ls_par_tpg').val(pagto);
            $('#ls_par_data').val(data);
        });

        $(document).on('click', '[data-dismiss="modal"]',
            function() {
                table_receber.ajax.reload(null, false);
                if (lista_parcelas == true) {
                    table_parcelas.ajax.reload(null, false);
                }
            }
        );

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
                    $(document).find('input').removeClass('is-invalid');

                },
                success: function(data_decoded) {
                    if (data_decoded.status == 1) {
                        $('#formRegisterContasaReceber')[0].reset();
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

        $("#formUpdateContasaReceber").on('submit', function(e) {

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
                        $('#formUpdateContasaReceber')[0].reset();
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

        var path = "{{ route('admin.autocomplete.rec.descricao') }}"

        $('input#txt_descricao').typeahead({
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
                    var table_receber = data_decoded;
                    table_receber.ajax.reload(null, false);
                }
            });
        });

    });
</script>
@endpush
