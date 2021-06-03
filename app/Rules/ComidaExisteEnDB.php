<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Comida;

class ComidaExisteEnDB implements Rule
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
        $estaEnDB=Comida::find(1);
        return $estaEnDB==null;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'La comida ya existe en la base de datos.';
    }
}
