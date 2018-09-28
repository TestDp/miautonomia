@extends('layouts.principalEncuesta')

@section('content')
    <div class="body">
        <div class="column one">
            <div class="hover_color_wrapper">
                @foreach($encuestas as $encuesta)
                    <fieldset>
                        <a href="{{url('FormularioEncuesta', ['idEncuesta' => $encuesta->id ])}}">{{ $encuesta->NombreEncuesta }}</a>
                    </fieldset>
                @endforeach
            </div>
        </div>
        <br/>
    </div>
@endsection
