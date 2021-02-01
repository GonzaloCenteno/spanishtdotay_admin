<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BlogRequest extends FormRequest
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
            'titulo' => ['required', Rule::unique('blog')->ignore($this->blog,'idblog')],
            'subtitulo' => 'required',
            'imagen' => 'required|mimes:jpg,jpeg,bmp,png',
            'contenido' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'titulo.required' => 'EL CAMPO TITULO ES OBLIGATORIO',
            'titulo.unique' => 'ESTE REGISTRO YA FUE INGRESADO',
            'subtitulo.required' => 'EL CAMPO SUBTITULO ES OBLIGATORIO',
            'imagen.required' => 'EL CAMPO IMAGEN ES OBLIGATORIO',
            'imagen.mimes' => 'LA IMAGEN DEBE SER UN ARCHIVO CON FORMATO JPG, JPEG, BMP, PNG.',
            'contenido.required' => 'EL CAMPO CONTENIDO ES OBLIGATORIO',
        ];
    }
}
