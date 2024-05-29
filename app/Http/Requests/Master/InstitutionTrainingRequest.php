<?php
namespace App\Http\Requests\Master;

use App\Http\Requests\Request;

class InstitutionTrainingRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        $rules = [
            'name' => 'required|max:150|unique:ref_institution_training,name,'.$this->get('id'),
            // 'desc' => 'required',
        ];

        return $rules;
    }
    public function attributes()
    {
       return [

       ];
    }

}
