<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre_cuestionario' => 'required',
            'descripcion' => 'required',
            'resumen' => 'required',
            'url' => 'nullable|url',
            'imagen' => 'required|mimes:jpg,jpeg,bmp,png',
            'nombre_pregunta.*' => 'required',
            'calificacion.*' => 'required',
            'cantidadCorrectas.*' => 'required',
            'respuesta.*' => 'required'
        ]; 
    }

    public function messages()
    {
        return [
            'nombre_cuestionario.required' => 'EL CAMPO NOMBRE ES OBLIGATORIO',
            'descripcion.required' => 'EL CAMPO DESCRIPCION ES OBLIGATORIO',
            'resumen.required' => 'EL CAMPO RESUMEN ES OBLIGATORIO',
            'url.url' => 'EL FORMATO URL ES INVALIDO',
            'imagen.required' => 'EL CAMPO IMAGEN ES OBLIGATORIO',
            'imagen.mimes' => 'LA IMAGEN DEBE SER UN ARCHIVO CON FORMATO JPG, JPEG, BMP, PNG.',
            'nombre_pregunta.*.required' => 'EL CAMPO NOMBRE PREGUNTA ES OBLIGATORIO',
            'calificacion.*.required' => 'EL CAMPO CALIFICACION ES OBLIGATORIO',
            'cantidadCorrectas.*.required' => 'EL CAMPO CANTIDAD CORRECTAS ES OBLIGATORIO',
            'respuesta.*.required' => 'EL CAMPO RESPUESTA ES OBLIGATORIO'
        ];
    }
}
