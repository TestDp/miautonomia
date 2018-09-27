@extends('layouts.principal')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-success">
                    <div class="panel-heading text-center"><h3>CREAR ENCUESTA</h3></div>
                    <form id="crearEncuesta" action="crearEncuesta" method="POST" enctype="multipart/form-data">
                        <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}"/>
                        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                        <div style="margin:0px !important;" class="row">
                            <div class="col-md-12">
                                Nombre de la encuesta
                                <input id="NombreEncuesta" name="NombreEncuesta" type="text" class="form-control" />
                            </div>
                        </div>
                        <hr/>
                        <div style="margin:0px !important;" class="row">
                            <div class="col-md-12">
                                Descripción de la encuesta
                                <textarea id="DesEncuesta" name="DesEncuesta"></textarea>
                                <input type="hidden" id="DescripcionEncuesta" name="DescripcionEncuesta" />
                                <label class="error-dinamico" id="errorTextArea"></label>
                            </div>
                        </div>
                        <br/>
                        <div style="margin:0px !important;" class="row">
                            <div class="col-md-12">
                                <input type="button" class="btn btn-info" onclick="AgregarPregunta()" value="Agregar Pregunta"/>
                            </div>
                        </div>
                        <div style="margin:0px !important;" class="row">
                            <div class="col-md-12">
                                <h3 class="col-md-12" >Preguntas</h3>
                                <div id="ListaPreguntas">

                                </div>
                                <hr style="border-top-color:lightslategray; width:100%" />
                                <div class="row">
                                    <div style="margin-bottom:2%;" class="col-md-12">
                                        <button type="button" class="btn btn-success" onclick="validarCamposCrearEncuesta()">
                                            Crear Encuesta
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div hidden="hidden">

        <div class="panel-group" id="divPregunta" name="divPregunta">
            <hr style="border-top-color:lightslategray; width:100%" />
            <div class="row">
                <div class="col-md-4">
                    Categoría
                    <select id="Categoria_id" name="Categoria_id[]"  class="form-control">
                        <option value="">Seleccionar</option>
                        @foreach($listCategorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->Nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon alert-warning">
                                <span><strong>¿</strong></span>
                            </div>
                            <input class="form-control" type="text" id="TextoPregunta" name="TextoPregunta"  placeholder="Pregunta" />

                            <div class="input-group-addon alert-warning">
                                <span><strong>?</strong> </span>
                            </div>
                            <div class="input-group-addon alert-warning">
                                <a id="eliminarPregunta" name="eliminarPregunta" title="Eliminar Pregunta" data-toggle="modal" data-target="#modalElimianarPregunta"><span class="glyphicon glyphicon-minus"  ></span></a>
                            </div>
                            <div class="input-group-addon alert-warning">
                                <a id="agregarRespuesta" name="agregarRespuesta" title="Agregar Respuesta" onclick="AgregarRespuesta(this)"><span class="glyphicon glyphicon-plus"  ></span></a>
                            </div>
                            <!-- Modal confirmación elimminar pregunta-->
                            <div id="modalElimianarPregunta" name="modalElimianarPregunta" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Enunciado de la pregunta</h4>
                                        </div>
                                        <div class="modal-body" style="text-align:center; color:black">
                                            <div class="row">
                                                ¿Esta seguro que desea eliminar la pregunta?
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-blue ripple trial-button" data-dismiss="modal" onclick="EliminarPregunta(this)">Elimminar</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">CANCELAR</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal confirmación elimminar pregunta-->
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    Explicación
                    <input class="form-control" type="text" id="Explicacion" name="Explicacion[]"  />
                </div>
            </div>
            <div class="row" name="Respuesta">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon alert-warning">
                                <span><strong>*</strong></span>
                            </div>
                            <input class="form-control" type="text" id="TextoRespuesta" name="TextoRespuesta"  placeholder="Respuesta"/>
                            <div class="input-group-addon alert-warning">
                                Puntaje
                                <input id="Puntaje" name="Puntaje" type="number" />
                            </div>
                            <div class="input-group-addon alert-warning">
                                <a id="eliminarRespuesta" name="eliminarRespuesta" title="Eliminar Respuesta" data-toggle="modal" data-target="#modalElimianarRespuesta"><span class="glyphicon glyphicon-minus"  ></span></a>
                            </div>
                            <!-- Modal confirmación elimminar respuesta-->
                            <div id="modalElimianarRespuesta" name="modalElimianarRespuesta" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Enunciado de la pregunta</h4>
                                        </div>
                                        <div class="modal-body" style="text-align:center; color:black">
                                            <div class="row">
                                                ¿Esta seguro que desea eliminar la respuesta?
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-blue ripple trial-button" data-dismiss="modal" onclick="EliminarRespuesta(this)">Eliminar</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">CANCELAR</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal confirmación elimminar respuesta-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" name="Respuesta">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon alert-warning">
                                <span><strong>*</strong></span>
                            </div>
                            <input class="form-control" type="text" id="TextoRespuesta" name="TextoRespuesta" placeholder="Respuesta"/>
                            <div class="input-group-addon alert-warning">
                                Puntaje
                                <input id="Puntaje" name="Puntaje" type="number" />
                            </div>
                            <div class="input-group-addon alert-warning">
                                <a id="eliminarRespuesta" name="eliminarRespuesta" title="Eliminar Respuesta" data-toggle="modal" data-target="#modalElimianarRespuesta"><span class="glyphicon glyphicon-minus"  ></span></a>
                            </div>
                            <!-- Modal confirmación elimminar respuesta-->
                            <div id="modalElimianarRespuesta" name="modalElimianarRespuesta" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Enunciado de la pregunta</h4>
                                        </div>
                                        <div class="modal-body" style="text-align:center; color:black">
                                            <div class="row">
                                                ¿Esta seguro que desea eliminar la respuesta?
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-blue ripple trial-button" data-dismiss="modal" onclick="EliminarRespuesta(this)">Eliminar</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">CANCELAR</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal confirmación elimminar respuesta-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" name="Respuesta">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon alert-warning">
                                <span><strong>*</strong></span>
                            </div>
                            <input class="form-control" type="text" id="TextoRespuesta" name="TextoRespuesta"   placeholder="Respuesta"/>
                            <div class="input-group-addon alert-warning">
                                Puntaje
                                <input id="Puntaje" name="Puntaje" type="number" />
                            </div>
                            <div class="input-group-addon alert-warning">
                                <a id="eliminarRespuesta" name="eliminarRespuesta" title="Eliminar Respuesta" data-toggle="modal" data-target="#modalElimianarRespuesta"><span class="glyphicon glyphicon-minus"  ></span></a>
                            </div>
                            <!-- Modal confirmación elimminar respuesta-->
                            <div id="modalElimianarRespuesta"  name="modalElimianarRespuesta" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Enunciado de la pregunta</h4>
                                        </div>
                                        <div class="modal-body" style="text-align:center; color:black">
                                            <div class="row">
                                                ¿Esta seguro que desea eliminar la respuesta?
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-blue ripple trial-button" data-dismiss="modal" onclick="EliminarRespuesta(this)">Eliminar</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">CANCELAR</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal confirmación elimminar respuesta-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" name="Respuesta">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon alert-warning">
                                <span><strong>*</strong></span>
                            </div>
                            <input class="form-control" type="text" id="TextoRespuesta" name="TextoRespuesta"  placeholder="Respuesta" />
                            <div class="input-group-addon alert-warning">
                                Puntaje
                                <input id="Puntaje" name="Puntaje" type="number" />
                            </div>
                            <div class="input-group-addon alert-warning">
                                <a id="eliminarRespuesta" name="eliminarRespuesta" title="Eliminar Respuesta" data-toggle="modal" data-target="#modalElimianarRespuesta"><span class="glyphicon glyphicon-minus"  ></span></a>
                            </div>
                            <!-- Modal confirmación elimminar respuesta-->
                            <div id="modalElimianarRespuesta" name="modalElimianarRespuesta" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Enunciado de la pregunta</h4>
                                        </div>
                                        <div class="modal-body" style="text-align:center; color:black">
                                            <div class="row">
                                                ¿Esta seguro que desea eliminar la respuesta?
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-blue ripple trial-button" data-dismiss="modal" onclick="EliminarRespuesta(this)">Eliminar</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">CANCELAR</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal confirmación elimminar respuesta-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="RespuestaPlantilla" name="RespuestaPlantilla" hidden="hidden">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon alert-warning">
                        <span><strong>*</strong></span>
                    </div>
                    <input class="form-control" type="text" id="TextoRespuesta" name="TextoRespuesta"   placeholder="Respuesta"/>
                    <div class="input-group-addon alert-warning">
                        Puntaje
                        <input id="Puntaje" name="Puntaje" type="number" />
                    </div>
                    <div class="input-group-addon alert-warning">
                        <a id="eliminarRespuesta" name="eliminarRespuesta" title="Eliminar Respuesta" data-toggle="modal" data-target="#modalElimianarRespuesta"><span class="glyphicon glyphicon-minus"  ></span></a>
                    </div>
                    <!-- Modal confirmación elimminar respuesta-->
                    <div id="modalElimianarRespuesta" name="modalElimianarRespuesta" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Enunciado de la pregunta</h4>
                                </div>
                                <div class="modal-body" style="text-align:center; color:black">
                                    <div class="row">
                                        ¿Esta seguro que desea eliminar la respuesta?
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-blue ripple trial-button" data-dismiss="modal" onclick="EliminarRespuesta(this)">Eliminar</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">CANCELAR</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal confirmación elimminar respuesta-->
                </div>
            </div>
        </div>
    </div>

    <div id="elmentosEliminados" hidden="hidden">
    </div>

    <script src="{{ asset('js/Plugins/EditorTexto/ckeditor.js') }}"></script>
    <script src="{{asset('js/Plugins/jqueryValidate/jquery.validate.js')}}"></script>
    <script type="text/javascript">
        CKEDITOR.replace('DesEncuesta');
    </script>

@endsection