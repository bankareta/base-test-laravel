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
        return Validator::make($data, [
            'email'           => 'required|email',
            'username'        => 'required|string|max:255',
            'password'        => 'required|string|min:6|confirmed',
            'nama'            => 'required',
            'captcha'         => 'required|captcha_check',
        ], [
            'email.required'    => 'Alamat email harus diisi.',
            'email.email'       => 'Format alamat email tidak valid.',
            'username.required' => 'Username harus diisi.',
            'password.required' => 'Password harus diisi.',
            'password.min'      => 'Password minimal harus :min karakter.',
            'password.confirmed'=> 'Konfirmasi password tidak cocok.',
            'nama.required'     => 'Nama harus diisi.',
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
        dd('asu');
        $user =  User::create([
            'username'   => $data['username'],
            'last_login' => date('Y-m-d H:i:s'),
            'password'   => bcrypt($data['password']),
            'email'      => $data['email'],
        ]);
        
        $user->roles()->attach(Role::where('name', 'user')->first());
        
        $user->karyawan()->create([
            'nik'         => $data['nik'],
            'nama'        => $data['nama'],
            'tgl_lahir'   => Carbon::createFromFormat('d/m/Y', $data['birth_date'])->format('Y-m-d'),
            'tmp_lahir'   => $data['tmp_lahir'],
            'jk'          => $data['gender'],
            'jabatan'     => $data['jabatan'],
            'no_hp'       => $data['phone'],
            'no_npwp'     => $data['npwp'],
            'no_rekening' => $data['no_rekening'],
            'atas_nama'   => $data['atas_nama'],
            'tgl_masuk'   => date('Y-m-d'),
            'tgl_keluar'  => null,
            'status'      => $data['status'],
        ]);

        return $user;
    }
}
