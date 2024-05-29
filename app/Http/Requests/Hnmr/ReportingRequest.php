<?php
namespace App\Http\Requests\Hnmr;

use App\Http\Requests\Request;

class ReportingRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        $rules = [
            'reportby' => 'required',
            'date' => 'required',
            'supervisor' => 'required',
            'department_id' => 'required',
            'site_id' => 'required',
            'location' => 'required|max:1000',
            'report' => 'required|max:1000',
        ];

        return $rules;
    }
    public function attributes()
    {
       return [
           'reportedby' => 'Reported By',
           'date' => 'Date',
           'supervisor' => 'Supervisor',
           'department_id' => 'Department',
           'site_id' => 'Site',
           'location' => 'Location',
           'report' => 'Report',
       ];
    }

     public function messages()
    {
        return [
            'required' => ':attribute cannot be empty',
            'max'  => 'The :attribute may not be greater than :max characters.',
        ];
    } 
}
