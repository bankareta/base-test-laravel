<?php
namespace App\Http\Requests\She;

use App\Http\Requests\Request;

class TrainingRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        if(Request::isMethod('put')){
            if(isset($this->filesname)){
                $rules = [
                    'site_id' => 'required',
                    'type_id' => 'required',
                    // 'number' => 'required',
                    'training_date' => 'required',
                    'expire_date' => 'required',
                    'issued_by' => 'required',
                    'title' => 'required',
                    'department' => 'required',
                    'employee_name' => 'required',
                ];
            }else{
                if(isset($this->materi_deleted_id)){
                    if(count($this->filesexist) == count($this->materi_deleted_id)){
                        $rules = [
                            'site_id' => 'required',
                            'type_id' => 'required',
                            'picture.*' => 'required',
                            'training_date' => 'required',
                            'expire_date' => 'required',
                            'issued_by' => 'required',
                            'title' => 'required',
                            'department' => 'required',
                            'employee_name' => 'required',
                        ];
                    }else{
                        $rules = [
                            'site_id' => 'required',
                            'type_id' => 'required',
                            // 'picture.*' => 'required',
                            'training_date' => 'required',
                            'expire_date' => 'required',
                            'issued_by' => 'required',
                            'title' => 'required',
                            'department' => 'required',
                            'employee_name' => 'required',
                        ];
                    }
                }else{
                    $rules = [
                        'site_id' => 'required',
                        'type_id' => 'required',
                        // 'number' => 'required',
                        'training_date' => 'required',
                        'expire_date' => 'required',
                        'issued_by' => 'required',
                        'title' => 'required',
                        'department' => 'required',
                        'employee_name' => 'required',
                    ];
                }
            }
        }else{            
            $rules = [
                'site_id' => 'required',
                'type_id' => 'required',
                'picture.*' => 'required',
                'training_date' => 'required',
                'expire_date' => 'required',
                'issued_by' => 'required',
                'title' => 'required',
                'department' => 'required',
                'employee_name' => 'required',
            ];
        }

        return $rules;
    }
    public function attributes()
    {
       return [
            "site_id" => '',
            "type_id" => '',
            "training_date" => '',
            "expire_date" => '',
            "issued_by" => '',
            "title" => '',
            "department" => '',
            "employee_name" => '',
            "picture.*" => '',
       ];
    }

}
