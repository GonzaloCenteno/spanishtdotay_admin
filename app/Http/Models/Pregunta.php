<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    protected $table = 'pregunta';
    protected $primaryKey='id_pregunta';

    protected $fillable = [
        'pregunta','detalle','fecha_creacion','calificacion','tipo','cantidadCorrectas','calificacionRespuesta'
    ];

    public function getTipoAttribute($value)
    {
        switch ($value) {
          case "1": return 'UNICA RESPUESTA';break;
          case "2": return 'MULTIRESPUESTA';break;
        }
    }
}
