<?php
namespace App\Http\Requests\Master;

use App\Http\Requests\Request;

class VaccineStatusRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        $rules = [
            'name' => 'required|max:150|unique:ref_vaccine_status,name,'.$this->get('id'),
            // 'description' => 'required',
        ];

        return $rules;
    }
    public function attributes()
    {
       return [
        'name' => 'Vaccine Status',
       ];
    }

}
