<?php

namespace App\Http\Requests\Master;

use App\Http\Requests\Request;

class BulletinRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
          'title' => 'required|max:150|unique:trans_bulletin,title,'.$this->get('id'),
          'content' => 'required|max:1000',
          // 'type.*' => 'required',
          'site_id.*' => 'required',
          'type_id' => 'required',
        ];

        if (Request::isMethod('put')) {
            $rules = [
              'title' => 'required|max:150|unique:trans_bulletin,title,'.$this->get('id'),
              'content' => 'required|max:1000',
              // 'type.*' => 'required',
              'site_id.*' => 'required',
              'type_id' => 'required',
            ];
        }

        return $rules;
    }
    public function attributes()
    {
       return [
            'site_id.0' => 'Company',
            'type_id' => '',
       ];
    }
}
