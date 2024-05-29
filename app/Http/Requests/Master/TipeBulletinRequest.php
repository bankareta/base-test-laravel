<?php

namespace App\Http\Requests\Master;

use App\Http\Requests\Request;

class TipeBulletinRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:100|unique:ref_bulletin_type,name,'.$this->get('id'),
            'description' => 'required',
        ];
    }
}