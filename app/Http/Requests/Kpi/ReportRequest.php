<?php
namespace App\Http\Requests\Kpi;

use App\Http\Requests\Request;

class ReportRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        $rules = [
            'site_id' => 'required',
            'year' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',

            'desc_lagging.*' => 'max:100',
            'target_lagging.*' => 'max:100',
            'site_lagging_id.*' => 'max:100',
            'realization_lagging.*' => 'max:100',
            
            'desc_leading.*' => 'max:100',
            'site_leading_id.*' => 'max:100',
            'target_leading.*' => 'max:100',
            'realization_leading.*' => 'max:100',
        ];

        return $rules;
    }
    public function attributes()
    {
       return [
            'site_id' => 'Site',
            'date_start' => 'Date ',
            'date_end' => 'Date ',

            'desc_lagging.*' => '',
            'target_lagging.*' => '',
            'site_lagging_id.*' => '',
            'realization_lagging.*' => '',

            'desc_leading.*' => '',
            'site_leading_id.*' => '',
            'target_leading.*' => '',
            'realization_leading.*' => '',
       ];
    }
}
