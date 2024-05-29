<?php

namespace App\Http\Controllers\Planning;

/* Base App */
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/* Validation */
// use App\Http\Requests\She\TrainingRequest;

/* Models */
use App\Models\Monitoring\Gift;

/* Libraries */
use DataTables;
// use Entrust;
use HasRoles;
use Carbon;
use Hash;
use PDF;
use App\Libraries\Helpers;
use App\Models\File\Files;
use App\Models\Planning\SeserahanList;

class SeserahanListController extends Controller
{
    protected $link = 'planning/seserahan-list/';
    protected $perms = 'seserahan-list';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setPerms($this->perms);
        $this->setTitle("Seserahan List");
        $this->setModalSize("large");
        $this->setSubtitle("Planning");
        $this->setBreadcrumb(['Planning' => '#', 'Seserahan List' => '#']);

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
                'data' => 'type',
                'name' => 'type',
                'label' => 'Type',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",

            ],[
                'data' => 'name',
                'name' => 'name',
                'label' => 'List',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",

            ],[
                'data' => 'merk',
                'name' => 'merk',
                'label' => 'Merk',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",

            ],[
                'data' => 'link',
                'name' => 'link',
                'label' => 'Link',
                'searchable' => false,
                'sortable' => false,
                'className' => "center aligned",

            ],[
                'data' => 'desc',
                'name' => 'desc',
                'label' => 'Desc',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",

            ],[
                'data' => 'real_budget',
                'name' => 'real_budget',
                'label' => 'Real Budget',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",

            ],[
                'data' => 'status',
                'name' => 'status',
                'label' => 'Status',
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
        $records = SeserahanList::select('*');
        //Init Sort
        if (!isset(request()->order[0]['column'])) {
            $records->orderBy('id', 'desc');
        }
        if ($list = $request->list) {
            $records->where('name', 'like', '%' . $list . '%');
        }
        $link = $this->link;
        return DataTables::of($records)
            ->addColumn('num', function ($record) use ($request) {
                return $request->get('start');
            })
            ->editColumn('real_budget', function ($record) {
                return number_format($record->real_budget, 0, '', '.');
            }) 
            ->editColumn('created_at', function ($record) {
                return $record->created_at->diffForHumans();
            })
            ->editColumn('status', function ($record) {
                return $record->statusLabel();
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
                $btn .= $this->makeButton([
                    'type' => 'delete',
                    'id'   => $record->id,
                    'url'   => url($link.$record->id)
                ]);

                return $btn;
            })
            ->rawColumns(['action','status'])
            ->make(true);
    }

    public function index()
    {
        $this->setSubtitle("Planning");
        return $this->render('modules.planning.seserahan-list.index', ['mockup' => false]);
    }

    public function create()
    {
        $this->setTitle("Seserahan List");
        $this->setSubtitle("Planning");
        $this->setBreadcrumb(['Planning' => '#', 'Seserahan List' => url($this->link), 'Create' => '#']);

        return $this->render('modules.planning.seserahan-list.create');
    }

    public function edit($id)
    {
        $record = SeserahanList::find($id);

        return $this->render('modules.planning.seserahan-list.edit', [
            'record' => $record
        ]);
    }

    public function store(Request $request)
    {
        foreach ($request->type as $key => $value) {
            $record = new SeserahanList;
            $record->fill([
                'type' => $value,
                'name' => $request->name[$key],
                'merk' => $request->merk[$key],
                'link' => $request->link[$key],
                'real_budget' => $request->real_budget[$key],
            ]);
            $record->save();
        }
        return response([
            'status' => true,
        ]);
    }

    public function update(Request $request, $id)
    {
         try {
            $record = SeserahanList::find($id);
            $record->fill([
                'type' => $request->type,
                'name' => $request->name,
                'merk' => $request->merk,
                'link' => $request->link,
                'real_budget' => $request->real_budget,
            ]);
            $record->save();
    
            return response([
                'status' => true,
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
        $record = Gift::find($id);
        $record->delete();

        return response([
            'status' => true,
        ]);
    }

}
