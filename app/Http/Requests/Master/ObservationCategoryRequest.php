<?php
namespace App\Http\Requests\Master;

use App\Http\Requests\Request;

class ObservationCategoryRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        $rules = [
            'name' => 'required|max:150|unique:ref_observation_category,name,'.$this->get('id'),
            'position' => 'required|unique:ref_observation_category,position,'.$this->get('id'),
            'component.0' => 'required|max:150',
            'component.*' => 'distinct'
        ];

        return $rules;
    }

    public function attributes()
    {
       return [
            'component.0' => 'Component'
       ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute cannot be empty',
            'max'  => 'The :attribute may not be greater than :max characters.',
            'component.0.required' => 'Minimum 1 component to save'
        ];
    }

}
