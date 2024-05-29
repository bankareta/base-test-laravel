<?php
namespace App\Http\Requests\Accident;

use App\Http\Requests\Request;

class IncidentApprovalRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        $rules = [
          
        ];

        return $rules;
    }
    public function attributes()
    {
       return [
           'site_id' => 'Site ',
           // 'project_id' => 'project',
           // 'date' => 'Document Date ',
           // 'file.*' => 'File',
       ];
    }

}
