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

	
		<link rel="stylesheet" href="{{ asset('css/mainEncuesta.css') }}" />
		<noscript><link rel="stylesheet" href="{{ asset('css/noscript.css') }}" /></noscript>


</head>
<body class="is-preload landing">
<div id="page-wrapper">


<!--left-fixed -navigation-->
    <!-- header-starts -->
    <header id="header">
        <a href="{{ url('/') }}"><h1 id="logo"><img class="image" src="{{ asset('images/Logo.png') }}"></img></h1></a>
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


					<!-- Footer -->
				<footer id="footer">
					<ul class="copyright">
						<li>Desarrollado por <a href="https://dpsoluciones.co">DPSoluciones</a></li>
					</ul>
				</footer>
				
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

</body>
</html>
