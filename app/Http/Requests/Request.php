<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() || !is_null($this->user());
    }

    /**
     * validation message that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return $rules = [
            'unique_with' => 'There is the same data',
            'required' => ':attribute can not be empty',
            'email' => 'Email is invalid',
            'unique' => ':attribute has already been taken',
            'max' => ':attribute can not be more than :max character',
            'min' => ':attribute can not be less than :min character',
            'date_format' => ':attribute does not match the calendar format',
        ];
    }
}
