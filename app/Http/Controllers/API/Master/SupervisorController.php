<?php

namespace App\Http\Controllers\API\Master;

use Illuminate\Http\Request;
use Unlu\Laravel\Api\QueryBuilder;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Master\Bulletin;
use App\Models\Authentication\User;

use Hash;
use Carbon\Carbon;
use App\Models\Master\Departemen;

class SupervisorController extends Controller
{
    public function index(Request $request)
    {
        $records = User::whereHas('roles.permissions',function($q){
            $q->where('name','hnmr-monitoring-supervisor');
        })->get();

        return response()->json([
            'status' => true,
            'data' => $records
        ]);
    }
    
    public function getAccident(Request $request)
    {
        $records = User::whereHas('roles.permissions',function($q){
            $q->where('name','accident-review-supervisor');
        })->get();

        return response()->json([
            'status' => true,
            'data' => $records
        ]);
    }
}
                            