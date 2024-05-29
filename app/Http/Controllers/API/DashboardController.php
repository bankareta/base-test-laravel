<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Unlu\Laravel\Api\QueryBuilder;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Master\Bulletin;
use App\Models\Master\Policy;
use App\Models\Accident\Report;
use App\Models\Hnmr\Reporting;
use App\Models\Master\DImg;

use Hash;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $ho = $request->site_id ? Reporting::whereNotIn('published',[3])->byFilterSite($request->site_id)->get()->count() : Reporting::whereNotIn('published',[3])->get()->count();
        $ao = $request->site_id ? Report::whereNotIn('status', [4])->byFilterSite($request->site_id)->get()->count() : Report::get()->count();
        $hc = $request->site_id ? Reporting::where('published',[3])->byFilterSite($request->site_id)->get()->count() : Reporting::whereNotIn('published',[3])->get()->count();
        $ac = $request->site_id ? Report::where('status', 4)->byFilterSite($request->site_id)->get()->count() : Report::get()->count();
        $b = $request->site_id ? Bulletin::with('creator', 'type')->whereHas('site', function ($b) use ($request) {
                                    $b->where('id', $request->site_id);
                                })->orderBy('id','desc')->take(6)->get() : Bulletin::with('creator', 'type')->orderBy('id','desc')->take(6)->get();

        $p = $request->site_id ? Policy::with('creator', 'type')->whereHas('site', function ($b) use ($request) {
                                    $b->where('id', $request->site_id);
                                })->orderBy('id','desc')->take(6)->get() : Policy::with('creator', 'type')->orderBy('id','desc')->take(6)->get();

        return response()->json([
            'status' => true,
            'background' => DImg::get(),
            'hazard_open' => $ho,
            'hazard_close' => $hc,
            'accident_open' => $ao,
            'accident_close' => $ac,
            'bulletin' => $b,
            'policy' => $p,
        ]);
    }
}
