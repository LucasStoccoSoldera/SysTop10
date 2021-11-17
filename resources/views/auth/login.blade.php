<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="76x76" href="img/dash/user.png">
    <link rel="icon" type="image/png" href="img/dash/user.png">
    <title>
      Login Top10
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!-- Nucleo Icons -->
    <link href="css/nucleo-icons.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link href="../css/black-dashboard.css" rel="stylesheet" />
    <link href="css/login.css" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="demo/demo.css" rel="stylesheet" />

     <script src="js/dash/core/jquery.min.js"></script>
    <script src="js/dash/core/popper.min.js"></script>
    <script src="js/dash/core/bootstrap.min.js"></script>
    <script src="js/dash/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!-- Chart JS -->
    <script src="js/dash/plugins/chartjs.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="js/dash/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Black Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="js/dash/black-dashboard.js?v=1.0.0"></script>
    <!-- Black Dashboard DEMO methods, don't include it in your project! -->
    <script src="demo/demo.js"></script>
    <script src="demo/edit.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"
        integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  </head>

<div class="geral">

    <div class="junto">
        <a href="{{ route('welcome') }}">
        <img src="img/dash/voltar_azul.png" alt="" style="float: left;margin-top:50px;margin-left: 4%;margin-right: 5%; width:7%;height:7%;" class="voltar">
    </a>
        <div class="row" id="login">
            <div class="card" id="tamanho-total"style="height: 105%; margin-bottom: 25px;">
                <div class="card-header"><h2><strong>{{ __('Entrar em sua conta') }}</strong></h2></div>
                <div class="card-body">

                @if($errors->all())
                    @foreach ($errors->all() as $error)
                       <div class="alert alert-danger problema"  role="alert">
                        {{$error}}
                      </div>
                  @endforeach
                @endif
                <form method="POST" action="{{  route('admin.login.do')  }}">
                    @csrf
                    <div class="form-group row">
                        <label for="usuario" class="campos">{{ __('E-Mail') }}</label>

                        <div class="input">
                            <input id="usuario" type="email" class="form-control form-control-filtro input-full @error('usuario') is-invalid @enderror" name="usuario" value="{{ old('usuario') }}" autocomplete="usuario" autofocus placeholder="Entre com o e-mail">

                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="campos">{{ __('Senha') }}</label>

                        <div class="input">
                            <input id="password" type="password" class="form-control form-control-filtro input-full @error('password') is-invalid @enderror" name="password" autocomplete="current-password" placeholder="Entre com a Senha">
                        </div>
                    </div>

                    {{--

                            @if (Route::has('password.request'))
                                <a class="btn btn-link" id="link" href="{{ route('password.request') }}">
                                    {{ __('Esqueceu seu senha?') }}
                                </a>
                            @endif
                            --}}

                            <button type="submit" class="btn btn-primary btn-login">
                                {{ __('Entrar') }}
                            </button>
                </form>


                </div>

                <img src="img/login_prop.png" style="margin-top: 100px">
            </div>
        </div>
        <div class="barra-vertical" style="height: 1100px; margin-bottom: 25px;">
        </div>
    <div class="row" id="register">
            <div class="card" id="tamanho-total" style="height: 1100px; margin-bottom: 25px;">
                <div class="card-header"><h2>{{ __('Ainda não tem uma conta?') }}<strong class="strong">{{ __('Crie uma aqui mesmo!') }}</strong></h2>
                </div>
                <div class="card-body">
                    <form name="formRegisterClienteLogin" id="formRegisterClienteLogin" method="POST" action="{{ route('admin.create.cliente.login') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="nomeCliente" class="campos" id="quebra">{{ __('Nome Completo') }}</label>

                            <div class="input">
                                <input id="nomeCliente" type="text" class="form-control form-control-filtro input-full @error('nomeCliente') is-invalid @enderror" name="nomeCliente" value="{{ old('nomeCliente') }}" autocomplete="nomeCliente" autofocus placeholder="Entre com o Nome">

                                <span class="invalid-feedback feedback nomeCliente_error" role="alert">
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="usuarioCliente" class="campos">{{ __('E-Mail') }}</label>

                            <div class="input">
                                <input id="usuarioCliente" type="email" class="form-control form-control-filtro input-full @error('usuarioCliente') is-invalid @enderror" name="usuarioCliente" value="{{ old('usuarioCliente') }}" placeholder="Entre com o E-mail">

                                <span class="invalid-feedback feedback usuarioCliente_error" role="alert">
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dtNascCliente" class="campos">{{ __('Dt. Nascimento') }}</label>

                            <div class="input">
                                <input id="dtNascCliente" type="email" class="form-control form-control-filtro input-full @error('dtNascCliente') is-invalid @enderror" name="dtNascCliente" value="{{ old('dtNascCliente') }}" placeholder="Entre com a Dt. Nascimento">

                                <span class="invalid-feedback feedback dtNascCliente_error" role="alert">
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="senhaCliente" class="campos">{{ __('Senha') }}</label>

                            <div class="input">
                                <input id="senhaCliente" type="password" class="form-control form-control-filtro input-full @error('senhaCliente') is-invalid @enderror" name="senhaCliente" placeholder="Entre com a Senha">

                                <span class="invalid-feedback feedback senhaCliente_error" role="alert">
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="campos" id="quebra">{{ __('Confirme sua senha') }}</label>
                            <div class="input">
                                <input id="senhaCliente_confirmation" type="password" class="form-control form-control-filtro input-full @error('senhaCliente') is-invalid @enderror" name="senhaCliente_confirmation" placeholder="Confirme a Senha">
                                <span class="invalid-feedback feedback senhaCliente_error" role="alert">
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cpfCliente" class="campos" id="quebra">{{ __('CPF') }}</label>

                            <div class="input">
                                <input id="cpfCliente" type="text" class="cpf form-control form-control-filtro input-full @error('cpfCliente') is-invalid @enderror" name="cpfCliente" value="{{ old('cpfCliente') }}" placeholder="Entre com o CPF">

                                <span class="invalid-feedback feedback cpfCliente_error" role="alert">
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cnpjCliente" class="campos" id="quebra">{{ __('CNPJ') }}</label>

                            <div class="input">
                                <input id="cnpjCliente" type="text" class="cnpj form-control form-control-filtro input-full @error('cnpjCliente') is-invalid @enderror" name="cnpjCliente" value="{{ old('cnpjCliente') }}" placeholder="Entre com o CNPJ">

                                <span class="invalid-feedback feedback cnpjCliente_error" role="alert">
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="telefoneCliente" class="campos" id="quebra">{{ __('Telefone') }}</label>

                            <div class="input">
                                <input id="telefoneCliente" type="text" class="telefone form-control form-control-filtro input-full @error('telefoneCliente') is-invalid @enderror" name="telefoneCliente" value="{{ old('telefoneCliente') }}" placeholder="Entre com o Telefone">

                                <span class="invalid-feedback feedback telefoneCliente_error" role="alert">
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="celularCliente" class="campos" id="quebra">{{ __('Celular') }}</label>

                            <div class="input">
                                <input id="celularCliente" type="text" class="celular form-control form-control-filtro input-full @error('celularCliente') is-invalid @enderror" name="celularCliente" value="{{ old('celularCliente') }}" placeholder="Entre com o Celular">

                                <span class="invalid-feedback feedback celularCliente_error" role="alert">
                                </span>
                            </div>
                        </div>
                                <button type="submit" class="btn btn-primary btn-login">
                                    {{ __('Criar Conta!') }}
                                </button>
                    </form>
                </div>
            </div>
          </div>
        </div>

</div>



<script>

$(document).ready(function(){

    $(event).ready(function(){  // A DIFERENÇA ESTA AQUI, EXECUTA QUANDO O DOCUMENTO ESTA "PRONTO"
    $( "div.problema" ).fadeIn( 300 ).delay( 6000 ).fadeOut( 1200 );
    });


                $('.cpf').mask('000.000.000-00');
                $('.cnpj').mask('00.000.000/0000-00');
                $('.telefone').mask('(00) 0000-0000');
                $('.celular').mask('(00) 00000-0000');

    $("#formRegisterClienteLogin").on('submit', function(e) {
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
                        $('#formRegisterClienteLogin')[0].reset();
                            window.location.href = "http://localhost/SITE/index.html";
                    }
                    if (data_decoded.status == 0) {

                        $.each(data_decoded.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                            $('#' + prefix).focus();
                            $('#' + prefix).addClass('is-invalid');
                            $('#' + prefix + '_confirmation').addClass(
                                'is-invalid');
                        });
                        $.each(data_decoded.error_cpf_cnpj, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                            $('#' + prefix).focus();
                            $('#' + prefix).addClass('is-invalid');
                        });
                        $.each(data_decoded.error_telefone_celular, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                            $('#' + prefix).focus();
                            $('#' + prefix).addClass('is-invalid');
                        });
                    }
                }
            });
        });
});

</script>

