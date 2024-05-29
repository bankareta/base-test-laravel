<?php
namespace App\Http\Requests\Tbm;

use App\Http\Requests\Request;

class DataRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        $rules = [
            // 'name' => 'required|max:150|unique:ref_departement,name,'.$this->get('id'),
            'site_id' => 'required',
            'leader_id' => 'required',
            'topic' => 'required|max:100|unique:trans_tbm,topic,'.$this->get('id'),
            'location' => 'required|max:50',
            'total_participants' => 'required|max:100',
            'date' => 'required',
            'time' => 'required',
            'description' => 'required|max:1000',
            'type_id' => 'required',
        ];

        return $rules;
    }
    public function attributes()
    {
       return [
           'site_id' => 'site',
           'leader_id' => 'leader',
           'type_id' => 'type',
       ];
    }

}
