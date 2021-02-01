<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaBlog extends Model
{
    protected $table = 'categoria_blog';
    protected $primaryKey = 'idcategoriablog';

    protected $fillable = [ 'nombre','estado' ];
}
