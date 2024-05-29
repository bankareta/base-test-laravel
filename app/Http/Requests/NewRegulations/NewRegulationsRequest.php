<?php
namespace App\Http\Requests\NewRegulations;

use App\Http\Requests\Request;
use App\Models\Regulation\Regulations;

class NewRegulationsRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar

        $rules = [
          'project_id' => 'required',
          'date' => 'required',
          'date_issued' => 'required',
          'client' => 'required|max:185',
          'description' => 'required|max:1000',
          'no_doc' => 'required|max:200|unique:trans_regulations_new,no_doc,'.$this->get('id'),
          'contractor_id' => 'required',
          'site_id' => 'required',
        ];

        return $rules;
    }
    public function attributes()
    {
       return [
           'no_gangguan' => 'No. Gangguan',
           'rayon_id' => 'Rayon',
           'area_id' => 'Area',
           'type_id' => 'Type',
           'site_id' => 'Company',
           'kelompok' => 'Category',
       ];
    }

    public function messages()
    {
        return [
            'unique' => 'There is the same data on Document Title',
            'max' => 'Sentence length cannot exceed :max characters',
            'required' => 'The data cannot be empty'

        ];
    }
}
