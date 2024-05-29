<?php
namespace App\Http\Requests\Konfigurasi;

use App\Http\Requests\Request;

class RolesRequest extends Request
{

    
     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        $rules = [
            'name' => 'required|max:20|unique:roles,name,'.$this->get('id'),
        ];

        return $rules;
    }

    public function attributes()
    {
        // ambil validasi dasar
        // $attributes = $this->attr;

        // validasi tambahan
        $attributes['name']    = 'Roles';
        return $attributes;
    }

}


