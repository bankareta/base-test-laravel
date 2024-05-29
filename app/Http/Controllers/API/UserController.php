<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Unlu\Laravel\Api\QueryBuilder;
use App\Http\Controllers\Controller;
use App\Models\Authentication\User;
use Auth;

use Hash;
use Carbon\Carbon;
use Adldap\Laravel\Facades\Adldap;
use App\Models\Master\Config;
use App\Libraries\Helpers;

class UserController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth:api-jwt', ['except' => ['login']]);
  }

  public function login()
  {
    $request = request();
    $checkConfig = Config::where('parent','ldap')->get()->first();
    if ($checkConfig) {
      if($checkConfig->status == 1){
        try {
          Adldap::connect();
    
          if(Adldap::auth()->attempt($request->username, $request->password, $bindAsUser = true))
          {
            $userInfo = Adldap::search()->users()->find($request->username);
            $user = User::with('roles')->where('username',$request->username)->first();
            if(!$user)
            {
              return response()->json([
                'code' => 400,
                'status' => false,
                'message' => 'User not found',
              ], 400);
            }else{
              $user->last_login = Carbon::now();
              Auth::login($user);
              $users= User::find($user->id);
    
              return response()->json([
                'status' => true,
                'perms' => array(
                  'supervisor_accident' => $users->can('hnmr-monitoring-supervisor'),
                  'supervisor_hnmr' => $users->can('accident-review-supervisor'),
                  'add_accident' => $users->can('accident-report-add'),
                  'add_hnmr' => $users->can('hnmr-reporting-add'),
                  'hnmr' => $users->getAllPermissions()->filter(function ($q) {
                    return starts_with($q->name,'hnmr-reporting');
                  })->count() > 0 ? true:false,
                  'accident' => $users->getAllPermissions()->filter(function ($q) {
                    return starts_with($q->name,'accident-report');
                   })->count() > 0 ? true:false,
                  'bulletin' => $users->can('communication-bulletin-view'),
                  'policy' => $users->can('communication-policy-view'),
                ),
                'data' => $user,
              ]);
            }
          }else{
            $user = User::with('site')->where('username', $request->username)
            ->orWhere('email', $request->username)->first();
    
            if ($user) {
              if (!Hash::check($request->password, $user->password)) {
                return response()->json([
                  'code' => 400,
                  'status' => false,
                  'message' => 'Password incorrect!',
                ], 400);
              }
              if ($user->status -= 1) {
                return response()->json([
                  'code' => 400,
                  'status' => false,
                  'message' => 'User is not available for this time.',
                ], 400);
              }
              $user->last_login = Carbon::now();
              $user->status = 1;
              $user->save();
              $users= User::find($user->id);
              $credentials = request(['username', 'password']);
    
              if (! $token = auth('api-jwt')->attempt($credentials)) {
                return response()->json([
                  'code' => 400,
                  'status' => false,
                  'message' => 'User is not available for this time.',
                ], 400);
              }
              auth('api-jwt')->factory()->setTTL(null);
              return $this->respondWithToken($token);
            }else{
              return response()->json([
                'code' => 400,
                'status' => false,
                'message' => 'These credentials do not match our records.',
              ], 400);
            }
          }
        } catch (\Exception $e) {
          $user = User::with('site')->where('username', $request->username)
          ->orWhere('email', $request->username)->first();
    
          if ($user) {
            if (!Hash::check($request->password, $user->password)) {
              return response()->json([
                'code' => 400,
                'status' => false,
                'message' => 'Password incorrect!',
              ], 400);
            }
            if ($user->status -= 1) {
              return response()->json([
                'code' => 400,
                'status' => false,
                'message' => 'User is not available for this time.',
              ], 400);
            }
            $user->last_login = Carbon::now();
            $user->status = 1;
            $user->save();
            $users= User::find($user->id);
            $credentials = request(['username', 'password']);
  
            if (! $token = auth('api-jwt')->attempt($credentials)) {
              return response()->json([
                'code' => 400,
                'status' => false,
                'message' => 'User is not available for this time.',
              ], 400);
            }
            auth('api-jwt')->factory()->setTTL(null);
            return $this->respondWithToken($token);
          }else{
            return response()->json([
              'code' => 400,
              'status' => false,
              'message' => 'These credentials do not match our records.',
            ], 400);
          }
        }
      }else{
        $user = User::with('site')->where('username', $request->username)
        ->orWhere('email', $request->username)->first();
  
        if ($user) {
          if (!Hash::check($request->password, $user->password)) {
            return response()->json([
              'code' => 400,
              'status' => false,
              'message' => 'Password incorrect!',
            ], 400);
          }
          if ($user->status -= 1) {
            return response()->json([
              'code' => 400,
              'status' => false,
              'message' => 'User is not available for this time.',
            ], 400);
          }
          $user->last_login = Carbon::now();
          $user->status = 1;
          $user->save();
          $users= User::find($user->id);
          $credentials = request(['username', 'password']);

          if (! $token = auth('api-jwt')->attempt($credentials)) {
            return response()->json([
              'code' => 400,
              'status' => false,
              'message' => 'User is not available for this time.',
            ], 400);
          }
          auth('api-jwt')->factory()->setTTL(null);
          return $this->respondWithToken($token);
        }else{
          return response()->json([
            'code' => 400,
            'status' => false,
            'message' => 'These credentials do not match our records.',
          ], 400);
        }
      }
    }else{
      $user = User::with('site')->where('username', $request->username)
      ->orWhere('email', $request->username)->first();
      if ($user) {
        if (!Hash::check($request->password, $user->password)) {
          return response()->json([
            'code' => 400,
            'status' => false,
            'message' => 'Password incorrect!',
          ], 400);
        }
        if ($user->status -= 1) {
          return response()->json([
            'code' => 400,
            'status' => false,
            'message' => 'User is not available for this time.',
          ], 400);
        }
        $user->last_login = Carbon::now();
        $user->status = 1;
        $user->save();
        $users= User::find($user->id);
        $credentials = request(['username', 'password']);

        if (! $token = auth('api-jwt')->attempt($credentials)) {
          return response()->json([
            'code' => 400,
            'status' => false,
            'message' => 'User is not available for this time.',
          ], 400);
        }
        auth('api-jwt')->factory()->setTTL(null);
        return $this->respondWithToken($token);
      }else{
        return response()->json([
          'code' => 400,
          'status' => false,
          'message' => 'These credentials do not match our records.',
        ], 400);
      }
    }
  }

  public function me()
    {
        return response()->json(auth('api-jwt')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('api-jwt')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('api-jwt')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        $user = auth('api-jwt')->user();
        $site = null;
        if($user->site->count() > 0){
          foreach ($user->site as $key => $value) {
            $site[$key] = $value->id;
          }
        }
        $record = [
          'id' => $user->id,
          'access_token' => $token,
          'token_type' => 'bearer',
          'expires_in' => auth('api-jwt')->factory()->getTTL(), 
          'username' => $user->username,
          'email' => $user->email,
          'last_login' => $user->last_login->format('Y-m-d H:i:s'),
          'status' => $user->status,
          'created_at' => $user->created_at->format('Y-m-d H:i:s'),
          'updated_at' => $user->updated_at->format('Y-m-d H:i:s'),
          'fullname' => $user->fullname,
          'address' => $user->address,
          'gender' => $user->gender,
          'fotopath' => $user->fotopath,
          'signaturepath' => $user->signaturepath,
          'birthdate' => $user->birthdate ? $user->birthdate->format('Y-m-d H:i:s'):null,
          'last_activity' => $user->last_activity,
          'password' => $user->password,
          'position' => $user->position,
          'display' => $user->display,
          'show_site' => $user->show_site,
          'site' => $site,
        ];
        return response()->json($record);
    }
}
