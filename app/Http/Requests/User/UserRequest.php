<?php
namespace App\Http\Requests\User;

use App\Http\Requests\Request;

class UserRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        $rules = [
            'fullname' => 'required',
        ];

        return $rules;
    }
    public function attributes()
    {
       return [
           'fullname' => 'Fullname',
       ];
    }

}
