<?php
namespace App\Http\Requests\Master\Training;

use App\Http\Requests\Request;

class CourseRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        $rules = [
            'title' => 'required|max:150|unique:ref_course,title,'.$this->get('id'),
            'contents' => 'required',
            'type_training_id' => 'required',
            'participant.*' => 'required',
            'site_id' => 'required',
        ];

        return $rules;
    }
    public function attributes()
    {
       return [
           'title' => 'Title',
           'contents' => 'Contents',
           'file' => 'File',
           'site_id' => 'Company',
           'type_training_id' => 'Type Training',
           'participant.*' => 'Participant'
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
