<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Cuestionario;
use App\Http\Models\CuestionarioPregunta;
use Illuminate\Support\Facades\DB;

class CuestionarioPreguntaController extends Controller
{
    public function edit($id)
    {
        return view('cuestionario_pregunta.edit', [
            'cuestionario' => Cuestionario::where('id_cuestionario',$id)->first()
        ]);
    }

    public function show(Request $request,$id_cuestionario)
    {
        $page = $request['page'];
        $limit = $request['rows'];
        $sidx = $request['sidx'];
        $sord = $request['sord'];
        $start = ($limit * $page) - $limit; 
        if ($start < 0) {
            $start = 0;
        }
        $totalg = DB::select(DB::raw('select count(*) as total from pregunta a
                                        left outer join cuestionario_pregunta b on a.id_pregunta = b.id_pregunta and b.id_cuestionario = :var'), array('var' => $id_cuestionario));
        $sql = DB::select(DB::raw('select a.id_pregunta,a.pregunta,
                                    CASE
                                       WHEN id_cuestionario is null THEN 0
                                       ELSE id_cuestionariopregunta
                                    END valor from pregunta a
                                    left outer join cuestionario_pregunta b on a.id_pregunta = b.id_pregunta and b.id_cuestionario = :var order by '.$sidx.' '.$sord.' limit '.$limit.' offset '.$start), array('var' => $id_cuestionario));

        $total_pages = 0;
        if (!$sidx) {
            $sidx = 1;
        }
        $count = $totalg[0]->total;
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
                ($Datos->valor == 0) ? '<div class="switch-button switch-button-yesno">
                                            <input type="checkbox" class="check_pregunta" onChange="agregar('.$id_cuestionario.','.$Datos->id_pregunta.')" id="switch_'.$Datos->id_pregunta.'"><span>
                                                  <label for="switch_'.$Datos->id_pregunta.'"></label></span>
                                        </div>'
                                    : '<div class="switch-button switch-button-yesno">
                                            <input type="checkbox" class="check_pregunta" onchange="eliminar('.$Datos->valor.')" checked id="switch_'.$Datos->id_pregunta.'"><span>
                                                  <label for="switch_'.$Datos->id_pregunta.'"></label></span>
                                        </div>'
            );
        }
        return response()->json($Lista);
    }

    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $request['estado'] = 1;
        $rspta = CuestionarioPregunta::create($request->all());
        return $rspta->id_cuestionariopregunta;
    }

    public function destroy($id)
    {
        return CuestionarioPregunta::where('id_cuestionariopregunta',$id)->delete();
    }
}
