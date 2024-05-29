<?php

namespace App\Http\Controllers\Monitoring;

/* Base App */
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/* Validation */
// use App\Http\Requests\She\TrainingRequest;

/* Models */
use App\Models\Monitoring\Resv;

/* Libraries */
use DataTables;
// use Entrust;
use HasRoles;
use Carbon;
use Hash;
use PDF;
use App\Libraries\Helpers;
use App\Models\File\Files;

class ResvController extends Controller
{
    protected $link = 'monitoring/resv/';
    protected $perms = 'resv';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setPerms($this->perms);
        $this->setTitle("Reservation");
        $this->setModalSize("mini");
        $this->setSubtitle("Monitoring");
        $this->setBreadcrumb(['Monitoring' => '#', 'Reservation' => '#']);

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
                'data' => 'name',
                'name' => 'name',
                'label' => 'Nama',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",

            ],[
                'data' => 'kehadiran',
                'name' => 'kehadiran',
                'label' => 'Kehadiran',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",

            ],[
                'data' => 'jumlah',
                'name' => 'jumlah',
                'label' => 'Jumlah Orang',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",

            ],
            [
                'data' => 'created_at',
                'name' => 'created_at',
                'label' => 'Created Date',
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
        $records = Resv::select('*');
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
        return $this->render('modules.monitoring.resv.index', ['mockup' => false]);
    }

    public function destroy($id)
    {
        $record = Resv::find($id);
        $record->delete();

        return response([
            'status' => true,
        ]);
    }

}
