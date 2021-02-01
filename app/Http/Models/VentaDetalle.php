<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\VentaCabecera;
use App\Http\Models\Item;

class VentaDetalle extends Model
{
    protected $table = 'ventadetalle';
    protected $primaryKey='id_ventadetalle';
    public $timestamps = false;

    protected $fillable = [
        'id_ventacabecera','id_item'
    ];

    public function item()
    {
        return $this->hasOne(Item::class,'id_item','id_item');
    }

    public function cabecera()
    {
        return $this->hasOne(VentaCabecera::class,'id_ventacabecera','id_ventacabecera');
    }
}
