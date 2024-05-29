<?php

namespace App\Http\Controllers\Auth;

use App\Models\Authentication\User;
use App\Models\Authentication\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

// rules
use App\Http\Rules\TrelloCheckUser;

// libraries
use anlutro\cURL\cURL;
use Carbon\Carbon;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $id = isset($data['id']) ? $data['id'] : null;
        return Validator::make($data, [
            'email' => 'required|email|unique:sys_users,email,'.$id,
            'username' => 'required|string|max:255|unique:sys_users,username,'.$id,
            'password'        => 'required|string|min:6|confirmed',
            'captcha'         => 'required|captcha_check',
        ], [
            'email.required'    => 'Alamat email harus diisi.',
            'email.unique'    => 'Alamat email sudah ada.',
            'email.email'       => 'Format alamat email tidak valid.',
            'username.required' => 'Username harus diisi.',
            'username.unique' => 'Username sudah ada.',
            'password.required' => 'Password harus diisi.',
            'password.min'      => 'Password minimal harus :min karakter.',
            'password.confirmed'=> 'Konfirmasi password tidak cocok.',
            'captcha.required'  => 'Captcha harus diisi.',
            'captcha.captcha_check'   => 'Captcha tidak valid.',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

    public function showRegistrationForm()
    {
        return view('modules.authentication.register');
    }

    protected function create(array $data)
    {
        $user =  User::create([
            'fullname'   => $data['fullname'],
            'username'   => $data['username'],
            'email'      => $data['email'],
            'last_login' => date('Y-m-d H:i:s'),
            'password'   => bcrypt($data['password']),
            'status'      => 1,
        ]);
        
        $user->roles()->attach(Role::where('name', 'Administrator')->first());
        return $user;
    }
}
