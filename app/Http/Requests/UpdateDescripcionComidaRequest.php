<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDescripcionComidaRequest extends FormRequest
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
            'descripcion' => ['required'],
        ];
    }

    public function messages(){
        return [
            'descripcion.required' => 'La descripción no puede ser vacía',
        ];
    }

    public function response(array $errors){
        return back()
            ->withErrors($errors, 'erroresComida')
            ->withInput();
    }
}
