<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Unlu\Laravel\Api\QueryBuilder;
use App\Http\Controllers\Controller;
use App\Models\File\Files;
use App\Models\She\Fauna;
use App\Models\Trail\Trail;
use App\Libraries\Helpers;
use App\Models\Inspection\PreTrip;
use App\Models\Monitoring\PobReporting;
use App\Models\She\ObservationCard;
use Carbon;

class PreTripController extends Controller
{
    public function index(Request $request)
    {
        
    }

    public function store(Request $request)
    {
        try {
            $dates = $request->date_inspection;
            $request['date_inspection'] = Helpers::DateToString(Carbon::parse($request->date_inspection));
            $request['no_police'] = $string = preg_replace('/\s+/', '', $request->no_police);

            $checkData = PreTrip::where('no_police',$request->no_police)
                ->whereDate('date_inspection',$dates)
                ->where('shift', $request->shift)
                ->first();
                
            if ($checkData) {
                return response()->json([
                    'status' => false,
                    'message' => 'This police number ('.$request->no_police.') has been inspection on the '.$request->date_inspection.' in the '.$checkData->shift.' shift.',
                    'data' => null
                ]);
            }else{
                $record = PreTrip::saveData($request);
                if(count($request->criteria_id) > 0){
                    foreach ($request->criteria_id as $key => $value) {
                        $filename = '';
                        $urlFiles = '';
                        $comment = isset($request->comment[$key]) ? $request->comment[$key]:'';

                        if(isset($request->attachment[$key])){
                            $file_1 = $request->attachment[$key]->storeAs('inspection/pre-trip', md5($request->attachment[$key]->getClientOriginalName().Carbon::now()->format('Ymdhis')).'.'.$request->attachment[$key]->getClientOriginalExtension(), 'public');
                            $filename = $request->attachment[$key]->getClientOriginalName();
                            $urlFiles = $file_1;
                        }
                        $categorys[$key] = [
                            "nilai" => $value,
                            "comment" => $comment,
                            "filename" => $filename,
                            "url" => $urlFiles
                        ]; 
                    }
                    $record->criteria()->sync($categorys);
                }
                
                Trail::log($this->getTitle(), 'Has been created Pre Trip Inspection record', request()->ip(), auth('api-jwt')->user()->id);

                return response()->json([
                    'status' => true,
                    'message' => 'Data successfully saved.',
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'data' => $e
            ]);
        }

    }
}
