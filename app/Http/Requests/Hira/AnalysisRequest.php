<?php
namespace App\Http\Requests\Hira;

use App\Http\Requests\Request;

class AnalysisRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        $rules = [
            'title' => 'required|max:20',
            'site_id' => 'required',
            'analysis_by' => 'required',
            'reviewed_by' => 'required',
            'approved_by' => 'required',
            'step.process_step.*' => 'required',
            'step.potential_hazard.*' => 'required',
            'step.risk_level_likelihood.*' => 'required',
            'step.risk_level_consequence.*' => 'required',
            'date' => 'required'
        ];

        return $rules;
    }
    public function attributes()
    {
       return [
           'title' => 'Title',
           'site_id' => 'Site',
           'Analysis' => 'required',
           'Reviewer' => 'required',
           'Approval' => 'required',
           'step.process_step.*' => 'Process Step',
           'step.potential_hazard.*' => 'Potential Hazard',
           'step.risk_level_likelihood.*' => 'Risk Level Likelihood',
           'step.risk_level_consequence.*' => 'Risk Level Consequence',
           'date' => 'Date',
       ];
    }

}
