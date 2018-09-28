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
									<div class="widget-shadow">
										<div style="background-size: cover; background-image: url('{{ asset('images/pic02.jpg') }}');" class="login-body">
										<img class="media-object" src="{{ asset('images/hojas-amarillas.png') }}"></img>
											@foreach($encuestas as $encuesta)
												<fieldset>
													<a href="{{url('FormularioEncuesta', ['idEncuesta' => $encuesta->id ])}}">{{ $encuesta->NombreEncuesta }}</a>
												</fieldset>
											@endforeach
										</div>
									</div>	
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
