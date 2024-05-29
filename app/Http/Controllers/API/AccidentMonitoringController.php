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
use App\Models\Master\Site;
use App\Models\Master\TypeIncident;
use App\Models\Authentication\User;

use Carbon;
use Zipper;
use PDF;

class AccidentMonitoringController extends Controller
{
    public function index(Request $request)
    {
        $records = Report::with('preparedby','reviewedby','investigationrequest','approver','site','investigationfile','incidentfile','actionplan')->showByUserApi($request->user_id)->select('*');
        
        
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
            $count = count($rec);
        }

        return response()->json([
            'status' => true,
            'data' => $rec,
            'total' => $count
        ]);
        
    }

    public function printPdf($id)
    {
        $record = Report::find($id);
        $site = Site::all();
        $incident_type = TypeIncident::get()->split(3);
        $approver = $record->approver->pluck('username')->split(2);

        $transpose_app = array();
        foreach ($approver as $i => $columns) {
            foreach ($columns as $j => $column2) {
                $transpose_app[$j] = $column2;
            }
        }
        $approver_size = sizeof($transpose_app);
        // dd($transpose_app);
        $arraychunk = array_chunk($transpose_app, 2);

        $pdf = PDF::loadView('modules.accident-incident.reports.print', [
            'record' => $record,
            'today' => Helpers::DateToString(Carbon::now()),
            'date' => Helpers::DateToString(Carbon::parse($record->date)),
            'site' => $site,
            'user' => User::first(),
            'size' => $approver_size,
            'approver' => $arraychunk,
            'incident_type' => $incident_type,
          ])->setPaper('a4', 'potrait')->setOptions(
            [
              'defaultFont' => 'times-roman',
              'isHtml5ParserEnabled' => true,
              'isRemoteEnabled' => true,
              'isPhpEnabled' => true
            ]
          );
          return $pdf->stream('HSE-IRI-PRO-0001-02.pdf');
    }
}
