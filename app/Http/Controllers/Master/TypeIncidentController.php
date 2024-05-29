<?php

namespace App\Http\Controllers\Master;

/* Base App */
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/* Validation */
use App\Http\Requests\Master\TypeIncidentRequest;

/* Models */
use App\Models\Master\TypeIncident;
use App\Models\Trail\Trail;

/* Libraries */
use DataTables;
use HasRoles;
use Carbon;
use Hash;

class TypeIncidentController extends Controller
{
    protected $link = 'master/type-incident/';
    protected $perms = 'master-type-incident';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setPerms($this->perms);
        $this->setTitle("Incident Type");
        $this->setModalSize("mini");
        $this->setBreadcrumb(['Master' => '#', 'Incident Type' => '#']);

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
                'label' => 'Name',
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
        $records = TypeIncident::with('creator')->select('*');
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
            ->rawColumns(['action','type'])
            ->make(true);
    }

    public function index()
    {
        return $this->render('modules.master.type-incident.index', ['mockup' => false]);
    }

    public function create()
    {
        return $this->render('modules.master.type-incident.create');
    }

    public function store(TypeIncidentRequest $request)
    {
        try {
            $record = TypeIncident::saveData($request);
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
        $record = TypeIncident::find($id);

        return $this->render('modules.master.type-incident.edit', [
            'record' => $record
        ]);
    }


    public function update(TypeIncidentRequest $request, $id)
    {
         try {
            $record = TypeIncident::saveData($request);
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
        $record = TypeIncident::find($id);
        $record->delete();
        Trail::log('Master '.$this->getTitle(), 'Deleted a record', request()->ip(), auth()->user()->id);

        return response([
            'status' => true,
        ]);
    }
}
