<?php
namespace App\Http\Requests\Monitoring;

use App\Http\Requests\Request;

class PobReportingRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        $rules_ext = [];
        $rules = [
            'site_id' => 'required',
            'company' => 'required',
            'resident_status' => 'required',
            'sex' => 'required',
            'age' => 'required',
            'domicile' => 'required',
            'position' => 'required',
            'date_arrive' => 'required',
            'reason_entry_id' => 'required',
            'vaccine_status_id' => 'required',
            'rapid_status' => 'required',
            'pcr_status' => 'required',
        ];
        if(request()->resident_status){
            switch (request()->resident_status) {
                case 'Employee':
                    $rules_ext = [
                        'employee_id' => 'required',
                        'employee_name' => 'required',
                    ];
                    break;
                case 'Contractor':
                    $rules_ext = [
                        'employee_id' => 'required',
                        'contractor_name' => 'required',
                    ];
                    break;
                case 'Visitor':
                    $rules_ext = [
                        'nik' => 'required',
                        'visitor_name' => 'required',
                    ];
                    break;
                
                default:
                    break;
            }
        }
        return array_merge($rules,$rules_ext);
    }
    public function attributes()
    {
       return [
            "site_id" => '',
            "company" => '',
            "resident_status" => '',
            "employee_id" => '',
            "nik" => '',
            "employee_name" => '',
            "sex" => '',
            "age" => '',
            "domicile" => '',
            "position" => '',
            "date_arrive" => '',
            "time_arrive" => '',
            "reason_entry_id" => '',
            "contractor_name" => '',
            "vaccine_status_id" => '',
            "rapid_status" => '',
            "pcr_status" => '',
            "visitor_name" => '',
       ];
    }

}
