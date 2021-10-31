@extends('layouts.header-footer')
@section('title', 'Finanças - TopSystem')
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
                                <h5 class="card-category">Análise Financeira</h5>
                                <h2 class="card-title">Caixa ao Longo do Mês</h2>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="chartFin"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 justify-content-center">
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title" id="no-margin">Relações Financeiras (Hoje)</h2><br>
                    </div>
                    <div>
                        <div class="col-auto justify-content-md-center float-left">
                            <h4 class="resumo" style="color: #2caeec;">Caixa:</h4>
                            <h3 class="dados-resumo" style="color: #2caeec;">{{ $hoje1 }}</h3>
                        </div>
                        <div class="col-auto justify-content-center float-left">
                            <h4 class="resumo" style="color: #2caeec;">Total de Entradas:</h4>
                            <h3 class="dados-resumo" style="color: #2caeec;">{{ $hoje2 }}</h3>
                        </div>
                        <div class="col-auto justify-content-center float-left">
                            <h4 class="resumo" style="color: #2caeec;">Total de Saídas:</h4>
                            <h3 class="dados-resumo" style="color: #2caeec;">{{ $hoje3 }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 justify-content-center">
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title" id="no-margin">Relações Financeiras (Sem)</h2><br>
                    </div>
                    <div>
                        <div class="col-auto justify-content-md-center float-left">
                            <h4 class="resumo" style="color: #2caeec;">Caixa (Sem):</h4>
                            <h3 class="dados-resumo" style="color: #2caeec;">{{ $sem4 }}</h3>
                        </div>
                        <div class="col-auto justify-content-center float-left">
                            <h4 class="resumo" style="color: #2caeec;">T. de Entradas (Sem):</h4>
                            <h3 class="dados-resumo" style="color: #2caeec;">{{ $sem5 }}</h3>
                        </div>
                        <div class="col-auto justify-content-center float-left">
                            <h4 class="resumo" style="color: #2caeec;">T. de Saídas (Sem):</h4>
                            <h3 class="dados-resumo" style="color: #2caeec;">{{ $sem6 }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 justify-content-center">
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title" id="no-margin">Relações Financeiras (Mês)</h2><br>
                    </div>
                    <div>
                        <div class="col-auto justify-content-md-center float-left">
                            <h4 class="resumo" style="color: #2caeec;">Caixa (Mês):</h4>
                            <h3 class="dados-resumo" style="color: #2caeec;">{{ $mes7 }}</h3>
                        </div>
                        <div class="col-auto justify-content-center float-left">
                            <h4 class="resumo" style="color: #2caeec;">Total de Entradas (Mês):</h4>
                            <h3 class="dados-resumo" style="color: #2caeec;">{{ $mes8 }}</h3>
                        </div>
                        <div class="col-auto justify-content-center float-left">
                            <h4 class="resumo" style="color: #2caeec;">Total de Saídas (Mês):</h4>
                            <h3 class="dados-resumo" style="color: #2caeec;">{{ $mes9 }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @section('sub-menu')
        <div class="add">
            <div class="dropup show-dropdown">
                <a href="#" data-toggle="dropdown">
                    <img src="../img/dash/addbtn.png">
                </a>
                <div class="dropdown-menu" id="add-menu">
                    <a class="dropdown-item" id="no-padding" href="{{ route('admin.Contas') }}"><img
                            src="../img/dash/contas.png" width="75" height="75"></a>
                    <a class="dropdown-item" id="no-padding" href="{{ route('admin.ContasaReceber') }}"><img
                            src="../img/dash/receber.png" width="75" height="75"></a>
                </div>
            </div>
        </div>
    @endsection
@endsection

