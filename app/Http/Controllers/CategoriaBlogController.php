<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\CategoriaBlog;
use App\Http\Requests\CategoriaBlogRequest;

class CategoriaBlogController extends Controller
{

    public function index()
    {
        return view('categoria_blog.index');
    }

    public function create()
    {
        return view('categoria_blog.create');
    }

    public function store(CategoriaBlogRequest $request)
    {
        if(!$request->ajax()) return redirect('/');
        $request['estado'] = ($request['estado'] == 'on') ? true : false;
        $data = CategoriaBlog::create($request->all());
        return $data->idcategoriablog;
    }

    public function show(Request $request,$id)
    {
       
    }

    public function edit($id)
    {
        $categoria = CategoriaBlog::find($id);
        return view('categoria_blog/edit', compact('categoria'));
    }

    public function update(CategoriaBlogRequest $request, $idcategoriablog)
    {
        $categoria = CategoriaBlog::find($idcategoriablog);
        $request['estado'] = ($request['estado'] == 'on') ? true : false;
        $categoria->update($request->all());
        return $categoria->idcategoriablog;
    }

    public function destroy(Request $request)
    {
        return CategoriaBlog::where('idcategoriablog',$request['idcategoriablog'])->delete();
    }

}
