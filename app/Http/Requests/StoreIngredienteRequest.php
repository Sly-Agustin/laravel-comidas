<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\EsImagenValida;
use App\Rules\IngredienteExisteEnDB;

class StoreIngredienteRequest extends FormRequest
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
            'nombre' => ['required', 'min:3', new IngredienteExisteEnDB],
            'ingredienteCaracteristica' => ['nullable'],
            'ingredienteDescripcion' => ['nullable'],
            'ingredienteUbicacion' => ['nullable'],
            'ingredienteTipo' => ['required', 'in:especia,carne,aceite,lacteo,fiambre,arroz,legumbre,fruta,verdura,alcohol,otro,harina'],
            'imagen' => ['nullable', new EsImagenValida],
        ];
    }

    public function messages(){
        return [
            'nombre.required' => 'Es necesario poner un nombre',
            'nombre.min' => 'El nombre debe tener un mínimo de 3 caracteres',
            'ingredienteTipo.required' => 'Es necesario especificar el tipo de ingrediente',
            'ingredienteTipo.in' => 'Seleccionada una categoría inválida, esto solo puede hacerse modificando el HTML de la página, no lo haga por favor',
        ];
    }

    public function response(array $errors){
        return back()
            ->withErrors($errors, 'erroresIngrediente')
            ->withInput();
    }
}
