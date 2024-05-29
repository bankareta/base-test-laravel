<?php

namespace App\Http\Controllers\Konfigurasi;

/* Base App */
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
/* Models */
use App\Models\Trail\Trail;

/* Libraries */
use DataTables;
use Carbon;
use Hash;

class AuditTrailController extends Controller
{
    protected $link = 'konfigurasi/audit-trail/';
    protected $perms = 'audit-trail';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setPerms($this->perms);
        $this->setTitle("Audit Trail");
        $this->setModalSize("mini");
        $this->setBreadcrumb(['Configuration' => '#', 'Audit Trail' => '#']);

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
            /* --------------------------- */
            [
                'data' => 'modul_name',
                'name' => 'modul_name',
                'label' => 'Modules',
                'searchable' => false,
                'sortable' => true,
                'width' => '120px',
            ],
            [
                'data' => 'trail',
                'name' => 'trail',
                'label' => 'Activity',
                'searchable' => false,
                'sortable' => true,
                'className' => "left aligned",
                'width' => '120px',
            ],
            [
                'data' => 'user.display',
                'name' => 'user.display',
                'label' => 'User',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",
                'width' => '120px',
            ],
            [
                'data' => 'client_ip',
                'name' => 'client_ip',
                'label' => 'Client IP',
                'searchable' => false,
                'sortable' => true,
                'width' => '120px',
                'className' => "center aligned",
            ],
            [
                'data' => 'created_at',
                'name' => 'created_at',
                'label' => 'Tanggal',
                'searchable' => false,
                'sortable' => true,
                'width' => '120px',
                'className' => "center aligned",
            ]
        ]);
    }

    public function grid(Request $request)
    {
        $records = Trail::with('creator', 'user')
        ->when($module_name = $request->module_name, function ($d) use ($module_name){
            $d->where('modul_name', 'like', '%' . $module_name . '%');
        })
        ->when($trail = $request->trail, function ($d) use ($trail){
            $d->where('trail', 'like', '%' . $trail . '%');
        })
        ->when($user = $request->user, function ($d) use ($user){
            $d->whereHas('user', function ($u) use ($user) {
              $u->where('fullname', 'like', '%' . $user . '%')->orWhere('username', 'like', '%' . $user . '%');
            });
        })
        ->when($date = $request->date, function ($d) use ($date){
            $d->whereDate('created_at', Carbon::createFromFormat('F d, Y', $date)->format('Y-m-d'));
        })->select('*');
        //Init Sort

        if (!isset(request()->order[0]['column'])) {
            $records->orderBy('created_at', 'desc');
        }else if(request()->order[0]['column'] == 3){
            if(request()->order[0]['dir'] == 'desc')
            {
              $records = $records->get()->sortByDesc('user.display');
            }else{
              $records = $records->get()->sortBy('user.display');
            }
        }

        $link = $this->link;
        return DataTables::of($records)
            ->addColumn('num', function ($record) use ($request) {
                return $request->get('start');
            })
            ->editColumn('created_at', function ($record) use ($request) {
                return $record->created_at->format('F d, Y H:i:s');
            })
            ->make(true);
    }

    public function index()
    {
        return $this->render('modules.konfigurasi.trail.index', ['mockup' => false]);
    }
}
