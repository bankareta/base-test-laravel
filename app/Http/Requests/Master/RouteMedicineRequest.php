<?php
namespace App\Http\Requests\Master;

use App\Http\Requests\Request;

class RouteMedicineRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        $rules = [
            'name' => 'required|max:150|unique:ref_route_medicine,name,'.$this->get('id'),
        ];

        return $rules;
    }

    public function attributes()
    {
       return [
            'name' => 'Route'
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
