<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CuestionarioRequest extends FormRequest
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
        switch($this->method())
        {
            case 'POST':
            {
                return [
                    'nombre' => 'required',
                    'descripcion' => 'required',
                    'resumen' => 'required',
                    'url' => 'nullable|url',
                    'imagen' => 'required|mimes:jpg,jpeg,bmp,png'
                ];
            }
            case 'PUT':
            {
                return [
                    'nombre' => 'required',
                    'descripcion' => 'required',
                    'resumen' => 'required',
                    'url' => 'nullable|url',
                    'imagen' => 'mimes:jpg,jpeg,bmp,png'
                ];
            }
            default:break;
        }
    }

    public function messages()
    {
        return [
            'nombre.required' => 'EL CAMPO NOMBRE ES OBLIGATORIO',
            'descripcion.required' => 'EL CAMPO DESCRIPCION ES OBLIGATORIO',
            'resumen.required' => 'EL CAMPO RESUMEN ES OBLIGATORIO',
            'imagen.required' => 'EL CAMPO IMAGEN ES OBLIGATORIO',
            'url.url' => 'EL FORMATO URL ES INVALIDO',
            'imagen.mimes' => 'LA IMAGEN DEBE SER UN ARCHIVO CON FORMATO JPG, JPEG, BMP, PNG.'
        ];
    }
}
