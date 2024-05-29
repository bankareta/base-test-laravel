<?php
namespace App\Http\Requests\Master;

use App\Http\Requests\Request;

class AuditPermitRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        $rules = [
            'name' => 'required|max:150|unique:ref_permit,name,'.$this->get('id'),
        ];

        return $rules;
    }
    public function attributes()
    {
       return [

       ];
    }

}