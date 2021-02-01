<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Pregunta;

class Respuesta extends Model
{
    protected $table = 'respuesta';
    protected $primaryKey='id_respuesta';

    protected $fillable = [
        'respuesta','estado','id_pregunta'
    ];

    public function pregunta()
    {
        return $this->hasOne(Pregunta::class,'id_pregunta','id_pregunta');
    }

    public function getEstadoAttribute($value)
    {
        switch ($value) {
          case "1": return 'CORRECTA';break;
          case "2": return 'INCORRECTA';break;
        }
    }
}
