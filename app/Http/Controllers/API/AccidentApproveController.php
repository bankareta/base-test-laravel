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

class AccidentApproveController extends Controller
{
    public function index(Request $request)
    {
        $user_id = $request->user_id;
        $records = Report::with(['action_plan' => function($filter){
            $filter->where('status',1)->where('slug',0);
        },'action_plan.evidencefile','investigationfile','incidentfile','site'])->whereHas('approver', function($q) use ($user_id){
            $q->where('approver_id', $user_id);
        })->where('status', 2)->select('*');
        
        if($request->incident_number){
            $records = $records->where('incident_number', 'like', '%'.strtolower($request->incident_number).'%');
        }

        if($request->date_of_incident){
            $records = $records->whereDate('date_of_incident', $request->date_of_incident);
        }

        if($request->title){
            $records = $records->where('title', 'like', '%'.$request->title.'%');
        }

        if($request->incident_location){
            $records = $records->where('incident_location', 'like', '%'.$request->incident_location.'%');
        }

        if($request->site_id){
            $records = $records->where('site_id', $request->site_id);
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
            foreach ($request->status as $key2 => $value) {
                $record = ReportActionPlan::find($key2);
                $add['slug'] = 0;
                if($value == 1){
                    $add['slug'] = 1;
                }
                $add['status'] = $value;
                $record->fill($add);
                $record->save();
                $record->sendNotAndro('Accident/Incident action has been '.$record->getStatusDescAttribute().' '.$record->accident->incident_number,'incident');
            }
            $cheked = ReportActionPlan::where('accident_incident_id',$record->accident_incident_id);
            if($cheked->sum('status') != $cheked->get()->count()){
                $rec = Report::find($record->accident_incident_id);
                $rec->fill(['status' => 3]);
                $rec->save();
                $rec->sendNotAndro('Accident/Incident has been '.$rec->positionstring().' '.$rec->incident_number,'incident');
            }else{
                $rec = Report::find($record->accident_incident_id);
                $rec->fill(['status' => 4]);
                $rec->save();
                $rec->sendNotAndro('Accident/Incident has been '.$rec->positionstring().' '.$rec->incident_number,'incident');
            }
            return response([
                'status' => true
            ]);
        } catch (Exception $e) {
            return response([
                'status' => false,
                'data' => $e
            ]);
        }
    }
}
