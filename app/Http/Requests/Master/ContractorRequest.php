<?php
namespace App\Http\Requests\Master;

use App\Http\Requests\Request;

class ContractorRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        $rules = [
            'email' => 'required|max:150|unique:ref_contractor,email,'.$this->get('id'),
            'company' => 'required|unique:ref_contractor,company,'.$this->get('id'),
            'reference' => 'required|unique:ref_contractor,reference,'.$this->get('id'),
            'date' => 'required',
            'owner' => 'required|max:150',
            'subject' => 'required|max:150',
            'contact_person' => 'required|max:150',
            'hp' => 'required|numeric|digits_between:10,13',
            'email' => 'required|max:150|email',
        ];

        return $rules;
    }
    public function attributes()
    {
        return [
            'hp' => 'Phone Number',
        ];

    }
    public function messages()
    {
       return $rules = [
           'digits' => ':attribute maximum :digits digit numbers',
           'integer' => 'The :attribute field must be number',
           'max' => 'The :attribute maximum :max digit numbers',
           'min' => 'The :attribute minimum :min digit numbers',
           'size' => 'The :attribute must be :size digit numbers',
           'required' => 'The :attribute field is required',
           'email' => 'Invalid email format',
       ];
    }

}
