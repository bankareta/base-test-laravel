<?php
namespace App\Http\Requests\Master;

use App\Http\Requests\Request;

class DepartemenRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        $rules = [
            'name' => 'required|max:150|unique_with:ref_departement,site_id,name,'.$this->get('id'),
            'description' => 'required|max:250',
            'pic' => 'site_id',
            'pic' => 'required',
        ];

        return $rules;
    }
    public function message(){
        return [
            'unique_with' => 'There is the same data on Company',
            'max' => 'Sentence length cannot exceed :max characters',
            'required' => 'The data :attr cannot be empty'
        ];
    }
    public function attributes()
    {
       return [

       ];
    }
}
