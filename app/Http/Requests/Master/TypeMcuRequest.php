<?php
namespace App\Http\Requests\Master;

use App\Http\Requests\Request;

class TypeMcuRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        $rules = [
            'name' => 'required|max:150|unique:ref_mcu_type,name,'.$this->get('id'),
        ];

        return $rules;
    }

    public function attributes()
    {
       return [
            'name' => 'Type'
       ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute cannot be empty',
            'unique' => ':attribute has already been taken',
        ];
    }

}
