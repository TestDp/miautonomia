<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 24/08/2018
 * Time: 9:54 PM
 */

namespace MA\Negocio\Logica\MAutonomia;

use MA\Datos\Repositorio\MAutonomia\CategoriaRepositorio;

class CategoriaServicio
{
    protected  $categoriaRepositorio;
    public function __construct(CategoriaRepositorio $categoriaRepositorio){
        $this->categoriaRepositorio = $categoriaRepositorio;
    }

    public  function  ObtenerListaCategorias()
    {
         return $this->categoriaRepositorio->ObtenerListaCategorias();
    }
}