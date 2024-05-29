<?php
namespace App\Http\Requests\Accident;

use App\Http\Requests\Request;
use App\Models\Accident\ReportFile;

class IncidentRecordRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $req = $this;
        $rules1 = [];
        $rules2 = [];
        if (Request::isMethod('put')) {
          if($req->icident_deleted_id){
            if(count($req->icident_deleted_id) > 0){
              $incident = ReportFile::where('parent_id',$req->id)->whereNotIn('id',$req->icident_deleted_id)->where('base_url','incident')->where('type','action-plan')->get();
              if($incident->count() == 0){
                $rules1 = [
                  'picture2.0' => 'required',
                ];
              }
            }
          }
          if($req->investigation_deleted_id){
            if(count($req->investigation_deleted_id) > 0){
              $investigation = ReportFile::where('parent_id',$req->id)->whereNotIn('id',$req->investigation_deleted_id)->where('base_url','investigation')->where('type','action-plan')->get();
              if($investigation->count() == 0){
                $rules2 = [
                  'picture.0' => 'required',
                ];
              }
            }
          }
        }else{
          $rules1 = [
            'picture.0' => 'required',
            'picture2.0' => 'required',
          ];
        }
        // ambil validasi dasar
        $rules = [
          'site_id' => 'required',
          'incident_location' => 'required|max:250',
          'type_of_incident' => 'required',
          'date_of_incident' => 'required',
          'type_incident_id' => 'required',
          'title' => 'required|max:250',
          'actual_loss' => 'required',
          'potential_loss' => 'required',
          'probability' => 'required',
          'factual_information' => 'required|max:1000',
          'cost_estimate' => 'required|max:100',
          'immediate_actions' => 'required|max:1000',
          'incident_mechanism' => 'required|max:1000',
          'immediate_actions' => 'required|max:1000',
          'incident_mechanism' => 'required|max:1000',
          'data_investigations' => 'required|max:1000',
          'root_cause' => 'required|max:1000',
          'summary' => 'required|max:1000',
          'approver.*' => 'required',
          'prepared_by' => 'required',
          'preparedby_job_title' => 'required|max:250',
          'supervised_by' => 'required',
          'supervisedby_job_title' => 'required|max:250',
          'investigation_request_by' => 'required',
          'recomendation.*' => 'required|max:1000',
          'due_date.*' => 'required',
          'pic.*' => 'required',
        ];

        return array_merge($rules,$rules1,$rules2);
    }
    public function attributes()
    {
       return [
            'site_id' => 'Site',
            'title' => 'Title',
            'type_of_incident' => 'required',
            'incident_location' => 'Location ',
            'preparedby_job_title' => 'Prepared by Job Title',
            'supervisedby_job_title' => 'Supervisor Job Title',
            'investigation_request_by' => 'Investigation Requestor',
            'recomendation.*' => 'Recommendation',
            'due_date.*' => 'Due date',
            'pic.*' => 'PIC',

            'site_id' => 'Company',
            'incident_location' => 'Location',
            'type_of_incident' => 'Type of Incident',
            'date_of_incident' => 'Date of Incident',
            'type_incident_id' => 'Type Incident',
            'title' => 'Title',
            'actual_loss' => 'Actual Loss Serverity',
            'potential_loss' => 'Potential Loss Serverity',
            'probability' => 'Probability of Recurrence',
            'factual_information' => 'Factual Information',
            'cost_estimate' => 'Cost Estimate',
            'immediate_actions' => 'Immediate Actions',
            'incident_mechanism' => 'Incident Mechanism',

            'data_investigations' => 'Data Investigation',
            'root_cause' => 'Root Cause',
            'summary' => 'Summary',
            'approver.*' => 'Approved',
            'prepared_by' => 'Prepared',
            'preparedby_job_title' => 'Prepared Job Title',
            'supervised_by' => 'Supervisor',
            'supervisedby_job_title' => 'Supervisor Job Title',
            'investigation_request_by' => 'Investigation Request',
            'recomendation.*' => 'Recommendation',
            'due_date.*' => 'Due Date',
            'pic.*' => 'PIC',

            'picture.0' => 'File Upload',
            'picture2.0' => 'File Upload',


       ];
    }

    public function message(){
      return [
          'unique_with' => 'There is the same data on Company',
          'max' => 'Sentence length cannot exceed :max characters',
          'required' => 'The data :attr cannot be empty'
      ];
    }

}
