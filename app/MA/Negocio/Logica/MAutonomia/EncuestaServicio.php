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

    public  function  ObtenerListaEncuestaUsuario($idUsuario)
    {
        return $this->encuestaRepositorio->ObtenerListaEncuestaUsuario($idUsuario);
    }

    public  function  ObtenerListaEncuesta()
    {
        return $this->encuestaRepositorio->ObtenerListaEncuesta();
    }

    public  function GuardarEncuesta($requestInfoEncuesta){
        return $this->encuestaRepositorio->GuardarEncuesta($requestInfoEncuesta);
    }

    public function obtenerFormularioEncuesta($idEncuesta,$idUsuario)
    {
        return $this->encuestaRepositorio->obtenerEncuesta($idEncuesta,$idUsuario);
    }

    public function GuardarRespuestaEncuesta($idUsuario,$idRespuesta)
    {
        return $this->encuestaRepositorio->GuardarRespuestaEncuesta($idUsuario,$idRespuesta);
    }

    public  function obtenerEstadisticasEncuesta($idEncuesta,$idUsuario)
    {
        return $this->encuestaRepositorio->obtenerEstadisticasEncuesta($idEncuesta,$idUsuario);
    }

    public  function obtenerUsuariosEncuestados($idEncuesta)
    {
        return $this->encuestaRepositorio->obtenerUsuariosEncuestados($idEncuesta);
    }

    public  function ObtenerEstadisticasGenerales($idEncuesta, $idPregunta, $idGenero, $idRangoEdad)
    {
        return $this->encuestaRepositorio->ObtenerEstadisticasGenerales($idEncuesta, $idPregunta, $idGenero, $idRangoEdad);
    }

    public  function obtenerPreguntasEncuestas($idEncuesta)
    {
        return $this->encuestaRepositorio->obtenerPreguntasEncuestas($idEncuesta);
    }
}