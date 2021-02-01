<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Contacto;

class ContactoController extends Controller
{

    public function index()
    {
        return view('contacto.index');
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
        $totalg = Contacto::count();
        $sql = Contacto::orderBY($sidx,$sord)->limit($limit)->offset($start)->get();

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
            $Lista->rows[$Index]['id'] = $Datos->id_contacto;
            $Lista->rows[$Index]['cell'] = array(
                $Datos->id_contacto,
                $Datos->nombre,
                $Datos->correo,
                $Datos->mensaje,
                $Datos->fecha_creacion
            );
        }
        return response()->json($Lista);
    }

}
