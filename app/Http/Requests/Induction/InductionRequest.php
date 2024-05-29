<?php
namespace App\Http\Requests\Induction;
use App\Models\Induction\InductionFile;

use App\Http\Requests\Request;

class InductionRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar

        $req = $this;
        $rules1 = [];
        if (Request::isMethod('put')) {
            if($req->materi_deleted_id){
                if(count($req->materi_deleted_id) > 0){
                  $incident = InductionFile::where('record_id',$req->id)->whereNotIn('id',$req->materi_deleted_id)->where('parent','material')->get();
                  if($incident->count() == 0 AND (!isset($req->filespath) OR count($req->filespath) == 0)){
                    $rules1 = [
                      'picture.*' => 'required',
                    ];
                  }
                }
            }
        }else{
            if(!isset($req->filespath) OR count($req->filespath) == 0){
                $rules1 = [
                    'picture.*' => 'required',
                ];
            }
        }
        $rules = [
            'name' => 'required|max:200|unique:trans_induction_record,name,'.$this->get('id'),
            'date_end' => 'required|max:185',
            'date_start' => 'required|max:185',
            'location' => 'required|max:200',
            'remarks' => 'required|max:200',
            'type.*' => 'required',
            'participant.*' => 'required|max:200',
            'user_id.*' => 'required',
        ];

        return array_merge($rules,$rules1);
    }

    public function attributes()
    {
       return [
           'name' => 'Induction Title',
           'date_end' => 'Start Date',
           'date_start' => 'End Date',
           'picture.*' => 'Material File',
           'user_id.*' => 'Participant',
           'participant.*' => 'Participant',
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
