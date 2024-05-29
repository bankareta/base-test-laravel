<?php

namespace App\Http\Requests\Master;

use App\Http\Requests\Request;

class HazardCategoryRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
          'name' => 'required|max:150|unique:ref_hazard_category,name,'.$this->get('id'),
        ];

        if (Request::isMethod('put')) {
            $rules = [
              'name' => 'required|max:150|unique:ref_hazard_category,name,'.$this->get('id'),
            ];
        }

        return $rules;
    }
    public function attributes()
    {
       return [
            'name' => 'Name',
       ];
    }
}
