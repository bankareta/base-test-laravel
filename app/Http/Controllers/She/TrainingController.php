<?php

namespace App\Http\Controllers\She;

/* Base App */
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/* Validation */
use App\Http\Requests\She\TrainingRequest;

/* Models */
use App\Models\She\Training;
use App\Models\She\TrainingMail;
use App\Models\Trail\Trail;
use App\Models\Authentication\User;

/* Libraries */
use DataTables;
// use Entrust;
use HasRoles;
use Carbon;
use Hash;
use PDF;
use App\Libraries\Helpers;
use App\Models\File\Files;

class TrainingController extends Controller
{
    protected $link = 'she/employee-training/';
    protected $perms = 'employee-training';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setPerms($this->perms);
        $this->setTitle("Employee Training");
        $this->setModalSize("mini");
        $this->setSubtitle("E-Form");
        $this->setBreadcrumb(['E-Form' => '#', 'Employee Training' => '#']);

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
                'data' => 'site_id',
                'name' => 'site_id',
                'label' => 'Company',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",

            ],
            [
                'data' => 'type_id',
                'name' => 'type_id',
                'label' => 'Training Type',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",

            ],
            [
                'data' => 'title',
                'name' => 'title',
                'label' => 'Title',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",

            ],
            [
                'data' => 'department',
                'name' => 'department',
                'label' => 'Department',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",

            ],
            [
                'data' => 'employee_name',
                'name' => 'employee_name',
                'label' => 'Employee Name',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",

            ],
            [
                'data' => 'training_date',
                'name' => 'training_date',
                'label' => 'Date of Training',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",
                
            ],
            [
                'data' => 'issued_by',
                'name' => 'issued_by',
                'label' => 'Issued by',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",

            ],
            [
                'data' => 'expire_date',
                'name' => 'expire_date',
                'label' => 'Expired Date',
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
        $records = Training::whereIn('site_id', auth()->user()->site->pluck('id')->toArray())->select('*');
        //Init Sort
        if (!isset(request()->order[0]['column'])) {
            $records->orderBy('created_at', 'desc');
        }

        //Filters
        if ($company = $request->company) {
            $records->where('site_id',$company);
        }

        if ($type = $request->type) {
            $records->where('type_id', $type);
        }

         if ($contract_no = $request->contract_no) {
            $records->whereHas('contractor',function($q) use($contract_no){
                $q->where('reference',$contract_no);
            })->get();
        }

        $link = $this->link;
        return DataTables::of($records)
            ->addColumn('num', function ($record) use ($request) {
                return $request->get('start');
            })
            ->editColumn('created_at', function ($record) {
                return $record->created_at->diffForHumans();
            })
            ->editColumn('site_id', function ($record) {
                return $record->site->name;
            })
            ->editColumn('type_id', function ($record) {
                return $record->type->name;
            })
            ->editColumn('issued_by', function ($record) {
                return $record->issued_by ? $record->employee->name:'';
            })
            ->editColumn('training_date', function ($record) {
                return Helpers::DateParse($record->training_date);
            })
            ->editColumn('expire_date', function ($record) {
                $date = Helpers::DateParse($record->expire_date);
                if(Carbon::parse($date)->isPast())
                {
                    return '<b style="color:red">'.$date.'</b>';
                }
                return $date;
            })
            ->addColumn('action', function ($record) use ($link){
                $btn = '';

                // $btn .= $this->makeButton([
                //     'type' => 'print',
                //     'id'   => $record->id,
                //     'url'   => url($link.$record->id.'/print')
                // ]);

                $btn .= $this->makeButton([
                    'type' => 'detail-page',
                    'label' => '<i class="eye icon"></i>',
                    'tooltip' => 'Detail Data',
                    'id'   => $record->id,
                ]);

                $btn .= $this->makeButton([
                    'type' => 'url',
                    'label' => '<i class="edit icon"></i>',
                    'disabled' => auth()->user()->can($this->perms.'-edit'),
                    'url'   => url($link.$record->id.'/edit')
                ]);
                // Delete
                $btn .= $this->makeButton([
                    'type' => 'delete',
                    'id'   => $record->id,
                    'url'   => url($link.$record->id)
                ]);

                return $btn;
            })
            ->rawColumns(['action','covid_status','expire_date'])
            ->make(true);
    }

    public function index()
    {
        $this->setSubtitle("E-Form");
        return $this->render('modules.she.employee-training.index', ['mockup' => false]);
    }

    public function create()
    {
        $this->setTitle("Create Employee Training");
        $this->setSubtitle("E-Form");
        $this->setBreadcrumb(['E-Form' => '#', 'Employee Training' => url($this->link), 'Create' => '#']);

        return $this->render('modules.she.employee-training.create');
    }

    public function store(TrainingRequest $request)
    {
        try {
            $record = Training::saveData($request);
            foreach ($request->filespath as $key => $path) {
                $data['filename'] = $request->filesname[$key];
                $data['url'] = $path;
                $data['target_type'] = 'she-employee-training';
                $data['target_id'] = $record->id;
                $data['type'] = 'primary';
                $saveImg = new Files;
                $saveImg->fill($data);
                $saveImg->save();
            }
            Trail::log($this->getTitle(), 'Has been created Employee Training record', request()->ip(), auth()->user()->id);

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
        $this->setTitle("Edit Employee Training");
        $this->setSubtitle("E-Form");
        $this->setBreadcrumb(['E-Form' => '#', 'Employee Training' => url($this->link), 'Edit' => '#']);

        $record = Training::find($id);
        return $this->render('modules.she.employee-training.edit', [
            'record' => $record
        ]);
    }

    public function getEmployee($id)
    {
        if($id == '-'){
            $list = User::options(function ($user) {
                return $user->email;
              }, 'id', ['filters' => [
                    function ($site) {
                        $site->where('status', '100');
                    },
                    function ($site) use ($id) {
                        $site->whereHas('site', function ($s) use ($id){
                            $s->where('site_id', 0);
                        });
                    },
            ]], 'Choose One');
        }else{
            $list = User::options(function ($user) {
                return $user->email;
              }, 'id', ['filters' => [
                    function ($site) {
                        $site->where('status', '1');
                    },
                    function ($site) use ($id) {
                        $site->whereHas('site', function ($s) use ($id){
                            $s->where('site_id', $id);
                        });
                    },
            ]], 'Choose One');
        }
        return response([
            'status' => true,
            'data' => $list,
        ]);
    }

    public function update(TrainingRequest $request, $id)
    {
        try {
            $record = Training::saveData($request);
            if(isset($request->filespath)){
                foreach ($request->filespath as $key => $path) {
                    $data['filename'] = $request->filesname[$key];
                    $data['url'] = $path;
                    $data['target_type'] = 'she-employee-training';
                    $data['target_id'] = $record->id;
                    $data['type'] = 'primary';
                    $saveImg = new Files;
                    $saveImg->fill($data);
                    $saveImg->save();
                }
            }
            if(isset($request->materi_deleted_id)){
                foreach ($request->materi_deleted_id as $key => $value) {
                    $deleteFiles = Files::find($value);
                    if(file_exists(storage_path().'/app/public/'.$deleteFiles->url))
                    {
                        unlink(storage_path().'/app/public/'.$deleteFiles->url);
                    }
                    $deleteFiles->delete();
                }
            }
            Trail::log($this->getTitle(), 'Has been edited Employee Training record', request()->ip(), auth()->user()->id);
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

    public function show($id)
    {
        $this->setTitle("Detail Employee Training");
        $this->setSubtitle("E-Form");
        $this->setBreadcrumb(['E-Form' => '#', 'Employee Training' => url($this->link), 'Detail' => '#']);

        $record = Training::find($id);
        return $this->render('modules.she.employee-training.show', [
            'record' => $record
        ]);
    }

    public function destroy($id)
    {
        $record = Training::find($id);
        if($record->primaryFiles){
            foreach ($record->primaryFiles as $key => $value) {
                if(file_exists(storage_path().'/app/public/'.$value->url))
                {
                    unlink(storage_path().'/app/public/'.$value->url);
                }
            }
            $record->primaryFiles()->delete();
        }
        Trail::log($this->getTitle(), 'Has been deleted Employee Training record', request()->ip(), auth()->user()->id);
        $record->delete();

        return response([
            'status' => true,
        ]);
    }

    public function uploadFile(Request $request)
    {
        try {
            $url = [];
            if(count($request->picture) > 0)
            {
                $i = 0;
                $j = 0;
                foreach($request->picture as $picture)
                {
                    $get = $picture->storeAs('she/employee-training', md5($picture->getClientOriginalName().Carbon::now()->format('Ymdhis').$i).'.'.$picture->getClientOriginalExtension(), 'public');
                    $url[$i]['url'] = asset('storage/'.$get);
                    $url[$i]['url_download'] = Helpers::showImgExtension($get,'audit');
                    $url[$i]['value'] = $get;
                    $url[$i]['filename'] = $picture->getClientOriginalName();
                    $i++;
                }
            }

            return response([
                'status' => true,
                'url' => $url,
            ]);

        } catch (Exception $e) {
              return response([
                'status' => false,
                'errors' => $e
            ]);
        }
    }
}
