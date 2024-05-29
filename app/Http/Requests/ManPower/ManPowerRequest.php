<?php
namespace App\Http\Requests\ManPower;

use App\Http\Requests\Request;

class ManPowerRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        $rules = [
            'contractor_id' => 'required|unique_with:trans_man_power,contractor_id,year,site_id,'.$this->get('id'),
            // 'area' => 'required',
            'year' => 'required',
            'date_taken' => 'required',
        ];

        return $rules;
    }

    public function attributes()
    {
       return [
        'contractor_id' => 'Contractor'
       ];
    }

    public function messages()
    {
        return [
            'unique_with' => 'There is the same data on contractors and years',
            'required' => 'The data cannot be empty'
        ];
    }

}
