@extends('layouts.principal')

@section('content')

    @if(count($encuesta->preguntas) >0)
        <section id="banner">
            <div class="content">
                <header>
                    <h2 style="font-size: 20px; font-family: sans-serif; color:#2297e1;">Responde por favor la siguiente encuesta</h2>
                    @foreach($encuesta->preguntas as $PreguntasFormulario)
                        <fieldset name="RespuestasUsuario">
                            <div style="font-weight:700; font-family: sans-serif; padding-top: 2%; color: #8d562f;" name ="id_pregunta" value = "{{ $PreguntasFormulario->id }}"> ¿ {{ $PreguntasFormulario->Enunciado }} ?</div>
                            @foreach($PreguntasFormulario->Respuestas as $respuestas)
                                <div class="col-md-6" >
                                    <div class="radio">
                                        <div style="font-family: sans-serif; line-height: 30px;"><input type="radio" onclick="guardarRespuestaUsuario(this,{{$respuestas->id}})" id="Respuesta_id" name="Respuesta_id[{{$loop->parent->index}}]" data-toggle="modal" data-target="#modalExplicacionRespuesta{{$respuestas->id}}">
                                            <b>{{$respuestas->Descripcion}}</b>
                                        </div>
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
                            <label for="Respuesta_id[{{$loop->index}}]" class="error" style="display:none;">Please choose one.</label>
                        </fieldset>
                    @endforeach
                </header>
            </div>
        </section>
    @endif
    <div class="row">
        <div class="col-md-12">
            <button type="submit" onclick="" class="btn btn-blue ripple trial-button">
                Finalizar
            </button>
        </div>
    </div>

@endsection
