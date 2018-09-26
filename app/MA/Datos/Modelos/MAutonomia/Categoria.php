<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 8/08/2018
 * Time: 12:33 PM
 */

namespace MA\Datos\Modelos\MAutonomia;


use Facin\Datos\Modelos\MEmpresa\Empresa;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'Tbl_Categorias';
    protected $fillable =['Nombre','Descripcion'];


    public function Preguntas(){
        return $this->hasMany( Pregunta::class,'Categoria_id','id');
    }
}