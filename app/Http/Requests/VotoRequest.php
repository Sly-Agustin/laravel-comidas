<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VotoRequest extends FormRequest
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
            'star' => ['required', 'integer', 'between:1,5'],
        ];
    }

    public function messages(){
        return [
            'star.required' => 'Seleccione una calificación',
            'star.integer' => 'Calificación no entera, este error solo puede saltar modificando el html, no lo haga por favor',
            'star.between' => 'Calificación fuera de rango, este error solo puede saltar modificando el html, no lo haga por favor',
        ];
    }
}
