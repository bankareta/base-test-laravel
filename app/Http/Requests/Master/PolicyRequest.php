<?php

namespace App\Http\Requests\Master;

use App\Http\Requests\Request;

class PolicyRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        $rules = [
          'title' => 'required|max:150|unique:trans_policy,title,'.$this->get('id'),
          'content' => 'required|max:1000',
          // 'attachment.0' => 'required',
          'site_id.*' => 'required',

          'type_id' => 'required',
        ];

        if (Request::isMethod('put')) {
            $rules = [
              'title' => 'required|max:150|unique:trans_policy,title,'.$this->get('id'),
              'content' => 'required|max:1000',
              // 'attachment.0' => 'required',
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
