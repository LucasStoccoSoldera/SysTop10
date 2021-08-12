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
            <li class="active">
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
                <div>
                    <form class="form" id="form-consulta" method="POST" action="">
                        <div class="card-header">
                            <h2 class="card-title"> Filtrar Fornecedores</h2>
                        </div>
                        <div class="">
                            <div class="campo">
                                <label for="fornecedor" class="campos">CPF/CNPJ</label>

                                <div class="input" id="cpf">
                                    <input name="txt_cpf_cnpj" id="cpf" type="text"
                                        class="form-control-filtro @error('txt_cpf_cnpj') is-invalid @enderror">

                                    @error('txt_cpf_cnpj')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="campo">
                                <label for="nome" class="campos">Nome do Fornecedor</label>

                                <div class="input" id="nome">
                                    <input name="txt_nome" id="nome" type="text"
                                        class="form-control-filtro @error('txt_nome') is-invalid @enderror">

                                    @error('txt_nome')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="campo">
                                <label for="produto" class="campos">Produtos</label>

                                <div class="input" id="nome">
                                    <input name="txt_produto" id="nome" type="text"
                                        class="form-control-filtro @error('txt_produto') is-invalid @enderror">

                                    @error('txt_produto')
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
                    <h2 class="card-title">Consulta de Fornecedores <button class="btn btn-primary btn-block"
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
                                        Nome / Razão
                                    </th>
                                    <th>
                                        CPF / CNPJ
                                    </th>
                                    <th>
                                        Telefone
                                    </th>
                                    <th>
                                        Cidade
                                    </th>
                                    <th class="text-right">
                                        <div id="acao">Ações</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($fornecedores as $fornecedor)
                                    <tr>
                                        <td>
                                            {{ $fornecedor['for_id'] }}
                                        </td>
                                        <td>
                                            {{ $fornecedor['for_nome'] }}
                                        </td>
                                        <td>
                                            {{ $fornecedor['for_cpf_cnpj'] }}
                                        </td>
                                        <td>
                                            {{ $fornecedor['for_telefone'] }}
                                        </td>
                                        <td>
                                            {{ $fornecedor['for_cidade'] }}
                                        </td>
                                        <td class="text-right">
                                            <a href="#" class="btn btn-primary" id="alter"><i
                                                    class="tim-icons icon-pencil"></i></a>
                                            <button href="#" class="btn btn-primary red" id="excluir-for"
                                                name="excluir-fornecedor" data-id="{{ $fornecedor['for_id'] }}"
                                                onclick="showDelete({{ $fornecedor['for_id'] }}, `{{ route('admin.delete.fornecedor') }}`);"
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
            <a href="#" data-toggle="dropdown">
                <img src="../img/dash/addbtn.png">
            </a>
            <div class="dropdown-menu" id="add-menu">
                <a class="dropdown-item" id="no-padding" data-toggle="modal"
                    data-target="#modalRegisterFornecedores"><img src="../img/dash/cadastro_fornecedor.png" width="75"
                        height="75"></a>
            </div>
        </div>
    </div>
@endsection
@section('modals')

    @isset($msgRegistrar)
        <x-alert-register :msgRegistrar="$msgRegistrar" />
    @endisset


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
                                    <span class="invalid-feedback nomeFornecedor_error" role="alert">
                                    </span>
                                </div>
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Telefone:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="text" name="telefoneFornecedor" id="telefoneFornecedor"
                                        onkeypress="mascara(this, '## ####-####')" maxlength="12"
                                        value="{{ old('telefoneFornecedor') }}" class="form-control"
                                        placeholder="Entre com o Telefone">
                                    <span class="invalid-feedback telefoneFornecedor_error" role="alert">
                                    </span>
                                </div>
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Celular:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="text" name="celularFornecedor" id="celularFornecedor"
                                        class="celular form-control" value="{{ old('celularFornecedor') }}"
                                        placeholder="Entre com o Celular">
                                    <span class="invalid-feedback celularFornecedor_error" role="alert">
                                    </span>
                                </div>
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">CPF:</label> <label style="color: red; font-size: 12px;">
                                        * </label>
                                    <input type="text" name="cpfFornecedor" id="cpfFornecedor" class="cpf form-control"
                                        value="{{ old('cpfFornecedor') }}" placeholder="Entre com o CPF">
                                    <span class="invalid-feedback cpfFornecedor_error" role="alert">
                                    </span>
                                </div>
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Produtos:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <select type="text" name="produtosFornecedor" id="produtosFornecedor"
                                        class="form-control" maxlength="80" value="{{ old('produtosFornecedor') }}"
                                        placeholder="Selecione com o Produtos">
                                        <option value="">------------Selecione------------</option>
                                        @foreach ($produtos as $produto)
                                            <option value="{{ $produto['pro_id'] }}">{{ $produto['pro_nome'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="invalid-feedback produtosFornecedor_error" role="alert">
                                    </span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label"> CEP:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="text" name="cepFornecedor" id="cepFornecedor" class="cep form-control"
                                        value="{{ old('cepFornecedor') }}" placeholder="Entre com o CEP">
                                    <span class="invalid-feedback cepFornecedor_error" role="alert">
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label class="modal-label">Cidade:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="text" name="cidadeFornecedor" id="cidadeFornecedor"
                                        class="form-control" maxlength="120" value="{{ old('cidadeFornecedor') }}"
                                        placeholder="Entre com a Cidade">
                                    <span class="invalid-feedback cidadeFornecedor_error" role="alert">
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label class="modal-label">Estado:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="text" name="estadoFornecedor" id="estadoFornecedor"
                                        class="form-control" maxlength="2" value="{{ old('estadoFornecedor') }}"
                                        placeholder="Entre com o Estado">
                                    <span class="invalid-feedback estadoFornecedor_error" role="alert">
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label class="modal-label">Bairro:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="text" name="bairroFornecedor" id="bairroFornecedor"
                                        class="form-control" maxlength="80" value="{{ old('bairroFornecedor') }}"
                                        placeholder="Entre com o Bairro">
                                    <span class="invalid-feedback bairroFornecedor_error" role="alert">
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label class="modal-label">Número:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="number" name="ncasaFornecedor" id="ncasaFornecedor"
                                        class="form-control" maxlength="4" value="{{ old('ncasaFornecedor') }}"
                                        placeholder="Entre com o Número">
                                    <span class="invalid-feedback ncasaFornecedor_error" role="alert">
                                    </span>
                                </div>
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">CNPJ:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="text" name="cnpjFornecedor" id="cnpjFornecedor"
                                        class="cnpj form-control" value="{{ old('cnpjFornecedor') }}"
                                        placeholder="Entre com o CNPJ">
                                    <span class="invalid-feedback cnpjFornecedor_error" role="alert">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="cancela btn btn-secondary btn-danger"
                            data-form="formRegisterFornecedores"
                            data-modal="modalRegisterFornecedores">Cancelar</button>
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

                    },
                    success: function(data_decoded) {
                        if (data_decoded.status == 1) {
                            $('#formRegisterFornecedores')[0].reset();
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

        if ($('#cpfFornecedor').val() != '') {
            $('#cnpjFornecedor').attr('disabled');
        }

        if ($('#telefoneFornecedor').val() != '') {
            $('#celularFornecedor').attr('disabled');
        }
    </script>
@endpush
