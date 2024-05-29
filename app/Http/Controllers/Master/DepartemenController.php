<?php

namespace App\Http\Controllers\Master;

/* Base App */
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/* Validation */
use App\Http\Requests\Master\DepartemenRequest;

/* Models */
use App\Models\Master\Departemen;
use App\Models\Trail\Trail;

/* Libraries */
use DataTables;
// use Entrust;
use HasRoles;
use Carbon;
use Hash;

class DepartemenController extends Controller
{
    protected $link = 'master/departemen/';
    protected $perms = 'master-departemen';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setPerms($this->perms);
        $this->setTitle("Department");
        $this->setModalSize("mini");
        $this->setBreadcrumb(['Master' => '#', 'Department' => '#']);

        // Header Grid Datatable
        $this->setTableStruct([
            [
                'data' => 'num',
                'name' => 'num',
                'label' => '#',
                'orderable' => false,
                'searchable' => false,
                'className' => "center aligned",
                'width' => '30px',
            ],
            /* --------------------------- */
            [
                'data' => 'name',
                'name' => 'name',
                'label' => 'Department',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",
                'width' => '400px',
            ],
            [
                'data' => 'site_id',
                'name' => 'site_id',
                'label' => 'Company',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",
                'width' => '400px',
            ],
            [
                'data' => 'person.display',
                'name' => 'person.display',
                'label' => 'Person In Charge',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",
            ],
            [
                'data' => 'creator.display',
                'name' => 'creator.display',
                'label' => 'Created By',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",
            ],
            [
                'data' => 'created_at',
                'name' => 'created_at',
                'label' => 'Created At',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",

            ],
            [
                'data' => 'action',
                'name' => 'action',
                'label' => 'Action',
                'searchable' => false,
                'sortable' => false,
                'className' => "center aligned",
                'width' => '150px',
            ]
        ]);
    }

    public function grid(Request $request)
    {
        $records = Departemen::with('person', 'creator')->select('*');
        //Init Sort
        if (!isset(request()->order[0]['column'])) {
            $records->orderBy('created_at', 'desc');
        }else{
            if(request()->order[0]['column'] == 2)
            {
                $records = Departemen::with('creator', 'person')->get();
                $records->sortBy('person.display');
            }
            if(request()->order[0]['column'] == 3)
            {
                if(request()->order[0]['dir'] == 'desc')
                {
                  $records = $records->get()->sortByDesc('creator.display');
                }else{
                  $records = $records->get()->sortBy('creator.display');
                }
            }
        }

        //Filters
        if ($name = $request->name) {
            $records->where('name', 'like', '%' . $name . '%');
        }
        if ($company = $request->company) {
            $records->where('site_id',$company);
        }

        $link = $this->link;

        return DataTables::of($records)
            ->addColumn('num', function ($record) use ($request) {
                return $request->get('start');
            })

            ->editColumn('created_at', function ($record) {
                return $record->created_at->diffForHumans();
            })
            ->editColumn('pic', function ($record) {
                return $record->person['username'];
            })
            ->editColumn('site_id', function ($record) {
                return $record->site_id ? $record->site->name:'';
            })
            ->addColumn('action', function ($record) use ($link){
                $btn = '';

                $btn .= $this->makeButton([
                    'type' => 'modal',
                    'datas' => [
                        'id' => $record->id
                    ],
                    'disabled' => auth()->user()->can($this->perms.'-edit'),
                    'id'   => $record->id
                ]);
                // Delete
                $btn .= $this->makeButton([
                    'type' => 'delete',
                    'id'   => $record->id,
                    'url'   => url($link.$record->id)
                ]);

                return $btn;
            })
            ->rawColumns(['action','pic'])
            ->make(true);
    }

    public function index()
    {
        return $this->render('modules.master.departemen.index', ['mockup' => false]);
    }

    public function create()
    {
        return $this->render('modules.master.departemen.create');
    }

    public function store(DepartemenRequest $request)
    {
        try {
            $record = Departemen::saveData($request);
            Trail::log('Master '.$this->getTitle(), 'Create a new record', request()->ip(), auth()->user()->id);
            return response([
                'status' => true
            ]);
        } catch (Exception $e) {
            return response([
                'status' => false,
                'data' => $e
            ]);
        }
    }

    public function edit($id)
    {
        $record = Departemen::find($id);

        return $this->render('modules.master.departemen.edit', [
            'record' => $record
        ]);
    }


    public function update(DepartemenRequest $request, $id)
    {
         try {
            $record = Departemen::saveData($request);
            Trail::log('Master '.$this->getTitle(), 'Edited a record', request()->ip(), auth()->user()->id);
            return response([
                'status' => true
            ]);
        } catch (Exception $e) {
            return response([
                'status' => false,
                'data' => $e
            ]);
        }
    }

    public function destroy($id)
    {
        $record = Departemen::find($id);
        Trail::log('Master '.$this->getTitle(), 'Deleted a record', request()->ip(), auth()->user()->id);
        $record->delete();

        return response([
            'status' => true,
        ]);
    }
}
