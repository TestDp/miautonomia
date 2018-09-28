@extends('layouts.Encuesta')

@section('content')

        @if(count($encuesta->preguntas) >0)
                <section id="banner">
					<div class="content">
						<header>
                <h2 style="font-size: 20px; font-family: sans-serif; color:#2297e1;">Responde por favor la siguiente encuesta</h2>
                @foreach($encuesta->preguntas as $PreguntasFormulario)
                    <fieldset>
                        <div style="font-weight:700; font-family: sans-serif; padding-top: 2%; color: #8d562f;" name ="id_pregunta" value = "{{ $PreguntasFormulario->id }}"> ¿ {{ $PreguntasFormulario->Enunciado }} ?</div>
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
				</header>
            </div>
			</section>
        @endif
    <div class="row">
        <div class="col-md-12">
            <button type="submit" onclick="generarQRCode()" class="btn btn-blue ripple trial-button">
                Enviar
            </button>
        </div>
    </div>

@endsection
