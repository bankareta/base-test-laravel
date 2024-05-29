<?php
namespace App\Http\Requests\Master;

use App\Http\Requests\Request;

class InductionRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $req = $this;
        $rulesfile = [];
        
        if(!isset($req->filename[0]) AND !isset($req->link_yt)){
            $rulesfile = [
                'link_yt' => 'required',
                'file' => 'required',
            ];
        }
        // ambil validasi dasar
        $rules = [
            'name' => $this->get('id') ? 'required|max:150' : 'required|max:150|unique:ref_induction_materi,name,'.$this->get('id'),
            'type_id' => 'required',
            // 'type_materi' => 'required',
        ];
        return array_merge($rules,$rulesfile);
    }
    public function attributes()
    {
       return [
           'name' => 'Material Name',
           'file' => 'File',
           'filename' => 'File',
           'type_id' => 'Induction Type',
           'type_materi' => 'Material File Type',
           'link_yt' => 'Url Youtube',
       ];
    }

}
