<?php
namespace App\Http\Requests\Induction;

use App\Http\Requests\Request;

class InductionMaterialRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        $rules = [
            'date' => 'required',
            'induction_id' => 'required',
            'site_id' => 'required',
            'fullname' => 'required|max:185',
            'corporate' => 'required|max:185',
            'visitor' => 'required|max:185',
            'site_specific' => 'required|max:1000',
            'number' => 'required|integer|min:1'
        ];

        return $rules;
    }
    
    public function attributes()
    {
       return [
           'material_name' => 'Title',
           'date' => 'Date',
           'induction_id' => 'Title',
           'site_id' => 'Company',
           'corporate' => 'Corporate',
           'visitor' => 'Visitor',
           'site_specific' => 'Site Specific',
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
