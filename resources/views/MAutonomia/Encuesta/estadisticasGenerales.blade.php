@extends('layouts.principal')

@section('content')
    <div class="row">
        <div class="col-md-3">
            Pregunta
            <select id="Categoria_id" name="Categoria_id"  class="form-control">
                <option value="">Seleccionar</option>
                @foreach($listPreguntas as $pregunta)
                    <option value="{{ $pregunta->id }}">{{ $pregunta->Enunciado }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            Sexo
            <select id="Sexo" name="Sexo"  class="form-control">
                <option value="0">Seleccionar</option>
                <option value="M">Masculino</option>
                <option value="F">Femenino</option>
            </select>
        </div>
        <div class="col-md-3">
            Rango de edad
            <select id="Sexo" name="Sexo"  class="form-control">
                <option value="0">Seleccionar</option>
                <option value="1">18-24</option>
                <option value="2">25-34</option>
                <option value="3">35-44</option>
                <option value="4">45+</option>
            </select>
        </div>
    </div>

@endsection
