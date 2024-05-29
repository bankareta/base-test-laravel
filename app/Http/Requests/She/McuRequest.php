<?php
namespace App\Http\Requests\She;

use App\Http\Requests\Request;

class McuRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        if(Request::isMethod('put')){
            if(isset($this->type)){
                if($this->type == 'duplicate'){
                    $rules = [
                        'last_date' => 'required',
                        'result_id' => 'required',
                        'due_date' => 'required', 
                        'type_id' => 'required',
                        'provider' => 'required',
                        'foto' => 'required',
                    ];
                }else{
                    $rules = [
                        'last_date' => 'required',
                        'result_id' => 'required',
                        'due_date' => 'required', 
                    ];
                }
            }else{
                $rules = [
                    'site_id' => 'required',
                    'user_id' => 'required',
                    'name' => 'required',
                    'gender' => 'required',
                    'blood_id' => 'required',
                    'date_birth' => 'required',
                    'company' => 'required',
                    'department' => 'required',
                    'title' => 'required',
                    'type_id' => 'required',
                    'provider' => 'required',
                    // 'last_date' => 'required',
                    // 'result_id' => 'required',
                    // 'due_date' => 'required', 
                    'assign_id' => 'required', 
                    // 'foto' => 'required',
                ];
            }
        }else{            
            $rules = [
                'site_id' => 'required',
                'user_id' => 'required|max:150|unique_with:trans_mcu,user_id'.$this->get('id'),
                'name' => 'required',
                'gender' => 'required',
                'blood_id' => 'required',
                'date_birth' => 'required',
                'company' => 'required',
                'department' => 'required',
                'title' => 'required',
                'type_id' => 'required',
                'provider' => 'required',
                // 'last_date' => 'required',
                // 'result_id' => 'required',
                // 'due_date' => 'required', 
                'assign_id' => 'required', 
                'foto' => 'required',
            ];
        }

        return $rules;
    }
    public function attributes()
    {
       return [
            "site_id" => '',
            "user_id" => '',
            "name" => '',
            "gender" => '',
            "blood_id" => '',
            "date_birth" => '',
            "company" => '',
            "department" => '',
            "title" => '',
            "type_id" => '',
            "last_date" => '',
            "result_id" => '',
            "due_date" => '',
            "assign_id" => '',
            "provider" => '',
            "foto" => '',
       ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute cannot be empty',
            'unique_with' => ':attribute already been taken',
        ];
    }

}
