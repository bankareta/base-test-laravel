<?php

namespace App\Http\Controllers\Ceremonial;

/* Base App */
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/* Validation */
// use App\Http\Requests\She\TrainingRequest;

/* Models */
use App\Models\Ceremonial\Ceremonial;

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

class CeremonialController extends Controller
{
    protected $link = 'ceremonial/ceremonial/';
    protected $perms = 'ceremonial';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setPerms($this->perms);
        $this->setTitle("Ceremonial");
        $this->setModalSize("mini");
        $this->setSubtitle("Ceremonial");
        $this->setBreadcrumb(['Ceremonial' => '#', 'Ceremonial' => '#']);
    }

    public function index()
    {
        $this->setSubtitle("Ceremonial");
        return $this->render('modules.ceremonial.index', [
            'mockup' => false,
            'record' => Acara::get()
        ]);
    }

    public function store(Request $request)
    {
        $check = Acara::get();
        if($check->count() > 0){
            $record = Acara::find($check->first()->id);
        }else{
            $record = new Acara;
        }
        $request['wedding_date'] = Helpers::DateTimeToSql($request->wedding_date);
        $record->fill($request->all());
        $record->save();

        return response([
            'status' => true,
        ]);
    }

    public function destroy($id)
    {
        $record = Acara::find($id);
        $record->delete();

        return response([
            'status' => true,
        ]);
    }

}
