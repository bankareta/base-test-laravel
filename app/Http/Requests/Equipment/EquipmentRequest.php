<?php
namespace App\Http\Requests\Equipment;

use App\Http\Requests\Request;

class EquipmentRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        $rules = [
            'type_id' => 'required',
            'site_id' => 'required',
            'name' => 'required|max:150',
            'no_sertifikat' => 'required|max:150|unique:trans_equipment,no_sertifikat,'.$this->get('id'),
            'merek' => 'required|max:150',
            'register_number' => 'required|max:150|unique:trans_equipment,register_number,'.$this->get('id'),
            'description' => 'required|max:1000',
           
        ];

        return $rules;
    }
    public function attributes()
    {
       return [
        'type_id' => 'Equipment Type',
        'site_id' => 'Company',
        'name' => 'Equipment Name',
        'no_sertifikat' => 'Certificate Number',
        'merek' => 'Brand',
        'register_number' => 'Register Number',
        'description' => 'Descriptions',
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
