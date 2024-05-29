<?php
namespace App\Http\Requests\Master;

use App\Http\Requests\Request;

class SiteRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        $rules = [
            'name' => 'required|max:150|unique:ref_site,name,'.$this->get('id'),
            'code' => 'required|max:20|unique:ref_site,code,'.$this->get('id')
        ];

        return $rules;
    }
    public function attributes()
    {
       return [
       ];
    }

}
