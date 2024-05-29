<?php

namespace App\Http\Controllers\Monitoring;

/* Base App */
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/* Validation */
// use App\Http\Requests\She\TrainingRequest;

/* Models */
use App\Models\Monitoring\Whises;

/* Libraries */
use DataTables;
// use Entrust;
use HasRoles;
use Carbon;
use Hash;
use PDF;
use App\Libraries\Helpers;
use App\Models\File\Files;

class WhisesController extends Controller
{
    protected $link = 'monitoring/whises/';
    protected $perms = 'whises';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setPerms($this->perms);
        $this->setTitle("Whises");
        $this->setModalSize("mini");
        $this->setSubtitle("Monitoring");
        $this->setBreadcrumb(['Monitoring' => '#', 'Whises' => '#']);

        // Header Grid Datatable
        $this->setTableStruct([
            [
                'data' => 'num',
                'name' => 'num',
                'label' => '#',
                'orderable' => false,
                'searchable' => false,
                'className' => "center aligned",
                'width' => '40px',
            ],
            [
                'data' => 'ip_address',
                'name' => 'ip_address',
                'label' => 'IP Address',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",

            ],[
                'data' => 'name',
                'name' => 'name',
                'label' => 'Nama',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",

            ],[
                'data' => 'ucapan',
                'name' => 'ucapan',
                'label' => 'Ucapan',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",

            ],
            [
                'data' => 'created_at',
                'name' => 'created_at',
                'label' => 'Visitor Date',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",

            ],
            /* --------------------------- */
            [
                'data' => 'action',
                'name' => 'action',
                'label' => 'Action',
                'searchable' => false,
                'sortable' => false,
                'className' => "center aligned",
                'width' => '100px',
            ]
        ]);
    }

    public function grid(Request $request)
    {
        $records = Whises::select('*');
        //Init Sort
        if (!isset(request()->order[0]['column'])) {
            $records->orderBy('created_at', 'desc');
        }

        $link = $this->link;
        return DataTables::of($records)
            ->addColumn('num', function ($record) use ($request) {
                return $request->get('start');
            })
            ->editColumn('created_at', function ($record) {
                return $record->created_at->diffForHumans();
            })
            ->addColumn('action', function ($record) use ($link){
                $btn = '';
                $btn .= $this->makeButton([
                    'type' => 'delete',
                    'id'   => $record->id,
                    'url'   => url($link.$record->id)
                ]);

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function index()
    {
        $this->setSubtitle("Monitoring");
        return $this->render('modules.monitoring.whises.index', ['mockup' => false]);
    }

    public function destroy($id)
    {
        $record = Whises::find($id);
        $record->delete();

        return response([
            'status' => true,
        ]);
    }

}
