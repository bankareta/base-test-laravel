<?php
namespace App\Http\Requests\Inspection;

use App\Http\Requests\Request;

class InspectionRecordRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        $rules = [
            'inspected_by' => 'required',
            'date_inspection' => 'required',
            'year' => 'required',
            'hazard_category' => 'required',
            'location' => 'required|max:150',
            'contractor_id' => 'required|max:200',
            'department_id' => 'required',
            'she_category_id' => 'required',
            'nature' => 'max:1000',
            'recommendation' => 'max:1000',
            'site_id' => 'required',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'unique_with' => 'There is the same data on Company',
            'max' => 'Sentence length cannot exceed :max characters',
            'required' => 'The data cannot be empty'
        ];
    }

    public function attributes(){
        return [
            'contractor_id' => 'Contractor'
        ];
    }
}
