<?php

namespace App\Http\Controllers\API\Type;

use Illuminate\Http\Request;
use Unlu\Laravel\Api\QueryBuilder;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Master\TypeIncident;

use Hash;
use Carbon\Carbon;

class TypeAccidentController extends Controller
{
    public function index()
    {
        $records = TypeIncident::get();
        return response()->json([
            'status' => true,
            'data' => $records
        ]);
    }
}
                            