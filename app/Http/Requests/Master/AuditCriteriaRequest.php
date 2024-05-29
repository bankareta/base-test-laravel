<?php
namespace App\Http\Requests\Master;

use App\Http\Requests\Request;

class AuditCriteriaRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        $rules = [
            'name' => 'required|max:300|unique:ref_criteria_audit,name,'.$this->get('id'),
        ];

        return $rules;
    }
    public function attributes()
    {
       return [

       ];
    }

}
