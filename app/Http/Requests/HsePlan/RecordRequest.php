<?php
namespace App\Http\Requests\HsePlan;

use App\Http\Requests\Request;

class RecordRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        $rules = [
            'contractor_id' => 'required',
            'project_id' => 'required',
            'date' => 'required',
            'date_issued' => 'required',
            'client' => 'required|max:100',
            'description' => 'required|max:1000',
            'site_id' => 'required',
            'no_doc' => 'required|max:100',
            // 'no_doc' => 'required|max:100|unique:trans_hse_plan,no_doc,'.$this->get('id'),

        ];

        return $rules;
    }
    public function attributes()
    {
       return [
            'contractor_id' => 'contractor',
            'project_id' => 'project',
            'date' => 'Document Date ',
            'file.*' => 'File',
            'no_doc' => 'Document Title',

       ];
    }


}
