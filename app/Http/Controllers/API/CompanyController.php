<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Unlu\Laravel\Api\QueryBuilder;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Master\Site;

use Hash;
use Carbon\Carbon;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $records = Site::with('creator')->orderBy('id','desc')->get();
        return response()->json([
            'status' => true,
            'data' => $records
        ]);
    }
}
                            