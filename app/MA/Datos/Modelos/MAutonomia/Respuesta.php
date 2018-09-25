<?php

namespace MA\Datos\Modelos\MAutonomia;

use Illuminate\Database\Eloquent\Model;
use Ecotickets\Datos\Modelos\Pregunta;

class Respuesta extends Model
{
    protected $table = 'Tbl_Respuestas';
    protected $fillable =['Descripcion','Pregunta_id','Puntaje'];

    public function pregunta(){
        return $this->belongsTo('Pregunta');
    }

    public function respuestasAsistentesXEventos(){
        return $this->hasMany('AsistenteXEvento','Respuesta_id','id');
    }
}
