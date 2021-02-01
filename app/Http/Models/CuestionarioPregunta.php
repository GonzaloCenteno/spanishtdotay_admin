<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class CuestionarioPregunta extends Model
{
    protected $table = 'cuestionario_pregunta';
    protected $primaryKey='id_cuestionariopregunta';

    protected $fillable = [
        'id_cuestionario','id_pregunta','estado'
    ];
}
