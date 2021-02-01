<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UsuarioRequest;

class UsuarioController extends Controller
{

    public function index()
    {
    	return view('usuario.index', [
            'usuario' => User::first()
        ]);
        return view('usuario.index');
    }

    public function update(UsuarioRequest $request, $idusuario)
    {
        if(!$request->ajax()) return redirect('/');
        $usuario = User::find($idusuario);
        if($request['password'] != '')
        {
            $request['password'] = Hash::make($request['password']);
        }
        else
        {
            unset($request['password']);
        }
        $usuario->update($request->all());
        return $usuario->idusuario;
    }

}
