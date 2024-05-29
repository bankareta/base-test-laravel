<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Unlu\Laravel\Api\QueryBuilder;
use App\Http\Controllers\Controller;
use App\Models\File\Files;
use App\Models\She\Fauna;
use App\Models\Trail\Trail;
use App\Libraries\Helpers;
use App\Models\Monitoring\PobReporting;
use Carbon;

class PobController extends Controller
{
    public function index(Request $request)
    {
        $record = PobReporting::where('created_by', auth('api-jwt')->user()->id)
                ->whereDate('created_at', Carbon::now()->format('Y-m-d'))->where('is_mobile',1)->first();
        if($record){
            if($record->date_exit){
                $screening = 'check-out';
            }else{
                $screening = 'check-in';
            }
        }else{
            $screening = 'ready';
        }

        return response()->json([
            'status' => true,
            'screening' => $screening, 
            'data' => $record
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request['date_arrive'] = Helpers::DateToString(Carbon::now());  
            $request['time_arrive'] = Carbon::now()->format('H:i');  
            $request['is_mobile'] = 1;   
            $record = PobReporting::saveData($request);

            if($request->foto){
                $get = $request->foto->storeAs('she-fauna', md5($request->foto->getClientOriginalName().Carbon::now()->format('Ymdhis')).'.'.$request->foto->getClientOriginalExtension(), 'public');
                asset('storage/'.$get);
                $link = $get;
    
                $data['filename'] = $request->foto->getClientOriginalName();
                $data['url'] = $link;
                $data['target_type'] = 'pob-reporting';
                $data['target_id'] = $record->id;
                $data['type'] = 'primary';
                $saveFoto = new Files;
                $saveFoto->fill($data);
                $saveFoto->save();
            }
            Trail::log($this->getTitle(), 'Has been created POB Reporting record', request()->ip(), auth('api-jwt')->user()->id);
            return response()->json([
                'status' => true,
                'message' => 'Data successfully saved.',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'data' => $e
            ]);
        }

    }

    public function update(Request $request,$id)
    {
        try {
            $request['date_exit'] = Helpers::DateToString(Carbon::now());  
            $request['time_exit'] = Carbon::now()->format('H:i');  

            $record = PobReporting::findOrFail($id);
            $record->fill([
                'date_exit' => $request->date_exit,
                'time_exit' => $request->time_exit,
                'reason_exit_id' => $request->reason_exit_id,
            ]);
            $record->save();

            Trail::log($this->getTitle(), 'Has been add Date Exit and Reason POB Reporting record', request()->ip(), auth('api-jwt')->user()->id);
            return response()->json([
                'status' => true,
                'message' => 'Data successfully saved.',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'data' => $e
            ]);
        }
    }
}
