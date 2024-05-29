<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Unlu\Laravel\Api\QueryBuilder;
use App\Http\Controllers\Controller;
use App\Models\Hnmr\Reporting;
use App\Models\Hnmr\ReportingEvidences;
use App\Models\Accident\Report;
use App\Models\Accident\ReportActionPlan;
use App\Libraries\Helpers;

use Carbon\Carbon;

class AccidentActionController extends Controller
{
    public function index(Request $request)
    {
        // $records = Report::whereIn('status',[1,3])->select('*');
        $records = ReportActionPlan::with('evidencefile','pic','accident.investigationfile','accident.incidentfile')->whereHas('accident',function($q) use($request){
            $q->whereIn('status',[1,3]);
                // ->orWhere('incident_number', 'like', '%'.strtolower($request->incident_number).'%')
                // ->orWhere('title', 'like', '%'.$request->title.'%')
                // ->orWhere('incident_location', 'like', '%'.$request->incident_location.'%')
                // ->orWhere('site_id', $request->site_id);
        })->where('status',0)->showByUserApi($request->user_id)->select('*');

        if($request->incident_number){
            $records = $records->whereHas('accident',function($q) use($request){
                $q->where('incident_number', 'like', '%'.strtolower($request->incident_number).'%');
            });
        }

        if($request->title){
            $records = $records->whereHas('accident',function($q) use($request){
                $q->where('title', 'like', '%'.$request->title.'%');
            });
        }

        if($request->site_id){
            $records = $records->whereHas('accident',function($q) use($request){
                $q->where('site_id', $request->site_id);
            });
        }

        if($request->incident_location){
            $records = $records->whereHas('accident',function($q) use($request){
                $q->where('incident_location','like', '%'.$request->incident_location.'%');
            });
        }

        if($request->due_date){
            $records = $records->where('due_date', $request->due_date);
        }

        return response()->json([
            'status' => true,
            'count' => $records->orderBy('created_at', 'desc')->count(),
            'data' => $records->orderBy('created_at', 'desc')->get()
        ]);
    }

    public function store(Request $request)
    {
        try {
            $record = ReportActionPlan::find($request->id);
            $record->saveFileApi($request);
            $record->fill($request->all());
            $record->save();
            if($request->status == 1){
                $record->sendNotAndro('Accident/Incident action has been approved '.$record->accident->incident_number,'incident');
            }
            $cheked = ReportActionPlan::where('accident_incident_id',$record->accident_incident_id);
            if($cheked->sum('status') == $cheked->get()->count()){
                Report::find($record->accident_incident_id)->fill(['status' => 2])->save();
            }
            return response([
                'status' => true
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'data' => $e
            ]);
        }

    }
}
