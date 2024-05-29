<?php

namespace App\Http\Controllers\Master;

/* Base App */
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/* Validation */
use App\Http\Requests\Master\SubComponentRequest;

/* Models */
use App\Models\Master\SubComponent;
use App\Models\Trail\Trail;

/* Libraries */
use DataTables;
// use Entrust;
use HasRoles;
use Carbon;
use Hash;

class SubComponentController extends Controller
{
    protected $link = 'master/sub-component/';
    protected $perms = 'master-sub-component';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setPerms($this->perms);
        $this->setTitle("Sub Component");
        $this->setModalSize("mini");
        $this->setBreadcrumb(['Master' => '#', 'Sub Component' => '#']);

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
                'data' => 'type_id',
                'name' => 'type_id',
                'label' => 'Equipment Type',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",

            ],
            [
                'data' => 'component_id',
                'name' => 'component_id',
                'label' => 'Component',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",

            ],

            [
                'data' => 'sub_component',
                'name' => 'sub_component',
                'label' => 'Sub Component',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",

            ],
            [
                'data' => 'created_at',
                'name' => 'created_at',
                'label' => 'Dibuat Pada',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",

            ],
            [
                'data' => 'action',
                'name' => 'action',
                'label' => 'Aksi',
                'searchable' => false,
                'sortable' => false,
                'className' => "center aligned",
                'width' => '150px',
            ]
        ]);
    }

    public function grid(Request $request)
    {
        $records = SubComponent::with('creator')->select('*');
        //Init Sort
        if (!isset(request()->order[0]['column'])) {
            $records->orderBy('created_at', 'desc');
        }

        //Filters
        if ($type_id = $request->type_id) {
            $records->where('type_id',$type_id);
        }

        if ($component_id = $request->component_id) {
            $records->where('component_id',$component_id);
        }

        if ($name = $request->name) {
            $records->where('sub_component', 'like', '%' . $name . '%');
        }

        $link = $this->link;
        return DataTables::of($records)
            ->addColumn('num', function ($record) use ($request) {
                return $request->get('start');
            })
            ->addColumn('component_id', function ($record) use ($request) {
                return $record->component->component;
            })
            ->addColumn('type_id', function ($record) use ($request) {
                return $record->type->type_equipment;
            })
            ->editColumn('created_at', function ($record) {
                return $record->created_at->diffForHumans();
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
            ->rawColumns(['action'])
            ->make(true);
    }

    public function index()
    {
        return $this->render('modules.master.sub-component.index', ['mockup' => false]);
    }

    public function create()
    {
        return $this->render('modules.master.sub-component.create');
    }

    public function store(SubComponentRequest $request)
    {
        // dd($request->all());
        try {
            $record = SubComponent::saveData($request);
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
        $record = SubComponent::find($id);
        return $this->render('modules.master.sub-component.edit', [
            'record' => $record
        ]);
    }


    public function update(SubComponentRequest $request, $id)
    {
         try {
            $record = SubComponent::saveData($request);
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
        $record = SubComponent::find($id);
        $record->delete();
        Trail::log('Master '.$this->getTitle(), 'Deleted a record', request()->ip(), auth()->user()->id);

        return response([
            'status' => true,
        ]);
    }
}
