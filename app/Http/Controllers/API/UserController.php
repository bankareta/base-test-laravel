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
}
