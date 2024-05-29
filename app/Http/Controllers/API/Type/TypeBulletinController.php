<?php

namespace App\Http\Controllers\API\Type;

use Illuminate\Http\Request;
use Unlu\Laravel\Api\QueryBuilder;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Master\TipeBulletin;

use Hash;
use Carbon\Carbon;

class TypeBulletinController extends Controller
{
    public function index()
    {
        $records = TipeBulletin::get();
        return response()->json([
            'status' => true,
            'data' => $records
        ]);
    }
}
                            