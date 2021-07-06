<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Ingrediente;

class IngredienteExisteEnDB implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $minuscula=strtolower($value);
        $estaEnDB=Ingrediente::where('nombre', $minuscula)->get();
        if ($estaEnDB=='[]'){
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El ingrediente ya existe en la base de datos.';
    }
}
