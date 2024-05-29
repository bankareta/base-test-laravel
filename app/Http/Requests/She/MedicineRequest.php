<?php
namespace App\Http\Requests\She;

use App\Http\Requests\Request;

class MedicineRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        if(isset($this->type)){
            if($this->type == 'update-stock'){
                $rules = [
                    'year' => 'required',
                    'site_id' => 'required',
                    'medicine_id' => 'required',
                    'expire_date' => 'required',
                    'stock' => 'required',
                ];
            }else{
                $rules = [
                    'year_trans' => 'required',
                    'site_trans_id' => 'required',
                    'medicine_trans_id' => 'required',
                    'expire_date_trans' => 'required',
                    'trans_stock' => 'required',
                ];
            }
        }else{
            $rules = [
                'medicine_id' => 'required|max:150|unique_with:trans_medicine,site_id,medicine_id,trademark_id,year,unit_id'.$this->get('id'),
                'site_id' => 'required',
                'year' => 'required',
                // 'trademark_id' => 'required',
                'dose' => 'required',
                'min_stock' => 'required',
                'unit_id' => 'required',
                'route_id' => 'required',
            ];
        }

        return $rules;
    }
    public function attributes()
    {
       return [
            "medicine_id" => '',
            "site_id" => '',
            "year" => '',
            "trademark_id" => '',
            "dose" => '',
            "min_stock" => '',
            "unit_id" => '',
            "route_id" => '',
            "status" => '',
            "expire_date" => '',
            "stock" => '',
            "year_trans" => '',
            "site_trans_id" => '',
            "medicine_trans_id" => '',
            "expire_date_trans" => '',
            "trans_stock" => '',
       ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute cannot be empty',
            'unique_with' => ':attribute already been taken',
        ];
    }

}
