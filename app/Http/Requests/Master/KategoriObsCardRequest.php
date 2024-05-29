<?php

namespace App\Http\Requests\Master;

use App\Http\Requests\Request;
use App\Models\Master\KategoriObsCard;

class KategoriObsCardRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (Request::isMethod('put')) {
          if (KategoriObsCard::where('name',request()->name)->where('category',request()->category)->get()->count()) {
            $rules = [
              'name' => 'required|max:150|unique:ref_cat_she_obs_card,name,'.$this->get('id'),
              'category' => 'required',
            ];
          } else {
            $rules = [
              'name' => 'required',
              'category' => 'required',
            ]; 
          }
        }else{
          if(KategoriObsCard::where('name',request()->name)->where('category',request()->category)->get()->count()){
            $rules = [
              'name' => 'required|max:150|unique:ref_cat_she_obs_card,name,'.$this->get('id'),
              'category' => 'required',
            ];
          }else{
            $rules = [
              'name' => 'required|max:150',
              'category' => 'required',
            ];
          }
        }

        return $rules;
    }
    public function attributes()
    {
       return [
            'name' => 'Name',
            'category' => 'Category',
       ];
    }
}
