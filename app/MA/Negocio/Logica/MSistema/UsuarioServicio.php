<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 6/09/2018
 * Time: 3:33 PM
 */

namespace MA\Negocio\Logica\MSistema;


use MA\Datos\Repositorio\MSistema\UsuarioRepositorio;

class UsuarioServicio
{

    protected  $usuarioRepositorio;
    public function __construct(UsuarioRepositorio $usuarioRepositorio){
        $this->usuarioRepositorio = $usuarioRepositorio;
    }

    public  function  ObtenerListaUsuarios($idEmpresa,$idUsuario){
        return $this->usuarioRepositorio->ObtenerListaUsuarios($idEmpresa,$idUsuario);
    }
}