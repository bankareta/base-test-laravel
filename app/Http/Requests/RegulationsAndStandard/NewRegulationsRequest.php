<?php
namespace App\Http\Requests\RegulationsAndStandard;

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
          'name' => 'required|max:185|unique:trans_regulations,name,'.$this->get('id'),
          'description' => 'required|max:1000',
          'type_id' => 'required',
          'kelompok' => 'required',
        ];
         
        return $rules;
    }
    public function attributes()
    {
       return [
           'no_gangguan' => 'No. Gangguan',
           'rayon_id' => 'Rayon',
           'area_id' => 'Area',
           'name' => 'Title',
           'type_id' => 'Type',
        //    'site_id' => 'Company',
           'kelompok' => 'Category',
       ];
    }

    public function messages()
    {
        return [
            'unique_with' => 'There is the same data on Company',
            'unique' => 'The :attribute has already been taken.',
            'max' => 'Sentence length cannot exceed :max characters',
            'required' => 'The data cannot be empty'

        ];
    }
}
