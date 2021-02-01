<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Pregunta;
use App\Http\Requests\PreguntaRequest;
use Carbon\Carbon;

class PreguntaController extends Controller
{

    public function index()
    {
        return view('pregunta.index');
    }

    public function create()
    {
        return view('pregunta/create');
    }

    public function edit($id)
    {
        return view('pregunta.edit', [
            'pregunta' => Pregunta::where('id_pregunta',$id)->first()
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
        $totalg = Pregunta::count();
        $sql = Pregunta::orderBY($sidx,$sord)->limit($limit)->offset($start)->get();

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
            $Lista->rows[$Index]['id'] = $Datos->id_pregunta;
            $Lista->rows[$Index]['cell'] = array(
                $Datos->id_pregunta,
                $Datos->pregunta,
                $Datos->calificacion,
                $Datos->tipo,
                $Datos->cantidadCorrectas,
                $Datos->calificacionRespuesta
            );
        }
        return response()->json($Lista);
    }

    public function store(PreguntaRequest $request)
    {
        if(!$request->ajax()) return redirect('/');
        $request['fecha_creacion'] = date('Y-m-d');
        $request['calificacionRespuesta'] = $request['calificacion'] / $request['cantidadCorrectas'];
        $pregunta = Pregunta::create($request->all());
        return $pregunta->id_pregunta;
    }

    public function update(PreguntaRequest $request, $id)
    {
        if(!$request->ajax()) return redirect('/');
        $pregunta = Pregunta::find($id);
        $request['calificacionRespuesta'] = $request['calificacion'] / $request['cantidadCorrectas'];
        $pregunta->update($request->all());
        return $pregunta->id_pregunta;
    } 

}
