<?php

namespace App\Http\Controllers\Master;

/* Base App */
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/* Validation */
use App\Http\Requests\Master\TypeEquipmentRequest;

/* Models */
use App\Models\Master\TypeEquipment;
use App\Models\Trail\Trail;

/* Libraries */
use DataTables;
// use Entrust;
use HasRoles;
use Carbon;
use Hash;

class TypeEquipmentController extends Controller
{
    protected $link = 'master/type-equipment/';
    protected $perms = 'master-type-equipment';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setPerms($this->perms);
        $this->setTitle("Equipment Type");
        $this->setModalSize("mini");
        $this->setBreadcrumb(['Master' => '#', 'Equipment Type' => '#']);

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
                'data' => 'name',
                'name' => 'name',
                'label' => 'Equipment Type',
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
                'width' => '150px',
            ],
            [
                'data' => 'created_at',
                'name' => 'created_at',
                'label' => 'Created At',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",
                'width' => '150px',
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
        $records = TypeEquipment::with('creator')->select('*');
        //Init Sort
        if (!isset(request()->order[0]['column'])) {
            $records->orderBy('created_at', 'desc');
        }

        //Filters
        if ($name = $request->name) {
            $records->where('name', 'like', '%' . $name . '%');
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
        return $this->render('modules.master.type-equipment.index', ['mockup' => false]);
    }

    public function create()
    {
        return $this->render('modules.master.type-equipment.create');
    }

    public function store(TypeEquipmentRequest $request)
    {
        try {
            $record = TypeEquipment::saveData($request);
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
        $record = TypeEquipment::find($id);

        return $this->render('modules.master.type-equipment.edit', [
            'record' => $record
        ]);
    }


    public function update(TypeEquipmentRequest $request, $id)
    {
         try {
            $record = TypeEquipment::saveData($request);
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
        $record = TypeEquipment::find($id);
        $record->delete();
        Trail::log('Master '.$this->getTitle(), 'Deleted a record', request()->ip(), auth()->user()->id);

        return response([
            'status' => true,
        ]);
    }
}
