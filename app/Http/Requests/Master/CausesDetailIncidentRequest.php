<?php
namespace App\Http\Requests\Master;

use App\Http\Requests\Request;

class CausesDetailIncidentRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        $rules = [
            'detail' => 'required|max:150|unique_with:ref_causes_incident_detail,causes_incident_id,detail,'.$this->get('id'),
            'causes_incident_id' => 'required'
        ];

        return $rules;
    }
    public function attributes()
    {
       return [
          'causes_incident_id' => 'Causes'
       ];
    }

}
