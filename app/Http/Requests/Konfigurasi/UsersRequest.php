<?php
namespace App\Http\Requests\Konfigurasi;

use App\Http\Requests\Request;

class UsersRequest extends Request
{


     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ambil validasi dasar
        $rules = [
            // 'password_lama'    => 'required',
            'username' => 'required|max:20|unique:sys_users,username,'.$this->get('id'),
            'email' => 'required|email|unique:sys_users,email,'.$this->get('id'),
        ];

       
        if($this->get('id')){
            if ($this->get('position') == 0) {
               
            }else{
                $rules['roles.*'] = 'required';
                $rules['sites.*'] = 'required';
            }
        }else{
            if ($this->get('position') == 0) {
                $rules['password'] = 'min:2|required_with:confirm_password|same:confirm_password';
                $rules['confirm_password'] = 'min:2';
            }else{
                $rules['roles.*'] = 'required';
                $rules['sites.*'] = 'required';
            }
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'username' => 'Username',
            'email' => 'E-Mail ',
            'password' => 'New Password',
            'confirm_password' => 'Confirm Password',
            'roles.*' => 'Roles',
            'sites.*' => 'Site'
        ];
    }
    public function messages()
    {
       return $rules = [
           'password.same' => ' :attribute and Confirmation Password do not match.',
           'required'             => 'The :attribute field is required.',
           'email'             => 'The :attribute must be a valid email address.',
           'unique'             => 'The :attribute has already been taken.',
           'min'             => 'The :attribute field is required.',
           'max'             => 'The :attribute may not be greater than :max characters.',
       ];
    }

}
