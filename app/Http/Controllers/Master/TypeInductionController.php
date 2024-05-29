<?php

namespace App\Http\Controllers\Master;

/* Base App */
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/* Validation */
use App\Http\Requests\Master\TypeInductionRequest;

/* Models */
use App\Models\Master\TypeInduction;
use App\Models\Trail\Trail;

/* Libraries */
use DataTables;
// use Entrust;
use HasRoles;
use Carbon;
use Hash;

class TypeInductionController extends Controller
{
    protected $link = 'master/type-induction/';
    protected $perms = 'master-type-induction';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setPerms($this->perms);
        $this->setTitle("Induction Type");
        $this->setModalSize("mini");
        $this->setBreadcrumb(['Master' => '#', 'Induction Type' => '#']);

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
                'label' => 'Type',
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
              'width' => '120px',
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
        $records = TypeInduction::with('creator')->select('*');
        //Init Sort
    		if (!isset(request()->order[0]['column'])) {
    				$records->orderBy('created_at', 'desc');
    		}else{
    				if(request()->order[0]['column'] == 2)
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
        if ($material_name = $request->material_name) {
            $records->where('name', 'like', '%' . $material_name . '%');
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
                    'type' => 'edit',
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
        return $this->render('modules.master.induction-type.index', ['mockup' => false]);
    }

    public function store(TypeInductionRequest $request)
    {
        $record = new TypeInduction;
        $record->fill($request->all());
        $record->save();
        Trail::log('Master '.$this->getTitle(), 'Create a new record', request()->ip(), auth()->user()->id);

        return response([
            'status' => true
        ]);
    }

    public function create()
    {
        return $this->render('modules.master.induction-type.create');
    }

    public function edit($id)
    {
        return $this->render('modules.master.induction-type.edit', [
            'record' => TypeInduction::find($id),
        ]);
    }

    public function update(TypeInductionRequest $request)
    {
        $record = TypeInduction::find($request->id);
        $record->fill($request->all());
        $record->save();
        Trail::log('Master '.$this->getTitle(), 'Edited a record', request()->ip(), auth()->user()->id);

        return response([
            'status' => true
        ]);
    }

    public function destroy($id)
    {
        try {
            $record = TypeInduction::find($id);
            $record->delete();
            Trail::log('Master '.$this->getTitle(), 'Deleted a record', request()->ip(), auth()->user()->id);

        } catch (Exception $e) {
              return response([
                'status' => false,
                'errors' => $e
            ]);
        }

        return response([
            'status' => true,
        ]);
    }
}
