<?php

namespace App\Http\Controllers\Master;

/* Base App */
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/* Validation */
use App\Http\Requests\RegulationsAndStandard\NewRegulationsRequest;

/* Models */
use App\Models\Regulation\Regulations;
use App\Models\Regulation\RegulationsFile;
use App\Models\Regulation\RegulationsReviews;
use App\Models\Authentication\User;
use App\Models\Trail\Trail;
use Carbon;

use App\Libraries\Helpers;

/* Libraries */
use DataTables;

class RegulationsController extends Controller
{
	protected $link = 'master/regulations/';
	protected $perms = 'master-regulations';

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
		$this->setTitle("Regulations & Standards");
		$this->setModalSize("mini");
		$this->setBreadcrumb(['Master' => '#', 'Regulations & Standards' => '#']);

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

			// [
			// 	'data' => 'site_id',
			// 	'name' => 'site_id',
			// 	'label' => 'Company',
			// 	'searchable' => false,
			// 	'sortable' => true,
			// 	'width' => '150px',
			// ],
			[
				'data' => 'name',
				'name' => 'name',
				'label' => 'Title',
				'searchable' => false,
				'sortable' => true,
				'width' => '120px',
			],
			[
				'data' => 'type_id',
				'name' => 'type_id',
				'label' => 'Regulations & Standards Type',
				'searchable' => false,
				'sortable' => true,
				'width' => '70',
			],
			// [
			// 	'data' => 'status',
			// 	'name' => 'status',
			// 	'label' => 'Status',
			// 	'searchable' => false,
			// 	'sortable' => true,
			// 	'className' => "center aligned",
			// 	'width' => '50px',
			// ],
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
		$records = Regulations::with('creator', 'type')->select('*');

		//Init Sort
		if (!isset(request()->order[0]['column'])) {
				$records->orderBy('created_at', 'desc');
		}else{
				if(request()->order[0]['column'] == 3)
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
			$records->where('name', 'like', '%'.$title.'%' );
		}

		if ($site = $request->site_id) {
			$records->whereHas('site',function($q) use($site){
				$q->where('trans_regulations_site.site_id',$site);
			})->get();
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
		$show = '-';
			if($record->site->count() > 0){
				$show = '';
				foreach ($record->site as $key => $value) {
					if($record->site->count() == $key+1){
						$show .='- '.$value->name;
					}else{
						$show .= '- '.$value->name.'<br>';
					}
				}
			}
			return $show;
		})
		->editColumn('created_at', function ($record) {
			return $record->created_at->diffForHumans();
		})
		->editColumn('type_id', function ($record) {
			return $record->type->name;
		})
		->editColumn('created_by', function ($record) {
			return $record->entryBy();
		})
		->addColumn('action', function ($record) use ($link) {
			$btn = '';
		 	//Edit
			$disabled = auth()->user()->can($this->perms.'-edit');

			// if($record->status == 1)
			// {
			// 	$disabled = true;
			// }

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
				'type' => 'detail-page',
				'tooltip' => 'Detail Regulations & Standards',
				'id'   => $record->id
			]);
			// $btn .= $this->makeButton([
			// 	'url' => url($this->link.'show-statistic/'.$record->id),
			// 	'type' => 'default',
			// 	'class' => 'teal icon',
			// 	'tooltip' => 'Statistic',
			// 	'label' => '<i class="list icon"></i>',
			// 	'id'   => $record->id
			// ]);

			return $btn;
		})
		->rawColumns(['status', 'action', 'content','site_id'])
		->make(true);
	}

	public function index()
	{
		return $this->render('modules.master.regulations.index', [
			'mockup' => false,
		]);
	}

	public function create()
	{

		$this->setBreadcrumb(['Master' => '#', 'Regulations & Standards' => '#', 'Create' => '#']);

		return $this->render('modules.master.regulations.create');

	}

	public function store(NewRegulationsRequest $request)
	{

		$file = [];
		if(isset($request->filespath)){
				if(count($request->filespath) > 0){
						foreach ($request->filespath as $k => $value) {
								$file[$k]['fileurl'] = $value;
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

		$record = new Regulations;
		$record = $record->fill($request->except(['fileurl', 'filename']));
		$record->save();
		$record->file()->createMany($file);
		Trail::log('Master '.$this->getTitle(), 'Create a new record', request()->ip(), auth()->user()->id);

		return response([
			'status' => true
		]);
	}

	public function edit($id)
	{
		$this->setBreadcrumb(['Master' => '#', 'Regulations & Standards' => '#', 'Edit' => '#']);

		return $this->render('modules.master.regulations.edit',[
			'record' => Regulations::find($id),
		]);
	}

	public function show($id)
	{
		$this->setBreadcrumb(['Master' => '#', 'Regulations & Standards' => '#', 'Detail' => '#']);

		return $this->render('modules.master.regulations.detail',[
			'record' => Regulations::find($id),
		]);
	}

	public function update(NewRegulationsRequest $request, $id)
	{
		// dd($request->all());
		try{
			$record = Regulations::find($id);
			$fileid = [];
			if(isset($request->filespath)){
					if(count($request->filespath) > 0){
							foreach ($request->filespath as $key => $value) {
									if($request->filename[$key])
									{
										$saveFile['filename'] = $request->filename[$key];
									}

									$saveFile['fileurl'] = $value;
									$saveFile['trans_id'] = $record->id;

									$recordFile = new RegulationsFile;

									if(isset($request->fileid[$key]))
									{
										$recordFile = RegulationsFile::where('fileurl', $value)->where('trans_id', $record->id)->first();
									}
									$recordFile->fill($saveFile);
									$recordFile->save();

									$fileid[] = $recordFile->id;
							}

							$notExist = RegulationsFile::whereNotIn('id', $fileid)->where('trans_id', $record->id)->get();

							if($notExist->count() > 0)
							{
									foreach($notExist as $ne)
									{
										if(file_exists(storage_path().'/app/public/'.$ne->fileurl))
										{
												unlink(storage_path().'/app/public/'.$ne->fileurl);
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

			$record = $record->fill($request->except(['fileurl', 'filename']));
			$record->save();
			// if($record->status == 1)
			// {
			// 	$record->sentEmailReviewing();
			// 	$record->sendNotAndro('You have a new report from record','record');
   //        // $record->status = 0;
			// }
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

		// try {
			$regulations = Regulations::find($id);
			$lampiran = RegulationsFile::where('trans_id', $regulations->id)->get();
			if($lampiran->count() > 0){
				foreach ($lampiran as $berkas) {
					if(file_exists(storage_path().'/app/public/'.$berkas->fileurl))
					{
							unlink(storage_path().'/app/public/'.$berkas->fileurl);
					}
					$berkas->delete();
				}
			}

			Trail::log('Master '.$this->getTitle(), 'Deleted a record', request()->ip(), auth()->user()->id);
			Regulations::destroy($id);
		// }catch (\Exception $e) {
		// 	return response([
		// 		'status' => 'error',
		// 		'message' => 'An error occurred!',
		// 	], 500);
		// }

		return response([
			'status' => true
		]);
	}
	// END PRIVATE TO GLOBAL

	public function upload(Request $request)
    {
        $url = [];
        $filename = [];
        try {
            if(count($request->picture) > 0){
                foreach ($request->picture as $key => $file) {
                    if(filesize($file)){
                        $url[$key] = $file->storeAs('regulations_standards', md5($file->getClientOriginalName().Carbon::now()->format('Ymdhis').$key).'.'.$file->getClientOriginalExtension(), 'public');
                        $filename[$key] = $file->getClientOriginalName();
                    }else{
                        return response([
                            'status' => false,
                            'size' => ini_get('upload_max_filesize').'B',
                        ]);
                    }
                }
            }
            return response([
                'status' => true,
                'filename' => $filename,
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

	public function showStatistic($id)
	{
		return $this->render('modules.master.regulations.statistic', [
			'record' => Regulations::find($id),
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
		$regulations = Regulations::find($request->bulletin_id);

		$records = User::whereHas('site', function ($site) use ($regulations) {
			$site->whereIn('id', $regulations->site->pluck('id'));
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
			$records->whereHas('regulations', function($review) use ($request) {
				$review->where('trans_regulations.id', $request->bulletin_id);
			});
		}else if($request->reviewed == 0 && $request->reviewed != NULL){
			$records->whereDoesntHave('regulations', function($review) use ($request) {
				$review->where('trans_regulations.id', $request->bulletin_id);
			});
		}

		return DataTables::of($records)
		->addColumn('num', function ($record) use ($request) {
			return $request->get('start');
		})

		->addColumn('status', function ($record) use ($request) {
			return $record->labelReviewedRegulations($request->bulletin_id);
		})
		->rawColumns(['status', 'action', 'content'])
		->make(true);
	}

	public function download($id){
		$lampiran = RegulationsFile::find($id);
		if($lampiran == true){
			if(file_exists(public_path('storage/'.$lampiran->fileurl)))
			{
				return response()->download(public_path('storage/'.$lampiran->fileurl), $lampiran->filename);
			}
		}

		return abort('404');
	}
}
