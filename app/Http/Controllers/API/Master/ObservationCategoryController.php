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
use App\Models\Master\ObservationCategory;
use App\Models\Master\PobReason;
use App\Models\Master\VaccineStatus;

class ObservationCategoryController extends Controller
{
    public function index(Request $request)
    {
        $records = ObservationCategory::with(['component:id,observation_category_id,desc,abbreviation'])->select('id','name','position')->get();
        return response()->json([
            'status' => true,
            'data' => $records
        ]);
    }
}
                            