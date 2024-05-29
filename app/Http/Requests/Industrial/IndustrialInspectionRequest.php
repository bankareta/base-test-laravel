<?php
namespace App\Http\Requests\Industrial;

use App\Http\Requests\Request;

class IndustrialInspectionRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        $rules = [
            'contract_no' => 'required|max:185',
            'site_id' => 'required',
            'date_inspection' => 'required',
            'inspected_by' => 'required',
            'location' => 'required|max:185',
            'building' => 'required|max:185',
            'area' => 'required|max:185',
            'type' => 'required|max:185',
            'operation' => 'required|max:1000',
            'material' => 'required|max:1000',
            'procedures' => 'required|max:1000',
            'employees' => 'required|max:1000',
            'monitoring' => 'required|max:1000',
            'remarks' => 'required|max:1000',
        ];

        return $rules;
    }

     public function attributes()
    {
       return [
        'site_id' => 'Company'
       ];
    }

    public function messages()
    {
        return [
            'unique_with' => 'There is the same data on Company',
            'max' => 'Sentence length cannot exceed :max characters',
            'required' => 'The data cannot be empty'
        ];
    }
}
