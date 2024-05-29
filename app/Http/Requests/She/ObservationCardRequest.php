<?php
namespace App\Http\Requests\She;

use App\Http\Requests\Request;

class ObservationCardRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        if(Request::isMethod('put')){
            if(isset($this->slug)){
                $rules = [
                    'date' => 'required',
                    'finding' => 'required',
                    'category_id.*' => 'required',
                    'action' => 'required',
                    'note' => 'required',
                    'corrective' => 'required',
                    'follow_up' => 'required',
                    'comments' => 'required',
                ];
            }else{
                $rules = [
                    'site_id' => 'required',
                    'company' => 'required',
                    'location' => 'required',
                    // 'location_detail' => 'required',
                    'date' => 'required',
                    'observer_name' => 'required',
                    'finding' => 'required',
                    // 'type' => 'required',
                    'category_id.*' => 'required',
                    'action' => 'required',
                    'note' => 'required',
                    'corrective' => 'required',
                    'follow_up' => 'required',
                    // 'sources' => 'required',
                    'comments' => 'required',
                    'obs_department_id' => 'required',
                    'department_id' => 'required',
                    // 'foto' => 'required',
                ];
            }
        }else{            
            $rules = [
                'site_id' => 'required',
                'company' => 'required',
                'location' => 'required',
                // 'location_detail' => 'required',
                'date' => 'required',
                'observer_name' => 'required',
                'finding' => 'required',
                // 'type' => 'required',
                'category_id.*' => 'required',
                'action' => 'required',
                'note' => 'required',
                'corrective' => 'required',
                'follow_up' => 'required',
                // 'sources' => 'required',
                'comments' => 'required',
                'obs_department_id' => 'required',
                'department_id' => 'required',
                'foto' => 'required',
            ];
        }

        return $rules;
    }
    public function attributes()
    {
       return [
            "site_id" => '',
            "company" => '',
            "location" => '',
            "location_detail" => '',
            "date" => '',
            "observer_name" => '',
            "finding" => '',
            "type" => '',
            "category_id.*" => '',
            "action" => '',
            "note" => '',
            "corrective" => '',
            "follow_up" => '',
            "sources" => '',
            "comments" => '',
            "foto" => '',
            "obs_department_id" => '',
            "department_id" => '',
       ];
    }

}
