<?php

namespace MA\Datos\Modelos\MAutonomia;

use App\User;
use Illuminate\Database\Eloquent\Model;

class RespuestaUsuarioXEncuesta extends Model
{
    protected $table = 'Tbl_Respuestas_UsuariosXEncuestas';
    protected $fillable =['user_id','Respuesta_id'];

    public function respuesta(){
        return $this->belongsTo(Respuesta::class,'Respuesta_id');
    }

    public function usuario(){
        return $this->belongsTo(User::class,'user_id');
    }
}
