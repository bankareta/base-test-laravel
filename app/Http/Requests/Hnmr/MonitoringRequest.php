<?php
namespace App\Http\Requests\Hnmr;

use App\Http\Requests\Request;

class MonitoringRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        $rules = [
            'planning' => 'required',
            'rating' => 'required',
        ];

        return $rules;
    }
    public function attributes()
    {
       return [
           'planning' => 'Hazard Control Action Plan',
           'rating' => 'Rating',
       ];
    }

}
