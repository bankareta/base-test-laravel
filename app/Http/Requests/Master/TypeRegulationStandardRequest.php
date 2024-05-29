<?php
namespace App\Http\Requests\Master;

use App\Http\Requests\Request;

class TypeRegulationStandardRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        $rules = [
            'type' => 'required',
            'name' => 'required|max:150|unique:ref_regulations_type,name,'.$this->get('id'),
        ];

        return $rules;
    }
    public function attributes()
    {
       return [
           'no_gangguan' => 'No. Gangguan',
           'rayon_id' => 'Rayon',
           'area_id' => 'Area',
       ];
    }

}
