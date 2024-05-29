<?php

namespace App\Http\Controllers\Master;

/* Base App */
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/* Validation */
use App\Http\Requests\Master\InductionRequest;

/* Models */
use App\Models\Master\Induction;
use App\Models\Master\InductionPlan;
use App\Models\Authentication\User;
use App\Models\Induction\InductionAnswer;
use App\Models\Trail\Trail;

/* Libraries */
use DataTables;
// use Entrust;
use HasRoles;
use Carbon;
use Hash;
use Helpers;

class InductionController extends Controller
{
    protected $link = 'master/induction/';
    protected $perms = 'master-induction';

    protected $planStruct = [
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
            'data' => 'title',
            'name' => 'title',
            'label' => 'Title',
            'searchable' => false,
            'sortable' => true,
            'className' => "left aligned",
        ],
        [
            'data' => 'date',
            'name' => 'date',
            'label' => 'Date',
            'searchable' => false,
            'sortable' => true,
            'className' => "center aligned",
        ],
        [
            'data' => 'status',
            'name' => 'status',
            'label' => 'Status',
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
            'width' => '180px',
        ]
    ];

    protected $userStruct = [
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
			'data' => 'display',
			'name' => 'display',
			'label' => 'Name',
			'searchable' => false,
			'sortable' => true,
		],
		[
			'data' => 'correct',
			'name' => 'correct',
			'label' => 'Correct Answer',
			'className' => "center aligned",
			'searchable' => false,
			'sortable' => true,
		],
		[
			'data' => 'wrong',
			'name' => 'wrong',
			'label' => 'Wrong Answer',
			'className' => "center aligned",
			'searchable' => false,
			'sortable' => true,
		],

		[
			'data' => 'status',
			'name' => 'status',
			'label' => 'Status',
			'searchable' => false,
			'sortable' => false,
			'className' => "center aligned",
			'width' => '250px',
        ],
		[
			'data' => 'action',
			'name' => 'action',
			'label' => 'Action',
			'searchable' => false,
			'sortable' => false,
			'className' => "center aligned",
			'width' => '50px',
		]
	];

    function __construct()
    {
        $this->setLink($this->link);
        $this->setPerms($this->perms);
        $this->setTitle("Induction Material");
        $this->setModalSize("small");
        $this->setBreadcrumb(['Master' => '#', 'Induction Material' => '#']);

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
                'label' => 'Material Name',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",

            ],
            [
                'data' => 'type.name',
                'name' => 'type.name',
                'label' => 'Induction Type',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",

            ],
            [
                'data' => 'type_file',
                'name' => 'type_file',
                'label' => 'Material File Type',
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
        $records = Induction::with('type')->whereNull('parent_id')->select('*');
        //Init Sort
        if (!isset(request()->order[0]['column'])) {
            $records->orderBy('created_at', 'desc');
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
            ->addColumn('type_file', function ($record) {
                return $record->typeMaterialFile();
            })
            ->addColumn('action', function ($record) use ($link){
                $btn = '';

                $btn .= $this->makeButton([
                    'url' => url($this->link.'manage-material/'.$record->id),
                    'disabled' => auth()->user()->can($this->perms.'-edit'),
                    'type' => 'default',
                    'class' => 'yellow icon',
                    'tooltip' => 'Manage this material',
                    'label' => '<i class="book icon"></i>',
                    'id'   => $record->id
                ]);

                if($record->status == 0){
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
                }else{
                  $btn .= '<button data-href="'.url($this->link.'cancel-publish/'.$record->id).'"
                  class="ui mini red icon button" data-message="Are you sure you want to cancel publish ?" data-tooltip="Cancel Publish" onClick="cancelAction(this)" type="button"><i class="close icon"></i></button>';
                }

                return $btn;
            })
            ->rawColumns(['action','status_user'])
            ->make(true);
    }

    public function gridPlan(Request $request)
	{
		$records = InductionPlan::with('creator')->where('materi_id', $request->materi_id)->select('*');
		//Init Sort
        if (!isset(request()->order[0]['column'])) {
            $records->orderBy('created_at', 'desc');
        }

		//Filters
		if ($search = $request->search) {
			$records->where('title', 'like', '%'.$search.'%' );
		}

        if ($start_date = $request->start_date) {
			$records->whereDate('date_induction_start', '>=', Helpers::DateToSql($start_date) );
		}

        if ($end_date = $request->end_date) {
			$records->whereDate('date_induction_end', '<=', Helpers::DateToSql($end_date) );
		}
		$link = $this->link;

		return DataTables::of($records)
		->addColumn('num', function ($record) use ($request) {
			return $request->get('start');
		})
		->addColumn('date', function ($record) {
		  	return Helpers::DateToString($record->date_induction_start).' - '.Helpers::DateToString($record->date_induction_end);
		})
		->addColumn('created_at', function ($record) {
		  	return $record->created_at->diffForHumans();
		})
		->addColumn('created_by', function ($record) {
		  	return $record->entryBy();
		})
		->editColumn('status', function ($record) {
		  	return $record->status == 0 ? '<a class="ui red tag label">Draft<a>':'<a class="ui black tag label">Published</a>';
		})
		->addColumn('action', function ($record) use ($link) {
	  		$btn = '';
            if($record->users()->count() > 0){
                if($record->status == 0){
                    $btn .= $this->makeButton([
                        'type' => 'approve-custom',
                        'id'   => $record->id,
                        'class' => 'red icon approve',
                        'label' => '<i class="check icon"></i>',
                        'labeled' => 'Publish',
                        'disabled' => '-',
                        'tooltip' => 'Publish this Induction',
                        'url'   => url($link.$record->id.'/approve')
                    ]);
                }
            }
		    if($record->status == 0){
                $btn .= $this->makeButton([
                    'url' => url($this->link.'manage-participant/'.$record->id),
                    'type' => 'default',
                    'class' => 'yellow icon',
                    'tooltip' => 'Manage participant before published',
                    'label' => '<i class="list icon"></i>',
                    'id'   => $record->id
                ]);
            }else{
                $btn .= $this->makeButton([
                    'url' => url($this->link.'monitoring-participant/'.$record->id),
                    'type' => 'default',
                    'class' => 'black icon',
                    'tooltip' => 'Monitoring participant',
                    'label' => '<i class="list icon"></i>',
                    'id'   => $record->id
                ]);
            }
            $btn .= $this->makeButton([
                'type' => 'detail-modal',
                'id'   => $record->id,
                'tooltip' => 'Detail Induction Plan',
                'url'   => url($link.'detail-plan/'.$record->id)
            ]);
            if($record->status == 0){
                $btn .= $this->makeButton([
                    'type' => 'edit-modal',
                    'id'   => $record->id,
                    'tooltip' => 'Edit Induction Plan',
                    'url'   => url($link.'edit-plan/'.$record->id)
                ]);
                // Delete
                $btn .= $this->makeButton([
                    'type' => 'delete',
                    'id'   => $record->id,
                    'url'   => url($link.'delete-plan/'.$record->id)
                ]);
            }else{
            $btn .= '<button data-href="'.url($this->link.'cancel-publish-plan/'.$record->id).'"
              class="ui mini red icon button" data-message="Are you sure you want to cancel publish ?" data-tooltip="Cancel Publish" onClick="cancelAction(this)" type="button"><i class="close icon"></i></button>';
            }


          	return $btn;
		})
		->rawColumns(['action','status'])
		->make(true);
    }

    public function gridUser(Request $request)
	{
        $acc = InductionPlan::find($request->bulletin_id);
        $answer = InductionAnswer::where('plan_id',$request->bulletin_id);
		$records = User::whereIn('id', $acc->users->pluck('id'))->select('*');
		//Init Sort
		if (!isset(request()->order[0]['column'])) {
		  // $records->->sort();
			$records->orderBy('created_at', 'desc');
		}

		//Filters
		if ($username = $request->username) {
			$records->where('username', 'like', '%'.$username.'%' )->orWhere('fullname','like', '%'.$username.'%' );
		}
        if($acc->materi->without_quiz){
            if($request->reviewed == 1 && $request->reviewed != NULL) {
                $user_id = array_merge($acc->doneusers()->pluck('id')->toArray(),$acc->failedusers()->pluck('id')->toArray());
                $records->whereNotIn('id',$user_id);
            }else if($request->reviewed == 2 && $request->reviewed != NULL){
                $records->whereIn('id',$acc->doneusers()->pluck('id')->toArray());
            }else if($request->reviewed == 0 && $request->reviewed != NULL){
                $records->whereIn('id',$acc->failedusers()->pluck('id'));
            }
        }else{
            if($request->reviewed == 1 && $request->reviewed != NULL) {
                $user_id = array_merge($answer->get()->pluck('user_id')->toArray(),$acc->failedusers()->pluck('id')->toArray());
                $records->whereNotIn('id',$user_id);
            }else if($request->reviewed == 2 && $request->reviewed != NULL){
                $records->whereIn('id',$answer->get()->pluck('user_id'));
            }else if($request->reviewed == 0 && $request->reviewed != NULL){
                $records->whereIn('id',$acc->failedusers()->pluck('id'));
            }
        }
		$link = $this->link;
        $records = $records->get();
		return DataTables::of($records)
		->addColumn('num', function ($record) use ($request) {
			return $request->get('start');
		})

		->addColumn('status', function ($record) use ($request,$answer,$acc) {
            $check = $answer->get()->where('user_id',$record->id);
            $text = "<a class='ui red tag label'>Haven't Joined the Induction yet</a>";
                if($acc->failedusers()->where('id',$record->id)->get()->count() > 0){
                    $text = '<a class="ui black tag label">Failed to follow Induction</a>';
                }else{
                    if($check->count() > 0 OR $acc->doneusers()->where('id',$record->id)->get()->count() > 0){
                        $text = '<a class="ui blue tag label">Has been Induction</a>';
                    }
                }
			return $text;
		})

        ->addColumn('correct', function ($record) use ($request,$answer) {
            $check = $answer->get()->where('user_id',$record->id);
            $text = "-";
            if($check->count() > 0){
                $text = $check->sum('result');
            }
			return $text;
		})

        ->addColumn('wrong', function ($record) use ($request,$answer) {
            $check = $answer->get()->where('user_id',$record->id);
            $text = "-";
            if($check->count() > 0){
                $text = $check->count() - $check->sum('result');
            }
			return $text;
        })
        ->addColumn('action', function ($record) use ($link,$acc) {
            $btn = '';
            $btn .= $this->makeButton([
                'type' => 'detail-modal',
                'id'   => $record->id,
                'tooltip' => 'Detail Answer',
                'url'   => url($link.'detail-user/'.$record->id.'/'.$acc->id)
            ]);
            return $btn;
      })
		->rawColumns(['status', 'action'])
		->make(true);
	}

    public function index()
    {
        return $this->render('modules.master.induction.index', ['mockup' => false]);
    }

    public function store(InductionRequest $request)
    {
        $wquiz = 0;
        if($request->without_quiz){
            $wquiz = $request->without_quiz;
        }
        $record = new Induction;
        $record->fill([
            'name' => $request->name,
            'type_id' => $request->type_id,
            'link_yt' => $request->link_yt,
            'without_quiz' => $wquiz,
        ]);
        $record->save();

        if($request->fileurl)
        {
          if(count($request->fileurl) > 0){
            foreach ($request->fileurl as $key => $file) {
              if($key == 0){
                $recordUpdate= Induction::find($record->id);
                $recordUpdate->fill(['fileurl' => $file, 'filename' => $request->filename[$key]]);
                $recordUpdate->save();
              }else{
                $recordMulti = new Induction;
                $recordMulti->fill([
                  'name' => $request->name,
                  'type_id' => $request->type_id,
                  'link_yt' => $request->link_yt,
                  'without_quiz' => $wquiz,
                  'parent_id' => $record->id,
                  'fileurl' => $file,
                  'filename' => $request->filename[$key]
                ]);
                $recordMulti->save();
              }
            }
          }
        }
        Trail::log('Master '.$this->getTitle(), 'create record', request()->ip(), auth()->user()->id);

        return response([
            'status' => true
        ]);
    }

    public function storePlan(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:500|unique_with:ref_induction_set_induction,materi_id',
            'date_induction_start' => 'required',
            'date_induction_end' => 'required',
        ], [
            'title.required' => 'Title Can Not Be Empty',
            'date_induction_start.required' => 'Start Date Can Not Be Empty',
            'date_induction_end.required' => 'End Date Can Not Be Empty',
            'title.max' => 'can not be more than :max character',

        ]);
        $record = new InductionPlan;
        $record->fill($request->all());
        $record->save();
        Trail::log('Master '.$this->getTitle(), 'create plan', request()->ip(), auth()->user()->id);

        return response([
            'status' => true,
            'mod' => true
        ]);
    }

    public function updatePlan(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:500|unique_with:ref_induction_set_induction,materi_id,'.$request->id,
            'date_induction_start' => 'required',
            'date_induction_end' => 'required',
        ], [
            'title.required' => 'Title Can Not Be Empty',
            'date_induction_start.required' => 'Start Date Can Not Be Empty',
            'date_induction_end.required' => 'End Date Can Not Be Empty',
            'title.max' => 'can not be more than :max character',

        ]);
        $record = InductionPlan::find($request->id);
        $record->fill($request->all());
        $record->save();
        Trail::log('Master '.$this->getTitle(), 'edited plan', request()->ip(), auth()->user()->id);

        return response([
            'status' => true,
            'mod' => true
        ]);
    }

    public function removefile(Request $request)
    {
        try {
            if(file_exists(storage_path().'/app/public/'.$request->fileurl))
            {
                unlink(storage_path().'/app/public/'.$request->fileurl);
            }
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

    public function create()
    {
        $this->setTitle("Create Induction Material");
        $this->setBreadcrumb(['Induction Material' => url($this->link), 'Create' => '#']);

        return $this->render('modules.master.induction.create');
    }

    public function edit($id)
    {
        $this->setTitle("Edit Induction");
        $this->setBreadcrumb(['Induction' => url($this->link), 'Edit' => '#']);

        return $this->render('modules.master.induction.edit', [
            'record' => Induction::find($id),
        ]);
    }

    public function addPlan($id)
    {
        return $this->render('modules.master.induction.add-plan', [
            'record' => Induction::find($id),
        ]);
    }

    public function update(InductionRequest $request)
    {
        $wquiz = 0;
        if($request->without_quiz){
            $wquiz = $request->without_quiz;
        }
        $record = Induction::find($request->id);

        $record->fill([
            'name' => $request->name,
            'type_id' => $request->type_id,
            'link_yt' => $request->link_yt,
            'without_quiz' => $wquiz,
        ]);
        $record->save();

        if($request->fileurl)
        {
          if(count($request->fileurl) > 0){
            foreach ($request->fileurl as $key => $file) {
              if($key == 0){
                $recordUpdate= Induction::find($record->id);
                $recordUpdate->fill(['fileurl' => $file, 'filename' => $request->filename[$key]]);
                $recordUpdate->save();
              }else{
                $recordMulti = new Induction;
                $recordMulti->fill([
                  'name' => $request->name,
                  'type_id' => $request->type_id,
                  'link_yt' => $request->link_yt,
                  'without_quiz' => $wquiz,
                  'parent_id' => $record->id,
                  'fileurl' => $file,
                  'filename' => $request->filename[$key]
                ]);
                $recordMulti->save();
              }
            }
          }
        }

        if($request->filedelete)
        {
          if(count($request->filedelete) > 0 ){
            foreach ($request->filedelete as $key => $filedelete) {
              $filedelete = base64_decode($filedelete);
              if(file_exists(storage_path().'/app/public/'.$filedelete))
              {
                unlink(storage_path().'/app/public/'.$filedelete);
              }
              if($record->fileurl != $filedelete){
                $recordDelete = Induction::where('fileurl',$filedelete)->first();
                Induction::findOrFail($recordDelete->id)->delete();
              }
            }
          }
        }

        Trail::log('Master '.$this->getTitle(), 'Edited a record', request()->ip(), auth()->user()->id);

        return response([
            'status' => true
        ]);
    }

    public function upload(Request $request)
    {
        try {
            $url = $request->file('files')->storeAs('induction', md5($request->file('files')->getClientOriginalName().Carbon::now()->format('Ymdhis')).'.'.$request->file('files')->getClientOriginalExtension(), 'public');

            return response([
                'status' => true,
                'filename' => $request->file('files')->getClientOriginalName(),
                'url' => $url,
            ]);

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

    public function destroy($id)
    {
        try {
            $record = Induction::find($id);
            Trail::log('Master '.$this->getTitle(), 'Deleted a record', request()->ip(), auth()->user()->id);
            if(isset($record->fileurl)){
                if(file_exists(storage_path().'/app/public/'.$record->fileurl))
                {
                    unlink(storage_path().'/app/public/'.$record->fileurl);
                }
            }
            if($record->child()->count() > 0){
                foreach($record->child as $child){
                    if(isset($child->fileurl)){
                        if(file_exists(storage_path().'/app/public/'.$child->fileurl))
                        {
                            unlink(storage_path().'/app/public/'.$child->fileurl);
                        }
                    }
                    $child->delete();
                }
            }
            if($record->plan()->count() > 0){
                foreach($record->plan as $ques1){
                    $ques1->answer()->delete();
                    $ques1->failedusers()->sync([]);
                    $ques1->users()->sync([]);
                }
            }
            $record->plan()->delete();
            if($record->question()->count() > 0){
                foreach($record->question as $ques){
                    if($ques->files()->count() > 0){
                        foreach($ques->files as $quesFile){
                            if(file_exists(storage_path().'/app/public/'.$quesFile->fileurl))
                            {
                                unlink(storage_path().'/app/public/'.$quesFile->fileurl);
                            }
                        }
                    }
                    $ques->files()->delete();
                    $ques->answer()->delete();
                }
            }
            $record->question()->delete();
            $record->delete();
            return response([
                'status' => true,
            ]);
        } catch (Exception $e) {
              return response([
                'status' => false,
                'errors' => $e
            ]);
        }


    }

    public function manage($id)
	{
        $this->setTitle("Manage Induction Material");
        $this->setModalSize("mini");
        $this->setBreadcrumb(['Master' => '#', 'Induction Material' => '#','Manage' => '#']);
        $record = Induction::find($id);

		return $this->render('modules.master.induction.manage', [
            'record' => $record,
            // 'users' => $record->users()->paginate(30),
            'planStruct' => $this->planStruct,
        ]);
	}

    public function manageParticipant($id)
	{
        $this->setTitle("Manage Participant Induction Plan");
        $this->setModalSize("large");
        $this->setBreadcrumb(['Master' => '#', 'Induction Material' => '#','Manage' => '#','Plan' => '#','Manage Participant' => '#']);
        $record = InductionPlan::find($id);

		return $this->render('modules.master.induction.participant', [
            'record' => $record,
        ]);
	}

    public function monitoringParticipant($id)
	{
        $this->setTitle("Monitoring Participant Induction");
        $this->setModalSize("large");
        $this->setBreadcrumb(['Master' => '#', 'Induction Material' => '#','Manage' => '#','Plan' => '#','Monitoring Participant' => '#']);
        $record = InductionPlan::find($id);

		return $this->render('modules.master.induction.monitoring', [
            'record' => $record,
            'userStruct' => $this->userStruct,
        ]);
	}

    public function showUsers($id = NULL, $site_id = NULL)
    {
        $paginator = User::query();

        $request = request()->all();
        if(isset($request['name']))
        {
            $paginator->where(function ($w) use ($request) {
                $w->where('username', 'like', '%'.$request['name'].'%')->orWhere('fullname', 'like', '%'.$request['name'].'%');
            });
        }
        if(isset($request['roles']))
        {
            $paginator->whereHas('roles', function ($roles) use ($request) {
                $roles->where('id', $request['roles']);
            });
        }

        if($site_id != NULL OR isset($request['site']))
        {
            if(isset($request['site'])){
                $site_id = $request['site'];
            }
            $paginator->whereHas('site', function ($site) use ($site_id) {
                $site->where('id', $site_id);
            });
        }

        $result = $paginator->paginate(30);
        $data['users'] = $result;

        $data['record'] = InductionPlan::find($id);
        return view('modules.master.induction.user-create', $data);
    }

    public function checkAll($id = NULL, $site_id = NULL)
    {
        $users = User::get();

        if($id != NULL)
        {
            if($id > 0)
            {
              $users = InductionPlan::find($id)->users;
            }
        }

        return view('modules.master.training.users.checked', [
            'users' => $users
        ]);
    }

    public function saveParticipant(Request $request)
    {
        $record = InductionPlan::find($request->plan_id);
        $record->users()->sync($request->participant);
        Trail::log('Master '.$this->getTitle(), 'updated participant', request()->ip(), auth()->user()->id);

        return response([
            'status' => true,
            'urlInduction' => 'manage-material/'.$record->materi_id
        ]);
    }

    public function published($id)
    {
        $record = InductionPlan::find($id);
        $record->sentEmailAction();
        $record->fill(["status" => 1]);
        $record->save();
        Trail::log('Master '.$this->getTitle(), 'published plan', request()->ip(), auth()->user()->id);

        return response([
            'status' => true,
            'mod' => true
        ]);
    }

    public function publishMateri($id)
    {
        $record = Induction::find($id);

        if($record->question()->count() > 0 && $record->without_quiz == 0){
            $record->fill(["status" => 1]);
            $record->save();
            Trail::log('Master '.$this->getTitle(), 'published material', request()->ip(), auth()->user()->id);

            return response([
                'status' => true,
            ]);
        }else if ($record->without_quiz == 1) {
            $record->fill(["status" => 1]);
            $record->save();
            Trail::log('Master '.$this->getTitle(), 'published material', request()->ip(), auth()->user()->id);

            return response([
                'status' => true,
            ]);
        }else{
            return response([
                'status' => false,
            ]);
        }
    }

    public function editPlan($id)
    {
        return $this->render('modules.master.induction.edit-plan', [
            'record' => InductionPlan::find($id),
        ]);
    }

    public function showPlan($id)
    {
        return $this->render('modules.master.induction.show-plan', [
            'record' => InductionPlan::find($id),
        ]);
    }

    public function showUser($user_id,$id)
    {
        return $this->render('modules.master.induction.show-user-answer', [
            'record' => InductionPlan::find($id),
            'user_id' => $user_id
        ]);
    }

    public function deletePlan($id)
    {
        $record = InductionPlan::find($id);
        Trail::log('Master '.$this->getTitle(), 'deleted plan', request()->ip(), auth()->user()->id);

        if($record->status == 0)
        {
          $record->answer()->delete();
          $record->users()->sync([]);
          $record->failedusers()->sync([]);
          $record->delete();

          return response([
              'status' => true,
              'mod' => true
          ]);
        }

        return response([
            'status' => false,
            'mod' => false
        ], 500);
    }

    public function cancelPublishPlan($id)
    {
        $record = InductionPlan::find($id);
        $record->fill(["status" => 0]);
        $record->save();
        Trail::log('Master '.$this->getTitle(), 'cancel published plan', request()->ip(), auth()->user()->id);

        return response([
            'status' => true,
            'mod' => true
        ]);
    }

    public function cancelPublish($id)
    {
        $record = Induction::find($id);
        $record->fill(["status" => 0]);
        $record->save();
        Trail::log('Master '.$this->getTitle(), 'cancel published record', request()->ip(), auth()->user()->id);

        return response([
            'status' => true,
            'mod' => true
        ]);
    }

    public function showFile($id,$type = null)
    {
        $id = base64_decode($id);
        if($type == 'yt'){
            $id = Induction::find($id)->link_yt;
        }
        return $this->render('modules.master.induction.show-file', [
            'link' => $id,
            'type' => $type,

        ]);
    }

}
