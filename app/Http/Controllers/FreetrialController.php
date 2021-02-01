<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\FreeTrial;

class FreetrialController extends Controller
{

    public function index()
    {
        return view('free_trial.index');
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
        $totalg = FreeTrial::count();
        $sql = FreeTrial::orderBY($sidx,$sord)->limit($limit)->offset($start)->get();

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
            $Lista->rows[$Index]['id'] = $Datos->id_freetrial;
            $Lista->rows[$Index]['cell'] = array(
                $Datos->id_freetrial,
                $Datos->nombre,
                $Datos->correo,
                $Datos->fecha,
                $Datos->hora,
                $Datos->zona_horaria,
                ($Datos->dele == 1) ? 'SI' : 'NO'
            );
        }
        return response()->json($Lista);
    }

}
