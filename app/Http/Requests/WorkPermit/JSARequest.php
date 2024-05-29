<?php

namespace App\Http\Requests\WorkPermit;

use App\Http\Requests\Request;

class JSARequest extends Request
{
     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        $rules = [
            'project_id' => 'required',            
            'job_desc' => 'required',
            'location' => 'required|max:185',
            'team_leader' => 'required',
            'reviewed_by' => 'required',
            'approved_by' => 'required',
            'supervisior' => 'required',
            'site_id' => 'required',
            'assembly_area' => 'required|max:1000',
            'date' => 'required',
            'status' => 'required|max:185',
            'attendence.*.name' => 'required|max:185',
            'attendence.*.company' => 'required|max:185',
            'detail.*.sequence' => 'required|max:1000',
            'detail.*.potential_hazard' => 'required|max:1000',
            'detail.*.recommendation' => 'required|max:1000',
            'detail.*.pic' => 'required|max:185',
        ];

        return $rules;
    }
    
    public function messages()
    {
        return [
            'unique_with' => 'There is the same data on Company',
            'max' => 'Sentence length cannot exceed :max characters',
            'required' => 'The data cannot be empty',
            'numeric' => 'The data must be number'
        ];
    }
}
