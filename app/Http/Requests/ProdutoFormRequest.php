<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoFormRequest extends FormRequest
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
            'produto' => 'required|min:3|max:50',
            'codigo_barra' => 'required|numeric',
            'preco' => 'required',
            'categoria' => 'required',
            'descricao' => 'min:0|max:255'
        ];
    }
    
    public function messages() {
        return [
            'produto.required' => 'O campo Produto deve ser preenchido.',
        ];
    }
}
