<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Unlu\Laravel\Api\QueryBuilder;
use App\Http\Controllers\Controller;
use App\Models\File\Files;
use App\Models\She\Fauna;
use App\Models\Trail\Trail;
use App\Libraries\Helpers;

use Carbon;

class FaunaController extends Controller
{
    public function index(Request $request)
    {
        $records = Fauna::with('site','photo', 'video')->orderBy('id','desc')->select('*');

        if($request->site_id){
            $records = $records->where('site_id', $request->site_id);
        }

        $records = $records->orderBy('created_at', 'desc')->get();
        $collections = $records->map(function($q){
            $w = $q;
            $w->site->makeHidden('offline_training');
            return $w;
        });

        return response()->json([
            'status' => true,
            'data' => $collections->all()
        ]);
    }

    public function store(Request $request)
    {

        try {
            $request['created_by'] = auth('api-jwt')->user()->id;
            $request['date_taken'] = Helpers::DateToString(Carbon::parse($request->date_taken));
            $record = Fauna::saveData($request);
            $i = 0;
            if(isset($request->foto)){
                if(count($request->foto) > 0){
                    foreach($request->foto as $picture)
                    {
                        $get = $picture->storeAs('she-fauna', md5($picture->getClientOriginalName().Carbon::now()->format('Ymdhis').$i).'.'.$picture->getClientOriginalExtension(), 'public');
                        asset('storage/'.$get);
                        $asset[$i] = $get;
                        $filename[$i] = $picture->getClientOriginalName();
        
                        $i++;
                    }
                    $request['filespath'] = $asset;
                    $request['filesname'] = $filename;
                    foreach ($request->filespath as $key => $path) {
                        $data['filename'] = $request->filesname[$key];
                        $data['url'] = $path;
                        $data['target_type'] = 'she-fauna';
                        $data['target_id'] = $record->id;
                        $data['type'] = 'foto';
                        $saveImg = new Files;
                        $saveImg->fill($data);
                        $saveImg->save();
                    }
                }
            }
            if($request->video){
                $get = $request->video->storeAs('she-fauna', md5($request->video->getClientOriginalName().Carbon::now()->format('Ymdhis').$i).'.'.$request->video->getClientOriginalExtension(), 'public');
                asset('storage/'.$get);
                $link = $get;
    
                $dataVideo['filename'] = $request->video->getClientOriginalName();
                $dataVideo['url'] = $link;
                $dataVideo['target_type'] = 'she-fauna';
                $dataVideo['target_id'] = $record->id;
                $dataVideo['type'] = 'video';
                $saveVideo = new Files;
                $saveVideo->fill($dataVideo);
                $saveVideo->save();
            }
    
            Trail::log($this->getTitle(), 'Has been created Fauna Sighting record', request()->ip(), auth('api-jwt')->user()->id);
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
