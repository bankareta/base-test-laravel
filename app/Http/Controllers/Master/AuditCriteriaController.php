<?php

namespace App\Http\Controllers\Master;

/* Base App */
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/* Validation */
use App\Http\Requests\Master\AuditCriteriaRequest;

/* Models */
use App\Models\Master\AuditCriteria;
use App\Models\Trail\Trail;

/* Libraries */
use DataTables;
use HasRoles;
use Carbon;
use Hash;

class AuditCriteriaController extends Controller
{
    protected $link = 'master/audit-criteria/';
    protected $perms = 'master-audit-criteria';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setPerms($this->perms);
        $this->setTitle("Audit Criteria");
        $this->setModalSize("mini");
        $this->setBreadcrumb(['Master' => '#', 'Criteria' => '#']);

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
                'label' => 'Criteria',
                'searchable' => false,
                'sortable' => true,
                // 'className' => "center aligned",
            ],
            [
                'data' => 'created_at',
                'name' => 'created_at',
                'label' => 'Created At',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",
                'width' => '120px',

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
        $records = AuditCriteria::with('creator')->select('*');
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
        return $this->render('modules.master.audit-criteria.index', ['mockup' => false]);
    }

    public function create()
    {
        return $this->render('modules.master.audit-criteria.create');
    }

    public function store(AuditCriteriaRequest $request)
    {
        try {
            $record = AuditCriteria::saveData($request);
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
        $record = AuditCriteria::find($id);

        return $this->render('modules.master.audit-criteria.edit', [
            'record' => $record
        ]);
    }


    public function update(AuditCriteriaRequest $request, $id)
    {
         try {
            $record = AuditCriteria::saveData($request);
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
        $record = AuditCriteria::find($id);
        Trail::log('Master '.$this->getTitle(), 'Deleted a record', request()->ip(), auth()->user()->id);
        $record->delete();

        return response([
            'status' => true,
        ]);
    }
}
