@extends('layouts.Encuesta')

@section('content')

    @if(count($encuesta->preguntas) >0)
        <section>
            <div class="content">
                
					<ul>
                    @foreach($encuesta->preguntas as $PreguntasFormulario)
					<li>
					<div class="row">
								<div class="col-12-medium">
                        <fieldset name="RespuestasUsuario">
                            <div style="font-weight:700; color: #8d562f;" name ="id_pregunta" value = "{{ $PreguntasFormulario->id }}"> ¿ {{ $PreguntasFormulario->Enunciado }} ?
							</div>
							<img class="media-object" style="display:block; margin:auto;" src="{{ asset('images/naranjas.png') }}"></img>
							@foreach($PreguntasFormulario->Respuestas as $respuestas)
                                <div class="col-sm-2 col-sm-offset-1" >
                                    <div class="radio">
                                        <label><input type="radio" onclick="guardarRespuestaUsuario(this,{{$respuestas->id}})" id="Respuesta_id" name="Respuesta_id[{{$loop->parent->index}}]" data-toggle="modal" data-target="#modalExplicacionRespuesta{{$respuestas->id}}">
                                            <b>{{$respuestas->Descripcion}}</b>
                                        </label>
                                    </div>
                                    <!-- Modal confirmación elimminar respuesta-->
                                    @if($respuestas->Puntaje >= 0)
                                        <div id="modalExplicacionRespuesta{{$respuestas->id}}" name="modalExplicacionRespuesta" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Gato Feliz</h4>
                                                    </div>
                                                    <div class="modal-body" style="text-align:center; color:black">
                                                        <div class="row">
                                                            {{ $PreguntasFormulario->Explicacion }}
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">ACEPTAR</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div id="modalExplicacionRespuesta{{$respuestas->id}}" name="modalExplicacionRespuesta" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Gato triste</h4>
                                                    </div>
                                                    <div class="modal-body" style="text-align:center; color:black">
                                                        <div class="row">
                                                            {{ $PreguntasFormulario->Explicacion }}
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">ACEPTAR</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                @endif
                                <!-- Modal confirmación elimminar respuesta-->
                                </div>
                            @endforeach
                            <label id="respuestaSinResponder"></label>
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
            <button type="submit" onclick="" class="btn btn-primary">
                Finalizar
            </button>
        </div>
    </div>

@endsection
