<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Unlu\Laravel\Api\QueryBuilder;
use App\Http\Controllers\Controller;
use App\Models\Hnmr\Reporting;
use App\Models\Hnmr\ReportingEvidences;
use App\Models\Accident\Report;
use App\Libraries\Helpers;

use Carbon\Carbon;

class AccidentController extends Controller
{
    public function index(Request $request)
    {
        $count = 0;
        $records = Report::with('preparedby','reviewedby','investigationrequest','approver','site','investigationfile','incidentfile','actionplan')->where('status',0)->showByUserApi($request->user_id)->select('*');
        

        if(isset($request->id)){
            $records = $records->where('id',$request->id);
        }

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

        $records = $records->orderBy('created_at', 'desc')->get();
        $collections = $records->map(function($q){
            $w = $q;
            $w->preparedby->setAppends([]);
            $w->reviewedby->setAppends([]);
            $w->investigationrequest->setAppends([]);
            return $w;
        });
        if($request->id){
            $rec = $collections->first();
            $count = 1;
        }else{
            $rec = $collections->all();
            $count=count($rec);
        }
        return response()->json([
            'status' => true,
            'count' => $count,
            'data' => $rec
        ]);
    }

    public function store(Request $request)
    {
        try {
            $record = new Report;
            $request['incident_number'] = Report::noDocSite($request->site_id);
            if($request->type_incident_id == 0){
                $request['other_incident'] = 1;
            }
            if ($request->type_incident_id > 0) {
                $request['other_incident'] = 0;
                $request['other_incident_type'] = null;
            }
            $record->fill($request->all());
            $dateTime = Helpers::DateTimeToSql($request->date_of_incident);
            // dd($dateTime);
            $record->date_of_incident = $dateTime;
            $record->save();
            if ($request->type_incident_id > 0) {
                $record->incidenttype()->sync($request->type_incident_id);
            }
            $todo = 'action-plan';

            $record->saveFileApi($record->id,$request,$todo);
            $record->saveAtionPlan($request,$record->id);

            $record->approver()->sync($request->approver);
            $record->sendNotAndro('you have a new accident '.$record->incident_number,'incident');
            if ($request->type_incident_id > 0) {
                $record->incidenttype()->sync($request->type_incident_id);
            }

            if($record->status == 1)
            {
                $record->sentEmailAction();
                $record->sendNotAndro('there is new Accident/Incident for you to action '.$record->incident_number,'incident');

            }
            return response()->json([
                'status' => true,
                'message' => 'Data successfully saved with Incident Number : '.$record->incident_number,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'data' => $e
            ]);
        }

    }

    public function getNumber()
    {
        return response()->json([
            'status' => true,
            'show_number' => Report::noDoc(),
        ]);
    }

    public function sendAction(Request $request)
    {
        $record = Report::find($request->id);
        $record->fill(['status' => 1]);
        $record->save();
        $record->sendNotAndro('there is new Accident/Incident for you to action '.$record->incident_number,'incident');

        return response()->json([
            'status' => true,
        ]);
    }

    public function getNumberSite(Request $request)
    {
        return response()->json([
            'status' => true,
            'show_number' => Report::noDocSite($request->site_id),
        ]);
    }
}
