<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\VentaDetalle;
use Carbon\Carbon;

class VentaController extends Controller
{

    public function index()
    {
        return view('venta.index');
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
        $totalg = VentaDetalle::count();
        $sql = VentaDetalle::orderBY($sidx,$sord)->limit($limit)->offset($start)->get();

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
            $Lista->rows[$Index]['id'] = $Datos->id_ventadetalle;
            $Lista->rows[$Index]['cell'] = array(
                $Datos->id_ventadetalle,
                $Datos->cabecera->nombres,
                $Datos->cabecera->email,
                Carbon::parse($Datos->cabecera->fecha)->format('Y-m-d'),
                $Datos->item->plan,
                $Datos->item->titulo . ' - ' . $Datos->item->descripcion,
                '$'.$Datos->item->precio
            );
        }
        return response()->json($Lista);
    }

}
