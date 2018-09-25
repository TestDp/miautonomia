<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 24/09/2018
 * Time: 10:48 AM
 */

namespace MA\Datos\Modelos\MAutonomia;


use App\User;
use Illuminate\Database\Eloquent\Model;

class Encuesta extends Model
{
    protected $table = 'Tbl_Encuestas';
    protected $fillable =['NombreEncuesta','Descripcion','user_id'];

    public function Usuario()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}