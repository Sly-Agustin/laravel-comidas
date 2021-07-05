<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\EsImagenValida;

class UpdateComidaRequest extends FormRequest
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
            'visibilidadComida' => ['required', 'in:0,1'],
            'imagen' => ['nullable', new EsImagenValida],
        ];
    }

    public function messages(){
        return [
            'visibilidadComida.required' => 'Debe especificarse la visibilidad, este error solo puede saltar modificando el html, no lo haga por favor',
            'visibilidadComida.in' => 'La visibilidad solo puede ser visible o invisible, este error solo puede saltar modificando el html, no lo haga por favor',
        ];
    }

    public function response(array $errors){
        return back()
            ->withErrors($errors, 'erroresComida')
            ->withInput();
    }
}
