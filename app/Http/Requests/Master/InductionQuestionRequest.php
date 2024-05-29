<?php
namespace App\Http\Requests\Master;

use App\Http\Requests\Request;

class InductionQuestionRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $req = $this;
        $rulesfile = [];
        if (Request::isMethod('put')) {

        }else{
            if(isset($req->type_materi)){
                if($req->type_materi == 0){
                    $rulesfile = [
                        'link_yt' => 'required',
                    ];
                }else{
                    $rulesfile = [
                        'filename' => 'required',
                    ];
                }
            }
        }
        // ambil validasi dasar
        $rules = [
            'name' => 'required|max:150|unique:ref_induction_materi,name,'.$this->get('id'),
            'type_id' => 'required',
            'type_materi' => 'required',
        ];
        return array_merge($rules,$rulesfile);
    }
    public function attributes()
    {
       return [
           'name' => 'Material Name',
           'filename' => 'File',
           'type_id' => 'Induction Type',
           'type_materi' => 'Material File Type',
           'link_yt' => 'Url Youtube',
       ];
    }

}
