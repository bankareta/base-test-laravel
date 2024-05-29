<?php
namespace App\Http\Requests\Accident;

use App\Http\Requests\Request;

class RegisterAccidentRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        $rules = [
          'type_incident_id' => 'required',
          'site_incident_report_no' => 'required',
          'title' => 'required',
          'project_id' => 'required',
          'site_id' => 'required',
          'year' => 'required',
          'time' => 'required',
          'date' => 'required',
          'class_of_incident_id' => 'required',
          'geothermal' => 'required',
          'report_to_ebtke' => 'required',
          'location' => 'required',
          'severity_level' => 'required',
          'brief_incident_notification' => 'required',
          'dept_id' => 'required',
          'report_by' => 'required',
          'name_of_party' => 'required',
          'title_of_the_party' => 'required',
          'mechanism_of_incident_id' => 'required',
          'agent_of_incident_id' => 'required',
          'causes_category_id.*' => 'required',
          'causes_details_id.*' => 'required',

          'short_term_actions.0' => 'required',
          'pic_once.0' => 'required',
          'completion_date_target_once.0' => 'required',
          'implementation_status_once.0' => 'required',
          'pic_two.0' => 'required',
          'completion_date_target_two.0' => 'required',
          'implementation_status_two.0' => 'required',
          'long_term_actions.0' => 'required',
        ];

        return $rules;
    }

    public function attributes()
    {
       return [
        'type_incident_id' => '',
        'site_incident_report_no' => '',
        'title' => '',
        'project_id' => '',
        'site_id' => '',
        'datetime' => '',
        'class_of_incident' => '',
        'geothermal' => '',
        'report_to_ebtke' => '',
        'location' => '',
        'severity_level' => '',
        'brief_incident_notification' => '',
        'dept' => '',
        'report_by' => '',
        'name_of_party_id' => '',
        'title_of_the_party' => '',
        'mechanism_of_incident' => '',
        'agent_of_incident' => '',
        'causes_category.*' => '',
        'causes_details.*' => '',
        'short_term_actions.0' => '',
        'pic_once.0' => '',
        'completion_date_target_once.0' => '',
        'implementation_status_once.0' => '',
        'pic_two.0' => '',
        'completion_date_target_two.0' => '',
        'implementation_status_two.0' => '',
        'long_term_actions.0' => '',
       ];
    }
}
