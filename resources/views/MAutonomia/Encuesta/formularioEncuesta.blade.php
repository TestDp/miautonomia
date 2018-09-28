@extends('layouts.principalEncuesta')

@section('content')
    <div class="column one">
        @if(count($encuesta->preguntas) >0)
            <div class="hover_color_wrapper">
                <h2 style="font-size: 20px; font-family: sans-serif; color:#2297e1;">Responde por favor la siguiente encuesta</h2>
                @foreach($encuesta->preguntas as $PreguntasFormulario)
                    <fieldset>
                        <div style="font-weight:700; font-family: sans-serif; padding-top: 2%;" name ="id_pregunta" value = "{{ $PreguntasFormulario->id }}"> ¿ {{ $PreguntasFormulario->Enunciado }} ?</div>
                        @foreach($PreguntasFormulario->Respuestas as $respuestas)
                            <div class="col-md-6" >
                                <div class="radio">
                                    <div style="font-family: sans-serif; line-height: 30px;"><input type="radio" value="{{$respuestas->id}}" id="Respuesta_id" name="Respuesta_id[{{$loop->parent->index}}]" >
                                        <b>{{$respuestas->Descripcion}}</b>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <label for="Respuesta_id[{{$loop->index}}]" class="error" style="display:none;">Please choose one.</label>
                    </fieldset>
                @endforeach
            </div>
        @endif
    </div>
    <br/>
    <div class="row">
        <div class="col-md-12">
            <button type="submit" onclick="generarQRCode()" class="btn btn-blue ripple trial-button">
                Enviar
            </button>
        </div>
    </div>

@endsection
