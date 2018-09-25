<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 24/09/2018
 * Time: 12:09 PM
 */

namespace MA\Datos\Repositorio\MAutonomia;


use MA\Datos\Modelos\MAutonomia\Encuesta;

class EncuestaRepositorio
{

    public  function  ObtenerListaEncuesta($idUsuario){
        return Encuesta::where('user_id', '=', $idUsuario)->get();
    }

    public  function GuardarEncuesta($requestInfoEncuesta){

    }
}