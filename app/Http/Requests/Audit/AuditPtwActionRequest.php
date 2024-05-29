<?php
namespace App\Http\Requests\Audit;

use App\Http\Requests\Request;

class AuditPtwActionRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        
        $rules = [
            'corrective_date' => 'required',
            'notes' => 'required',
            'status' => 'required',
        ];
        return $rules;
    }
    public function attributes()
    {
       return [
            "corrective_date" => '',
            "notes" => '',
            "status" => '',
       ];
    }

}
