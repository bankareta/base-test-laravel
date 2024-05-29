<?php

namespace App\Http\Controllers\API\Slider;

use Illuminate\Http\Request;
use Unlu\Laravel\Api\QueryBuilder;
use App\Http\Controllers\Controller;
use Auth;
use Hash;
use Carbon\Carbon;
use App\Models\Master\DImg;

class SliderController extends Controller
{
    public function index(Request $request)
    {
        $records = DImg::get();
        return response()->json([
            'status' => true,
            'count' => $records->count(),
            'data' => $records
        ]);
    }

    public function show($id)
    {
        $records = DImg::findOrFail($id);
        return response()->json([
            'status' => true,
            'data' => $records
        ]);
    }
}
                            