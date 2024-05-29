<?php

namespace App\Http\Requests\WorkPermit;

use App\Http\Requests\Request;

class WpRequestRequest extends Request
{
     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        if(count($this->get('type')) == 1){
            // header('HTTP/1.1 500 Internal Server Booboo');
            // header('Content-Type: application/json; charset=UTF-8');
            // die(json_encode(array('message' => 'ERROR', 'errors' => array("type.0.type" => ["Data cannot be empty, please fill in one type"]))));
            $rules = [
                'wo_no' => 'required|max:185|unique:trans_wp_request,wo_no,'.$this->get('id'),
                'date' => 'required',
                'duration' => 'required|numeric',
                'area' => 'required|max:185',
                'system' => 'required|max:185',
                'location' => 'required|max:185',
                'service' => 'required|max:1000',
                'description' => 'required|max:1000',
                'describe' => 'required|max:1000',
                'request_by' => 'required',
                'permit_date' => 'required',
                'site_id' => 'required',
                'type.*.type' => 'required',
            ];
        }else{
            $rules = [
                'wo_no' => 'required|max:185',
                'date' => 'required',
                'duration' => 'required|numeric',
                'area' => 'required|max:185',
                'system' => 'required|max:185',
                'location' => 'required|max:185',
                'service' => 'required|max:1000',
                'description' => 'required|max:1000',
                'describe' => 'required|max:1000',
                'request_by' => 'required',
                'permit_date' => 'required',
                'site_id' => 'required',
            ];
        }

        return $rules;
    }

    public function attributes()
    {
       return [
            'wo_no' => 'Wo Number',
            'date' => 'Date',
            'duration' => 'Duration',
            'area' => 'Area',
            'system' => 'System',
            'location' => 'Location',
            'service' => 'Service',
            'description' => 'Description',
            'describe' => 'Describe',
            'request_by' => 'Request By',
            'permit_date' => 'Permit Date',
            'site_id' => 'Company',
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
