<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 9/08/2018
 * Time: 10:49 AM
 */

namespace MA\Datos\Modelos\MEmpresa;


use App\User;
use Illuminate\Database\Eloquent\Model;

class Sede extends  Model
{
    protected $table = 'Tbl_Sedes';
    protected $fillable =['Nombre','Direccion','Telefono','Empresa_id'];

    public function Empresa()
    {
        return $this->belongsTo(Empresa::class,'Empresa_id');
    }

    public function Usuarios(){
        return $this->hasMany(User::class,'Sede_id','id');
    }


}