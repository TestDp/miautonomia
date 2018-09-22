<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 24/08/2018
 * Time: 9:08 AM
 */

namespace MA\Datos\Modelos\MSistema;


use MA\Datos\Modelos\MInventario\Proveedor;
use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    protected $table = 'Tbl_Tipos_Documento';
    protected $fillable =['Nombre','Descripcion'];

    public function Proveedores(){
        return $this->hasMany(Proveedor::class,'TipoDocumento_id','id');
    }
}