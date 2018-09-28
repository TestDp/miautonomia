<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 24/09/2018
 * Time: 12:11 PM
 */

namespace MA\Negocio\Logica\MAutonomia;


use MA\Datos\Repositorio\MAutonomia\EncuestaRepositorio;

class EncuestaServicio
{

    protected  $encuestaRepositorio;
    public function __construct(EncuestaRepositorio $encuestaRepositorio){
        $this->encuestaRepositorio = $encuestaRepositorio;
    }

    public  function  ObtenerListaEncuesta($idUsuario)
    {
        return $this->encuestaRepositorio->ObtenerListaEncuesta($idUsuario);
    }

    public  function GuardarEncuesta($requestInfoEncuesta){
        return $this->encuestaRepositorio->GuardarEncuesta($requestInfoEncuesta);
    }

    public function obtenerFormularioEncuesta($idEncuesta)
    {
        return $this->encuestaRepositorio->obtenerEncuesta($idEncuesta);
    }
}