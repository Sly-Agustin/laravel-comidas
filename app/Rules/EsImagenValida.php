<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class EsImagenValida implements Rule
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
        if($value->isValid()) {
            try {
                /* Si no podemos obtener el tamaño de la imagen, se nos pasó una imagen no válida (modificando un archivo 
                .txt a .jpg y tratando de hacerlo pasar por ejemplo).*/ 
                $size = getimagesize($value);
                if ($size === false) {
                    return false;
                }

                /*Algunos archivos modificados pueden pasar la verificación de arriba, por ejemplo un script con atributos
                de archivo seteados apropósito para hacerlo pasar por imagen. Sin embargo podemos tratar de crear la imagen
                a partir del archivo, si esto falla entonces no es una imagen. Esto agrega seguridad al sistema para evitar la
                ejecución de scripts (o eso leí por ahí, si me equivoco corrijanme). 
                No funciona en heroku, ver porque mientras tanto dejarlo comentado*/
                /*$esImagen=imagecreatefromstring(file_get_contents($value->path()));
                if (!$esImagen) {
                    return false;
                }
                return true;*/
            } 
            catch (FileNotFoundException $e) {
                echo "catch";
                return false;
            }
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Imagen no válida.';
    }
}
