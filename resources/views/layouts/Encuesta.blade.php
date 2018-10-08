<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Miautonomía | Corporación Mujeres que crean</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
	
	<!-- To include only some csshake animations use this syntax -->
<link rel="stylesheet" type="text/css" href="csshake-slow.min.css">
<!-- or from surge.sh -->
<link rel="stylesheet" type="text/css" href="http://csshake.surge.sh/csshake-slow.min.css">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('css/bootstrap.css') }}" rel='stylesheet' type='text/css'/>
    <!-- Custom CSS -->
    <link href="{{ asset('css/style.css') }}" rel='stylesheet' type='text/css'/>
    <!-- font CSS -->
    <!-- font-awesome icons -->
    <link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet">
    <!-- //font-awesome icons -->
    <!-- js-->
    <script src="{{ asset('js/jquery-1.11.1.min.js') }}"></script>

    <script src="{{ asset('js/modernizr.custom.js') }}"></script>
    <!--webfonts-->
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic'
          rel='stylesheet' type='text/css'>
    <!--//webfonts-->
    <!--animate-->
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet" type="text/css" media="all">
    <script src="{{ asset('js/wow.min.js') }}"></script>
    <!-- Metis Menu -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <!-- sweet plugins-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <link rel="stylesheet" href="{{ asset('css/mainEncuesta.css') }}" />
    <noscript><link rel="stylesheet" href="{{ asset('css/noscript.css') }}" /></noscript>


</head>
<body class="is-preload landing">
<div style="background-size: cover; background-image: url('{{ asset('images/fondo-preguntas.png') }}');" id="page-wrapper">
<audio src="{{ asset('images/sonido.mp3') }}" autoplay loop></audio>


    <!--left-fixed -navigation-->
    <!-- header-starts -->
    <header id="header">
        <a href="{{ url('/encuestas') }}"><h1 id="logo"><img class="image" src="{{ asset('images/Logo.png') }}"></img></h1></a>
        <nav id="nav">
            <ul>
                <li class="dropdown profile_details_drop">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <div class="profile_img">
                            <div class="user-name">
                                <p>Hola {{ Auth::user()->name }} </p>
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
        </nav>
    </header>


    <div>
        @yield('content')
    </div>


</div>


<!-- Classie -->
<script src="{{ asset('js/classie.js') }}"></script>
<script>
    var menuLeft = document.getElementById('cbp-spmenu-s1'),
        showLeftPush = document.getElementById('showLeftPush'),
        body = document.body;




    function disableOther(button) {
        if (button !== 'showLeftPush') {
            classie.toggle(showLeftPush, 'disabled');
        }
    }
</script>
<!--scrolling js-->
<script src="{{ asset('js/jquery.nicescroll.js') }}"></script>
<script src="{{ asset('js/scripts.js') }}"></script>
<!--//scrolling js-->
<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('js/bootstrap.js') }}"></script>

<script src="{{ asset('js/jquery.min.js') }}"""></script>
<script src="{{ asset('js/jquery.scrolly.min.js') }}"></script>
<script src="{{ asset('js/jquery.dropotron.min.js') }}"></script>
<script src="{{ asset('js/jquery.scrollex.min.js') }}"></script>
<script src="{{ asset('js/browser.min.js') }}"></script>
<script src="{{ asset('js/breakpoints.min.js') }}"></script>
<script src="{{ asset('js/util.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<!-- js de la apliacion-->
<script src="{{ asset('js/Transversal/generales.js') }}"></script>
<script src="{{ asset('js/MAutonomia/Encuesta.js') }}"></script>

</body>
</html>
