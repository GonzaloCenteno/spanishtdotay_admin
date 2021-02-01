<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Respuesta;
use App\Http\Models\Pregunta;
use App\Http\Requests\RespuestaRequest;
use Carbon\Carbon;

class RespuestaController extends Controller
{

    public function index()
    {
        return view('respuesta.index');
    }

    public function create()
    {
        return view('respuesta.create', [
            'pregunta' => Pregunta::orderBy('id_pregunta','asc')->get()
        ]);
    }

    public function edit($id)
    {
        return view('respuesta.edit', [
            'respuesta' => Respuesta::where('id_respuesta',$id)->first(),
            'pregunta' => Pregunta::orderBy('id_pregunta','asc')->get()
        ]);
    }

    public function show(Request $request,$id)
    {
        $page = $request['page'];
        $limit = $request['rows'];
        $sidx = $request['sidx'];
        $sord = $request['sord'];
        $start = ($limit * $page) - $limit; 
        if ($start < 0) {
            $start = 0;
        }
        $totalg = Respuesta::count();
        $sql = Respuesta::orderBY($sidx,$sord)->limit($limit)->offset($start)->get();

        $total_pages = 0;
        if (!$sidx) {
            $sidx = 1;
        }
        $count = $totalg;
        if ($count > 0) {
            $total_pages = ceil($count / $limit);
        }
        if ($page > $total_pages) {
            $page = $total_pages;
        }
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;
        foreach ($sql as $Index => $Datos) {
            $Lista->rows[$Index]['id'] = $Datos->id_respuesta;
            $Lista->rows[$Index]['cell'] = array(
                $Datos->id_respuesta,
                $Datos->pregunta->pregunta,
                $Datos->respuesta,
                $Datos->estado
            );
        }
        return response()->json($Lista);
    }

    public function store(RespuestaRequest $request)
    {
        if(!$request->ajax()) return redirect('/');
        $respuesta = Respuesta::create($request->all());
        return $respuesta->id_respuesta;
    }

    public function update(RespuestaRequest $request, $id)
    {
        if(!$request->ajax()) return redirect('/');
        $respuesta = Respuesta::find($id);
        $respuesta->update($request->all());
        return $respuesta->id_respuesta;
    } 

}
