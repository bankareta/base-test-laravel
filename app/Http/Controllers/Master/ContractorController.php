<?php

namespace App\Http\Controllers\Master;

/* Base App */
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/* Validation */
use App\Http\Requests\Master\ContractorRequest;

/* Models */
use App\Models\Master\Contractor;
use App\Models\Trail\Trail;

/* Libraries */
use DataTables;
// use Entrust;
use HasRoles;
use Carbon;
use Hash;

class ContractorController extends Controller
{
    protected $link = 'master/contractor/';
    protected $perms = 'master-contractor';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setPerms($this->perms);
        $this->setTitle("Contractor");
        $this->setModalSize("small");
        $this->setBreadcrumb(['Master' => '#', 'Contractor' => '#']);

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
                'data' => 'company',
                'name' => 'company',
                'label' => "Contractor's Name",
                'searchable' => false,
                'sortable' => true,
                'class' => 'center aligned',
                'width' => '150px',
            ],
            [
                'data' => 'reference',
                'name' => 'reference',
                'label' => 'Contract Reference No',
                'searchable' => false,
                'sortable' => true,
                'class' => 'center aligned',
                'width' => '150px',
            ],
            [
                'data' => 'owner',
                'name' => 'owner',
                'label' => 'Owner',
                'searchable' => false,
                'sortable' => true,
                'class' => 'center aligned',
                'width' => '150px',
            ],
            [
                'data' => 'email',
                'name' => 'email',
                'label' => 'Email',
                'searchable' => false,
                'sortable' => true,
                'class' => 'center aligned',
                'width' => '150px',
            ],
            [
                'data' => 'hp',
                'name' => 'hp',
                'label' => 'Hp / Telp',
                'searchable' => false,
                'sortable' => true,
                'class' => 'center aligned',
                'width' => '100px',
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
        $records = Contractor::with('creator')->select('*');
        //Init Sort
        if (!isset(request()->order[0]['column'])) {
            $records->orderBy('created_at', 'desc');
        }else{
            if(request()->order[0]['column'] == 6)
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
            $records->where('company', 'like', '%' . $name . '%');
        }

        if ($reference = $request->reference) {
            $records->where('reference', 'like', '%' . $reference . '%');
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
        return $this->render('modules.master.contractor.index', ['mockup' => false]);
    }

    public function create()
    {
        return $this->render('modules.master.contractor.create');
    }

    public function store(ContractorRequest $request)
    {
        try {
            $record = Contractor::saveData($request);
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
        $record = Contractor::find($id);

        return $this->render('modules.master.contractor.edit', [
            'record' => $record
        ]);
    }


    public function update(ContractorRequest $request, $id)
    {
         try {
            $record = Contractor::saveData($request);
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
        $record = Contractor::find($id);
        Trail::log('Master '.$this->getTitle(), 'Deleted a record', request()->ip(), auth()->user()->id);
        $record->delete();

        return response([
            'status' => true,
        ]);
    }
}
