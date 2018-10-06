@extends('layouts.Encuesta')

@section('content')

	@if(count($encuesta->preguntas) >0)
		<section id="seccionPreguntas">
			<div class="content">
				<div id="myCarousel" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						@foreach($encuesta->preguntas as $PreguntasFormulario)
							@if($loop->index == 0)
								<li data-target="#myCarousel" data-slide-to="{{$loop->index}}" class="active"></li>
							@else
								<li data-target="#myCarousel" data-slide-to="{{$loop->index}}"></li>
							@endif
						@endforeach
					</ol>

						<div class="carousel-inner" >
						@foreach($encuesta->preguntas as $PreguntasFormulario)

								@if($loop->index == 0)
									<div class="item active">
										@else
											<div class="item">
												@endif
								<div class="row">
									<div class="col-12-medium">
										<fieldset name="RespuestasUsuario">
											<div style="font-weight: 700; color: #ffffff; background: #e86e48; padding: 1%; border-radius: 50px;" name ="id_pregunta" value = "{{ $PreguntasFormulario->id }}"> ¿ {{ $PreguntasFormulario->Enunciado }} ?
											</div>
											@foreach($PreguntasFormulario->Respuestas as $respuestas)
												<div class="col-sm-2 col-sm-offset-1" >

													<label><input data-num="{{$respuestas->Puntaje}}" type="radio" onclick="guardarRespuestaUsuario(this,{{$respuestas->id}})" id="Respuesta_id" name="Respuesta_id[{{$loop->parent->index}}]" data-toggle="modal" data-target="#modalExplicacionRespuesta{{$respuestas->id}}">
														<b>{{$respuestas->Descripcion}}
															@if($loop->index == 0)
																<div class="image-container">
																	<img class="plumas" style="width: 30%; display:block; margin:auto;" src="{{ asset('images/verde.png') }}"></img>
																	<div class="after"><img class="media-object" style="width:100%; display:block; margin:auto;" src="{{ asset('images/gato-feliz.gif') }}"></img></div>
																</div>
															@else
																@if($loop->index == 1)
																	<div class="image-container">
																		<img class="plumas" style="width: 30%; display:block; margin:auto;" src="{{ asset('images/naranja.png') }}"></img>
																		<div class="after"><img class="media-object" style="width:100%; display:block; margin:auto;" src="{{ asset('images/gato-feliz.gif') }}"></img></div>
																	</div>
																@else
																	@if($loop->index == 2)
																		<div class="image-container">
																			<img class="plumas" style="width: 30%; display:block; margin:auto;" src="{{ asset('images/amarilla.png') }}"></img>
																			<div class="after"><img class="media-object" style="width:100%; display:block; margin:auto;" src="{{ asset('images/gato-feliz.gif') }}"></img></div>
																		</div>
																	@else
																		@if($loop->index == 3)
																			<div class="image-container">
																				<img class="plumas" style="width: 30%; display:block; margin:auto;" src="{{ asset('images/morada.png') }}"></img>
																				<div class="after"><img class="media-object" style="width:100%; display:block; margin:auto;" src="{{ asset('images/gato-feliz.gif') }}"></img></div>
																			</div>
																		@else
																			@if($loop->index == 4)
																				<div class="image-container">
																					<img class="plumas" style="width: 30%; display:block; margin:auto;" src="{{ asset('images/azul.png') }}"></img>
																					<div class="after"><img class="media-object" style="width:100%; display:block; margin:auto;" src="{{ asset('images/gato-feliz.gif') }}"></img></div>
																				</div>
																			@else
																				<div class="image-container">
																					<img class="plumas" style="width: 30%; display:block; margin:auto;" src="{{ asset('images/verde.png') }}"></img>
																					<div class="after"><img class="media-object" style="width:100%; display:block; margin:auto;" src="{{ asset('images/gato-feliz.gif') }}"></img></div>
																				</div>
																			@endif
																		@endif
																	@endif
																@endif
															@endif
														</b>
													</label>
													<!-- Modal confirmación elimminar respuesta-->
													@if($respuestas->Puntaje >= 0)
														<div id="modalExplicacionRespuesta{{$respuestas->id}}" name="modalExplicacionRespuesta" class="modal fade" role="dialog">
															<div class="modal-dialog">
																<!-- Modal content-->
																<div class="modal-content">
																	<div class="row">
																		<div class="row">
																			<div class="col-md-6">
																				<div class="modal-header">
																					<img class="swing" style="display:block; margin:auto; width: 40%; left: 25%; top: -20px; position: absolute;" src="{{ asset('images/sombrero.png') }}"></img>
																					<img class="media-object" style="width:100%; display:block; margin:auto;" src="{{ asset('images/gato-feliz.gif') }}"></img>
																					<img class="ball" style="display:block; margin:auto;" src="{{ asset('images/pelota.png') }}"></img>
																				</div>
																			</div>
																			<div class="col-md-6">
																				<div class="modal-body" style="text-align:center; color:black">
																					<div style="font-size: 12px; color: #000; font-family: sans-serif; text-align: justify;" class="row">
																						{{ $PreguntasFormulario->Explicacion }}
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="col-md-12">
																			<div class="modal-footer">
																				<button style="display:block; margin:auto;" type="button" class="btn btn-primary" data-dismiss="modal">ACEPTAR</button>
																			</div>
																		</div>

																	</div>
																</div>
															</div>
														</div>
													@else
														<div id="modalExplicacionRespuesta{{$respuestas->id}}" name="modalExplicacionRespuesta" class="modal fade" role="dialog">
															<div class="modal-dialog">
																<!-- Modal content-->
																<div class="modal-content">
																	<div class="row">
																		<div class="row">
																			<div class="col-md-6">
																				<div class="modal-header">
																					<img class="shake-slow shake-constant shake-constant--hover" style="position:absolute; left:20%; top:15%; width:50%; display:block; margin:auto;" src="{{ asset('images/gafas.png') }}"></img>
																					<img class="media-object" style="width:100%; display:block; margin:auto;" src="{{ asset('images/gato-triste.gif') }}"></img>
																				</div>
																			</div>
																			<div class="col-md-6">
																				<div class="modal-body" style="text-align:center; color:black">
																					<div style="font-size: 12px; color: #000; font-family: sans-serif; text-align: justify;" class="row">
																						{{ $PreguntasFormulario->Explicacion }}
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="col-md-12">
																			<div class="modal-footer">
																				<button style="display:block; margin:auto;" type="button" class="btn btn-primary" data-dismiss="modal">ACEPTAR</button>
																			</div>
																		</div>

																	</div>
																</div>
															</div>
														</div>
												@endif
												<!-- Modal confirmación elimminar respuesta-->
												</div>
											@endforeach
											<label id="respuestaSinResponder" name="respuestaSinResponder"></label>
										<!--<img class="media-object" style="position: relative; padding-top: 15%; width:20%; display:block; margin:auto;" src="{{ asset('images/ojos.gif') }}"></img>-->
											<!--<div style="border-bottom: 5px solid #e86e48; width: 40%; display: block; margin: auto;"></div>-->
										</fieldset>
									</div>
								</div>
											</div>

						@endforeach
						</div>

									<a class="left carousel-control" href="#myCarousel" data-slide="prev">
										<span class="glyphicon glyphicon-chevron-left"></span>
										<span class="sr-only">Previous</span>
									</a>
									<a class="right carousel-control" href="#myCarousel" data-slide="next">
										<span class="glyphicon glyphicon-chevron-right"></span>
										<span class="sr-only">Next</span>
									</a>
				</div>
			</div>
		</section>
	@endif
	<div class="row">
		<div class="col-md-12">
			<button  onclick="validarRespuetas()" class="btn btn-primary">
				Finalizar
			</button>
		</div>
	</div>

@endsection
