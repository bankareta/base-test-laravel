<?php

namespace App\Http\Controllers\Master;

/* Base App */
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/* Validation */
use App\Http\Requests\Master\BulletinRequest;

/* Models */
use App\Models\Master\TipeBulletin;
use App\Models\Master\Bulletin;
use App\Models\Master\LampiranBulletin;
use App\Models\Authentication\User;
use App\Models\Trail\Trail;

use App\Libraries\Helpers;
use Carbon;

/* Libraries */
use DataTables;

class BulletinController extends Controller
{
	protected $link = 'master/bulletin/';
	protected $perms = 'master-bulletin';

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
		$this->setTitle("Bulletin & Alert");
		$this->setModalSize("mini");
		$this->setBreadcrumb(['Master' => '#', 'Bulletin & Alert' => '#']);

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
				'data' => 'title',
				'name' => 'title',
				'label' => 'Title',
				'searchable' => false,
				'sortable' => true,
				'width' => '120px',
			],
			[
				'data' => 'type.name',
				'name' => 'type.name',
				'label' => 'Bulletin & Alert Type',
				'searchable' => false,
				'sortable' => true,
				'width' => '70',
			],
			[
				'data' => 'status',
				'name' => 'status',
				'label' => 'Status',
				'searchable' => false,
				'sortable' => true,
				'className' => "center aligned",
				'width' => '50px',
			],
			[
				'data' => 'created_by',
				'name' => 'created_by',
				'label' => 'Created By',
				'searchable' => false,
				'sortable' => true,
				'className' => "center aligned",
				'width' => '70px',
			],
			[
				'data' => 'created_at',
				'name' => 'created_at',
				'label' => 'Created At',
				'searchable' => false,
				'sortable' => true,
				'className' => "center aligned",
				'width' => '70px',
			],
			[
				'data' => 'action',
				'name' => 'action',
				'label' => 'Action',
				'searchable' => false,
				'sortable' => false,
				'className' => "center aligned",
				'width' => '80px',
			]
		]);
	}

	public function grid(Request $request)
	{
		$records = Bulletin::with('creator', 'type')->select('*');

		//Init Sort
		if (!isset(request()->order[0]['column'])) {
				$records->orderBy('created_at', 'desc');
		}else{
				if(request()->order[0]['column'] == 5)
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
		if ($title = $request->title) {
			$records->where('title', 'like', '%'.$title.'%' );
		}

		if ($site = $request->site_id) {
			$records->where('site_id', $site);
		}

		if ($type_id = $request->type_id) {
			$records->where('type_id', $type_id);
		}
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
				'url' => url($link . $record->id)
			]);

			$btn .= $this->makeButton([
				'url' => url($this->link.'show-statistic/'.$record->id),
				'type' => 'default',
				'class' => 'teal icon',
				'tooltip' => 'Statistic',
				'label' => '<i class="list icon"></i>',
				'id'   => $record->id
			]);

			return $btn;
		})
		->rawColumns(['status', 'action', 'content','site_id'])
		->make(true);
	}

	public function index()
	{
		return $this->render('modules.master.bulletin.index', [
			'mockup' => false,
		]);
	}

	public function create()
	{
		$type = TipeBulletin::get(['id', 'name']);
		$this->setBreadcrumb(['Master' => '#', 'Bulletin & Alert' => '#', 'Create' => '#']);

		if($type->count() > 0)
		{
			return $this->render('modules.master.bulletin.create', [
				'types' => $type->split(4),
			]);
		}
		return $this->render('modules.master.bulletin.failed');
	}

	public function store(BulletinRequest $request)
	{
		$this->validate($request, [
			'attachment.*' => 'required',
		],[
			'attachment.*.uploaded' => 'File to large, Max Size File '.ini_get('upload_max_filesize').'B',
			'attachment.*.required' => 'Attachment field is required.',
		]);
		try {
			$bulletin = new Bulletin;
			$bulletin->fill($request->all());
			$bulletin->save();
			$bulletin->site()->sync($request->site_id);
			Trail::log('Master '.$this->getTitle(), 'Create a new record', request()->ip(), auth()->user()->id);

			if(!is_null($request->attachment)){

				foreach ($request->attachment as $i => $berkas) {
        	// dd($berkas->getClientOriginalName());
					if (!is_null($berkas)) {
						$nama = $berkas->getClientOriginalName();
						$path = $berkas->storeAs('lampiran', md5($berkas->getClientOriginalName().Carbon::now()->format('Ymdhis').$i).'.'.$berkas->getClientOriginalExtension(), 'public');

						$lampiranbulletin = new LampiranBulletin;
						$lampiranbulletin->filename = $nama;
						$lampiranbulletin->bulletin_id = $bulletin->id;
						$lampiranbulletin->url = $path;
						$bulletin->lampiranberkas()->save($lampiranbulletin);
					}
				}
			}
			if($bulletin->status == 1)
			{
				$bulletin->sentEmailReviewing();
				$bulletin->sendNotAndro('You have a new report from bulletin','bulletin');
			}
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

	public function edit($id)
	{
		$this->setBreadcrumb(['Master' => '#', 'Bulletin & Alert' => '#', 'Edit' => '#']);

		return $this->render('modules.master.bulletin.edit',[
			'record' => Bulletin::find($id),
			'types' => TipeBulletin::get(['id', 'name'])->split(4),
		]);
	}

	public function update(BulletinRequest $request, $id)
	{
		$cheked = Bulletin::find($id);
		if($request->file_deleted_id)
		{
			if(count($request->file_deleted_id) > 0){
				$cheked = Bulletin::where('id',$id)->whereHas('lampiranberkas',function($q)use($request){
					$q->whereNotIn('id',$request->file_deleted_id);
				})->first();
			}
		}
		if(!isset($cheked)){
			$this->validate($request, [
				'attachment.*' => 'required',
			],[
				'attachment.*.uploaded' => 'File to large, Max Size File '.ini_get('upload_max_filesize').'B',
				'attachment.*.required' => 'Attachment field is required.',
			]);
		}else{
			if($cheked->lampiranberkas->count() == 0){
				$this->validate($request, [
					'attachment.*' => 'required',
				],[
					'attachment.*.uploaded' => 'File to large, Max Size File '.ini_get('upload_max_filesize').'B',
					'attachment.*.required' => 'Attachment field is required.',
				]);
			}
		}
		try{
			$bulletin = Bulletin::find($id);
			$bulletin->fill($request->all());
			$bulletin->save();
			$bulletin->site()->sync($request->site_id);

			if($request->file_deleted_id)
			{
				if(count($request->file_deleted_id) > 0){
					foreach ($request->file_deleted_id as $asd => $www) {
						$lampiranbulletin = LampiranBulletin::find($www);
						$attachment = public_path().'/'.'storage/'.$lampiranbulletin->url;
						unlink($attachment);
						$lampiranbulletin->delete();
					}
				}
			}

			if($request->attachment)
			{
				if(count($request->attachment) > 0){
					foreach ($request->attachment as $i => $berkas) {
						if (!is_null($berkas)) {
							$nama = $berkas->getClientOriginalName();
							$path = $berkas->storeAs('lampiran', md5($berkas->getClientOriginalName().Carbon::now()->format('Ymdhis').$i).'.'.$berkas->getClientOriginalExtension(), 'public');

							$lampiranbulletin = new LampiranBulletin;
							$lampiranbulletin->filename = $nama;
							$lampiranbulletin->bulletin_id = $bulletin->id;
							$lampiranbulletin->url = $path;
							$bulletin->lampiranberkas()->save($lampiranbulletin);
						}
					}
				}
			}
			if($bulletin->status == 1)
			{
				$bulletin->sentEmailReviewing();
				$bulletin->sendNotAndro('You have a new report from bulletin','bulletin');
          // $record->status = 0;
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
			$bulletin = Bulletin::find($id);
			$bulletin->lampiranberkas()->delete();
			$bulletin->site()->sync([]);
			$bulletin->review()->sync([]);
			$bulletin->delete();
			Trail::log('Master '.$this->getTitle(), 'Deleted a record', request()->ip(), auth()->user()->id);
		}catch (\Exception $e) {
			return response([
				'status' => 'error',
				'message' => $e,
			], 500);
		}

		return response([
			'status' => true
		]);
	}

	public function showStatistic($id)
	{
		return $this->render('modules.master.bulletin.statistic', [
			'record' => Bulletin::find($id),
			'userStruct' => $this->userStruct,
		]);
	}

	public function removeLampiran(Request $request)
	{
		$lampiran = LampiranBulletin::find($request->id);
		$attachment = public_path().'/'.'storage/'.$lampiran->url;
		unlink($attachment);
		$lampiran->delete();

		return response([
			'status' => true,
		]);
	}

	public function gridUser(Request $request)
	{
		$bulletin = Bulletin::find($request->bulletin_id);

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
			$records->whereHas('bulletin', function($review) use ($request) {
				$review->where('id', $request->bulletin_id);
			});
		}else if($request->reviewed == 0 && $request->reviewed != NULL){
			$records->whereDoesntHave('bulletin', function($review) use ($request) {
				$review->where('id', $request->bulletin_id);
			});
		}
		$records = $records->get();

		return DataTables::of($records)
		->addColumn('num', function ($record) use ($request) {
			return $request->get('start');
		})

		->addColumn('status', function ($record) use ($request) {
			return $record->labelReviewedBulletin($request->bulletin_id);
		})
		->rawColumns(['status', 'action', 'content'])
		->make(true);
	}

	public function download($id){
		$lampiran = LampiranBulletin::find($id);
		if($lampiran == true){
			if(file_exists(public_path('storage/'.$lampiran->url)))
			{
				return response()->download(public_path('storage/'.$lampiran->url), $lampiran->filename);
			}
		}

		return abort('404');
	}
}
