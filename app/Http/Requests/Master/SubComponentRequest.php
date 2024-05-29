<?php
namespace App\Http\Requests\Master;

use App\Http\Requests\Request;

class SubComponentRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        $rules = [
            'sub_component' => 'required|max:150|unique:ref_sub_component,component_id,'.$this->get('id'),
            'component_id' => 'required',
            'type_id' => 'required',
        ];

        return $rules;
    }
    public function attributes()
    {
       return [
           
       ];
    }

}
