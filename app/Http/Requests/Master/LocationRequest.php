<?php
namespace App\Http\Requests\Master;

use App\Http\Requests\Request;

class LocationRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        $rules = [
            'name' => 'required|unique_with:ref_location,site_id,'.$this->get('id'),
            'site_id' => 'required'
        ];

        return $rules;
    }

    public function attributes()
    {
       return [
            'name' => 'Location',
            'site_id' => 'Company'
       ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute cannot be empty',
            'unique_with' => ':attribute There is the same data on Company',
        ];
    }

}
