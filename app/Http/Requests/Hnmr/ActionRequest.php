<?php
namespace App\Http\Requests\Hnmr;

use App\Http\Requests\Request;

class ActionRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        $rules = [
            'action' => 'required|max:1000',
            'date' => 'required',
        ];

        return $rules;
    }
    public function attributes()
    {
       return [
           'action' => 'Corrective Action',
           'date' => 'Date',
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
