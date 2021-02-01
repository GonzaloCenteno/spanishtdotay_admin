<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CategoriaBlog;

class Blog extends Model
{
    protected $table = 'blog';
    protected $primaryKey='idblog';

    protected $fillable = [ 'idcategoriablog','titulo','subtitulo','imagen','contenido','estado' ];
 
    public function categoria()
    {
        return $this->hasOne(CategoriaBlog::class,'idcategoriablog','idcategoriablog');
    }
}
