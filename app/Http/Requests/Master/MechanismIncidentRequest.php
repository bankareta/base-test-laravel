<?php
namespace App\Http\Requests\Master;

use App\Http\Requests\Request;

class MechanismIncidentRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        $rules = [
            'detail' => 'required|max:150|unique:ref_mechanism_incident,detail,'.$this->get('id'),
        ];

        return $rules;
    }
    public function attributes()
    {
       return [

       ];
    }

}
