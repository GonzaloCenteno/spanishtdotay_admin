<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UsuarioRequest extends FormRequest
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
            'nombre' => 'required',
            'email' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'EL CAMPO NOMBRE ES OBLIGATORIO',
            'email.required' => 'EL CAMPO EMAIL ES OBLIGATORIO'
        ];
    }
}
