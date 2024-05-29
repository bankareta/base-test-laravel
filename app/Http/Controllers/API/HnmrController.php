<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Unlu\Laravel\Api\QueryBuilder;
use App\Http\Controllers\Controller;
use App\Models\Hnmr\Action;
use App\Models\Hnmr\Reporting;
use App\Models\Hnmr\Monitoring;
use App\Models\Hnmr\ReportingEvidences;

use Carbon;

class HnmrController extends Controller
{
    public function index(Request $request)
    {
        $records = Reporting::with('creator', 'department', 'spv', 'reported', 'solvedpics', 'evidences')->byReportingApi($request->user_id,$request->supervisor_id)->orderBy('id','desc')->select('*');

        if($request->no_report){
            $records = $records->where('no_report', 'like', '%'.strtolower($request->no_report).'%');
        }

        if($request->date){
            $records = $records->whereDate('date', $request->date);
        }

        if($request->site_id){
            $records = $records->where('site_id', $request->site_id);
        }

        $records = $records->orderBy('created_at', 'desc')->get();

        $collections = $records->map(function($q){
            $w = $q;
            $w->spv->setAppends([]);
            $w->reported->setAppends([]);
            if(isset($w->department)){
                if(($w->department->person)){
                    $w->department->person->setAppends([]);
                }
            }
            // $w->department->person->setAppends([]);
            return $w;
        });

        return response()->json([
            'status' => true,
            'data' => $collections->all()
        ]);
    }

    public function getNumber()
    {
        return response()->json([
            'status' => true,
            'identification_number' => Reporting::generateIdNumApi(),
            'show_number' => Reporting::generateNumbersApi(),
        ]);
    }

    public function sendAction(Request $request)
    {
        if($request->picture)
        {
          if(count($request->picture) > 0)
              {
                  $i = 0;
                  foreach($request->picture as $picture)
                  {
                      $get = $picture->storeAs('hnmr/reporting', md5($picture->getClientOriginalName().Carbon::now()->format('Ymdhis').$i).'.'.$picture->getClientOriginalExtension(), 'public');
                      asset('storage/'.$get);
                      $asset[$i] = $get;
                      $addFIle['reporting_id'] = $request->id;
                      $addFIle['filepath'] = $get;
                      $saveFile = new ReportingEvidences;
                      $saveFile->fill($addFIle);
                      $saveFile->save();
                  }
              }
        }

        try {
            $record = Reporting::find($request->id);
            // $request['no_report'] = Reporting::generateNumbersBySite($request->site_id);
            // $request['identification_number'] = Reporting::generateIdNumBySite($request->site_id);
            $record->fill($request->all());
            $record->save();
            $record->saveEvidencesApi($request);

            $record->sendNotAndro('You have a new hazard report / '.$record->no_report,'hnmr');
            if($record->published == 1)
            {
                $record->sentEmailMonitoring();
                $record->sendNotAndro('You have a hazard report to monitor / '.$record->no_report,'hnmr');

            }

            return response()->json([
                'status' => true,
                'message' => 'Data successfully saved with Report No. : '.$record->id_num,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'data' => $e
            ]);
        }
    }

    public function getNumberSite(Request $request)
    {
        return response()->json([
            'status' => true,
            'identification_number' => Reporting::generateIdNumApi(),
            'show_number' => Reporting::generateNumbersBySiteApi($request->site_id),
        ]);
    }

    public function store(Request $request)
    {
        if(count($request->picture) > 0)
            {
                $i = 0;
                foreach($request->picture as $picture)
                {
                    $get = $picture->storeAs('hnmr/reporting', md5($picture->getClientOriginalName().Carbon::now()->format('Ymdhis').$i).'.'.$picture->getClientOriginalExtension(), 'public');
                    asset('storage/'.$get);
                    $asset[$i] = $get;

                    $i++;
                }
                $request['filespath'] = $asset;
            }
        try {
            $record = new Reporting;
            $request['no_report'] = Reporting::generateNumbersBySite($request->site_id);
            $request['identification_number'] = Reporting::generateIdNumBySite($request->site_id);
            $record->fill($request->all());
            $record->save();
            $record->saveEvidences($request->filespath);

            $record->sendNotAndro('You have a new hazard report / '.$record->no_report,'hnmr');
            if($record->published == 1)
            {
                $record->sentEmailMonitoring();
                $record->sendNotAndro('You have a hazard report to monitor / '.$record->no_report,'hnmr');

            }
            return response()->json([
                'status' => true,
                'message' => 'Data successfully saved with Report No. : '.$record->id_num,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'data' => $e
            ]);
        }

    }

    public function getMonitoring(Request $request)
    {
        $records = Reporting::with('creator', 'department', 'spv', 'reported','solvedpics','evidences')->byMonitoringApi($request->user_id)->orderBy('id','desc')->select('*');

        if($request->no_report){
            $records = $records->where('no_report', 'like', '%'.strtolower($request->no_report).'%');
        }

        if($request->site_id){
            $records = $records->where('site_id', $request->site_id);
        }

        if($request->date){
            $records = $records->whereDate('date', $request->date);
        }
        $records = $records->orderBy('created_at', 'desc')->get();


        $collections = $records->map(function($q){
            $w = $q;
            $w->spv->setAppends([]);
            $w->department->person->setAppends([]);
            $w->reported->setAppends([]);
            return $w;
        });

        return response()->json([
            'status' => true,
            'count' => count($collections),
            'data' => $collections->all()
        ]);
    }

    public function saveMonitor(Request $request)
    {
        try {
            $record = Monitoring::saveData($request);
            $record->setPublished($request->published);

            if($request->published == 2)
            {
                $record->reporting->sentEmailAction();
                $record->sendNotAndro('You have a new action from hazard, please complete this action / '.$record->reporting->no_report,'hnmr');
            }

            return response()->json([
                'status' => true,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'data' => $e
            ]);
        }

    }

    public function getact(Request $request)
    {
        $records = Reporting::with('department.person', 'spv', 'reported','solvedpics','evidences','monitoring.act')->byActionApi($request->user_id)->orderBy('id','desc')->select('*');

        if($request->no_report){
            $records = $records->where('no_report', 'like', '%'.strtolower($request->no_report).'%');
        }

        if($request->date){
            $records = $records->whereDate('date', $request->date);
        }

        if($request->site_id){
            $records = $records->where('site_id', $request->site_id);
        }


        $records = $records->orderBy('created_at', 'desc')->get();


        $collections = $records->map(function($q){
            $w = $q;
            $w->spv->setAppends([]);
            $w->reported->setAppends([]);
            $w->department->person->setAppends([]);
            return $w;
        });

        return response()->json([
            'status' => true,
            'count' => $collections->count(),
            'data' => $collections->all()
        ]);
    }

    public function saveact(Request $request)
    {
        try {
            $deleteAction = Action::where('monitoring_id',$request->monitoring_id);
            if($deleteAction->get()->count() > 0){
                $deleteAction->delete();
            }
            $record = new Action;
            $record->fill($request->all());
            $record->save();
            $record->setPublished($request->published);
            $record->saveImgApi($request);

            if($request->published == 3)
            {
                $record->monitoring->reporting->sentEmailClosed();
                $record->sendNotAndro('Your monitored report has been closed / '.$record->monitoring->reporting->no_report,'hnmr');
            }

            return response()->json([
                'status' => true,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'data' => $e
            ]);
        }

    }
}
