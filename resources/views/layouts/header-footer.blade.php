<!--
=========================================================
* * Black Dashboard - v1.0.1
=========================================================

* Product Page: https://www.creative-tim.com/product/black-dashboard
* Copyright 2019 Creative Tim (https://www.creative-tim.com)


* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="76x76" href="../img/dash/apple-icon.png">
    <link rel="icon" type="icon" href="../img/dash/sacola.png">
    <title>
        @yield('title')
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!-- Nucleo Icons -->
    <link href="../css/nucleo-icons.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link href="../css/black-dashboard.css?v=1.0.0" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../demo/demo.css" rel="stylesheet" />




    </head>


<body class="">
    <div class="wrapper">
        @yield('menu-principal')
        <div class="main-panel">
            <nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <div class="navbar-toggle d-inline">
                            <button type="button" class="navbar-toggler">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </button>
                        </div>
                        <img src="../img/dash/logo.png" class="navbar-brand" id="margin-navbar"
                            href="javascript:void(0)" width="200" height="50">
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navigation">
                        <ul class="navbar-nav ml-auto">
                            <li class="dropdown nav-item" style="margin-top: 12px; margin-right: 20px;">
                                <?php
                                setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
                                date_default_timezone_set('America/Sao_Paulo');
                                $uppercaseMonth = ucfirst(gmstrftime('%B'));
                                echo utf8_encode(ucfirst(strftime( '%A, %d de ' .$uppercaseMonth. ' de %Y', strtotime('today'))));
                                ?>
                                <i class="far fa-clock"></i></i> <span id="timer"></span></span>
                            </li>
                            <li class="dropdown nav-item">
                                <a href="javascript:void(0)" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                    <div class="notification d-none d-lg-block d-xl-block"></div>
                                    <i class="tim-icons icon-sound-wave"></i>
                                    <p class="d-lg-none">
                                        Notifica????es
                                    </p>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right dropdown-navbar">
                                    <li class="nav-link"><a href="#" class="nav-item dropdown-item">Conta com vencimento pr??ximo!</a></li>
                                    <li class="nav-link"><a href="javascript:void(0)" class="nav-item dropdown-item">50 novos clientes foram cadastrados ontem!</a></li>
                                    <li class="nav-link"><a href="javascript:void(0)"
                                            class="nav-item dropdown-item">Produto sem estoque!</a></li>
                                    <li class="nav-link"><a href="javascript:void(0)"
                                            class="nav-item dropdown-item">Novo funcion??rio inserido!</a></li>
                                    <li class="nav-link"><a href="javascript:void(0)"
                                            class="nav-item dropdown-item">43 vendas em aberto essa semana.</a></li>
                                </ul>
                            </li>

                            <li class="dropdown nav-item">
                                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                    <div class="photo">
                                        <img src="../img/dash/user.png" alt="Profile Photo">
                                    </div>
                                    <b class="caret d-none d-lg-block d-xl-block"></b>
                                    <p class="d-lg-none">
                                        Sair
                                    </p>
                                </a>
                                <ul class="dropdown-menu dropdown-navbar">
                                    <li class="nav-link"><a class="nav-item dropdown-item"
                                            href="{{ route('admin.logout') }}" onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                                            {{ __('Sair') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown nav-item" style="margin-top: 12px;" >
                                {{ Auth::user()->usu_nome_completo }}
                            </li>
                            <li class="separator d-lg-none"></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="modal modal-search fade" id="searchModal" tabindex="-1" role="dialog"
                aria-labelledby="searchModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="SEARCH">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="tim-icons icon-simple-remove"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Navbar -->
            @yield('content')
            <footer class="footer" id="footer-padding">
                <div class="container-fluid">
                    <ul class="nav" id="footer-padding">
                        <li class="nav-item">
                            <a href="http://localhost/SITE/index.html" target="_blank" class="nav-link">
                                Site Top 10 Embalagens
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin')}}" class="nav-link">
                                In??cio
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../doc/manual.pdf" download class="nav-link">
                                Manual
                            </a>
                        </li>
                    </ul>
                    <div class="copyright">
                        ??
                        <script>
                            document.write(new Date().getFullYear())
                        </script> 2021 feito de <i class="tim-icons icon-bulb-63"></i> pela
                        <a href="http://localhost/FLEX/FLEX/index.html" target="_blank">Flex</a> Solu????es em Tecnologia.
                    </div>
                </div>
            </footer>
        </div>
    </div>

    @yield('sub-menu')
    <div class="fixed-plugin">
        <div class="dropdown show-dropdown">
            <a href="#" data-toggle="dropdown">
                <i class="fa fa-cog fa-2x"> </i>
            </a>
            <ul class="dropdown-menu">
                <li class="header-title"> Menu de Ajustes e Acessibilidade</li>
                <li class="adjustments-line">
                    <a href="javascript:void(0)" class="switch-trigger background-color">
                        <div class="badge-colors text-center">
                            <span class="badge filter badge-primary active" data-color="primary"></span>
                            <span class="badge filter badge-info" style="background-color: var(--indigo);" data-color="indigo"></span>
                            <span class="badge filter badge-success" data-color="green"></span>
                        </div>
                        <div class="clearfix"></div>
                    </a>
                </li>
                <li class="adjustments-line text-center color-change">
                    <span class="color-label">TEMA CLARO</span>
                    <span class="badge light-badge mr-2"></span>
                    <span class="badge dark-badge ml-2"></span>
                    <span class="color-label">TEMA ESCURO</span>
                </li>

                <li class="button-container">
                    <center>

                            <a href="../doc/manual.pdf" download class="btn btn-primary btn-block btn-round"
                            id="btn-center">Manual</a>

                            <a href="#" data-toggle="modal"
                            data-target="#modalLGPD" class="btn btn-primary btn-block btn-round"
                            id="btn-center">LGPD</a>

                        <a href="http://localhost/FLEX/FLEX/index.html"
                            target="_blank" class="btn btn-default btn-block btn-round" id="btn-center">
                            Flex - Suporte T??cnico
                        </a>
                    </center>
                </li>
                <li class="header-title">Acesso R??pido</li>
                <li class="button-container text-center">
                    <a href="http://localhost/SITE/index.html" target="_blank" id="twitter" class="btn btn-round btn-info"><i class="fab fa-digital-ocean"></i> &middot;
                        Site</a>
                    <a href="https://pt-br.facebook.com/Top10Embalagens/" target="_blank" id="facebook" class="btn btn-round btn-info"><i class="fab fa-facebook-f"></i> &middot;
                        Facebook</a>
                    <br>
                    <br>
                </li>
            </ul>
        </div>
    </div>

    @yield('modals')

    <div class="modal fade" id="modalAlertDelete" style="display: none; top: 2.5%;" aria-hidden="true">
        <div class="modal-dialog">
            <form id="formExcluir" method="POST" autocomplete="off" enctype="multipart/form-data" >
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header" style="background-color: red">
                        <h4 class="modal-title">! Alerta de Exclus??o !</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div style="text-align: center;">
                                    <label class="modal-label" style="font-size: 18px; color:red; padding 0px;"> Deseja
                                        realmente excluir esse registro?</label>
                                    <input name="id" id="idDelete" type="hidden" class="input_01">
                                    <input name="form" id="rotaDelete" type="hidden" class="input_01">
                                    <br>
                                    <img src="../img/dash/delete.png"
                                        style="padding 0px; width: 100px; heigth:100px; margin-top:10px;">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                        style="padding 0px; width: 125px; height:50px;">Cancelar</button>
                                    <button type="submit" class="btn btn-secondary alert-danger"
                                        style="background-image:none; background-color: red !important;padding 0px; width: 125px; height:50px;">Excluir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="modalAlertCancelar" style="display: none; top: 50%;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title">! Alerta de Cancelamento !</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div style="text-align: center;">
                                <label class="modal-label danger" style="font-size: 18px; padding 0px;"> Deseja
                                    realmente cancelar esse cadastro?</label>
                                <input name="form" id="formCancelar" type="hidden" class="input_01">
                                <input name="modal" id="modalCancelar" type="hidden" class="input_01">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" onclick="hideModal('modalAlertCancelar');"
                                        style="padding 0px; width: 125px; height:50px;">Voltar</button>
                                    <button type="submit" class="btn btn-secondary bg-danger"
                                        style="background-image:none;padding 0px; width: 125px; height:50px;"
                                        onclick="cancelar();">Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <div class="modal fade" id="modalReturnCadastro" style="display: none; top: 50%;" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #00cca4;">
                        <h4 class="modal-title">Alerta de Cadastro</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div style="text-align: center;">
                                    <label class="modal-label" style="font-size: 18px; padding 0px;"> Deseja continuar cadastrando?</label>
                                    <div class="modal-footer">
                                        <a href="" id="rotaReload" class="btn btn-secondary"
                                            style="background-color: #d7ba11;background-image:none;padding: 16px 40px !important; width: 125px; height:50px; margin-right:10px;vertical-align: middle;color: #fff;">Parar</a>
                                        <button type="submit" class="btn btn-secondary"
                                            style="background-color: #00cca4;background-image:none;padding 0px; width: 125px; height:50px;margin-left:10px;"
                                            onclick="hideModal('modalReturnCadastro');">Pr??ximo</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            <div class="modal fade" id="modalLGPD" style="display: none; top: 10%;" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: var(--orange);">
                            <h4 class="modal-title">LGPD</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <div style="text-align: center;">
                                        <label class="modal-label" style="font-size: 18px; padding 0px;"> Este sistema compactua com a nova Lei Geral de Prote????o de Dados, <br>
                                            garantindo assim a integridade das informa????es <br>aqui armazenadas e seu correto manusei,<br> compartilhamento de dados e seguran??a.<br>
                                        <a href="http://www.planalto.gov.br/ccivil_03/_Ato2015-2018/2018/Lei/L13709.htm" target="__blank" style="color: var(--orange);">Norma Completa +</a></label>
                                        <div class="modal-footer" style="justify-content:center;">
                                            <center><button type="submit" class="btn btn-secondary" data-dismiss="modal"
                                                style="background-color: var(--orange);background-image:none;padding 0px; width: 125px; height:50px;margin-left:10px;">Entendido!</button></center>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalPivo" hidden>
            </div>

        <!--   Core JS Files   -->
        <script src="../js/dash/core/jquery.min.js"></script>
        <script src="../js/dash/core/popper.min.js"></script>
        <script src="../js/dash/core/bootstrap.min.js"></script>
        <script src="../js/dash/plugins/perfect-scrollbar.jquery.min.js"></script>
        <!-- Chart JS -->
        <script src="../js/dash/plugins/chartjs.min.js"></script>
        <!--  Notifications Plugin    -->
        <script src="../js/dash/plugins/bootstrap-notify.js"></script>
        <!-- Control Center for Black Dashboard: parallax effects, scripts for the example pages etc -->
        <script src="../js/dash/black-dashboard.js?v=1.0.0"></script>
        <!-- Black Dashboard DEMO methods, don't include it in your project! -->
        <script src="../demo/demo.js"></script>
        <script src="../demo/edit.js"></script>
        <script src="../js/recarrega.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"
            integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-typeahead/2.11.0/jquery.typeahead.min.js" integrity="sha512-Rc24PGD2NTEGNYG/EMB+jcFpAltU9svgPcG/73l1/5M6is6gu3Vo1uVqyaNWf/sXfKyI0l240iwX9wpm6HE/Tg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
            <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.11.3/b-2.0.1/b-html5-2.0.1/b-print-2.0.1/fh-3.2.0/datatables.min.js"></script>
            <script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.2.0/js/dataTables.fixedHeader.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.1/jquery.maskMoney.min.js"></script>

        <script>

            $('button.cancela').on('click', function() {
                var form = $(this).data('form');
                var modal = $(this).data('modal');
                $('#' + modal).modal('show', {backdrop: false});
                $('#modalAlertCancelar').modal('show', {backdrop: false});
                $('#formCancelar').val(form);
                $('#modalCancelar').val(modal);
            });

            function cancelar() {
                var form2 = $('#formCancelar').val();
                var modal2 = $('#modalCancelar').val();
                $('#' + form2)[0].reset();
                $('.div-feedback').html("");
                $('.is-invalid').removeClass('is-invalid');
                $('#modalAlertCancelar').hide(800);
                $('#' + modal2).delay(500).hide(800);
                $('#modalAlertCancelar').modal('toggle');
                $('#' + modal2).modal('toggle');
                recarrega();

            }



            function abrirModal(modalOpen, De, Para) {
                $(Para).val($(De).val());
                $(modalOpen).modal('show', {backdrop: false});

            }

                $('.red').on('click', function() {
                var id = $(this).data('id');
                var rota2 = $(this).data('rota');
                $('#modalAlertDelete').modal('show', {backdrop: false});
                $('#idDelete').val(id);
                $('#rotaDelete').val(rota2);
                $('#formExcluir').change('action', rota2);
            });

            $('.red-min').on('click', function() {
                var id = $(this).data('id');
                var rota3 = $(this).data('rota');
                $('#modalAlertDelete').modal('show', {backdrop: false});
                $('#idDelete').val(id);
                $('#rotaDelete').val(rota3);
                $('#formExcluir').change('action', rota3);
            });

            function excluir(id3, rota3){
                $('#modalAlertDelete').modal('show');
                $('#idDelete').val(id3);
                $('#rotaDelete').val(rota3);
                $('#formExcluir').attr('action', rota3);
            }

           function hideModal(modal) {
                $('#' + modal).modal('hide');
            }

        </script>

        <script>
            $(document).ready(function() {

                    $('.dinheiro').maskMoney({
                    prefix:'R$ ',
                    allowNegative: true,
                    thousands:'.', decimal:',',
                    affixesStay: true, reverse: true});

                $('.porcentagem').mask('#0%');

           //     $('.dinheiro').mask('#0.00', {
           //         reverse: true
           //     });

                $('.cpf').mask('000.000.000-00');
                $('.cnpj').mask('00.000.000/0000-00');
                $('.rg').mask('00.000.000-0');
                $('.cep').mask('00000-000');
                $('.telefone').mask('(00) 0000-0000');
                $('.celular').mask('(00) 00000-0000');
                $('.dimensao').mask('000 x 000 x 000');
                $('.cep').mask('00000-000');
            });

        </script>
        <script>
            $(document).ready(function() {
                $().ready(function() {
                    $sidebar = $('.sidebar');
                    $navbar = $('.navbar');
                    $main_panel = $('.main-panel');

                    $full_page = $('.full-page');

                    $sidebar_responsive = $('body > .navbar-collapse');
                    sidebar_mini_active = true;
                    white_color = false;

                    window_width = $(window).width();

                    fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();


                    $('.fixed-plugin a').click(function(event) {
                        if ($(this).hasClass('switch-trigger')) {
                            if (event.stopPropagation) {
                                event.stopPropagation();
                            } else if (window.event) {
                                window.event.cancelBubble = true;
                            }
                        }
                    });

                    $('.fixed-plugin .background-color span').click(function() {
                        $(this).siblings().removeClass('active');
                        $(this).addClass('active');

                        var new_color = $(this).data('color');

                        if ($sidebar.length != 0) {
                            $sidebar.attr('data', new_color);
                        }

                        if ($main_panel.length != 0) {
                            $main_panel.attr('data', new_color);
                        }

                        if ($full_page.length != 0) {
                            $full_page.attr('filter-color', new_color);
                        }

                        if ($sidebar_responsive.length != 0) {
                            $sidebar_responsive.attr('data', new_color);
                        }
                    });

                    $('.switch-sidebar-mini input').on("switchChange.bootstrapSwitch", function() {
                        var $btn = $(this);

                        if (sidebar_mini_active == true) {
                            $('body').removeClass('sidebar-mini');
                            sidebar_mini_active = false;
                            blackDashboard.showSidebarMessage('Sidebar mini deactivated...');
                        } else {
                            $('body').addClass('sidebar-mini');
                            sidebar_mini_active = true;
                            blackDashboard.showSidebarMessage('Sidebar mini activated...');
                        }

                        // we simulate the window Resize so the charts will get updated in realtime.
                        var simulateWindowResize = setInterval(function() {
                            window.dispatchEvent(new Event('resize'));
                        }, 180);

                        // we stop the simulation of Window Resize after the animations are completed
                        setTimeout(function() {
                            clearInterval(simulateWindowResize);
                        }, 1000);
                    });

                    $('.switch-change-color input').on("switchChange.bootstrapSwitch", function() {
                        var $btn = $(this);

                        if (white_color == true) {

                            $('body').addClass('change-background');
                            setTimeout(function() {
                                $('body').removeClass('change-background');
                                $('body').removeClass('white-content');
                            }, 900);
                            white_color = false;
                        } else {

                            $('body').addClass('change-background');
                            setTimeout(function() {
                                $('body').removeClass('change-background');
                                $('body').addClass('white-content');
                            }, 900);

                            white_color = true;
                        }


                    });

                    $('.light-badge').click(function() {
                        $('body').addClass('white-content');
                    });

                    $('.dark-badge').click(function() {
                        $('body').removeClass('white-content');
                    });
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                // Javascript method's body can be found in assets/js/demos.js
                demo.initDashboardPageCharts();
            });
            $(event).ready(function() {
                $("div.voltar").fadeIn(500);
            });
        </script>

        <script type="text/javascript">
            function mascara(t, mask) {

                var i = t.value.length;
                var saida = mask.substring(1, 0);
                var texto = mask.substring(i)

                if (texto.substring(0, 1) != saida) {
                    t.value += texto.substring(0, 1);
                }
            }
        </script>

        <script type="text/javascript">

                    $('#imgsub').click(function() {
                        if (document.getElementById('imgsub').src == "http://localhost:8000/img/dash/add_open.png") {
                    document.getElementById('imgsub').src = "../img/dash/addbtn.png";
                } else {
                    document.getElementById('imgsub').src = "../img/dash/add_open.png";
                }
                    });

                $(document).on('click', '[data-dismiss="modal"]',
                    function() {
                        document.getElementById('imgsub').src = "../img/dash/addbtn.png";

                    }
               );

               $("#modalAlertDelete").on("hidden.bs.modal", function() {
                    $("body").addClass("modal-open");
                });
                $("#modalAlertCancelar").on("hidden.bs.modal", function() {
                    $("body").addClass("modal-open");
                });
                $("#modalReturnCadastro").on("hidden.bs.modal", function() {
                    $("body").addClass("modal-open");
                });

            function pegaCodigo(campoItem, campoOrigem) {
                document.getElementById(campoItem).value = document.getElementById(campoOrigem).value();
            }

            function volta() {
                document.getElementById('imgsub').src = "../img/dash/add_btn.png";
            }
        </script>



<script>
    window.TrackJS &&
        TrackJS.install({
            token: "ee6fab19c5a04ac1a32a645abde4613a",
            application: "black-dashboard-free"
        });
</script>

        @stack('ajax')
        <script>
            $('#modalReturnCadastro').on('show', function() {
                $('#rotaReload').attr('href', rota_reload);
            });
        </script>

</body>

</html>
