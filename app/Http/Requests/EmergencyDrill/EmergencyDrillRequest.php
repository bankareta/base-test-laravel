<?php
namespace App\Http\Requests\EmergencyDrill;

use App\Http\Requests\Request;

class EmergencyDrillRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        $rules = [
            'title'=> 'required',
            'date'=> 'required',
            'time_alarm'=> 'required',
            'time_drill'=> 'required',
            'time_evacuate'=> 'required',
            'type'=> 'required',
            'notification'=> 'required',
            'weather'=> 'required',
            'situation'=> 'required',
            'management_trained'=> 'required',
            'employees_trained'=> 'required',
            'incident_command'=> 'required',
            'desc_incident_command'=> 'required',
            'operations_chief'=> 'required',
            'extenuating'=> 'required|max:1000',
            'explain_corrective'=> 'required|max:1000',
            'no_doc'=> 'required|max:100|unique:trans_emergency_drill,no_doc,'.$this->get('id'),
            'site_id'=> 'required',
        ];

        return $rules;
    }
    public function attributes()
    {
       return [
            'title' => '',
            'date' => '',
            'time_alarm' => '',
            'time_drill' => '',
            'time_evacuate' => '',
            'type' => '',
            'notification' => '',
            'weather' => '',
            'situation' => '',
            'management_trained' => '',
            'employees_trained' => '',
            'incident_command' => '',
            'desc_incident_command' => '',
            'operations_chief' => '',
            'extenuating' => '',
            'explain_corrective' => '',
            'no_doc' => '',
            'site_id' => '',
       ];
    }

}
