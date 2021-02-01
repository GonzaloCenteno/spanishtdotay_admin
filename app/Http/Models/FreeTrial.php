<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class FreeTrial extends Model
{
    protected $table = 'free_trial';
    protected $primaryKey='id_freetrial';
    public $timestamps = false;

    protected $fillable = [
        'nombre','correo','fecha','hora','zona_horaria','dele'
    ];
}
