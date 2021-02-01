<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class VentaCabecera extends Model
{
    protected $table = 'ventacabecera';
    protected $primaryKey='id_ventacabecera';
    public $timestamps = false;

    protected $fillable = [
        'nombres','email','token'
    ];
}
