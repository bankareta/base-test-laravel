<?php
namespace App\Http\Requests\FreshEye;

use App\Http\Requests\Request;

class FreshEyeRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        $rules = [
            'site_id'=> 'required',
            'observer_id'=> 'required',
            'date'=> 'required',
            'time'=> 'required',
            'number_workers'=> 'required',
            'employee'=> 'required',
            'number_contractor'=> 'required',
            'area'=> 'required',
            'total_safe'=> 'required',
            'total_risk'=> 'required',
            'feedback'=> 'required',
        ];

        return $rules;
    }
    public function attributes()
    {
       return [
            'site_id' => '',
            'observer_id' => '',
            'date' => '',
            'time' => '',
            'number_workers' => '',
            'employee' => '',
            'number_contractor' => '',
            'area' => '',
            'total_safe' => '',
            'total_risk' => '',
            'feedback' => '',
       ];
    }

}
