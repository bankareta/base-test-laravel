<?php

namespace App\Http\Controllers\She;

/* Base App */
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/* Validation */
use App\Http\Requests\She\McuRequest;

/* Models */
use App\Models\She\Mcu;
use App\Models\She\McuMail;
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
use App\Models\Master\Site;

class McuController extends Controller
{
    protected $link = 'she/medical-checkup/';
    protected $perms = 'medical-checkup';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setPerms($this->perms);
        $this->setTitle("Medical Check Up");
        $this->setModalSize("mini");
        $this->setSubtitle("E-Form");
        $this->setBreadcrumb(['E-Form' => '#', 'Medical Check Up' => '#']);

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
                'data' => 'title',
                'name' => 'title',
                'label' => 'Title',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",

            ],
            [
                'data' => 'user_id',
                'name' => 'user_id',
                'label' => 'Employee',
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
                'data' => 'type_id',
                'name' => 'type_id',
                'label' => 'MCU Type',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",

            ],
            [
                'data' => 'due_date',
                'name' => 'due_date',
                'label' => 'Due date',
                'searchable' => false,
                'sortable' => false,
                'className' => "center aligned",

            ],
            [
                'data' => 'assign',
                'name' => 'assign',
                'label' => 'Assign to',
                'searchable' => false,
                'sortable' => false,
                'className' => "center aligned",

            ],
            [
                'data' => 'status',
                'name' => 'status',
                'label' => 'Status',
                'searchable' => false,
                'sortable' => false,
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
                'width' => '170px',
            ]
        ]);
    }

    public function grid(Request $request)
    {
        $records = Mcu::with('site','mail')->whereNull('mcu_id')->select('*');

        //Init Sort
        if (!isset(request()->order[0]['column'])) {
            $records->orderBy('created_at', 'desc');
        }

        //Filters
        if ($company = $request->company) {
            $records->where('site_id',$company);
        }else{
            $records->whereIn('site_id', auth()->user()->site->pluck('id')->toArray());
        }
        
        if ($employee_id = $request->employee_id) {
            $records->where('user_id',$employee_id);
        }else{
            $records->where(function ($q){
                $q->whereHas('mail', function($q){
                    $q->where('user_id',auth()->user()->id);
                })->orWhere('created_by', auth()->user()->id)->orWhere('user_id', auth()->user()->id);
            });
        }

        if ($department = $request->department) {
            $records->where('department', 'like', '%' . $department . '%');
        }

        if ($start_date = $request->start_date) {
			$records->whereDate('due_date', '>=', Helpers::DateToSql($start_date) );
		}

        if ($end_date = $request->end_date) {
			$records->whereDate('due_date', '<=', Helpers::DateToSql($end_date) );
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
            ->editColumn('user_id', function ($record) {
                return $record->employee->display;
            })
            ->editColumn('type_id', function ($record) {
                return $record->type->name;
            })
            ->addColumn('assign', function ($record) {
                return $record->mail->user ? $record->mail->user->email:'';
            })
            ->editColumn('due_date', function ($record) {
                return $record->noticeDueDate();
            })
            ->editColumn('status', function ($record) {
                return $record->positionlabel();
            })
            ->addColumn('action', function ($record) use ($link){
                $btn = '';

                if($record->created_by == auth()->user()->id){
                    if($record->due_date){
                        $date = Helpers::DateParse($record->due_date);
                        if(Carbon::parse($date)->isPast())
                        {
                            $btn .= $this->makeButton([
                                'type' => 'print',
                                'class' => 'black icon send-notif',
                                'label' => '<i class="bell icon"></i>',
                                'tooltip' => 'Send Notification',
                                'id'   => $record->id,
                                'url'   => '#'
                            ]);
                        }else if(Carbon::parse($date) < Carbon::now()->addWeeks(2)){
                            $btn .= $this->makeButton([
                                'type' => 'print',
                                'class' => 'black icon send-notif',
                                'label' => '<i class="bell icon"></i>',
                                'tooltip' => 'Send Notification',
                                'id'   => $record->id,
                                'url'   => '#'
                            ]);
                        }
                    }
                }

                if($record->mail->user->id == auth()->user()->id){
                    $btn .= $this->makeButton([
                        'type' => 'url',
                        'class' => 'yellow icon reviewer',
                        'label' => '<i class="check icon"></i>',
                        'tooltip' => 'Submit Result MCU',
                        'id'   => $record->id,
                        'url'   => url($link.'mcu-review').'/'.$record->id
                    ]);
                }

                if($record->mail->user->id == auth()->user()->id){
                    if($record->due_date){
                        $btn .= $this->makeButton([
                            'type' => 'print',
                            'id'   => $record->id,
                            'url'   => url($link.$record->id.'/print')
                        ]);
                    }
                }

                $btn .= $this->makeButton([
                    'type' => 'detail-page',
                    'label' => '<i class="eye icon"></i>',
                    'tooltip' => 'Detail Data',
                    'id'   => $record->id,
                ]);

                if(!$record->status){
                    $btn .= $this->makeButton([
                        'type' => 'url',
                        'label' => '<i class="edit icon"></i>',
                        'disabled' => auth()->user()->can($this->perms.'-edit'),
                        'url'   => url($link.$record->id.'/edit')
                    ]);
                }
                // Delete
                $btn .= $this->makeButton([
                    'type' => 'delete',
                    'id'   => $record->id,
                    'url'   => url($link.$record->id)
                ]);

                return $btn;
            })
            ->rawColumns(['action','due_date','status'])
            ->make(true);
    }

    public function index()
    {
        $this->setSubtitle("E-Form");
        return $this->render('modules.she.medical-checkup.index', ['mockup' => false]);
    }

    public function create()
    {
        $this->setTitle("Create Medical Check Up");
        $this->setSubtitle("E-Form");
        $this->setBreadcrumb(['E-Form' => '#', 'Medical Check Up' => url($this->link), 'Create' => '#']);

        return $this->render('modules.she.medical-checkup.create');
    }

    public function store(McuRequest $request)
    {
        try {
            $request['doc_no'] = Site::find($request->site_id)->code.'-SHE-HLT-MCU-'.Carbon::now()->format('y').'-'.$request->employee_id;
            $record = Mcu::saveData($request);
            $file_1 = $request->foto->storeAs('she/mcu', md5($request->foto->getClientOriginalName().Carbon::now()->format('Ymdhis')).'.'.$request->foto->getClientOriginalExtension(), 'public');
            $data['filename'] = $request->foto->getClientOriginalName();
            $data['url'] = $file_1;
            $data['target_type'] = 'she-mcu';
            $data['target_id'] = $record->id;
            $data['type'] = 'primary';
            $saveImg = new Files;
            $saveImg->fill($data);
            $saveImg->save();
            $saveMail = new McuMail;
            if($request->assign_id){
                $mail = User::find($request->assign_id)->email;
            }else{
                $mail = $request->mail_employee;
            }
            $saveMail->fill([
                'mcu_id' => $record->id,
                'employee' => $request->mail_employee,
                'mail' => $mail,
                'user_id' => $request->assign_id,
                'flag' => $request->propose,
            ]);
            $saveMail->save();
            $record->sentEmailReviewing();

            Trail::log($this->getTitle(), 'Has been created Medical Check Up record', request()->ip(), auth()->user()->id);

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
    
    public function sendNotification(Request $request)
    {
        try {
            $record = Mcu::findOrFail($request->id);
            $record->sentEmailReminder();

            Trail::log($this->getTitle(), 'Has been send notification assigned Medical Check Up record', request()->ip(), auth()->user()->id);

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

    public function getEmployee($id)
    {
        if($id == '-'){
            $list = User::options(function ($user) {
                return $user->display;
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
            
            $listAssign = User::options(function ($user) {
                return $user->display;
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
                return $user->display;
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
            
            $listAssign = User::options(function ($user) {
                return $user->display;
              }, 'id', ['filters' => [
                    function ($site) {
                        $site->where('status', '1');
                    },
                    function ($site) use ($id) {
                        $site->whereHas('site', function ($s) use ($id){
                            $s->where('site_id', $id);
                        })->whereHas('roles.permissions', function($q){
                            $q->where('name',$this->perms.'-approval');
                        });
                    },
            ]], 'Choose One');
        }
        return response([
            'status' => true,
            'data' => $list,
            'data_assign' => $listAssign
        ]);
    }

    public function edit($id)
    {
        $this->setTitle("Edit Medical Check Up");
        $this->setSubtitle("E-Form");
        $this->setBreadcrumb(['E-Form' => '#', 'Medical Check Up' => url($this->link), 'Edit' => '#']);

        $record = Mcu::find($id);
        return $this->render('modules.she.medical-checkup.edit', [
            'record' => $record
        ]);
    }
    
    public function apporveModal($id)
    {
        $this->setTitle("Set Appointment Medical Check Up");
        $this->setSubtitle("E-Form");
        $this->setBreadcrumb(['E-Form' => '#', 'Medical Check Up' => url($this->link), 'Set Appointment' => '#']);

        $record = Mcu::find($id);
        return $this->render('modules.she.medical-checkup.approve-modal', [
            'record' => $record
        ]);
    }
    
    public function apporveSave(request $request)
    {
        $request['status'] = 2;
        $record = Mcu::saveData($request);
        $record->sentEmailApprove();
        return response([
            'status' => true,
        ]);
    }

    public function update(McuRequest $request, $id)
    {
        try {
            if($request->type){
                if($request->type == 'review'){
                    $record = Mcu::find($id);
                    $record->fill([
                        'result_id' => $request->result_id,
                        'last_date' => $request->last_date,
                        'due_date' => $request->due_date,
                        'reason_result' => $request->reason_result,
                        'status' => 1
                    ]);
                    $record->save();
                    $record->sentEmailEmployee();
                    Trail::log($this->getTitle(), 'Has been create result Medical Check Up record', request()->ip(), auth()->user()->id);
                }else{
                    $record = Mcu::find($id);

                    $recordDup = new Mcu;
                    $recordDup->fill([
                        'site_id' => $record->site_id,
                        'user_id' => $record->user_id,
                        'name' => $record->name,
                        'gender' => $record->gender,
                        'blood_id' => $record->blood_id,
                        'date_birth' => Helpers::DateParse($record->date_birth),
                        'company' => $record->company,
                        'department' => $record->department,
                        'title' => $record->title,
                        'type_id' => $record->type_id,
                        'employee_id' => $record->employee_id,
                        'provider' => $record->provider,
                        'doc_no' => $record->doc_no,
                        'type_reports' => $record->type_reports,
                        'result_id' => $request->result_id,
                        'last_date' => $request->last_date,
                        'due_date' => $request->due_date,
                        'reason_result' => $request->reason_result,
                        'status' => 1
                    ]);
                    $recordDup->save();
                    
                    $saveMail = new McuMail;
                    $saveMail->fill([
                        'mcu_id' => $recordDup->id,
                        'employee' => $record->mail->employee,
                        'mail' => $record->mail->mail,
                        'user_id' => $record->mail->user_id,
                        'flag' => $record->mail->flag,
                    ]);
                    $saveMail->save();
                    
                    $file_1 = $request->foto->storeAs('she/mcu', md5($request->foto->getClientOriginalName().Carbon::now()->format('Ymdhis')).'.'.$request->foto->getClientOriginalExtension(), 'public');
                    $data['filename'] = $request->foto->getClientOriginalName();
                    $data['url'] = $file_1;
                    $data['target_type'] = 'she-mcu';
                    $data['target_id'] = $recordDup->id;
                    $data['type'] = 'primary';
                    $saveImg = new Files;
                    $saveImg->fill($data);
                    $saveImg->save();
                    
                    $record->fill(['mcu_id' => $recordDup->id]);
                    $record->save();
                    $recordDup->sentEmailEmployee();
                    Trail::log($this->getTitle(), 'Has been create result Medical Check Up record', request()->ip(), auth()->user()->id);
                }
            }else{
                $record = Mcu::saveData($request);
                $getMail = McuMail::where('mcu_id',$record->id)->first();
                $saveMail = McuMail::find($getMail->id);
                if($request->assign_id){
                    $mail = User::find($request->assign_id)->email;
                }else{
                    $mail = $request->mail_employee;
                }
                $saveMail->fill([
                    'mcu_id' => $record->id,
                    'employee' => $request->mail_employee,
                    'mail' => $mail,
                    'user_id' => $request->assign_id,
                    'flag' => $request->propose,
                ]);
                $saveMail->save();
                if($request->foto){
                    if(file_exists(storage_path().'/app/public/'.$record->primaryFiles->url))
                    {
                        unlink(storage_path().'/app/public/'.$record->primaryFiles->url);
                    }
                    $record->primaryFiles->delete();

                    $file_1 = $request->foto->storeAs('she/observation-card', md5($request->foto->getClientOriginalName().Carbon::now()->format('Ymdhis')).'.'.$request->foto->getClientOriginalExtension(), 'public');
                    $data['filename'] = $request->foto->getClientOriginalName();
                    $data['url'] = $file_1;
                    $data['target_type'] = 'she-observation-card';
                    $data['target_id'] = $record->id;
                    $data['type'] = 'primary';
                    $saveImg = new Files;
                    $saveImg->fill($data);
                    $saveImg->save();
                }
                Trail::log($this->getTitle(), 'Has been edited Medical Check Up record', request()->ip(), auth()->user()->id);
            }
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
        $this->setTitle("Detail Medical Check Up");
        $this->setSubtitle("E-Form");
        $this->setBreadcrumb(['E-Form' => '#', 'Medical Check Up' => url($this->link), 'Detail' => '#']);

        $record = Mcu::findOrFail($id);
        $status = true;
        $approved = false;
        if($record->due_date){
            $date = Helpers::DateParse($record->due_date);
            if(Carbon::parse($date)->isPast())
            {
                $status = true;
            }else if(Carbon::parse($date) < Carbon::now()->addWeeks(2)){
                $status = true;
            }else{
                $status = false;
            }

            if($status){
                if(auth()->user()->id == $record->employee->id){
                    if(!$record->appointment_date){
                        $approved = true;
                    }
                }
            }
        }
        return $this->render('modules.she.medical-checkup.show', [
            'record' => $record,
            'due_date' => $status,
            'approved' => $approved
        ]);
    }
    
    public function mcuReview($id)
    {
        $this->setTitle("Medical Check Up Action Result");
        $this->setSubtitle("E-Form");
        $this->setBreadcrumb(['E-Form' => '#', 'Medical Check Up' => url($this->link), 'Action Result' => '#']);

        $record = Mcu::findOrFail($id);
        
        return $this->render('modules.she.medical-checkup.review', [
            'record' => $record,
        ]);
    }
    
    public function destroy($id)
    {
        $record = Mcu::find($id);
        if($record->primaryFiles){
            if(file_exists(storage_path().'/app/public/'.$record->primaryFiles->url))
            {
                unlink(storage_path().'/app/public/'.$record->primaryFiles->url);
            }
            $record->primaryFiles->delete();
        }
        if($record->history->count() > 0){
            foreach ($record->history as $key => $history) {
                if($history->primaryFiles){
                    if(file_exists(storage_path().'/app/public/'.$history->primaryFiles->url))
                    {
                        unlink(storage_path().'/app/public/'.$history->primaryFiles->url);
                    }
                    $history->primaryFiles->delete();
                }
            }
            $record->history()->delete();
        }
        Trail::log($this->getTitle(), 'Has been deleted Medical Check Up record', request()->ip(), auth()->user()->id);
        $record->delete();

        return response([
            'status' => true,
        ]);
    }

    public function printPdf($id)
    {
        $record = Mcu::find($id);
        $pdf = PDF::loadView('modules.she.medical-checkup.pdf', [
            'routes' => $this->link,
            'record' => $record,
            'title' => 'FIRST AID AND MEDICAL CARE',
            'no_doc' => 'SE-MSHE-WHH-PRO-0001',
            'revision' => '2 (Draft)',
            'name_file' => 'FM-KP-Blank',
            'today' => Helpers::DateToString(Carbon::now())
        ])
        ->setPaper('a4', 'potrait')
        ->setWarnings(false);

        return $pdf->stream("FM-KP-Blank.pdf");
    }
}
