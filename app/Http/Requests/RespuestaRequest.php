<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RespuestaRequest extends FormRequest
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
            'respuesta' => 'required',
            'estado' => 'required',
            'id_pregunta' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'respuesta.required' => 'EL CAMPO RESPUESTA ES OBLIGATORIO',
            'estado.required' => 'EL CAMPO ESTADO ES OBLIGATORIO',
            'id_pregunta.required' => 'EL CAMPO PREGUNTA ES OBLIGATORIO'
        ];
    }
}
