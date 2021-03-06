<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../img/dash/apple-icon.png">
    <link rel="icon" type="icon" href="../img/dash/sacola.png">
    <title>
      Enviar Email - TopSystem
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!-- Nucleo Icons -->
    <link href="../css/nucleo-icons.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link href="../css/black-dashboard.css?v=1.0.0" rel="stylesheet" />
    <link href="../css/login.css" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../demo/demo.css" rel="stylesheet" />
  </head>

<div class="content">
    <div class="row" id="row-reset">
        <button type="submit" class="btn btn-primary" id="reset-login">
            {{ __('Voltar para o Login') }}
        </button>

        <div id="reset">
            <div class="card">
                <div class="card-header">{{ __('Mudança de Senha') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Endereço de E-mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Enviar Link para o E-mail') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary" id="reset-site">
            {{ __('Voltar as Compras') }}
        </button>
    </div>
</div>

<script src="js/dash/core/jquery.min.js"></script>
<script src="js/dash/core/popper.min.js"></script>
<script src="js/dash/core/bootstrap.min.js"></script>
<script src="js/dash/plugins/perfect-scrollbar.jquery.min.js"></script>
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
