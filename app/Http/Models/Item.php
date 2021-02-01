<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'item';
    protected $primaryKey='id_item';

    protected $fillable = [
        'plan','titulo','descripcion','precio'
    ];
}
