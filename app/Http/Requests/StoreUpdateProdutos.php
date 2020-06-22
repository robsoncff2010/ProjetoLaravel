<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateProdutos extends FormRequest
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
        // regra de escessão para id ex: 'name'=>'required|min:3|max:10|unique:produtos, name, {$id}, id',
        $id = $this->segment(2);

        return [
            'name'=>"required|min:3|max:10|unique:produtos,name,{$id},id",
            'description'=>'required|min:3|max:100',
            'price'=>"required|regex:/^\d+(\.\d{1,2})?$/",
            'image'=>'nullable|image' 
        ];
    }

    public function messages()
    {
        return [
            'name.max' => 'Campo nome tem o máximo de 10 caracteres!',
            'name.required' => 'Campo nome e obrigatório!',            
            'description.required' => 'Campo descrição e obrigatório!',
            'price.required' => 'Campo valor e obrigatório!',
            'price.regex' => 'Campo valor não pode conter vírgula, favor usar ponto ex: "10.45"!'

        ];
    }
}
