<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProductCreate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => "required|string|min:2|max:200",
            "description" => "required|string",
            "price" => "required|min:0|max:99999999.99",
            "weight" => "required|min:0|max:9999999999999999.9999",
            "thumbnail" => "nullable|file|mimes:jpeg,jpg,png"
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "Informe o nome do Produto",
            "name.string" => "Nome inválido para o Produto",
            "name.min" => "Nome do produto muito curto",
            "name.max" => "Nome do produto muito longo",
            "description.required" => "Informe o texto descritivo sobre o produto",
            "description.string" => "Texto inválido",
            "price.required" => "Informe o Preço do Produto",
            "price.min" => "Preço menor que o controlado pela Plataforma",
            "price.max" => "Preço extrapola ao controlado pela Plataforma",
            "weight.required" => "Informe o Peso",
            "weight.min" => "Peso menor que o controlado pela Plataforma",
            "weight.max" => "Peso extrapola ao controlado pela Plataforma",
            "thumbnail.file" => "Arquivo inválido",
            "thumbnail.mimes" => "Permitido apenas JPG e PNG"
        ];
    }
}
