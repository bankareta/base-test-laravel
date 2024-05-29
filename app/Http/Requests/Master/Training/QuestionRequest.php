<?php
namespace App\Http\Requests\Master\Training;

use App\Http\Requests\Request;

class QuestionRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        $rules = [
            'question' => 'required|unique_with:ref_question,question,quiz_id,'.$this->get('id'),
            'type_answer' => 'required',
            'answer.*' => 'required',
            'true.*' => 'required',
        ];

        return $rules;
    }

    public function messages()
    {
       return [
           'unique_with' => 'Same Question is exist',
       ];
    }

    public function attributes()
    {
       return [
           'question' => 'Question',
           'answer.*' => 'Answer',
           'type_answer' => 'Type Answer',
           'true' => 'True Answer',
           'quiz_id' => 'Quiz'
       ];
    }

}
