<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProductUpdate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => "nullable|string|min:2|max:200",
            "description" => "nullable|string",
            "price" => "nullable|min:0|max:99999999.99",
            "weight" => "nullable|min:0|max:9999999999999999.9999",
            "thumbnail" => "nullable|file|mimes:jpeg,jpg,png"
        ];
    }

    public function messages()
    {
        return [
            "name.string" => "Nome inválido para o Produto",
            "name.min" => "Nome do produto muito curto",
            "name.max" => "Nome do produto muito longo",
            "description.string" => "Texto inválido",
            "price.min" => "Preço menor que o controlado pela Plataforma",
            "price.max" => "Preço extrapola ao controlado pela Plataforma",
            "weight.min" => "Peso menor que o controlado pela Plataforma",
            "weight.max" => "Peso extrapola ao controlado pela Plataforma",
            "thumbnail.file" => "Arquivo inválido",
            "thumbnail.mimes" => "Permitido apenas JPG e PNG"
        ];
    }
}
