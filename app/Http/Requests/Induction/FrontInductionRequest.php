<?php
namespace App\Http\Requests\Induction;

use App\Http\Requests\Request;

class FrontInductionRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        $rules = [
            'full_name' => 'required',
            'department_id' => 'required',
            'identity_number' => 'required',
            'induction_id' => 'required',
            'purpose' => 'required',
        ];

        return $rules;
    }
    public function attributes()
    {
       return [
           'full_name' => 'Fullname',
           'department_id' => 'Department',
           'induction_id' => 'Materials',
           'purpose' => 'Purposes',
           'identity_number' => 'Identity Number'
       ];
    }

}
