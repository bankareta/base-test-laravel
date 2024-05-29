<?php

namespace App\Http\Controllers\Master;

/* Base App */
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/* Validation */
use App\Http\Requests\Master\PolicyRequest;

/* Models */
use App\Models\Master\TipePolicy;
use App\Models\Master\Policy;
use App\Models\Master\LampiranPolicy;
use App\Models\Authentication\User;
use App\Models\Trail\Trail;
use Carbon;


/* Libraries */
use DataTables;

class PolicyController extends Controller
{
    protected $link = 'master/policy/';
    protected $perms = 'master-policy';

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
      'data' => 'status',
      'name' => 'status',
      'label' => 'Status',
      'searchable' => false,
      'sortable' => false,
      'className' => "center aligned",
      'width' => '150px',
    ]
  ];

    function __construct()
    {
        $this->setLink($this->link);
        $this->setPerms($this->perms);
        $this->setTitle("Policy & Procedure");
        $this->setModalSize("mini");
        $this->setBreadcrumb(['Master' => '#', 'Policy & Procedure' => '#']);

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
      		        'data' => 'site_id',
      		        'name' => 'site_id',
      		        'label' => 'Company',
      		        'searchable' => false,
      		        'sortable' => true,
      		        'width' => '150px',
      			],
            [
		        'data' => 'type.name',
		        'name' => 'type.name',
		        'label' => 'Policy & Procedure Type',
		        'searchable' => false,
		        'sortable' => true,
		        'width' => '10%',
			],
            [
		        'data' => 'title',
		        'name' => 'title',
		        'label' => 'Title',
		        'searchable' => false,
		        'sortable' => true,
		        'width' => '20%',
			],
			[
		        'data' => 'status',
		        'name' => 'status',
		        'label' => 'Status',
		        'searchable' => false,
		        'sortable' => true,
		        'className' => "center aligned",
		        'width' => '100px',
			],
			// [
		    //     'data' => 'created_by',
		    //     'name' => 'created_by',
		    //     'label' => 'Created By',
		    //     'searchable' => false,
		    //     'sortable' => true,
		    //     'className' => "center aligned",
		    //     'width' => '100px',
			// ],
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
		$records = Policy::with('creator', 'type')->select('*');
		// dd($records);
		//Init Sort
		if (!isset(request()->order[0]['column'])) {
		  // $records->->sort();
		  $records->orderBy('created_at', 'desc');
	}

	//Filters
  if ($title = $request->title) {
    $records->where('title', 'like', '%'.$title.'%' );
  }

  if ($site = $request->site_id) {
    $records->whereHas('site', function($q) use($site){
		$q->where('id',$site);
	});
  }

  if ($type_id = $request->type_id) {
    $records->where('type_id', $type_id);
  }

  	$records = $records->get();
	$link = $this->link;
	return DataTables::of($records)
	->addColumn('num', function ($record) use ($request) {
		return $request->get('start');
	})
	->addColumn('status', function ($record) {
	  	return $record->labelStatus();
	})

  ->addColumn('site_id', function ($record) {
    $show = isset($record->company->name) ? $record->company->name : '-';
    if($record->site->count() > 0){
      $show = '';
      foreach ($record->site as $key => $value) {
      if($record->site->count() == $key+1){
        $show .= $value->name;
      }else{
        $show .= $value->name.'<br>';
      }
      }
    }
    return $show;
    })
	->addColumn('created_at', function ($record) {
	  	return $record->created_at->diffForHumans();
	})
	->addColumn('created_by', function ($record) {
	  	return $record->entryBy();
	})
	->addColumn('action', function ($record) use ($link) {
  		$btn = '';
	 	  //Edit
      $disabled = auth()->user()->can($this->perms.'-edit');


	    $btn .= $this->makeButton([
	      'type' => 'edit-page',
	      'tooltip' => 'Edit Data',
	      'disabled' => $disabled,
	      'id'   => $record->id
	    ]);
	    // Delete
	    $btn .= $this->makeButton([
	      'type' => 'delete',
	      'tooltip' => 'Delete',
	      'id'   => $record->id,
        'disabled' => $disabled,
        'url' => url($link . $record->id)
	    ]);

	    $btn .= $this->makeButton([
	      'url' => url($this->link.'show-statistic/'.$record->id),
	      'type' => 'url',
	      'class' => 'teal icon',
	      'tooltip' => 'Statistic',
	      'label' => '<i class="list icon"></i>',
	      'id'   => $record->id
	    ]);

	  	return $btn;
	})
	->rawColumns(['status', 'action', 'content', 'site_id'])
	->make(true);
	}

	public function index()
	{
		return $this->render('modules.master.policy.index', [
		  'mockup' => false,
		]);
	}

	public function create()
	{
		$this->setTitle("Create New Policy & Procedure");
		$this->setBreadcrumb(['Master' => '#','Policy & Procedure' => url($this->link), 'Create' => '#']);

		$type = TipePolicy::get(['id', 'name']);
		if($type->count() > 0)
		{
			return $this->render('modules.master.policy.create', [
				'types' => $type->split(4),
			]);
		}
		return $this->render('modules.master.policy.failed');
	}

	public function store(PolicyRequest $request)
	{
    $file = [];
		if(isset($request->filespath)){
				if(count($request->filespath) > 0){
						foreach ($request->filespath as $k => $value) {
								$file[$k]['url'] = $value;
								$file[$k]['filename'] = $request->filename[$k];
						}
				}
		}else{
				$this->validate($request, [
					'fileupload' => 'required',
				],[
					'fileupload.required' => 'References Files is required.',
				]);
		}

		$policy = new Policy;
		$policy->fill($request->all());
		$policy->save();
		$policy->site()->sync($request->site_id);
    $policy->lampiranberkas()->createMany($file);

		if($policy->status == 1)
		{
			$policy->sentEmailReviewing();
			$policy->sendNotAndro('You have a new report from policy','policy');
			// $record->status = 0;
		}

    Trail::log('Master '.$this->getTitle(), 'Create a new record', request()->ip(), auth()->user()->id);
  	return response([
  			'status' => true
  		]);
	}

	public function edit($id)
	{
		$this->setTitle("Edit Policy & Procedure");
		$this->setBreadcrumb(['Master' => '#','Policy & Procedure' => url($this->link), 'Edit' => '#']);

		return $this->render('modules.master.policy.edit',[
		    'record' => Policy::find($id),
		    'types' => TipePolicy::get(['id', 'name'])->split(4),
		]);
	}

	public function update(PolicyRequest $request, $id)
	{
		try {
			$policy = Policy::find($id);

			if(isset($request->filespath)){
					if(count($request->filespath) > 0){
							foreach ($request->filespath as $key => $value) {
									if($request->filename[$key])
									{
										$saveFile['filename'] = $request->filename[$key];
									}

									$saveFile['url'] = $value;
									$saveFile['policy_id'] = $policy->id;

									$recordFile = new LampiranPolicy;
									if(isset($request->fileid[$key]))
									{
										$recordFile = LampiranPolicy::where('url', $value)->where('policy_id', $policy->id)->first();
									}
									$recordFile->fill($saveFile);
									$recordFile->save();

									$fileid[] = $recordFile->id;
							}

							$notExist = LampiranPolicy::whereNotIn('id', $fileid)->where('policy_id', $policy->id)->get();

              if($notExist->count() > 0)
							{
									foreach($notExist as $ne)
									{
										if(file_exists(storage_path().'/app/public/'.$ne->url))
										{
												unlink(storage_path().'/app/public/'.$ne->url);
										}
										$ne->delete();
									}
							}
					}
			}else{
					$this->validate($request, [
						'fileupload' => 'required',
					],[
						'fileupload.required' => 'References Files is required.',
					]);
			}
		$policy->fill($request->all());
  	$policy->save();
		$policy->site()->sync($request->site_id);

    if($request->status == 1)
		{
			$policy->sentEmailReviewing();
			$policy->sendNotAndro('You have a new report from policy','policy');
		}
    Trail::log('Master '.$this->getTitle(), 'Edited a record', request()->ip(), auth()->user()->id);
		}catch (\Exception $e) {
			return response([
				'status' => 'error',
				'message' => 'An error occurred!',
				'error' => $e->getMessage(),
			], 500);
		}

		return response([
			'status' => true
		]);
	}

	public function destroy(Request $request, $id)
	{
		try {
			$policy = Policy::find($id);
      Trail::log('Master '.$this->getTitle(), 'Deleted a record', request()->ip(), auth()->user()->id);

      if($policy->lampiranberkas->count() > 0)
      {
        foreach($policy->lampiranberkas as $file)
        {
            if(file_exists(storage_path().'/app/public/'.$file->url))
            {
                unlink(storage_path().'/app/public/'.$file->url);
            }
            $file->delete();
        }
      }
      $policy->review()->detach();
      $policy->site()->detach();
      $policy->delete();
		}catch (\Exception $e) {
			return response([
				'status' => 'error',
				'message' => $e->getMessage(),
			], 500);
		}

		return response([
			'status' => true
		]);
	}

	public function showStatistic($id)
	{
		return $this->render('modules.master.policy.statistic', [
		    'record' => Policy::find($id),
		    'userStruct' => $this->userStruct,
		]);
	}

	public function removeLampiran(Request $request)
    {
    	// dd($request->all());
        $lampiran = LampiranPolicy::find($request->id);
        $attachment = public_path().'/'.'storage/'.$lampiran->url;
        unlink($attachment);
        $lampiran->delete();

        return response([
            'status' => true,
        ]);
    }

	public function gridUser(Request $request)
	{
    $bulletin = Policy::find($request->bulletin_id);

		$records = User::whereHas('site', function ($site) use ($bulletin) {
        	$site->whereIn('id', $bulletin->site->pluck('id'));
		})->select('*');
		//Init Sort
		if (!isset(request()->order[0]['column'])) {
		  // $records->->sort();
			$records->orderBy('created_at', 'desc');
		}

		//Filters
		if ($username = $request->username) {
			$records->where('username', 'like', '%'.$username.'%' );
		}

		if($request->reviewed == 1 && $request->reviewed != NULL) {
			$records->whereHas('policy', function($review) use ($request) {
				$review->where('id', $request->bulletin_id);
			});
		}else if($request->reviewed == 0 && $request->reviewed != NULL){
			$records->whereDoesntHave('policy', function($review) use ($request) {
			  	$review->where('id', $request->bulletin_id);
			});
		}
		$records = $records->get();
		return DataTables::of($records)
		->addColumn('num', function ($record) use ($request) {
			return $request->get('start');
		})

		->addColumn('status', function ($record) use ($request) {
			return $record->labelReviewedPolicy($request->bulletin_id);
		})
		->rawColumns(['status', 'action', 'content'])
		->make(true);
	}

	public function download($id){
		$lampiran = LampiranPolicy::find($id);
        if($lampiran == true){
            if(file_exists(public_path('storage/'.$lampiran->url)))
            {
                return response()->download(public_path('storage/'.$lampiran->url), $lampiran->filename);
            }
        }

        return abort('404');
    }
}
