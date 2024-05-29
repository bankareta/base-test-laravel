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
use App\Models\Planning\WeddingList;
use App\Models\Planning\WeddingListDetail;

class BudgetListController extends Controller
{
    protected $link = 'planning/budget-list/';
    protected $perms = 'budget-list';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setPerms($this->perms);
        $this->setTitle("Wedding List");
        $this->setModalSize("large");
        $this->setSubtitle("Planning");
        $this->setBreadcrumb(['Planning' => '#', 'Wedding List' => '#']);

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
                'data' => 'name',
                'name' => 'name',
                'label' => 'List',
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
                'data' => 'dp',
                'name' => 'dp',
                'label' => 'DP',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",

            ],[
                'data' => 'debt',
                'name' => 'debt',
                'label' => 'Debt',
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
        $records = WeddingList::select('*');
        //Init Sort
        if (!isset(request()->order[0]['column'])) {
            $records->orderBy('created_at', 'desc');
        }

        $link = $this->link;
        return DataTables::of($records)
            ->addColumn('num', function ($record) use ($request) {
                return $request->get('start');
            })
            ->editColumn('real_budget', function ($record) {
                return number_format($record->real_budget, 0, '', '.');
            }) 
            ->editColumn('dp', function ($record) {
                return number_format($record->dp, 0, '', '.');
            })
            ->editColumn('debt', function ($record) {
                return number_format($record->debt, 0, '', '.');
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
        return $this->render('modules.planning.budget-list.index', ['mockup' => false]);
    }

    public function create()
    {
        $this->setTitle("Wedding List");
        $this->setSubtitle("Planning");
        $this->setBreadcrumb(['Planning' => '#', 'Wedding List' => url($this->link), 'Create' => '#']);

        return $this->render('modules.planning.budget-list.create');
    }

    public function edit($id)
    {
        $record = WeddingList::find($id);

        return $this->render('modules.planning.budget-list.edit', [
            'record' => $record
        ]);
    }

    public function store(Request $request)
    {
        if (isset($request->child_name)) {
            if(count($request->child_name) > 0){
                $request['dp'] = array_sum($request->child_budget);
            }
        }
        $record = new WeddingList;
        $record->fill([
            'name' => $request->name,
            'qty' => $request->qty,
            'vendor' => $request->vendor,
            'plan_budget' => $request->plan_budget,
            'real_budget' => $request->real_budget,
            'dp' => $request->dp,
            'debt' => $request->real_budget - $request->dp,
            'status' => ($request->real_budget - $request->dp) < 1 ? 1:0,
        ]);
        $record->save();

        if (isset($request->child_name)) {
            if(count($request->child_name) > 0){
                foreach ($request->child_name as $key => $value) {
                    $child = new WeddingListDetail;
                    $child->fill([
                        'wedding_list_id' => $record->id,
                        'name' => $value,
                        'real_budget' => $request->child_budget[$key],
                    ]);
                    $child->save();
                }
            }
        }

        return response([
            'status' => true,
        ]);
    }

    public function update(Request $request, $id)
    {
         try {
            if (isset($request->child_name)) {
                if(count($request->child_name) > 0){
                    $request['dp'] = array_sum($request->child_budget);
                }
            }
            $record = WeddingList::find($id);
            $record->fill([
                'name' => $request->name,
                'qty' => $request->qty,
                'vendor' => $request->vendor,
                'plan_budget' => $request->plan_budget,
                'real_budget' => $request->real_budget,
                'dp' => $request->dp,
                'debt' => $request->real_budget - $request->dp,
                'status' => ($request->real_budget - $request->dp) < 1 ? 1:0,
            ]);
            $record->save();
            $record->child()->delete();

            if (isset($request->child_name)) {
                if(count($request->child_name) > 0){
                    foreach ($request->child_name as $key => $value) {
                        $child = new WeddingListDetail;
                        $child->fill([
                            'wedding_list_id' => $record->id,
                            'name' => $value,
                            'real_budget' => $request->child_budget[$key],
                        ]);
                        $child->save();
                    }
                }
            }
    
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
