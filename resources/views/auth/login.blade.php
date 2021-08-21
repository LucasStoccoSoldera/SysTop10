<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
    <link href="css/black-dashboard.css?v=1.0.0" rel="stylesheet" />
    <link href="css/login.css" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="demo/demo.css" rel="stylesheet" />
  </head>

<div class="geral">
    <a href="{{route('welcome')}}"><img class="voltar_login" src="../img/dash/back_login.png"></a>
    <div class="junto">
        <div class="row" id="login">
            <div class="card" id="tamanho-total">
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
                            <input id="usuario" type="email" class="form-control-filtro @error('usuario') is-invalid @enderror" name="usuario" value="{{ old('usuario') }}" autocomplete="usuario" autofocus>

                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="campos">{{ __('Senha') }}</label>

                        <div class="input">
                            <input id="password" type="password" class="form-control-filtro @error('password') is-invalid @enderror" name="password" autocomplete="current-password">
                        </div>
                    </div>

                            @if (Route::has('password.request'))
                                <a class="btn btn-link" id="link" href="{{ route('password.request') }}">
                                    {{ __('Esqueceu seu senha?') }}
                                </a>
                            @endif

                            <button type="submit" class="btn btn-primary" id="btn-login">
                                {{ __('Entrar') }}
                            </button>
                </form>


                </div>
            </div>
        </div>
        <div class="barra-vertical">
        </div>
    <div class="row" id="register">
            <div class="card" id="tamanho-total">
                <div class="card-header"><h2>{{ __('Ainda não tem uma conta?') }}<strong class="strong">{{ __('Crie uma aqui mesmo!') }}</strong></h2>
                </div>
                <div class="card-body">
                    <form name="formRegisterCliente" method="POST" action="{{ route('admin.create.cliente') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="nomeCliente" class="campos" id="quebra">{{ __('Nome Completo') }}</label>

                            <div class="input">
                                <input id="nomeCliente" type="text" class="form-control-filtro @error('nomeCliente') is-invalid @enderror" name="nomeCliente" value="{{ old('nomeCliente') }}" autocomplete="nomeCliente" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="usuarioCliente" class="campos">{{ __('E-Mail') }}</label>

                            <div class="input">
                                <input id="usuarioCliente" type="email" class="form-control-filtro @error('usuarioCliente') is-invalid @enderror" name="usuarioCliente" value="{{ old('usuarioCliente') }}">

                                <span class="invalid-feedback usuarioCliente_error" role="alert">
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="senhaCliente" class="campos">{{ __('Senha') }}</label>

                            <div class="input">
                                <input id="senhaCliente" type="password" class="form-control-filtro @error('senhaCliente') is-invalid @enderror" name="senhaCliente">

                                <span class="invalid-feedback senhaCliente_error" role="alert">
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="campos" id="quebra">{{ __('Confirme sua senha') }}</label>
                            <div class="input">
                                <input id="senhaCliente_confirmation" type="password" class="form-control-filtro  @error('senhaCliente') is-invalid @enderror" name="senhaCliente_confirmation">
                                <span class="invalid-feedback senhaCliente_error" role="alert">
                                </span>
                            </div>  
                        </div>

                        <div class="form-group row">
                            <label for="cpf" class="campos" id="quebra">{{ __('CPF') }}</label>

                            <div class="input">
                                <input id="cpf" type="text" class="cpf form-control-filtro @error('cpf') is-invalid @enderror" name="cpf" value="{{ old('cpf') }}">

                                <span class="invalid-feedback cpf_error" role="alert">
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="telefone" class="campos" id="quebra">{{ __('Telefone para Contato') }}</label>

                            <div class="input">
                                <input id="telefone" type="text" class="form-control-filtro @error('telefone') is-invalid @enderror" name="telefone" value="{{ old('telefone') }}">
                            </div>
                        </div>
                                <button type="submit" class="btn btn-primary" id="btn-login">
                                    {{ __('Criar Conta!') }}
                                </button>
                    </form>


                </div>
            </div>
          </div>
        </div>
    </div>
<script src="js/dash/core/jquery.min.js"></script>
<script src="js/dash/core/popper.min.js"></script>
<script src="js/dash/core/bootstrap.min.js"></script>
<script src="../js/dash/plugins/perfect-scrollbar.jquery.min.js"></script>
<!--  Google Maps Plugin    -->
<!-- Place this tag in your head or just before your close body tag. -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!-- Chart JS -->
<script src="js/dash/plugins/chartjs.min.js"></script>
<!--  Notifications Plugin    -->
<script src="js/dash/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Black Dashboard: parallax effects, scripts for the example pages etc -->
<script src="js/dash/black-dashboard.min.js?v=1.0.0"></script><!-- Black Dashboard DEMO methods, don't include it in your project! -->
<script src="demo/demo.js"></script>

<script>
    $(event).ready(function(){  // A DIFERENÇA ESTA AQUI, EXECUTA QUANDO O DOCUMENTO ESTA "PRONTO"
    $( "div.problema" ).fadeIn( 300 ).delay( 6000 ).fadeOut( 1200 );
    });

    </script>

    @push('ajax')
    <script>

$(document).ready(function(){

    $("#formRegisterContas").on('submit', function(e){

        e.preventDefault();

        $.ajax({
            headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize(),
            processData:false,
            dataType: 'json',
            beforeSend:function(){
                $(document).find('span.invalid-feedback').text('');

            },
            success:function(data_decoded){
                if(data_decoded.status == 0){
                    $.each(data_decoded.error, function(prefix, val){
                        $('span.' +prefix+ '_error').text(val[0]);
                        $('input#' +prefix).addClass('is-invalid');
                    });
               }
            }
        });
    });
});

</script>
@endpush


