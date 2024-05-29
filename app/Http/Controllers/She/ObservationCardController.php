<?php

namespace App\Http\Controllers\She;

/* Base App */
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/* Validation */
use App\Http\Requests\She\ObservationCardRequest;

/* Models */
use App\Models\She\ObservationCard;
use App\Models\Trail\Trail;
use App\Models\Master\Location;
use App\Models\Master\Site;

/* Libraries */
use DataTables;
// use Entrust;
use HasRoles;
use Carbon;
use Hash;
use PDF;
use App\Libraries\Helpers;
use App\Models\File\Files;
use App\Models\Master\ObservationCategory;
use App\Exports\ObservationCardExcel;
use App\Models\Master\Departemen;
use Maatwebsite\Excel\Facades\Excel;


class ObservationCardController extends Controller
{
    protected $link = 'she/observation-card/';
    protected $perms = 'observation-card';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setPerms($this->perms);
        $this->setTitle("SHE Observation Card");
        $this->setModalSize("mini");
        $this->setSubtitle("E-Form");
        $this->setMonitor("use");
        $this->setBreadcrumb(['E-Form' => '#', 'SHE Observation Card' => '#']);

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
                'className' => "center aligned",

            ],
            [
                'data' => 'location',
                'name' => 'location',
                'label' => 'Location',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",

            ],
            [
                'data' => 'date',
                'name' => 'date',
                'label' => "Observed Date",
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",

            ],
            [
                'data' => 'obs_department_id',
                'name' => 'obs_department_id',
                'label' => "Observer's Department",
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",

            ],
            [
                'data' => 'observer_name',
                'name' => 'observer_name',
                'label' => "Observer's Name",
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",

            ],
            [
                'data' => 'finding',
                'name' => 'finding',
                'label' => 'Finding',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",

            ],
            [
                'data' => 'department_id',
                'name' => 'department_id',
                'label' => "PIC Department",
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",

            ],
            [
                'data' => 'type',
                'name' => 'type',
                'label' => "Status Observation",
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
        $records = ObservationCard::whereIn('site_id', auth()->user()->site->pluck('id')->toArray())->select('*');
        //Init Sort
        if (!isset(request()->order[0]['column'])) {
            $records->orderBy('created_at', 'desc');
        }

        //Filters
        if ($company = $request->company) {
            $records->where('site_id',$company);
        }
        
        if ($department = $request->department) {
            $records->where('obs_department_id',$department);
        }
        
        if ($pic = $request->pic) {
            $records->where('department_id',$pic);
        }

        if ($finding = $request->finding) {
            $records->where('finding',$finding);
        }

        if ($start_date = $request->start_date) {
			$records->whereDate('date', '>=', Helpers::DateToSql($start_date) );
		}

        if ($end_date = $request->end_date) {
			$records->whereDate('date', '<=', Helpers::DateToSql($end_date) );
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
            ->editColumn('obs_department_id', function ($record) {
                return $record ->obs_department_id ? $record->department->name:'';
            })
            ->editColumn('department_id', function ($record) {
                return $record ->department_id ? $record->pic->name:'';
            })
            ->editColumn('location', function ($record) {
                return $record->locations->name;
            })
            ->editColumn('date', function ($record) {
                return Helpers::DateParse($record->date);
            })
            ->editColumn('type', function ($record) {
                return $record->typelabel();
            })
            ->editColumn('finding', function ($record) {
                switch ($record->finding) {
                    case 1:
                        return 'Unsafe Action';
                        break;
                    case 2:
                        return 'Unsafe Condition';
                        break;
                    case 3:
                        return 'Positive Observation';
                        break;
                    
                    default:
                        return '-';
                        break;
                }
            })
            ->addColumn('action', function ($record) use ($link){
                $btn = '';

                if($record->created_by == auth()->user()->id){
                    if(($record->type == 0) OR ($record->type == 4)){
                        $btn .= $this->makeButton([
                            'type' => 'print',
                            'class' => 'black icon send-notif',
                            'label' => '<i class="bell icon"></i>',
                            'tooltip' => 'Send Notification',
                            'id'   => $record->id,
                            'url'   => '#'
                        ]);
                    }
                    if(($record->type == 1) OR ($record->type == 3) OR ($record->type == 4) ){
                        $btn .= $this->makeButton([
                            'type' => 'url',
                            'class' => 'black icon re-finding',
                            'label' => '<i class="refresh icon"></i>',
                            'tooltip' => 'Update Finding',
                            'id'   => $record->id,
                            'url'   => url($link.$record->id.'/finding')
                        ]);
                    }
                }
                $btn .= $this->makeButton([
                    'type' => 'detail-page',
                    'label' => '<i class="eye icon"></i>',
                    'tooltip' => 'Detail Data',
                    'id'   => $record->id,
                ]);

                if($record->type == 0){
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
            ->rawColumns(['action','type'])
            ->make(true);
    }

    public function index()
    {
        $this->setSubtitle("E-Form");
        return $this->render('modules.she.observation-card.index', ['mockup' => false]);
    }
    
    public function monitoring()
    {
        $this->setSubtitle("E-Form");
        return $this->render('modules.she.observation-card.monitoring', [
            'mockup' => false,
            'category' => ObservationCategory::with('component')->get(),
        ]);
    }

    public function searchData()
    {
        $request = request();
        switch ($request->type) {
            case 'chart':
                $dataChart1 = [
                    [
                        'name' => 'Positive Observation', 
                        'y' => ObservationCard::where('site_id',$request->site_id)->whereBetween('date',[Helpers::DateToSql($request->start_date),Helpers::DateToSql($request->end_date)])->where('finding',3)->get()->count(), 
                        'sliced' => false,
                    ],
                    [
                        'name' => 'Unsafe Condition', 
                        'y' => ObservationCard::where('site_id',$request->site_id)->whereBetween('date',[Helpers::DateToSql($request->start_date),Helpers::DateToSql($request->end_date)])->where('finding',2)->get()->count(), 
                        'sliced' => false,
                    ],
                    [
                        'name' => 'Unsafe Action', 
                        'y' => ObservationCard::where('site_id',$request->site_id)->whereBetween('date',[Helpers::DateToSql($request->start_date),Helpers::DateToSql($request->end_date)])->where('finding',1)->get()->count(), 
                        'sliced' => false,
                    ],
                ];
                $dataChart2 = [
                    [
                        'name' => 'OPEN',
                        'y' =>  ObservationCard::where('site_id',$request->site_id)->whereBetween('date',[Helpers::DateToSql($request->start_date),Helpers::DateToSql($request->end_date)])->where('status',1)->get()->count(), 
                        'sliced' => false,
                    ],
                    [
                        'name' => 'CLOSED', 
                        'y' => ObservationCard::where('site_id',$request->site_id)->whereBetween('date',[Helpers::DateToSql($request->start_date),Helpers::DateToSql($request->end_date)])->where('status',2)->get()->count(), 
                        'sliced' => false,
                    ],
                    [
                        'name' => 'Positive Finding', 
                        'y' => ObservationCard::where('site_id',$request->site_id)->whereBetween('date',[Helpers::DateToSql($request->start_date),Helpers::DateToSql($request->end_date)])->where('status',2)->get()->count(), 
                        'sliced' => false,
                    ],
                ];
                
                // set Chart data 3
                $catFirst = ObservationCategory::with('component')->first();
                $title = $catFirst->name;
                $categories = [];
                $dataChart3 = [];
                foreach ($catFirst->component as $key => $component) {
                    $categories[$key] = $component->abbreviation;
                    $idcek = $component->id;
                    $dataChart3[$key] = ObservationCard::with('category')->where('site_id',$request->site_id)
                                        ->whereHas('category', function($q)use($idcek){
                                            $q->where('category_id',$idcek);
                                        })
                                        ->whereBetween('date',[Helpers::DateToSql($request->start_date),Helpers::DateToSql($request->end_date)])
                                        ->get()->count();
                }
                // set Chart data 4
                $catList = ObservationCategory::get();
                $title2 = 'Observation Category';
                $categories2 = [];
                $dataChart4 = [];
                foreach ($catList as $key => $category) {
                    $categories2[$key] = $category->name;
                    $idcek = $category->component()->pluck('id')->toArray();
                    $dataChart4[$key] = ObservationCard::with('category')->where('site_id',$request->site_id)
                                        ->whereHas('category', function($q)use($idcek){
                                            $q->whereIn('category_id',$idcek);
                                        })
                                        ->whereBetween('date',[Helpers::DateToSql($request->start_date),Helpers::DateToSql($request->end_date)])
                                        ->get()->count();
                }

                $title3 = 'Department Observer';
                $departList = Departemen::where('site_id',$request->site_id)->get();
                foreach ($departList as $key => $depart) {
                    $categories3[$key] = $depart->name;
                    $dataChart5[$key] = ObservationCard::where('site_id',$request->site_id)->whereBetween('date',[Helpers::DateToSql($request->start_date),Helpers::DateToSql($request->end_date)])->where('obs_department_id', $depart->id)->count();
                }

                $title6 = 'Observation Category By Department';
                $departFirst = Departemen::where('site_id',$request->site_id)->first();
                $catList2 = ObservationCategory::with(['component' => function($q)use($request,$departFirst){
                    $q->withCount(['obsrvCard' => function($p)use($request,$departFirst){
                        $p->where('site_id',$request->site_id)->where('obs_department_id', $departFirst->id)->whereBetween('date',[Helpers::DateToSql($request->start_date),Helpers::DateToSql($request->end_date)]);
                    }])->withCount(['obsrvCardRisk' => function($p)use($request,$departFirst){
                        $p->where('site_id',$request->site_id)->where('obs_department_id', $departFirst->id)->whereBetween('date',[Helpers::DateToSql($request->start_date),Helpers::DateToSql($request->end_date)])->where('nilai',2);
                    }])->withCount(['obsrvCardSafe' => function($p)use($request,$departFirst){
                        $p->where('site_id',$request->site_id)->where('obs_department_id', $departFirst->id)->whereBetween('date',[Helpers::DateToSql($request->start_date),Helpers::DateToSql($request->end_date)])->where('nilai',1);
                    }]);
                }])->get();
                $categories6 = [];
                $dataChart6 = [];
                foreach ($catList2 as $key => $category) {
                    $categories6[$key] = $category->name;
                    $idcek = $category->component()->pluck('id')->toArray();
                    $dataChart6[$key] = ObservationCard::with('category')->where('site_id',$request->site_id)->where('obs_department_id', $departFirst->id)
                                        ->whereHas('category', function($q)use($idcek){
                                            $q->whereIn('category_id',$idcek);
                                        })
                                        ->whereBetween('date',[Helpers::DateToSql($request->start_date),Helpers::DateToSql($request->end_date)])
                                        ->get()->count();
                    
                    $dataFindingChart6[$key] = $category->component->sum('obsrv_card_count');
                    $dataFindingRiskChart6[$key] = $category->component->sum('obsrv_card_risk_count');
                    $dataFindingSafeChart6[$key] = $category->component->sum('obsrv_card_safe_count');
                    
                }
                return response([
                    'status' => true,
                    'type' => $request->type,
                    'chart1' => [
                        'data' => $dataChart1
                    ],
                    'chart2' => [
                        'data' => $dataChart2
                    ],
                    'chart3' => [
                        'title' => $title,
                        'categories' => $categories,
                        'data' => $dataChart3,
                    ],
                    'chart4' => [
                        'title' => $title2,
                        'categories' => $categories2,
                        'data' => $dataChart4,
                    ],
                    'chart5' => [
                        'title' => $title3,
                        'categories' => $categories3,
                        'data' => $dataChart5,
                    ],
                    'chart6' => [
                        'title' => $title6,
                        'categories' => $categories6,
                        'data' => $dataChart6,
                        'dataFinding' => $dataFindingChart6,
                        'dataRisk' => $dataFindingRiskChart6,
                        'dataSafe' => $dataFindingSafeChart6,
                    ],
                ]);  
            break;

            case 'refresh-chart':
                $catFirst = ObservationCategory::with('component')->find($request->val);
                $title = $catFirst->name;
                $categories = [];
                $dataChart3 = [];
                foreach ($catFirst->component as $key => $component) {
                    $categories[$key] = $component->abbreviation;
                    $idcek = $component->id;
                    $dataChart3[$key] = ObservationCard::with('category')->where('site_id',$request->site_id)
                                        ->whereHas('category', function($q)use($idcek){
                                            $q->where('category_id',$idcek);
                                        })
                                        ->whereBetween('date',[Helpers::DateToSql($request->start_date),Helpers::DateToSql($request->end_date)])
                                        ->get()->count();
                }
                return response([
                    'status' => true,
                    'type' => $request->type,
                    'chart3' => [
                        'title' => $title,
                        'categories' => $categories,
                        'data' => $dataChart3,
                    ],
                ]);  
            break;
            
            case 'refresh-chart-depart':
                $title6 = 'Observation Category By Department';
                $catList = ObservationCategory::with(['component' => function($q)use($request){
                    $q->withCount(['obsrvCard' => function($p)use($request){
                        $p->where('site_id',$request->site_id)->where('obs_department_id', $request->val)->whereBetween('date',[Helpers::DateToSql($request->start_date),Helpers::DateToSql($request->end_date)]);
                    }])->withCount(['obsrvCardRisk' => function($p)use($request){
                        $p->where('site_id',$request->site_id)->where('obs_department_id', $request->val)->whereBetween('date',[Helpers::DateToSql($request->start_date),Helpers::DateToSql($request->end_date)])->where('nilai',2);
                    }])->withCount(['obsrvCardSafe' => function($p)use($request){
                        $p->where('site_id',$request->site_id)->where('obs_department_id', $request->val)->whereBetween('date',[Helpers::DateToSql($request->start_date),Helpers::DateToSql($request->end_date)])->where('nilai',1);
                    }]);
                }])->get();
                $categories6 = [];
                $dataChart6 = [];
                foreach ($catList as $key => $category) {
                    $categories6[$key] = $category->name;
                    $idcek = $category->component()->pluck('id')->toArray();
                    $dataChart6[$key] = ObservationCard::with('category')->where('site_id',$request->site_id)->where('obs_department_id', $request->val)
                                        ->whereHas('category', function($q)use($idcek){
                                            $q->whereIn('category_id',$idcek);
                                        })
                                        ->whereBetween('date',[Helpers::DateToSql($request->start_date),Helpers::DateToSql($request->end_date)])
                                        ->get()->count();
                    $dataFindingChart6[$key] = $category->component->sum('obsrv_card_count');
                    $dataFindingRiskChart6[$key] = $category->component->sum('obsrv_card_risk_count');
                    $dataFindingSafeChart6[$key] = $category->component->sum('obsrv_card_safe_count');
                }
                return response([
                    'status' => true,
                    'type' => $request->type,
                    'chart6' => [
                        'title' => $title6,
                        'categories' => $categories6,
                        'data' => $dataChart6,
                        'dataFinding' => $dataFindingChart6,
                        'dataRisk' => $dataFindingRiskChart6,
                        'dataSafe' => $dataFindingSafeChart6,
                    ],
                ]);  
            break;
            
            default:
                $record = ObservationCard::where('site_id',$request->site_id)->whereBetween('date',[Helpers::DateToSql($request->start_date),Helpers::DateToSql($request->end_date)])->get();
                $category = ObservationCategory::with(['component' => function($q)use($request){
                    $q->withCount(['obsrvCard' => function($p)use($request){
                        $p->where('site_id',$request->site_id)->whereBetween('date',[Helpers::DateToSql($request->start_date),Helpers::DateToSql($request->end_date)]);
                    }])->withCount(['obsrvCardRisk' => function($p)use($request){
                        $p->where('site_id',$request->site_id)->whereBetween('date',[Helpers::DateToSql($request->start_date),Helpers::DateToSql($request->end_date)])->where('nilai',2);
                    }])->withCount(['obsrvCardSafe' => function($p)use($request){
                        $p->where('site_id',$request->site_id)->whereBetween('date',[Helpers::DateToSql($request->start_date),Helpers::DateToSql($request->end_date)])->where('nilai',1);
                    }]);
                }])->get();
                $searchData = base64_encode($request->site_id.','.Helpers::DateToSql($request->start_date).','.Helpers::DateToSql($request->end_date));
                return $this->render('modules.she.observation-card.monitoring.summary',[
                    'record' => $record,
                    'category' => $category,
                    'listDepartment' => Departemen::where('site_id',$request->site_id)->get(),
                    'searchdata' => $searchData
                ]);
            break;
        }
    }

    public function exportExcel($id)
    {
        $request = explode(',',base64_decode($id));
        $site_id = $request[0];
        $start_date = $request[1];
        $end_date = $request[2];

        $site = Site::find($site_id);

        $record = ObservationCard::where('site_id',$site_id)->whereBetween('date',[$start_date,$end_date])->get();
        $category = ObservationCategory::with(['component' => function($q)use($request){
            $q->withCount(['obsrvCard' => function($p)use($request){
                $p->where('site_id',$request[0])->whereBetween('date',[$request[1],$request[2]]);
            }])->withCount(['obsrvCardRisk' => function($p)use($request){
                $p->where('site_id',$request[0])->whereBetween('date',[$request[1],$request[2]])->where('nilai',2);
            }])->withCount(['obsrvCardSafe' => function($p)use($request){
                $p->where('site_id',$request[0])->whereBetween('date',[$request[1],$request[2]])->where('nilai',1);
            }]);
        }])->get();

        $filename = 'SHE Observation Card - '.$site->name.' '.$request[1].' sampai '.$request[2];

        if(file_exists(storage_path().'/app/public/'.$filename.'.xlsx'))
        {
            unlink(storage_path().'/app/public/'.$filename.'.xlsx');
        }
        $data = [
            'routes' => $this->link,
            'record' => $record,
            'category' => $category,
            'title' => 'SHE Observation Card',
            'divisi' => $site->name,
            'tgl_berlaku' => '-',
            'periode' => Carbon::createFromFormat('Y-m-d',$start_date)->format('d/m/Y').' Sampai '.Carbon::createFromFormat('Y-m-d',$end_date)->format('d/m/Y'),
            'name_file' => $filename.'.xlsx',
        ];

        Excel::store(new ObservationCardExcel($data), $filename.'.xlsx', 'public');
        $path = storage_path().'/app/public/';

        if(file_exists($path.$filename.'.xlsx'))
        {
            return response()->download($path.$filename.'.xlsx');
        }
        return $this->render('failed.file');
    }

    public function create()
    {
        $this->setTitle("Create SHE Observation Card");
        $this->setSubtitle("E-Form");
        $this->setBreadcrumb(['E-Form' => '#', 'SHE Observation Card' => url($this->link), 'Create' => '#']);

        return $this->render('modules.she.observation-card.create');
    }

    public function store(ObservationCardRequest $request)
    {
        try {
            $request['type'] = 0;
            $record = ObservationCard::saveData($request);
            $file_1 = $request->foto->storeAs('she/observation-card', md5($request->foto->getClientOriginalName().Carbon::now()->format('Ymdhis')).'.'.$request->foto->getClientOriginalExtension(), 'public');
            $data['filename'] = $request->foto->getClientOriginalName();
            $data['url'] = $file_1;
            $data['target_type'] = 'she-observation-card';
            $data['target_id'] = $record->id;
            $data['type'] = 'primary';
            if(count($request->category_id) > 0){
                foreach ($request->category_id as $key => $value) {
                    $categorys[$key] = [
                        "nilai" => $value
                    ]; 
                }
                $record->category()->sync($categorys);
            }
            $saveImg = new Files;
            $saveImg->fill($data);
            $saveImg->save();
            
            if($request->other_foto){
                $file_2 = $request->other_foto->storeAs('she/observation-card', md5($request->other_foto->getClientOriginalName().Carbon::now()->format('Ymdhis')).'.'.$request->other_foto->getClientOriginalExtension(), 'public');
                $data['filename'] = $request->other_foto->getClientOriginalName();
                $data['url'] = $file_2;
                $data['target_type'] = 'she-observation-card';
                $data['target_id'] = $record->id;
                $data['type'] = 'secondary';
                $saveImg = new Files;
                $saveImg->fill($data);
                $saveImg->save();
            }
            $record->sentEmailReviewing();
            Trail::log($this->getTitle(), 'Has been created SHE Observation Card record', request()->ip(), auth()->user()->id);

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
        $this->setTitle("Edit SHE Observation Card");
        $this->setSubtitle("E-Form");
        $this->setBreadcrumb(['E-Form' => '#', 'SHE Observation Card' => url($this->link), 'Edit' => '#']);

        $record = ObservationCard::find($id);
        return $this->render('modules.she.observation-card.edit', [
            'record' => $record
        ]);
    }
    
    public function finding($id)
    {
        $this->setTitle("Update Finding SHE Observation Card");
        $this->setSubtitle("E-Form");
        $this->setBreadcrumb(['E-Form' => '#', 'SHE Observation Card' => url($this->link), 'Update Finding' => '#']);

        $record = ObservationCard::find($id);
        return $this->render('modules.she.observation-card.finding', [
            'record' => $record
        ]);
    }
    
    public function getLocation($id)
    {
        if($id == '-'){
            $list = Location::options('name','id',['filters' => [
                function ($site) {
                    $site->where('site_id', 0);
                  },
                ]
              ], 'Choose One');
            
            $depart = Departemen::options('name','id',['filters' => [
                function ($site) {
                    $site->where('site_id', 0);
                  },
                ]
              ], 'Choose One');
        }else{
            $list = Location::options('name','id',['filters' => [
                function ($site) use ($id) {
                    $site->where('site_id', $id);
                  },
                ]
              ], 'Choose One');
            
            $depart = Departemen::options('name','id',['filters' => [
                function ($site) use ($id) {
                    $site->where('site_id', $id);
                  },
                ]
              ], 'Choose One');
        }
        return response([
            'status' => true,
            'data' => $list,
            'depart' => $depart
        ]);
    }

    public function update(ObservationCardRequest $request, $id)
    {
        try {
            if(isset($request->slug)){
                if($request->type == 3){
                    $beType = $request->type;
                    $request['type'] = 4;
                }
            }
            $record = ObservationCard::saveData($request);
            if(count($request->category_id) > 0){
                foreach ($request->category_id as $key => $value) {
                    $categorys[$key] = [
                        "nilai" => $value
                    ]; 
                }
                $record->category()->sync($categorys);
            }
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
            if($request->other_foto){
                if($record->secFiles){
                    if(file_exists(storage_path().'/app/public/'.$record->secFiles->url))
                    {
                        unlink(storage_path().'/app/public/'.$record->secFiles->url);
                    }
                    $record->secFiles->delete();
                }

                $file_2 = $request->other_foto->storeAs('she/observation-card', md5($request->other_foto->getClientOriginalName().Carbon::now()->format('Ymdhis')).'.'.$request->other_foto->getClientOriginalExtension(), 'public');
                $data['filename'] = $request->other_foto->getClientOriginalName();
                $data['url'] = $file_2;
                $data['target_type'] = 'she-observation-card';
                $data['target_id'] = $record->id;
                $data['type'] = 'secondary';
                $saveImg = new Files;
                $saveImg->fill($data);
                $saveImg->save();
            }
            if(isset($beType)){
                $record->sentEmailReviewing();
            }
            Trail::log($this->getTitle(), 'Has been edited SHE Observation Card record', request()->ip(), auth()->user()->id);
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
        $this->setTitle("Detail SHE Observation Card");
        $this->setSubtitle("E-Form");
        $this->setBreadcrumb(['E-Form' => '#', 'SHE Observation Card' => url($this->link), 'Detail' => '#']);

        $record = ObservationCard::with('site','category','locations','energySources','primaryFiles','secFiles')->find($id);
        if(($record->type == 0 ) OR ($record->type == 4)){
            if($record->pic->person->id == auth()->user()->id){
                $record->fill(['type' => 1]);
                $record->save();
            }
        }
        return $this->render('modules.she.observation-card.show', [
            'record' => $record
        ]);
    }
    public function destroy($id)
    {
        $record = ObservationCard::find($id);
        if($record->primaryFiles){
            if(file_exists(storage_path().'/app/public/'.$record->primaryFiles->url))
            {
                unlink(storage_path().'/app/public/'.$record->primaryFiles->url);
            }
            $record->primaryFiles->delete();
            
        }
        if($record->secFiles){
            if(file_exists(storage_path().'/app/public/'.$record->secFiles->url))
            {
                unlink(storage_path().'/app/public/'.$record->secFiles->url);
            }
            $record->secFiles->delete();
        }

        Trail::log($this->getTitle(), 'Has been deleted SHE Observation Card record', request()->ip(), auth()->user()->id);
        $record->delete();

        return response([
            'status' => true,
        ]);
    }

    public function printPdf($id)
    {
        $record = ObservationCard::find($id);
        $pdf = PDF::loadView('modules.she.observation-card.pdf', [
            'record' => $record,
            'today' => Helpers::DateToString(Carbon::now()),
            'title' => 'SHE Observation Card Evaluation Report',
            'date' => Helpers::DateToString(Carbon::parse($record->date)),
          ])->setPaper('a4', 'potrait')->setOptions(
            [
              'defaultFont' => 'times-roman',
              'isHtml5ParserEnabled' => true,
              'isRemoteEnabled' => true,
              'isPhpEnabled' => true
            ]
          );
          return $pdf->stream('Industrial-Inspection-'.Carbon::now()->format('d-m-Y H:i:s').'.pdf');
    }

    public function sendNotification(Request $request)
    {
        try {
            $record = ObservationCard::findOrFail($request->id);
            $record->sentEmailReviewing();

            Trail::log($this->getTitle(), 'Has been send notification Observation Card reviewer', request()->ip(), auth()->user()->id);

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
    
    public function actionPic(Request $request)
    {
        try {
            $record = ObservationCard::find($request->id);
            $stt = 2;
            if($request->status == 'reject'){
                $stt = 3;
            }
            $record->fill(["type" => $stt]);
            $record->save();
            $record->sentEmailAction();

            Trail::log($this->getTitle(), 'Has been send notification assigned Observation Card record', request()->ip(), auth()->user()->id);

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
}
