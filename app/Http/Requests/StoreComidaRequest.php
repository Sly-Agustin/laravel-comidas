<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ComidaExisteEnDB;

class StoreComidaRequest extends FormRequest
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
            'nombre' => ['required', 'min:4', 'unique:comidas', new ComidaExisteEnDB]   # El unique es redundante? Creo que ya se comprueba en la regla ComidaExisteEnDB. Testear
        ];
    }

    public function messages(){
        return [
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.min' => 'El nombre de la comida debe tener un mínimo de 4 caracteres',
            'nombre.unique' => 'La comida ya existe, no es necesario crearla',
        ];
    }

    public function response(array $errors){
        return back()
            ->withErrors($errors, 'erroresComida')
            ->withInput();
    }
}
