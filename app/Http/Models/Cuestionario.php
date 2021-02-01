<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Cuestionario extends Model
{
    protected $table = 'cuestionario';
    protected $primaryKey='id_cuestionario';

    protected $fillable = [
        'nombre','descripcion','resumen','imagen','estado','url'
    ];
}
