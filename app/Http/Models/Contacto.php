<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    protected $table = 'contacto';
    protected $primaryKey='id_contacto';
    public $timestamps = false;

    protected $fillable = [
        'nombre','correo','mensaje'
    ];
}
