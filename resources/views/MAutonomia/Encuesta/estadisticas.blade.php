@section('contentRespuestasUsuarios')
    <table style="border-collapse: collapse !important; border-spacing: 0 !important; width: 100% !important;" class="table table-bordered" id="tablaEncuestas">
        <thead>
        <tr>
            <th scope="col">Pregunta</th>
            <th scope="col">Respuesta</th>
            <th scope="col">Puntaje</th>

        </tr>
        </thead>
        <tbody>
        @foreach($usuariosRespuesta as $usuario)
            <tr>
                <td>{{$usuario->Enunciado}}</td>
                <td>{{$usuario->Descripcion}}</td>
                <td>{{$usuario->Puntaje}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
