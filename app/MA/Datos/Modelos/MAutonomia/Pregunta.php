<?php

namespace MA\Datos\Modelos\MAutonomia;

use Illuminate\Database\Eloquent\Model;


class Pregunta extends Model
{
    protected $table = 'Tbl_Preguntas';
    protected $fillable =['Enunciado','Encuesta_id'];

    public function evento(){
        return $this->belongsTo(Encuesta::class,'Encuesta_id');
    }

    public function respuestas(){
        return $this->hasMany(Respuesta::class,'Pregunta_id','id');
    }
}
