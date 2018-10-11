@extends('layouts.principal')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="panel panel-success">
                <div class="panel-heading"><h3>Encuestas</h3></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            <button onclick="ajaxRenderSectionVistaCrearEncuesta()" type="button" class="btn btn-success">Nueva Encuesta</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                            <table style="border-collapse: collapse !important; border-spacing: 0 !important; width: 100% !important;" class="table table-bordered" id="tablaEncuestas">
                                <thead>
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Descripción</th>
                                    <th scope="col">Usuarios Encuestados</th>
                                    <th scope="col">Estadísticas</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($listEncuesta as $encuesta)
                                    <tr>
                                        <td >{{$encuesta->NombreEncuesta}}</td>
                                        <td>{!!$encuesta->Descripcion!!}</td>
                                        <td>
                                            <a class="btn btn-blue ripple trial-button" onclick="verUsuariosEncuestados({{$encuesta->id}})">ver</a>
                                        </td>
                                        <td>
                                            <a class="btn btn-blue ripple trial-button" onclick="verEstadisticas({{$encuesta->id}})">ver</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <link href="{{asset('js/Plugins/data-table/datatables.css')}}" rel="stylesheet">
    <!-- Plugins-->
    <script src="{{asset('js/Plugins/data-table/datatables.js')}}"></script>
    <script type="text/javascript">
        // Material Select Initialization
        $(document).ready(function() {
            $('#tablaEncuestas').DataTable({
                dom: 'B<"clear">lfrtip',
                buttons: {
                    name: 'primary',
                    text: 'Save current page'
                },
                language: {
                    "lengthMenu": "Registros por página _MENU_",
                    "info":"Mostrando del _START_ a _END_ de _TOTAL_ registros",
                    "infoEmpty":"Mostrando del 0 a 0 de 0 registros",
                    "infoFiltered": "(Registros filtrados _MAX_ )",
                    "zeroRecords": "No hay registros",
                    "search": "Buscador:",
                    "paginate": {
                        "first":      "First",
                        "last":       "Last",
                        "next":       "Siguiente",
                        "previous":   "Anterior"
                    }
                }
            });
        });

    </script>
@endsection
