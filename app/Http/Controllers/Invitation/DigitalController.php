<?php

namespace App\Http\Controllers\Invitation;

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
use App\Models\Undangan\Undangan;

class DigitalController extends Controller
{
    protected $link = 'invitation/digital/';
    protected $perms = 'digital';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setPerms($this->perms);
        $this->setTitle("Undangan Digital");
        $this->setModalSize("large");
        $this->setSubtitle("Tamu Undangan");
        $this->setBreadcrumb(['Tamu Undangan' => '#', 'Undangan Digital' => '#']);

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
                'label' => 'Tamu Undangan',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",

            ],[
                'data' => 'no_telp',
                'name' => 'no_telp',
                'label' => 'No Whatsapp',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",

            ],[
                'data' => 'from',
                'name' => 'from',
                'label' => 'Undangan Pihak',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",

            ],
            // [
            //     'data' => 'count_sender',
            //     'name' => 'count_sender',
            //     'label' => 'Status',
            //     'searchable' => false,
            //     'sortable' => true,
            //     'className' => "center aligned",

            // ],
            /* --------------------------- */
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
        $records = Undangan::select('*');
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
            ->editColumn('created_at', function ($record) {
                return $record->created_at->diffForHumans();
            })
            ->editColumn('from', function ($record) {
                return $record->fromLabel();
            })
            ->editColumn('count_sender', function ($record) {
                return $record->countLabel();
            })
            ->addColumn('action', function ($record) use ($link){
                $btn = '';
                $mess = '';
                if($record->from == 'male'){
                    $mess = Helpers::getMessageWhatsapp($record->name);
                }else{
                    $mess = Helpers::getMessageWhatsappFemale($record->name);
                }
                $btn .= $this->makeButton([
                    'type' => 'print',
                    'class' => 'black icon copy-invit',
                    'label' => '<i class="copy icon"></i>',
                    'tooltip' => 'Copy Link Invitation',
                    'id'   => base64_encode($mess),
                    'url'   => '#'
                ]);
                if($record->no_telp){
                    $btn .= $this->makeButton([
                        'type' => 'url',
                        'class' => 'yellow icon',
                        'label' => '<i class="envelope outline icon"></i>',
                        'tooltip' => 'Send Whatsapp Message',
                        'url'   => 'https://api.whatsapp.com/send?phone='.Helpers::changeNumber($record->no_telp).'&text='
                    ]);
                }
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
            ->rawColumns(['action','from','count_sender'])
            ->make(true);
    }

    public function index()
    {
        $this->setSubtitle("Tamu Undangan");
        return $this->render('modules.invitation.digital.index', ['mockup' => false]);
    }

    public function create()
    {
        $this->setTitle("Undangan Digital");
        $this->setSubtitle("Tamu Undangan");
        $this->setBreadcrumb(['Tamu Undangan' => '#', 'Undangan Digital' => url($this->link), 'Create' => '#']);

        return $this->render('modules.invitation.digital.create');
    }

    public function edit($id)
    {
        $record = Undangan::find($id);

        return $this->render('modules.invitation.digital.edit', [
            'record' => $record
        ]);
    }

    public function store(Request $request)
    {
        foreach ($request->name as $key => $value) {
            $record = new Undangan;
            $record->fill([
                'name' => $value,
                'no_telp' => $request->no_telp[$key],
                'from' => $request->from[$key],
                'type' => 'digital',
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
            if (isset($request->child_name)) {
                if(count($request->child_name) > 0){
                    $request['dp'] = array_sum($request->child_budget);
                }
            }
            $record = Undangan::find($id);
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
        $record = Undangan::find($id);
        $record->delete();

        return response([
            'status' => true,
        ]);
    }

}
