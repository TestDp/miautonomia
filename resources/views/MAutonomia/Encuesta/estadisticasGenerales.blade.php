@extends('layouts.principal')

@section('content')
    <form id="formEstadisticas" action="crearEncuesta" method="POST" enctype="multipart/form-data">
        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" id="idEncuesta" name="idEncuesta" value="{{$idEncuesta}}">
        <div class="row">
            <div class="col-md-3">
                Pregunta
                <select id="Pregunta_id" name="Pregunta_id"  class="form-control" onchange="validarCamporEstadisticas()">
                    <option value="">Seleccionar</option>
                    @foreach($listPreguntas as $pregunta)
                        <option value="{{ $pregunta->id }}">{{ $pregunta->Enunciado }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                Sexo
                <select id="Sexo" name="Sexo"  class="form-control" onchange="validarCamporEstadisticas()">
                    <option value="0">Seleccionar</option>
                    <option value="M">Masculino</option>
                    <option value="F">Femenino</option>
                </select>
            </div>
            <div class="col-md-3">
                Rango de edad
                <select id="RangoEdad" name="RangoEdad"  class="form-control" onchange="validarCamporEstadisticas()">
                    <option value="0">Seleccionar</option>
                    <option value="1">18-24</option>
                    <option value="2">25-34</option>
                    <option value="3">35-44</option>
                    <option value="4">45+</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <canvas style="height:600px !important;" id="canvasEstadisticasGenerales" class="img-responsive"></canvas>
            </div>
        </div>
    </form>
    <script src="{{ asset('js/Plugins/Chart/Chart.js') }}"></script>
    <script src="{{asset('js/Plugins/jqueryValidate/jquery.validate.js')}}"></script>
@endsection
