<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Blog;
use App\Http\Models\CategoriaBlog;
use App\Http\Requests\BlogRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{

    public function index()
    {
        return view('blog.index');
    }

    public function create()
    {
        return view('blog.create', [
            'categorias' => CategoriaBlog::get()
        ]);
    }

    public function store(BlogRequest $request)
    {
        if(!$request->ajax()) return redirect('/');

        $file = $request->imagen;
        $bandera = Str::random(12);
        $filename = $file->getClientOriginalName();
        $fileserver = $bandera.' '.$filename;
        Storage::putFileAs('public/blog', $file, $fileserver);
        return Blog::insertGetId([
            'idcategoriablog' => $request['idcategoriablog'],
            'imagen' => 'blog/'.$fileserver, 
            'titulo'=> $request['titulo'],
            'subtitulo'=> $request['subtitulo'],
            'contenido'=> $request['contenido'],
            'estado'=> ($request['estado'] == 'on') ? true : false
        ]);
    }

    public function show(Request $request,$id)
    {
        
    }

    public function edit($id)
    {
        $blog = Blog::find($id);
        return view('blog/edit', compact('blog'));
    }

    public function update(BlogRequest $request, $idblog)
    {
        $data = Blog::find($idblog);
        $data->update($request->all());
        return $data->idblog;
    }

    public function destroy(Request $request)
    {
        return Blog::where('idblog',$request['idblog'])->delete();
    }

    public function upload(Request $request)
    {
        $filename = time() . "." . $request->contenido->extension();
        $request->contenido->move(public_path('images/blog'), $filename);
        return response()->json(["default" => \URL::to('/') . '/images/blog/' . $filename]);
    }

}
