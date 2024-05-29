<?php
namespace App\Http\Requests\Audit;

use App\Http\Requests\Request;

class AuditPtwRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        if(Request::isMethod('put')){
            
        }else{  
        
        }


        if($this->location_type == 2){
            $rules1 = [
                'location' => 'required',
            ];
        }else{
            $rules1 = [
                'location_manual' => 'required',
            ];
        }
        
        if($this->performing_type == 2){
            $rules1 = [
                'performing_contractor' => 'required',
            ];
        }else{
            $rules1 = [
                'performing_user_id' => 'required',
            ];
        }
        $rules = [
            'site_id' => 'required',
            'criteria_id.*' => 'required',
            'name' => 'required',
            'permit_id' => 'required',
            'date_audit' => 'required',
            'permit_type_id' => 'required',
            'permit_no' => 'required',
            'performing_type' => 'required',
            'location_type' => 'required',
        ];
        return array_merge($rules,$rules1);
    }
    public function attributes()
    {
       return [
            "site_id" => '',
            "name" => '',
            "permit_id" => '',
            "date_audit" => '',
            "permit_type_id" => '',
            "permit_no" => '',
            "performing_type" => '',
            "performing_user_id" => '',
            "performing_contractor" => '',
            "location_type" => '',
            "location" => '',
            "location_manual" => '',
            "location_type" => '',
            "criteria_id.*" => '',
       ];
    }

}
