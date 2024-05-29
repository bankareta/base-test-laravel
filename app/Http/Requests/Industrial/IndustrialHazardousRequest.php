<?php
namespace App\Http\Requests\Industrial;

use App\Http\Requests\Request;

class IndustrialHazardousRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        if($this->get('contractor_field') == 'off'){
            $rules = [
            'contractor_other' => 'required|max:185',
            'site_id' => 'required',
            'facility' => 'required|max:185',
            'building' => 'required|max:185',
            'area' => 'required|max:185',
            'date' => 'required',
            'to' => 'required',
            'from' => 'required',
            'peer' => 'required|max:1000',
            'specific' => 'required|max:1000',
            'inventory' => 'required|max:1000',
            'storage' => 'required|max:1000',
            'rooms' => 'required|max:1000',
            'procces' => 'required|max:1000',
            'form' => 'required|max:1000',
            'concentration' => 'required|max:1000',
            'adquate' => 'required|max:1000',
            'procceses' => 'required|max:1000',
            'location' => 'required|max:185',
            'agents' => 'required|max:185',
            'exposure' => 'required|max:1000',
            'potential' => 'required|max:1000',
            'sampling' => 'required|max:1000',
            'training' => 'required|max:1000',
            'routine' => 'required|max:1000',
            'enginner' => 'required|max:1000',
            'administrative' => 'required|max:1000',
            'personal' => 'required|max:1000',
            'other' => 'required|max:1000',
            'comments' => 'required|max:1000',
            'request' => 'required|max:185',
            'follow' => 'required|max:185',
            'follow_report' => 'required|max:185',
            'follow_letter' => 'required|max:185',
            'documents' => 'required',
            // 'contractor_id' => 'required|max:1000',
            ];
        }else{
            $rules = [
            'site_id' => 'required',
            'facility' => 'required|max:185',
            'building' => 'required|max:185',
            'area' => 'required|max:185',
            'date' => 'required',
            'to' => 'required',
            'from' => 'required',
            'peer' => 'required|max:1000',
            'specific' => 'required|max:1000',
            'inventory' => 'required|max:1000',
            'storage' => 'required|max:1000',
            'rooms' => 'required|max:1000',
            'procces' => 'required|max:1000',
            'form' => 'required|max:1000',
            'concentration' => 'required|max:1000',
            'adquate' => 'required|max:1000',
            'procceses' => 'required|max:1000',
            'location' => 'required|max:185',
            'agents' => 'required|max:185',
            'exposure' => 'required|max:1000',
            'potential' => 'required|max:1000',
            'sampling' => 'required|max:1000',
            'training' => 'required|max:1000',
            'routine' => 'required|max:1000',
            'enginner' => 'required|max:1000',
            'administrative' => 'required|max:1000',
            'personal' => 'required|max:1000',
            'other' => 'required|max:1000',
            'comments' => 'required|max:1000',
            'request' => 'required|max:185',
            'follow' => 'required|max:185',
            'follow_report' => 'required|max:185',
            'follow_letter' => 'required|max:185',
            'documents' => 'required',
            'contractor_id' => 'required|max:185',
            ];
        }
        

        return $rules;
    }

     public function attributes()
    {
       return [
        'site_id' => 'Company',
        'contractor_id' => 'Contractor No.',
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
