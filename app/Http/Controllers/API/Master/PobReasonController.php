<?php

namespace App\Http\Controllers\API\Master;

use Illuminate\Http\Request;
use Unlu\Laravel\Api\QueryBuilder;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Master\Bulletin;

use Hash;
use Carbon\Carbon;
use App\Models\Master\Departemen;
use App\Models\Master\PobReason;
use App\Models\Master\VaccineStatus;

class PobReasonController extends Controller
{
    public function index(Request $request)
    {
        $records = PobReason::get();
        return response()->json([
            'status' => true,
            'data' => $records
        ]);
    }
}
                            