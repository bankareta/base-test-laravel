<?php

namespace App\Http\Controllers\API\Type;

use Illuminate\Http\Request;
use Unlu\Laravel\Api\QueryBuilder;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Master\TipePolicy;

use Hash;
use Carbon\Carbon;

class TypePolicyController extends Controller
{
    public function index()
    {
        $records = TipePolicy::get();
        return response()->json([
            'status' => true,
            'data' => $records
        ]);
    }
}
                            