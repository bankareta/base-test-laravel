<?php
namespace App\Http\Requests\Master;

use App\Http\Requests\Request;

class ComponentRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        $rules = [
            'component' => 'required|max:150|unique:ref_component,component,'.$this->get('id'),
            'type_id' => 'required|max:150',
        ];

        return $rules;
    }
    public function attributes()
    {
       return [

       ];
    }

}
