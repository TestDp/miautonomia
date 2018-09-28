<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Confirma tu cuenta</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="{{ asset('css/main.css') }}" />

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a class="button primary" href="{{ route('login') }}">Inicio de Sesión</a>
                <a class="button primary" href="{{ route('register') }}">Registro</a>
            @endauth
        </div>
    @endif

    <div style="padding: 10%; background-size: cover; background-image: url('{{ asset('images/pic02.jpg') }}');"  class="py-4">
      @if($respuesta == 'true')
            <h2 style="font-weight:700; text-align: center; color:#000;">Muchas gracias por registrarse, se ha enviado un correo electrónico para verificación de la cuenta </h2>
        @else
            @if($respuesta =='sinPago')
                <h3 style="font-weight:700; text-align: center; color:#000;">No se ha realizado el pago de la suscripción</h3>
            @else
                <h3 style="font-weight:700; text-align: center; color:#000;">No se ha verificado la cuenta, por favor verifcar su cuenta </h3>
            @endif
        @endif
    </div>
</div>
</body>
</html>
