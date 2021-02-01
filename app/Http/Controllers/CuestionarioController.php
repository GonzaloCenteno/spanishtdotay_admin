<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Cuestionario;
use App\Http\Models\CuestionarioPregunta;
use App\Http\Models\Pregunta;
use App\Http\Models\Respuesta;
use App\Http\Requests\CuestionarioRequest;
use App\Http\Requests\ValidacionesRequest;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CuestionarioController extends Controller
{
    public function index()
    {
        return view('cuestionario.index');
    }

    public function create(Request $request)
    {
        if($request['tipo'] == '1')
        {
            return view('cuestionario/create');
        }
        else
        {
            return view('cuestionario/builder');
        }
    }

    public function edit($id)
    {
        return view('cuestionario.edit', [
            'cuestionario' => Cuestionario::where('id_cuestionario',$id)->first()
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
        $totalg = Cuestionario::count();
        $sql = Cuestionario::orderBY($sidx,$sord)->limit($limit)->offset($start)->get();

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
            $Lista->rows[$Index]['id'] = $Datos->id_cuestionario;
            $Lista->rows[$Index]['cell'] = array(
                $Datos->id_cuestionario,
                $Datos->nombre,
                '<a type="button" href="'.route('cuestionario_pregunta.edit',$Datos->id_cuestionario).'" class="btn btn-outline-secondary btn-xs btn-block"><i class="fa fa-edit fa-2x"></a>',
                ($Datos->estado == 1) ? '<div class="switch-button switch-button-yesno">
                                            <input type="checkbox" class="check_pregunta" onChange="cambiar_estado('.$Datos->id_cuestionario.',0)" checked id="switch_'.$Datos->id_cuestionario.'"><span>
                                                  <label for="switch_'.$Datos->id_cuestionario.'"></label></span>
                                        </div>'
                                    : '<div class="switch-button switch-button-yesno">
                                            <input type="checkbox" class="check_pregunta" onChange="cambiar_estado('.$Datos->id_cuestionario.',1)" id="switch_'.$Datos->id_cuestionario.'"><span>
                                                  <label for="switch_'.$Datos->id_cuestionario.'"></label></span>
                                        </div>'
            );
        }
        return response()->json($Lista);
    }

    public function store(CuestionarioRequest $request)
    {
        if(!$request->ajax()) return redirect('/');
        return Cuestionario::create([
            'nombre' => $request['nombre'],
            'resumen' => $request['resumen'],
            'url' => $request['url'],
            'imagen' => $this->agregar_imagen($request->file('imagen')), 
            'descripcion'=> $request['descripcion']
        ]);
    }

    public function update(CuestionarioRequest $request, $id)
    {
        if(!$request->ajax()) return redirect('/');
        $cuestionario = Cuestionario::find($id);
        $imagen = $this->agregar_imagen($request->file('imagen'));
        if($imagen)
        {
            $cuestionario->update([
                'nombre' => $request['nombre'],
                'resumen' => $request['resumen'],
                'url' => $request['url'],
                'imagen' => $imagen, 
                'descripcion'=> $request['descripcion']
            ]);
        }
        else
        {
            $cuestionario->update([
                'nombre' => $request['nombre'],
                'resumen' => $request['resumen'],
                'url' => $request['url'],
                'descripcion'=> $request['descripcion']
            ]);
        }
        return $cuestionario->id_cuestionario;
    } 

    private function agregar_imagen($imagen){
        if($imagen)
        {
            $bandera = Str::random(12);
            $filename = $imagen->getClientOriginalName();
            $fileserver = $bandera.'_'.$filename;
            $imagen->move(public_path('images/blog/gramatica/'), htmlentities($fileserver));
            return 'images/blog/gramatica/'.$fileserver;
        }
        else
        {
            return false;
        }
    }

    public function guardar(ValidacionesRequest $request)
    {
        if(!$request->ajax()) return redirect('/');

        DB::beginTransaction();
        try{

            $cuestionario = Cuestionario::create([
                'nombre' => $request['nombre_cuestionario'],
                'resumen' => $request['resumen'],
                'url' => $request['url'],
                'imagen' => $this->agregar_imagen($request->file('imagen')), 
                'descripcion'=> $request['descripcion']
            ]);

            foreach($request['selector_pregunta'] as $i => $data_pregunta) 
            {
                $pregunta = Pregunta::create([
                    'pregunta' => $request['nombre_pregunta'][$i],
                    'detalle' => $request['detalle'][$i],
                    'fecha_creacion' => date('Y-m-d'),
                    'calificacion' => $request['calificacion'][$i],
                    'tipo' => $request['tipo'][$i],
                    'cantidadCorrectas' => $request['cantidadCorrectas'][$i],
                    'calificacionRespuesta' => round($request['calificacion'][$i] / $request['cantidadCorrectas'][$i], 2)
                ]);

                CuestionarioPregunta::create([
                    'id_cuestionario' => $cuestionario->id_cuestionario,
                    'id_pregunta' => $pregunta->id_pregunta,
                    'estado' => 1
                ]);

                foreach($request['selector_respuesta'] as $j => $data_respuesta)
                {
                    if($data_pregunta == $data_respuesta)
                    {
                        $respuesta = Respuesta::create([
                            'respuesta' => $request['respuesta'][$j],
                            'estado' => $request['estado'][$j],
                            'id_pregunta' => $pregunta->id_pregunta
                        ]); 
                    }
                }
            }

            DB::commit();
            return $cuestionario->id_cuestionario;

        } catch (\Exception $ex) {
            DB::rollback();             
            return $ex->getMessage();               
        }
    }

    public function cambiar_estado(Request $request, $id)
    {
        $cuestionario = Cuestionario::find($id);
        $cuestionario->update([
            'estado' => $request['estado']
        ]);
        return $cuestionario->id_cuestionario;
    }
}
