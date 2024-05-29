<?php

namespace App\Http\Controllers\Master;

/* Base App */
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/* Validation */
use App\Http\Requests\Master\TipePolicyRequest;
use App\Models\Trail\Trail;

/* Models */
use App\Models\Master\TipePolicy;

/* Libraries */
use DataTables;

class PolicyTypeController extends Controller
{
     protected $link = 'master/type-policy/';
    protected $perms = 'master-type-policy';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setPerms($this->perms);
        $this->setTitle("Policy & Procedure Type");
        $this->setModalSize("mini");
        $this->setBreadcrumb(['Master' => '#', 'Policy & Procedure Type' => '#']);

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
				'label' => 'Policy & Procedure Type',
				'searchable' => false,
				'sortable' => true,
        'width' => '150px',
			],
      [
        'data' => 'description',
        'name' => 'description',
        'label' => 'Description',
        'searchable' => false,
        'sortable' => true,
        'className' => "left aligned",
        'width' => '150px',
      ],
      [
        'data' => 'creator.display',
        'name' => 'creator.display',
        'label' => 'Created By',
        'searchable' => false,
        'sortable' => false,
        'className' => "center aligned",
        'width' => '120px',
      ],
			[
				'data' => 'created_at',
				'name' => 'created_at',
				'label' => 'Created At',
				'searchable' => false,
				'sortable' => false,
				'className' => "center aligned",
				'width' => '100px',
			],
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
        $records = TipePolicy::with('creator')->select('*');;
        // dd($records->get());
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
            ->editColumn('description', function ($record) {
              return $record->readMoreText('description', 150);
            })
            ->addColumn('action', function ($record) use ($link){
                $btn = '';

                $btn .= $this->makeButton([
                    'type' => 'modal',
                    'datas' => [
                        'id' => $record->id
                    ],
                    'tooltip' => 'Edit Data',
                    'disabled' => auth()->user()->can($this->perms.'-edit'),
                    'id'   => $record->id
                ]);
                // Delete
                $btn .= $this->makeButton([
                    'type' => 'delete',
                    'tooltip' => 'Delete',
                    'id'   => $record->id,
                    'url'   => url($link.$record->id)
                ]);

                return $btn;
            })
            ->rawColumns(['action', 'description'])
            ->make(true);
    }

    public function index()
    {
        return $this->render('modules.master.policy-type.index', ['mockup' => false]);
    }

    public function create()
    {
        return $this->render('modules.master.policy-type.create');
    }

    public function store(TipePolicyRequest $request)
    {
        try {
            $record = TipePolicy::saveData($request);
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
        $record = TipePolicy::find($id);

        return $this->render('modules.master.policy-type.edit', [
            'record' => $record
        ]);
    }

    public function update(TipePolicyRequest $request, $id)
    {
        try {
            $record = TipePolicy::saveData($request);
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
        $jabatan = TipePolicy::find($id);
        Trail::log('Master '.$this->getTitle(), 'Deleted a record', request()->ip(), auth()->user()->id);
        $jabatan->delete();
        // $jabatan->deleteIdJabatanFromRefJabatanUser($id);

        return response([
            'status' => true,
        ]);
    }
}
