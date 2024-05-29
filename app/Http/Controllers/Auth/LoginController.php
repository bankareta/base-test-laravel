<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

use Hash;
use Auth;
use Session;
use Carbon;
use App\Models\Authentication\User;
use App\Models\Trail\Trail;
use Adldap\Laravel\Facades\Adldap;
use App\Models\Master\Config;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/welcome';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    protected function attemptLogin(Request $request)
    {
        $user = User::where('username', $request->username)->first();
        if($user)
        {
            if($user->last_activity != NULL && !Carbon::parse($user->last_activity)->addHours(2)->isPast())
            {
                return false;
            }
            if (!Hash::check($request->password, $user->password)) {
                return false;
            }
            if ($user->status -= 1) {
                return false;
            }
            Auth::login($user);
            if (auth()->user()) {
                $this->guard()->attempt(
                    $this->credentials($request), $request->filled('remember')
                );
                return redirect()->intended('/welcome');
            }
        }else{
            return false;
        }
    }


    public function sendFailedLoginResponse(Request $request)
    {
        $user = User::where('username', $request->username)->where('position', 0)->first();
        if($user)
        {
            if($user->last_activity != NULL && !Carbon::parse($user->last_activity)->addHours(2)->isPast())
            {
                throw ValidationException::withMessages([
                    $this->username() => [ 'These credentials has been logged in application' ],
                ]);
            }
            if (!Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    $this->username() => [ 'These credentials wrong password' ],
                ]);
            }
            if ($user->status != 1) {
                throw ValidationException::withMessages([
                    $this->username() => [ 'These credentials do not active yet, contact administrator to get active' ],
                ]);
            }
        }else{
            throw ValidationException::withMessages([
                $this->username() => [ 'These credentials do not exist or wrong password' ],
            ]);
        }
    }

    public function logout()
    {
        if(auth()->user())
        {
          auth()->user()->flushActivity();
        }
        Auth::logout();

        return redirect('/login');
    }

    public function username()
    {
        return 'username';
    }
}
