@extends('layouts.Encuesta')

@section('content')

	@if(count($encuesta->preguntas) >0)
		<section id="seccionPreguntas">
			<div class="content">

				<ul>
					@foreach($encuesta->preguntas as $PreguntasFormulario)
						<li>
							<div class="row">
								<div class="col-12-medium">
									<fieldset name="RespuestasUsuario">
										<div style="font-weight: 700; color: #ffffff; background: #e86e48; padding: 5%; border-radius: 50px;" name ="id_pregunta" value = "{{ $PreguntasFormulario->id }}"> ¿ {{ $PreguntasFormulario->Enunciado }} ?
										</div>
										@foreach($PreguntasFormulario->Respuestas as $respuestas)
											<div class="col-sm-2 col-sm-offset-1" >

												<label><input type="radio" onclick="guardarRespuestaUsuario(this,{{$respuestas->id}})" id="Respuesta_id" name="Respuesta_id[{{$loop->parent->index}}]" data-toggle="modal" data-target="#modalExplicacionRespuesta{{$respuestas->id}}">
													<b>{{$respuestas->Descripcion}}</b>
													@if($loop->index == 0)
														<img class="plumas" style="width: 40%; display:block; margin:auto;" src="{{ asset('images/morada.png') }}">amarillo</img>
													@else
														@if($loop->index == 1)
															<img class="plumas" style="width: 40%; display:block; margin:auto;" src="{{ asset('images/morada.png') }}">azul</img>
														@else
															@if($loop->index == 2)
																<img class="plumas" style="width: 40%; display:block; margin:auto;" src="{{ asset('images/morada.png') }}">rojo</img>
															@else
																@if($loop->index == 3)
																	<img class="plumas" style="width: 40%; display:block; margin:auto;" src="{{ asset('images/morada.png') }}">naranja</img>
																@else
																	@if($loop->index == 4)
																		<img class="plumas" style="width: 40%; display:block; margin:auto;" src="{{ asset('images/morada.png') }}">verde</img>
																	@else
																		<img class="plumas" style="width: 40%; display:block; margin:auto;" src="{{ asset('images/morada.png') }}">cafe</img>
																	@endif
																@endif
															@endif
														@endif
													@endif
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
																				<img class="media-object" style="width:100%; display:block; margin:auto;" src="{{ asset('images/gato-feliz.gif') }}"></img>
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
										<img class="media-object" style="width:20%; display:block; margin:auto;" src="{{ asset('images/ojos.gif') }}"></img>
										<div style="border-bottom: 5px solid #e86e48; width: 40%; display: block; margin: auto;"></div>
									</fieldset>
								</div>
							</div>
						</li>
					@endforeach
				</ul>

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
