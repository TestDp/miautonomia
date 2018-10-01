<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 24/09/2018
 * Time: 12:09 PM
 */

namespace MA\Datos\Repositorio\MAutonomia;


use MA\Datos\Modelos\MAutonomia\Encuesta;
use Illuminate\Support\Facades\DB;
use MA\Datos\Modelos\MAutonomia\Pregunta;
use MA\Datos\Modelos\MAutonomia\Respuesta;
use MA\Datos\Modelos\MAutonomia\RespuestaUsuarioXEncuesta;

class EncuestaRepositorio
{

    public  function  ObtenerListaEncuestaUsuario($idUsuario){
        return Encuesta::where('user_id', '=', $idUsuario)->get();
    }

    public  function  ObtenerListaEncuesta(){
        return Encuesta::all();
    }

    public  function GuardarEncuesta($requestInfoEncuesta){
        DB::beginTransaction();
        try{
            //inicio del bloque donde se guarda el evento para obtener el id del evento
            $encuesta = new Encuesta($requestInfoEncuesta->all());
            $encuesta->Descripcion =$requestInfoEncuesta->DescripcionEncuesta;
            $encuesta ->save();
            //fin del bloque
            $ind =0;
            //Validar si el array es vacio
            if($requestInfoEncuesta->Enunciado)
            {
                // ciclo que recorre el arrya de enunciado para obtener el texto de las preguntas
                foreach ($requestInfoEncuesta->Enunciado  as $EnunciadoPregunta)
                {
                    $Pregunta = new Pregunta();
                    $Pregunta ->Enunciado = $EnunciadoPregunta;
                    $Pregunta ->Encuesta_id = $encuesta -> id;
                    $Pregunta ->Categoria_id = $requestInfoEncuesta->Categoria_id[$ind];
                    $Pregunta ->Explicacion = $requestInfoEncuesta->Explicacion[$ind];
                    $Pregunta ->save();// se guarda la pregunta para obtner el id y poder relacionarlo con la respuesta
                    //se recorre el array en la posicion ind para sacar las respuestas relacionadas a las preguntas
                    $indPuntaje =0;
                    foreach ($requestInfoEncuesta->TextoRespuesta[$ind] as $EnunciadoRespuesta)
                    {
                        $Respuesta = new Respuesta();
                        $Respuesta ->Descripcion = $EnunciadoRespuesta;
                        $Respuesta ->Pregunta_id = $Pregunta->id;
                        $Respuesta ->Puntaje = $requestInfoEncuesta->Puntaje[$ind][$indPuntaje];
                        $Respuesta ->save();// se guarda la respuesta
                        $indPuntaje++;
                    }
                    $ind++;

                }
            }

            DB::commit();
        }catch (\Exception $e) {

            $error = $e->getMessage();
            DB::rollback();
            return  false;
        }
        return true;

    }

    public function obtenerEncuesta($idEncuesta)
    {
        $encuesta = Encuesta::where('id','=',$idEncuesta)->get()->first();
        $encuesta->preguntas;
        $encuesta->preguntas->each(function($preguntas){
            $preguntas ->respuestas;// se realiza la relacion de la respuestas de la preguntas del evento
        });
        return $encuesta ;
    }


    public function GuardarRespuestaEncuesta($idUsuario,$idRespuesta)
    {
        DB::beginTransaction();
        try{
            $respuestaXUsuario = new RespuestaUsuarioXEncuesta();
            $respuestaXUsuario->user_id = $idUsuario;
            $respuestaXUsuario->Respuesta_id = $idRespuesta;
            $respuestaXUsuario->save();
            DB::commit();
        }catch (\Exception $e) {

            $error = $e->getMessage();
            DB::rollback();
            return  false;
        }
        return true;
    }

    public  function obtenerEstadisticasEncuesta($idEncuesta,$idUsuario)
    {
        $users = DB::table('users')
            ->join('Tbl_Respuestas_UsuariosXEncuestas', 'Tbl_Respuestas_UsuariosXEncuestas.user_id', '=', 'users.id')
            ->join('Tbl_Respuestas','Tbl_Respuestas.id','=','Tbl_Respuestas_UsuariosXEncuestas.Respuesta_id')
            ->join('Tbl_Preguntas','Tbl_Preguntas.id','=','Tbl_Respuestas.Pregunta_id')
            ->join('Tbl_Encuestas', 'Tbl_Encuestas.id', '=', 'Tbl_Preguntas.Encuesta_id')
            ->select('users.*','Tbl_Preguntas.Enunciado','Tbl_Respuestas.Descripcion', 'Tbl_Respuestas.Puntaje')
            ->where('Tbl_Encuestas.id', '=', $idEncuesta)
            ->where('Tbl_Respuestas_UsuariosXEncuestas.user_id','=',$idUsuario)
            ->get();
        return $users;
    }

    //retornar a lista de los usuarios que respondieron la enceusta
    public  function obtenerUsuariosEncuestados($idEncuesta)
    {
        $users = DB::table('users')
            ->join('Tbl_Respuestas_UsuariosXEncuestas', 'Tbl_Respuestas_UsuariosXEncuestas.user_id', '=', 'users.id')
            ->join('Tbl_Respuestas','Tbl_Respuestas.id','=','Tbl_Respuestas_UsuariosXEncuestas.Respuesta_id')
            ->join('Tbl_Preguntas','Tbl_Preguntas.id','=','Tbl_Respuestas.Pregunta_id')
            ->join('Tbl_Encuestas', 'Tbl_Encuestas.id', '=', 'Tbl_Preguntas.Encuesta_id')
            ->select('users.*')
            ->where('Tbl_Encuestas.id', '=', $idEncuesta)
            ->distinct()
            ->get();
        return $users;
    }
}