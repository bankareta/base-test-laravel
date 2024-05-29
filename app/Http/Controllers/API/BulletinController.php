<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Unlu\Laravel\Api\QueryBuilder;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Master\Bulletin;

use Hash;
use Carbon\Carbon;

class BulletinController extends Controller
{
    public function index(Request $request)
    {
        $records = Bulletin::with('creator', 'type')->where('status', 1)->orderBy('id','desc')->get();
        
        if($request->site_id)
        {
          $records = Bulletin::with('creator', 'type')->where('status', 1)->whereHas('site', function ($b) use ($request) {
              $b->where('id', $request->site_id);
          })->orderBy('id','desc')->get();
        }

        return response()->json([
            'status' => true,
            'data' => $records
        ]);
    }
}
