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
use App\Models\She\ObservationCard;
use Carbon;

class ObservationCardController extends Controller
{
    public function index(Request $request)
    {
        
    }

    public function store(Request $request)
    {
        try {
            $request['type'] = 0;
            $request['date'] = Helpers::DateToString(Carbon::parse($request->date));
            $record = ObservationCard::saveData($request);

            $file_1 = $request->foto->storeAs('she/observation-card', md5($request->foto->getClientOriginalName().Carbon::now()->format('Ymdhis')).'.'.$request->foto->getClientOriginalExtension(), 'public');
            $data['filename'] = $request->foto->getClientOriginalName();
            $data['url'] = $file_1;
            $data['target_type'] = 'she-observation-card';
            $data['target_id'] = $record->id;
            $data['type'] = 'primary';
            
            if(count($request->category_id) > 0){
                foreach ($request->category_id as $key => $value) {
                    $categorys[$key] = [
                        "nilai" => $value
                    ]; 
                }
                $record->category()->sync($categorys);
            }
            
            $saveImg = new Files;
            $saveImg->fill($data);
            $saveImg->save();
            
            if($request->other_foto){
                $file_2 = $request->other_foto->storeAs('she/observation-card', md5($request->other_foto->getClientOriginalName().Carbon::now()->format('Ymdhis')).'.'.$request->other_foto->getClientOriginalExtension(), 'public');
                $data['filename'] = $request->other_foto->getClientOriginalName();
                $data['url'] = $file_2;
                $data['target_type'] = 'she-observation-card';
                $data['target_id'] = $record->id;
                $data['type'] = 'secondary';
                $saveImg = new Files;
                $saveImg->fill($data);
                $saveImg->save();
            }

            $record->sentEmailReviewing();
            Trail::log($this->getTitle(), 'Has been created SHE Observation Card record', request()->ip(), auth('api-jwt')->user()->id);

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
