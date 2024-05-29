<?php

namespace App\Http\Controllers\Frontend;

/* Base App */
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/* Validation */
use App\Http\Requests\She\TrainingRequest;

/* Models */
use App\Models\She\Training;
use App\Models\She\TrainingMail;
use App\Models\Trail\Trail;
use App\Models\Authentication\User;

/* Libraries */
use DataTables;
// use Entrust;
use HasRoles;
use Carbon;
use Hash;
use PDF;
use App\Libraries\Helpers;
use App\Models\Design\Acara;
use App\Models\File\Files;
use App\Models\Monitoring\Gift;
use App\Models\Monitoring\Resv;
use App\Models\Monitoring\Visitor;
use App\Models\Monitoring\Whises;

class SebarController extends Controller
{
    public function index()
    {
        $visitor_name = 'Anonymous';
        if(count(request()->all()) > 0){
            if(isset(request()->sdr)){
                $visitor_name = request()->sdr;
                if(isset(array_keys(request()->toArray())[1])){
                    $visitor_name = request()->sdr.' & '.str_replace('_',' ',array_keys(request()->toArray())[1]);
                }
            }
        }
        $log = new Visitor;
        $log->fill([
            'visitor' => $visitor_name,
            'ip_address' => request()->ip(),
        ]);
        $log->save();
        $whises = Whises::orderBy('created_at', 'desc')->get();
        // $rand = Carbon::now()->format('md');
        // if ($rand % 2 == 0) {
        //     return $this->render('modules.frontend.undangan.index2', [
        //         'tamu' => $visitor_name,
        //         'total_comments' => $whises->count(), 
        //         'comments' => $whises,
        //         'record' => Acara::get()->first(),
        //         'mockup' => false
        //     ]);
        // }
        return $this->render('modules.frontend.undangan.index2', [
            'tamu' => $visitor_name,
            'total_comments' => $whises->count(), 
            'comments' => $whises,
            'record' => Acara::get()->first(),
            'mockup' => false
        ]);
    }
    
    public function home()
    {
        $visitor_name = 'Anonymous';
        if(count(request()->all()) > 0){
            if(isset(request()->sdr)){
                $visitor_name = request()->sdr;
                if(isset(array_keys(request()->toArray())[1])){
                    $visitor_name = request()->sdr.' & '.str_replace('_',' ',array_keys(request()->toArray())[1]);
                }
            }
        }
        $log = new Visitor;
        $log->fill([
            'visitor' => $visitor_name,
            'ip_address' => request()->ip(),
        ]);
        $log->save();
        $whises = Whises::orderBy('created_at', 'desc')->get();
        // $rand = Carbon::now()->format('md');
        // if ($rand % 2 == 0) {
        //     return $this->render('modules.frontend.undangan.index2', [
        //         'tamu' => $visitor_name,
        //         'total_comments' => $whises->count(), 
        //         'comments' => $whises,
        //         'record' => Acara::get()->first(),
        //         'mockup' => false
        //     ]);
        // }
        return $this->render('modules.frontend.undangan.index', [
            'tamu' => $visitor_name,
            'total_comments' => $whises->count(), 
            'comments' => $whises,
            'record' => Acara::get()->first(),
            'mockup' => false
        ]);
    }
    public function uploadGift(Request $request)
    {
        $path = $request->file->storeAs('gift', md5($request->file->getClientOriginalName().Carbon::now()->format('Ymdhisu')).'.'.$request->file->getClientOriginalExtension(), 'public');
        $record = new Gift;
        $record->fill([
            'name' => $request->tamu,
            'ip_address' => request()->ip(),
            'filename' => $request->file->getClientOriginalName(),
            'url' => $path,
        ]);
        $record->save();
        
        return response([
            'status' => true,
        ]);
    }
    
    public function saveResv(Request $request)
    {
        $record = new Resv;
        $record->fill([
            'name' => $request->form_fields['nama'],
            'kehadiran' => $request->form_fields['kehadiran'],
            'jumlah' => $request->form_fields['jumlah'],
        ]);
        $record->save();
        
        return response([
            'status' => true,
        ]);
    }
    
    public function saveWishes(Request $request)
    {
        $record = new Whises;
        $record->fill([
            'ip_address' => request()->ip(),
            'name' => $request->author,
            'ucapan' => $request->comment,
        ]);
        $record->save();
        
        return response([
            'status' => true,
            'name' => $record->name,
            'ucapan' => $record->ucapan,
            'tanggal' => $record->created_at->diffForHumans(),
        ]);
    }
}
