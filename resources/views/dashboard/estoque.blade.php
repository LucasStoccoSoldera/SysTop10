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
                    <form class="form-filtro" id="formFilterCliente" method="POST" autocomplete="off"
                    enctype="multipart/form-data" action="">
                    @csrf
                        <div class="card-header">
                            <h2 class="card-title">Filtrar Produtos no Estoque</h2>
                        </div>
                        <div class="col-12">

                            <div class="col-4 float-left">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Produto:</label>
                                    <input type="text" name="txt_produto" id="txt_produto" maxlength="25"
                                        value="{{ old('txt_produto') }}" class="form-control @error('txt_produto') is-invalid @enderror">
                                        @error('txt_produto')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors }}</strong>
                                            </span>
                                        @enderror
                                </div>
                                    </div>

                                    <div class="col-4 float-left">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label"style="float: left; margin-right: 100%;   ">Quantidade:</label>
                                    <select type="text" name="txt_fil" id="txt_fil" class="form-control"
                                     value="{{ old('txt_fil') }}" style="width: 15%; float:left;margin-bottom: 0px;padding: 0px 0px 0px 0px;">
                                    <option value="">...</option>
                                    <option value="1"><=</option>
                                    <option value="2"> =</option>
                                    <option value="3">>=</option>
                                </select>
                                    <input type="number" name="txt_qtde" id="txt_qtde" maxlength="6"
                                        value="{{ old('txt_qtde') }}" class="form-control @error('txt_qtde') is-invalid @enderror"style="width: 80%;float:right;">
                                        @error('txt_qtde')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-4 float-left">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Dimensão:</label>
                                    <select type="text" name="txt_dimensao" id="txt_dimensao" class="form-control" @error('txt_dimensao') is-invalid @enderror
                                    value="{{ old('txt_centro') }}"
                                   >
                                    <option value="">------------Selecione------------</option>
                                    @foreach ($dimensoes as $dimensao)
                                        <option value="{{ $dimensao['dim_id'] }}">{{ $dimensao['dim_descricao'] }}
                                        </option>
                                    @endforeach
                                </select>
                                        @error('txt_dimensao')
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
            </div>
        </div>

    <div class="row">
        <div class="col-8" style="padding-left: 0px;">
            <div class="card " id="card-consulta-tabela">
                <div class="card-header" id="ch-adaptado">
                    <h2 class="card-title">Movimentação do Estoque</h2>
                </div>
                <div class="card-body" id="cd-adaptado">
                    <div class="table-responsive">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                                <tr>
                                    <th style="width: 35%">
                                        Produto
                                    </th>
                                    <th style="width: 10%">
                                        Qtde
                                    </th>
                                    <th style="width: 20%">
                                        Dimensão
                                    </th>
                                    <th style="width: 20%">
                                        Cor
                                    </th>
                                    <th class="text-center" style="width: 15%">
                                        Data
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($entradas as $entrada)
                                    <tr>
                                        <td>

                                        </td>
                                        <td>
                                            {{ $entrada['quantidade'] }}
                                        </td>
                                        <td>
                                            {{ $entrada['dim_id'] }}
                                        </td>
                                        <td>
                                            {{ $entrada['cor_id'] }}
                                        </td>
                                        <td class="text-center">
                                            {{ $entrada['data'] }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-4" style="padding-right: 0px;">
            <div class="card " id="card-consulta-tabela">
                <div class="card-header" id="ch-adaptado">
                    <h2 class="card-title">Todos os Produtos
                </div>
                <div class="card-body" id="cd-adaptado">
                    <div class="table-responsive">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                                <tr>
                                    <th style="width: 70%">
                                        Produto
                                    </th>
                                    <th style="width: 30%">
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($entradas as $entrada)
                                    <tr>
                                        <td>
                                            {{ $entrada['pro_id'] }}
                                        </td>
                                        <td class="text-center">
                                            {{ $entrada['est_status'] }}
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
                <a class="dropdown-item" id="no-padding" data-toggle="modal" data-backdrop="static" data-target="#modalRegisterEstoque"> <img
                        src="../img/dash/materia_prima.png" width="75" height="75"></a>
            </div>
        </div>
    </div>
@endsection

@section('modals')

    @isset($msgRegistrar)
        <x-alert-register :msgRegistrar="$msgRegistrar" />
    @endisset

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
                                    <label class="modal-label">Quantidade:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="number" name="qtdeEstoque" id="qtdeEstoque" class="form-control"
                                        maxlength="6" value="{{ old('qtdeEstoque') }}"
                                        placeholder="Entre com a Quantidade" autofocus>
                                    <span class="invalid-feedback qtdeEstoque_error" role="alert">
                                    </span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Dimensão do Produto:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <select type="text" name="IDDimensao" id="IDDimensao" class="form-control"
                                        value="{{ old('IDDimensao') }}" placeholder="Selecione com a Dimensão">
                                        <option value="">------------Selecione------------</option>
                                        @foreach ($dimensoes as $dimensao)
                                            <option value="{{ $dimensao['dim_id'] }}">
                                                {{ $dimensao['dim_descricao'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="invalid-feedback IDDimensao_error" role="alert">
                                    </span>
                                </div>
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Cor do Produto:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <select type="text" name="IDCor" id="IDCor" class="form-control"
                                        value="{{ old('IDCor') }}" placeholder="Selecione com a Cor">
                                        <option value="">------------Selecione------------</option>
                                        @foreach ($cores as $cor)
                                            <option value="{{ $cor['cor_id'] }}">{{ $cor['cor_nome'] }}</option>
                                        @endforeach
                                    </select>
                                    <span class="invalid-feedback IDCor_error" role="alert">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="cancela btn btn-secondary btn-danger"
                            data-form="formRegisterEstoque" data-modal="modalRegisterEstoque">Cancelar</button>
                                      <button  type="button" class="limpar btn btn-secondary btn-danger"  data-form="formRegisterEstoque">Limpar</button>
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

                    },
                    success: function(data_decoded) {
                        if (data_decoded.status == 1) {
                            $('#formRegisterEstoque')[0].reset();
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
            $(document).on('click', '[data-dismiss="modal"]',
            function(e) {
        e.preventDefault();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                url: "{{ route('admin.list.estoque') }}",
                processData: false,
                dataType: 'json',
                success: function(data_decoded) {
                    $entradas = data_decoded.$movimentacoes;
                    $produtos = data_decoded.$produtos;
                }
            });
        }
    );

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
            $('#modalReturnDelete').modal('show');
    }
});
});
        });
    </script>
@endpush
