<?php
namespace App\Http\Requests\Master;

use App\Http\Requests\Request;

class TitleDataRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        $rules = [
            'name' => 'required|max:150|unique:ref_title_data,name,'.$this->get('id'),
            'description' => 'required|max:250',
        ];

        return $rules;
    }
    public function attributes()
    {
       return [
           
       ];
    }

}
