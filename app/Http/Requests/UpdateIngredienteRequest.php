<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateIngredienteRequest extends FormRequest
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
            'visibilidadIngrediente' => ['required','in:0,1']
        ];
    }

    public function messages(){
        return [
            'visibilidadIngrediente.required' => 'Debe especificarse la visibilidad, este error solo puede saltar modificando el html, no lo haga por favor',
            'visibilidadIngrediente.in' => 'La visibilidad solo puede ser visible o invisible, este error solo puede saltar modificando el html, no lo haga por favor',
        ];
    }

    public function response(array $errors){
        return back()
            ->withErrors($errors, 'erroresIngrediente')
            ->withInput();
    }
}
