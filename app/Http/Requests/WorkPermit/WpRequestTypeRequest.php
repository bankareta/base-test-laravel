<?php

namespace App\Http\Requests\WorkPermit;

use App\Http\Requests\Request;

class WpRequestTypeRequest extends Request
{
     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
      
            $rules = [
                'gwp.location' => 'max:185',
                'gwp.system' => 'max:185',
                'gwp.description' => 'max:1000',
                'gwp.service' => 'max:1000',
                'gwp.items.*.description' => 'max:1000',
                'gwp.items.*.value' => 'max:185',
                'gwp.auth_name' => 'max:185',
                'gwp.perform_name' => 'max:185',
                'gwp.op_name' => 'max:185',
                'gwp.permit_auth' => 'max:185',
                'gwp.wc_name' => 'max:185',
                'gwp.wc1_name' => 'max:185'
            ];
      
        return $rules;
    }

    public function attributes()
    {
     
    }

     public function messages()
    {
        return [
            'max' => 'Sentence length cannot exceed :max characters',
        ];
    }
}
