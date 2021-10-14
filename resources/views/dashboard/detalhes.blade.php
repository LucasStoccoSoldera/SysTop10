@extends('layouts.header-footer', [$add = 'no'])
@section('title', 'Detalhes - TopSystem')
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
    </div>
</div>
@endsection
@section('content')
<div class="content">
    <div class="row">

        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <a class="btn btn-primary col-12" id="btn-detalhe" href="{{ route('admin.logistica') }}">
                        <div class="tudo">
                            <p id="p-detalhe">{{ __('Ir para Logística') }}</p>
                        </div>
                    </a>
                    <br>
                    <br>
                    <br>
                    <br>
                    <h1 class="card-title" id="detalhe-title">Logística</h1>
                </div>
                <div class="card-body" id="detalhe">
                    <div class="justify-content-md-center">
                        <div class="col-auto justify-content-md-center">
                            <h4 class="resumo" style="text-align: center;
                            float: unset;
                            margin: 0 auto;
                            margin-top: 30px;
                            color: fff;">Total de Relações</h4>
                            <h3 class="dados-resumo"style="color: #2caeec;text-align: center;
                            float: unset;
                            margin: 0 auto;
                            margin-top: 30px;
                            color: fff;">{{ $relacao_total }}
                            </h3>
                        </div>
                        <div class="col-auto justify-content-center">
                            <h4 class="resumo" style="text-align: center;
                            float: unset;
                            margin: 0 auto;
                            margin-top: 30px;
                            color: fff;">Total de Transportadoras</h4>
                            <h3 class="dados-resumo"style="color: #2caeec;text-align: center;
                            float: unset;
                            margin: 0 auto;
                            margin-top: 30px;
                            color: fff;">
                                {{ $transportadora_total }}</h3>
                        </div>
                        <div class="col-auto justify-content-center">
                            <h4 class="resumo" style="text-align: center;
                            float: unset;
                            margin: 0 auto;
                            margin-top: 30px;
                            color: fff;">Total de Pacotes</h4>
                            <h3 class="dados-resumo"style="color: #2caeec;text-align: center;
                            float: unset;
                            margin: 0 auto;
                            margin-top: 30px;
                            color: fff;">{{ $pacotes_total }}
                            </h3>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-primary col-12" id="btn-detalhe" data-backdrop="static"
                        onclick="abrirModal('#modalRegisterCentroCusto');">
                        <div class="tudo">
                            <p id="p-detalhe">{{ __('Novo Centro de Custo') }}</p>
                        </div>
                    </button>
                    <br>
                    <br>
                    <br>
                    <br>
                    <h1 class="card-title" id="detalhe-title">Centros de Custo</h1>
                </div>
                <div class="card-body" id="detalhe">
                    <div>
                        <div class="col-auto justify-content-md-center">
                            @foreach ($centros as $centro)
                                <h3 class="dados-resumo" id="cc_descricao_json" style="color: #2caeec;    text-align: center;
                                float: unset;
                                margin: 0 auto;
                                margin-top: 30px;
                                color: fff;">
                                    {{ $centro['cc_descricao'] }}</h3>
                                <div class="text-center">
                                    <a href="#" class="btn btn-primary alter"><i
                                            class="tim-icons icon-pencil"></i></a>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-primary col-12" id="btn-detalhe" data-toggle="modal" data-backdrop="static"
                        data-target="#modalRegisterTpgPagto">
                        <div class="tudo">
                            <p id="p-detalhe">{{ __('Novo Tipo de Pagamento') }}</p>
                        </div>
                    </button>
                    <br>
                    <br>
                    <br>
                    <br>
                    <h1 class="card-title" id="detalhe-title">Tipos de Pagamento</h1>
                </div>
                <div class="card-body" id="detalhe">
                    <div>
                        <div class="col-auto justify-content-md-center">
                            @foreach ($pagamentos as $pagamento)
                                <h3 class="dados-resumo" id="tpg_descricao_json" style="color: #2caeec;    text-align: center;
                                float: unset;
                                margin: 0 auto;
                                margin-top: 30px;
                                color: fff;">
                                    {{ $pagamento['tpg_descricao'] }}</h3>
                                <div class="text-center">
                                    <a href="#" class="btn btn-primary alter"><i
                                            class="tim-icons icon-pencil"></i></a>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('modals')
    <div class="modal" id="modalRegisterCentroCusto" style="display:none;top: 0;" aria-hidden="true">
        <div class="modal-dialog">
            <form class="form-cadastro" id="formRegisterCentroCusto" method="PUT" autocomplete="off"
                enctype="multipart/form-data" action="{{ route('admin.update.centrocusto') }}">
                @csrf
                <input type="hidden" id="idPag" name="idPag">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Atualizar Centro de Custo</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Nome do Departamento:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="text" name="NomeCentroCustoUp" id="NomeCentroCustoUp" maxlength="25"
                                        value="{{ old('NomeCentroCustoUp') }}" class="form-control"
                                        placeholder="Entre com o Nome do Departamento">
                                    <span class="invalid-feedback NomeCentroCustoUp_error" role="alert">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="cancela btn btn-secondary btn-danger"
                            data-form="formRegisterCentroCusto" data-modal="modalRegisterCentroCusto">Cancelar</button>

                <button type="submit" class="btn-register btn btn-primary">Cadastrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="modalRegisterTpgPagto" style="display:none;top: 0;" aria-hidden="true">
        <div class="modal-dialog">
            <form class="form-cadastro" id="formRegisterTpgPagto" method="POST" autocomplete="off"
                enctype="multipart/form-data" action="{{ route('admin.create.tpgpagto') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Atualizar Tipo de Pagamento</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Tipo de Pagamento:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="text" name="TPTipoPagto" id="TPTipoPagto" maxlength="25"
                                        value="{{ old('TPTipoPagto') }}" class="form-control"
                                        placeholder="Entre com o Tipo de Pagamento">
                                    <span class="TPTipoPagto_error invalid-feedback" role="alert">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="cancela btn btn-secondary btn-danger"
                            data-form="formRegisterTpgPagto" data-modal="modalRegisterTpgPagto">Cancelar</button>

                <button type="submit" class="btn-register btn btn-primary">Cadastrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal" id="modalUpdateCentroCusto" style="display:none;top: 0;" aria-hidden="true">
        <div class="modal-dialog">
            <form class="form-cadastro" id="formUpdateCentroCusto" method="PUT" autocomplete="off"
                enctype="multipart/form-data" action="{{ route('admin.update.centrocusto') }}">
                @csrf
                <input type="hidden" id="idCC" name="idCC">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Cadastrar Centro de Custo</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Nome do Departamento:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="text" name="NomeCentroCustoUp" id="NomeCentroCustoUp" maxlength="25"
                                        value="{{ old('NomeCentroCustoUp') }}" class="form-control"
                                        placeholder="Entre com o Nome do Departamento">
                                    <span class="invalid-feedback NomeCentroCustoUp_error" role="alert">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="cancela btn btn-secondary btn-danger"
                            data-form="formUpdateCentroCusto" data-modal="modalUpdateCentroCusto">Cancelar</button>

                <button type="submit" class="btn-register btn btn-primary">Cadastrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="modalUpdateTpgPagto" style="display:none;top: 0;" aria-hidden="true">
        <div class="modal-dialog">
            <form class="form-cadastro" id="formUpdateTpgPagto" method="POST" autocomplete="off"
                enctype="multipart/form-data" action="{{ route('admin.create.tpgpagto') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Cadastrar Tipo de Pagamento</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group" id="form-group">
                                    <label class="modal-label">Tipo de Pagamento:</label> <label
                                        style="color: red; font-size: 12px;"> * </label>
                                    <input type="text" name="TPTipoPagto" id="TPTipoPagto" maxlength="25"
                                        value="{{ old('TPTipoPagto') }}" class="form-control"
                                        placeholder="Entre com o Tipo de Pagamento">
                                    <span class="TPTipoPagto_error invalid-feedback" role="alert">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="cancela btn btn-secondary btn-danger"
                            data-form="formUpdateTpgPagto" data-modal="modalUpdateTpgPagto">Cancelar</button>

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

            $("#formRegisterCentroCusto").on('submit', function(e) {

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
                        $(document).find('span.invalid-feedback').attr('');
                        $(document).find('input').removeClass('is-invalid');

                    },
                    success: function(data_decoded) {
                        if (data_decoded.status == 1) {
                            $('#formRegisterCentroCusto')[0].reset();
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

            $("#formRegisterTpgPagto").on('submit', function(e) {

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
                        $(document).find('span.invalid-feedback').attr('');
                        $(document).find('input').removeClass('is-invalid');
                    },
                    success: function(data_decoded) {
                        if (data_decoded.status == 1) {
                            $('#formRegisterTpgPagto')[0].reset();
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

});
    </script>
@endpush
