<?php
namespace App\Http\Requests\Master;

use App\Http\Requests\Request;

class ManPowerRecordRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        $rules = [
            'name' => 'required|max:150|unique:ref_man_record,name,'.$this->get('id'),
            'hitung' => 'required',
        ];

        return $rules;
    }
    public function attributes()
    {
       return [
           'hitung' => 'Calculation'
       ];
    }

}
