<?php
namespace App\Http\Requests\Master\Training;

use App\Http\Requests\Request;

class QuizRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        $rules = [
            'title' => 'required|max:150|unique_with:ref_quiz,site_id,title,'.$this->get('id'),
            'contents' => 'required|max:1000',
            'site_id' => 'required',
            'type_training_id' => 'required',
        ];

        return $rules;
    }
    public function messages()
    {
       return [
           // 'typefile' => [
           //          'required' => 'Choose the Type of file',
           // ],
           'unique_with' => 'There is the same data on Company',
            'max' => 'Sentence length cannot exceed :max characters',
            'required' => 'The data cannot be empty'
       ];
    }
    public function attributes()
    {
       return [
           'title' => 'Title',
           'contents' => 'Contents',
           'typefile' => 'Type of file',
           'type_training_id' => 'Training Type',
           'site_id' => 'Company',
       ];
    }


}
