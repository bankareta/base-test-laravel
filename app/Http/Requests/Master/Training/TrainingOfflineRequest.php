<?php
namespace App\Http\Requests\Master\Training;

use App\Http\Requests\Request;

class TrainingOfflineRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        $rules = [
            'name' => 'required|max:185',
            'dept' => 'required|max:185',
            'site_id' => 'required|max:185',
            'type_id' => 'required|max:185',
            'date' => 'required|max:185',
            'end_date' => 'required|max:185',
            'location' => 'required|max:185',
            'participant_number' => 'required|max:5',
            'remarks' => 'max:185'
        ];

        return $rules;
    }
    public function attributes()
    {
       return [
           'name' => 'Training Name',
           'date' => 'Date Of Training',
           'type_id' => 'Type Of Training',
           'site_id' => 'Site',
           'participant_number' => 'Number Of Participant'
       ];
    }

    public function messages()
    {
        return [
            'unique_with' => 'There is the same data on Company',
            'max' => 'Sentence length cannot exceed :max characters',
            'required' => 'The data cannot be empty',
            'numeric' => 'The data must be number'
        ];
    }

}
