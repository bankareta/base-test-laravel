<?php

namespace App\Http\Requests\WorkPermit;

use App\Http\Requests\Request;

class ScaffoldPermitRegisterRequest extends Request
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
            'sheet_no' => 'required',
            'date' => 'required',
            'detail' => 'required',
            'company' => 'required',
        ];

        return $rules;
    }
    public function attributes()
    {
       return [
           
       ];
    }
}
