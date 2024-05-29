<?php
namespace App\Http\Requests\Hira;

use App\Http\Requests\Request;

class ImitigationRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        $rules = [
            'step.control_measures.*' => 'required',
            'step.residual_risk_likelihood.*' => 'required',
            'step.residual_risk_consequence.*' => 'required',
        ];

        return $rules;
    }
    public function attributes()
    {
       return [
           'step.control_measures.*' => 'Control Measures',
           'step.residual_risk_likelihood.*' => 'Residual Level Likelihood',
           'step.residual_risk_consequence.*' => 'Residual Level Consequence',
       ];
    }

}
