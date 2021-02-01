<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PreguntaRequest extends FormRequest
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
            'pregunta' => 'required',
            'calificacion' => 'required',
            'tipo' => 'required',
            'cantidadCorrectas' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'pregunta.required' => 'EL CAMPO PREGUNTA ES OBLIGATORIO',
            'calificacion.required' => 'EL CAMPO CALIFICACION ES OBLIGATORIO',
            'tipo.required' => 'EL CAMPO TIPO ES OBLIGATORIO',
            'cantidadCorrectas.required' => 'EL CAMPO CANTIDAD CORRECTAS ES OBLIGATORIO'
        ];
    }
}
