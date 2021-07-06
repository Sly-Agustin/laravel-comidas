<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\EsImagenValida;

class UpdateFotoRequest extends FormRequest
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
            'imagen' => ['required', new EsImagenValida]
        ];
    }

    public function messages(){
        return [
            'imagen.required' => 'Es necesaria una imagen',
        ];
    }

    public function response(array $errors){
        return back()
            ->withErrors($errors, 'erroresComida')
            ->withInput();
    }
}
