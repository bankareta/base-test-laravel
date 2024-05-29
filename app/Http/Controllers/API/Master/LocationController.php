<?php

namespace App\Http\Controllers\API\Master;

use Illuminate\Http\Request;
use Unlu\Laravel\Api\QueryBuilder;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Master\Bulletin;

use Hash;
use Carbon\Carbon;
use App\Models\Master\Location;

class LocationController extends Controller
{
    public function index(Request $request)
    {
        $records = Location::orderBy('id','desc')->select('*');
        if($request->site_id){
            $site_id = explode(',',$request->site_id);
            $records = $records->whereIn('site_id', $site_id);
        }
        return response()->json([
            'status' => true,
            'data' => $records->get()
        ]);
    }
}
                            