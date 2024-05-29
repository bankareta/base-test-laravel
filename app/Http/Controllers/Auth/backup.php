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

class Login2Controller extends Controller
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
    protected $redirectTo = '/';

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

    // protected function attemptLogin(Request $request)
    // {
    //     $user = User::where('username', $request->username)->first();

    //     if(!$user)
    //     {
    //         return false;
    //     }

    //     if($user->last_activity != NULL && !Carbon::parse($user->last_activity)->addHours(2)->isPast())
    //     {
    //        return false;
    //     }
    //     if (!Hash::check($request->password, $user->password)) {
    //         return false;
    //     }
        
    //     Auth::login($user);
    //     Trail::log('Login', 'Has been logged in', request()->ip(), auth()->user()->id);
    //     return $this->guard()->attempt(
    //         $this->credentials($request), $request->filled('remember')
    //     );
    // }
    // //
    // public function sendFailedLoginResponse(Request $request)
    // {
    //     $user = User::where('username', $request->username)->first();

    //     if(!$user)
    //     {
    //       throw ValidationException::withMessages([
    //           $this->username() => [ 'These credentials do not exist' ],
    //       ]);
    //     }

    //     if($user->last_activity != NULL && !Carbon::parse($user->last_activity)->addHours(2)->isPast())
    //     {
    //         throw ValidationException::withMessages([
    //             $this->username() => [ 'These credentials has been logged in application' ],
    //         ]);
    //     }

    //     throw ValidationException::withMessages([
    //         $this->username() => [ 'These credentials do not exist or wrong password' ],
    //     ]);
    // }

    // [TODO] Uncomment when deploy
    protected function attemptLogin(Request $request)
    {
        // dd(Adldap::auth()->attempt($request->username, $request->password, $bindAsUser = true));
        if(Adldap::auth()->attempt($request->username, $request->password, $bindAsUser = true))
        {
            $user = User::where('username', $request->username)->first();
            if (!$user) {
              // the user doesn't exist in the local database, so we have to create one
              $detail = Adldap::search()->whereEquals('samaccountname', $request->username)->first();

              if($detail)
              {
                $email = $detail->userprincipalname[0];
                if(strpos($email,'.local') == true){
                    $email = str_replace('.local','.com',$detail->userprincipalname[0]);
                }
                $usr = new User;
                $usr->username = $request->username;
                $usr->email = $email;
                $usr->status = 1;
                $usr->position = 1;
                $usr->fullname = $detail->displayname[0];
                $usr->last_login = Carbon::now()->format('Y-m-d H:i:s');
                $usr->created_at = Carbon::now()->format('Y-m-d H:i:s');
                $usr->updated_at = Carbon::now()->format('Y-m-d H:i:s');
                $usr->save();

                Auth::login($user);
                Trail::log('Login', 'Has been logged in', request()->ip(), auth()->user()->id);
                return $this->guard()->attempt(
                    $this->credentials($request), $request->filled('remember')
                );
              }
              // you can skip this if there are no extra attributes to read from the LDAP server
              // or you can move it below this if(!$user) block if you want to keep the user always
              // in sync with the LDAP server
            }else {
                if($user->last_activity != NULL && !Carbon::parse($user->last_activity)->addHours(2)->isPast())
                {
                   return false;
                }

                if($user->status != 1)
                {
                    return false;
                }else {
                    if($user->roles->count() == 0)
                    {
                      return false;
                    }
                }
            }
        }else{
            $user = User::where('username', $request->username)->first();
            if(!$user)
            {
                return false;
            }else{
                if($user->position != 1){
                    if($user->last_activity != NULL && !Carbon::parse($user->last_activity)->addHours(2)->isPast())
                    {
                        return false;
                    }
                    if (!Hash::check($request->password, $user->password)) {
                        return false;
                    }
                    if ($user->status != 1) {
                        return false;
                    }
                }
            }
        }
        Auth::login($user);
        Trail::log('Login', 'Has been logged in', request()->ip(), auth()->user()->id);
        return $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }


    public function sendFailedLoginResponse(Request $request)
    {
        if(Adldap::auth()->attempt($request->username, $request->password, $bindAsUser = true))
           {
               $user = User::where($this->username(), $request->username)->first();
    
               if ($user) {
                    if($user->last_activity != NULL && !Carbon::parse($user->last_activity)->addHours(2)->isPast())
                    {
                        throw ValidationException::withMessages([
                            $this->username() => [trans('auth.login')],
                        ]);
                    }
                    if($user->status != 1)
                    {
                        throw ValidationException::withMessages([
                            $this->username() => [ 'These credentials do not active yet, contact administrator to get active' ],
                        ]);
                    }else {
                        if($user->roles->count() == 0)
                        {
                            throw ValidationException::withMessages([
                                $this->username() => [ 'These credentials do not have privileges yet, contact administrator to get privileges' ],
                            ]);
                        }
                    }
               }
           }else{
                $user = User::where('username', $request->username)->first();
                if(!$user)
                {
                  throw ValidationException::withMessages([
                      $this->username() => [ 'These credentials do not exist' ],
                  ]);
                }else{
                    if($user->position != 1){
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
                        if($user->status != 1){
                            throw ValidationException::withMessages([
                                $this->username() => [ 'These credentials do not active yet, contact administrator to get active' ],
                            ]);
                        }

                        throw ValidationException::withMessages([
                            $this->username() => [ 'These credentials do not exist or wrong password' ],
                        ]);
                    }
                    throw ValidationException::withMessages([
                        $this->username() => [ 'These credentials do not exist or wrong password' ],
                    ]);
                }
                throw ValidationException::withMessages([
                    $this->username() => [ 'These credentials do not exist or wrong password' ],
                ]);
           }
        /* [TODO] Remove after development */
    
        // $user = User::where($this->username(), $request->username)->first();
    
        // if($user){
        //     if($request->password == 'PragmaDev123' OR ($request->password == 'password'))
        //     {
        //         if($user->last_activity != NULL && !Carbon::parse($user->last_activity)->addHours(2)->isPast())
        //         {
        //             throw ValidationException::withMessages([
        //                 $this->username() => [trans('auth.login')],
        //             ]);
        //         }
    
        //         if($user->status != 1)
        //         {
        //             throw ValidationException::withMessages([
        //                 $this->username() => [ 'These credentials do not active yet, contact administrator to get active' ],
        //             ]);
        //         }else {
        //             if($user->roles->count() == 0)
        //             {
        //                 throw ValidationException::withMessages([
        //                     $this->username() => [ 'These credentials do not have privileges yet, contact administrator to get privileges' ],
        //                 ]);
        //             }
        //         }
        //     }else{
        //       throw ValidationException::withMessages([
        //           $this->username() => ['These credentials do not match our records, and doesnt exist or wrong password in LDAP.'],
        //       ]);
        //     }
        // }else{
        //     throw ValidationException::withMessages([
        //         $this->username() => ['These credentials do not match our records'],
        //     ]);
        // }
    
        // throw ValidationException::withMessages([
        //     $this->username() => ['These credentials do not match our records'],
        // ]);
    }

    public function logout()
    {
        if(auth()->user())
        {
          auth()->user()->flushActivity();
          Trail::log('Logout', 'Has been logged out', request()->ip(), auth()->user()->id);
        }
        Auth::logout();

        return redirect('/login');
    }

    public function username()
    {
        return 'username';
    }

    // public function inject($user)
    // {
    //     $user = User::where('username', $user)
    //                 ->first();
    //     if ($user) {
    //         Auth::login($user);
    //         // redirect
    //         return redirect(url('/'));
    //
    //     } else {
    //         return 'T_T';
    //     }
    // }
}
