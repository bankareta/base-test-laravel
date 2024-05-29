<?php
namespace App\Http\Requests\Audit;

use App\Http\Requests\Request;

class AuditRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        $rules = [
            'year' => 'required',
            'date_audit' => 'required',
            'date_audit' => 'required',
            'action' => 'required',
            'site_id' => 'required',
            'type_id' => 'required',
            'all_user.first.*' => 'required',
            'all_user.second.*' => 'required',
            'all_user.third.*' => 'required',
        ];

        return $rules;
    }
    public function attributes()
    {
       return [
           'audit_by' => 'audit by',
           'date_audit' => 'date',
           'site_id' => 'company ',
           'type_id' => 'type',
           'pic_id' => 'audit PIC',
           'personnel_id' => 'Personnel',
           'all_user.first.*' => 'Audit By',
           'all_user.second.*' => 'Audit PIC',
           'all_user.third.*' => 'Personnel',
       ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute cannot be empty',
            'max'  => 'The :attribute may not be greater than :max characters.',
        ];
    }
}
