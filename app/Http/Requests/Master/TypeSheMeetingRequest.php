<?php
namespace App\Http\Requests\Master;

use App\Http\Requests\Request;

class TypeSheMeetingRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        $rules = [
            'name' => 'required|max:150|unique:ref_type_she_meeting,name,'.$this->get('id'),
            'description' => 'required'
        ];

        return $rules;
    }
    public function attributes()
    {
       return [
          
       ];
    }

}
