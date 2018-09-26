<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 26/09/2018
 * Time: 10:33 AM
 */

namespace MA\Datos\Repositorio\MAutonomia;


use MA\Datos\Modelos\MAutonomia\Categoria;

class CategoriaRepositorio
{
    public  function  ObtenerListaCategorias()
    {
        return Categoria::all();
    }
}