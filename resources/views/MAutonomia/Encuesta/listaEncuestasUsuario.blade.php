@extends('layouts.principalEncuesta')

@section('content')
	<div class="body">
		<section id="one" class="spotlight style1 bottom">
			<div class="content">
				<div class="container">
					<div class="row">
						<div class="col-4 col-12-medium">
							<header>
								<span class="image"><img style="width: 100%;" src="images/arbol-left.png" alt="" /></span>
							</header>
						</div>
						<div class="col-4 col-12-medium">
							@if(sizeof($encuestas) > 0)
								@foreach($encuestas as $encuesta)
									<div style="margin-top:2%; margin-bottom:2%; text-align: center; color: #8d562f; font-weight: 700;" class="widget-shadow">
										<div style="background-size: cover; background-image: url('{{ asset('images/pic02.jpg') }}');" class="login-body">
											<img class="media-object" style="width:100%;" src="{{ asset('images/hojas-amarillas.png') }}"></img>
											<fieldset>
												{{ $encuesta->NombreEncuesta }}</br>
												<a class="button primary" href="{{url('FormularioEncuesta', ['idEncuesta' => $encuesta->id ])}}">PARTICIPA AHORA - CLICK AQUÍ</a>
											</fieldset>

										</div>
									</div>
								@endforeach
							@else
								¡No hay encuestas para responder<!doctype html>
								<html lang="en">
								<head>
									<meta charset="UTF-8">
									<meta name="viewport"
										  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
									<meta http-equiv="X-UA-Compatible" content="ie=edge">
									<title>Document</title>
								</head>
								<body>

								</body>
								</html>
							@endif
						</div>
						<div class="col-4 col-12-medium">
							<span class="image"><img style="width: 100%;" src="images/arbol-right.png" alt="" /></span>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
@endsection
