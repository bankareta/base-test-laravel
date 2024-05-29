<?php

namespace App\Http\Controllers\Konfigurasi;

/* Base App */
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/* Validation */
// use App\Http\Requests\Master\SiteRequest;

/* Models */
use App\Models\Master\DImg;
use App\Models\Trail\Trail;

/* Libraries */
use DataTables;
use HasRoles;
use Carbon;
use Hash;

class DImgController extends Controller
{
    protected $link = 'konfigurasi/dashboard-img/';
    protected $perms = 'konfigurasi-dashboard-img';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setPerms($this->perms);
        $this->setTitle("Dashboard Image");
        $this->setModalSize("large");
        $this->setBreadcrumb(['Configuration' => '#', 'Dashboard Image' => '#']);

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
                'data' => 'filename',
                'name' => 'filename',
                'label' => 'Filename',
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
                'width' => '120px',

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
        $records = DImg::with('creator')->select('*');
        //Init Sort
        if (!isset(request()->order[0]['column'])) {
            $records->orderBy('created_at', 'desc');
        }

        //Filters
        if ($name = $request->name) {
            $records->where('filename', 'like', '%' . $name . '%');
        }

        $link = $this->link;
        return DataTables::of($records)
            ->addColumn('num', function ($record) use ($request) {
                return $request->get('start');
            })

            ->editColumn('created_at', function ($record) {
                return $record->created_at->diffForHumans();
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
        return $this->render('modules.master.d-img.index', [
            'mockup' => false,
            'file' => DImg::get()
            ]);
    }

    public function create()
    {
        return $this->render('modules.master.d-img.create');
    }

    public function store(Request $request)
    {
        if(!isset($request->filespath)){
            $this->validate($request, [
                'picture.0' => 'required',
            ], [
                'picture.0.required' => 'Can Not Be Empty',
            ]);
        }
        try {
            if(count($request->filespath) > 0){
                foreach ($request->filespath as $key => $value) {
                    $save = new DImg;
                    $add['filename'] = $request->filesname[$key];
                    $add['url'] = $value;
                    $add['position'] = $request->position ? $request->position:0;
                    $add['base_url'] = 'master';
                    $add['type'] = 'dashboard';
                    $save->fill($add);
                    $save->save();
                }
            }
            Trail::log('Master '.$this->getTitle(), 'upload new image', request()->ip(), auth()->user()->id);
            return response([
                'status' => true,
                'reload' => true
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
        $record = DImg::find($id);

        return $this->render('modules.master.d-img.edit', [
            'record' => $record
        ]);
    }


    public function update(Request $request, $id)
    {
        try {
            $save = DImg::find($id);
            $add['position'] = $request->position ? $request->position:0;
            $save->fill($add);
            $save->save();
            
            Trail::log('Master '.$this->getTitle(), 'edited image', request()->ip(), auth()->user()->id);
            return response([
                'status' => true,
                'reload' => true
            ]);
        } catch (Exception $e) {
            return response([
                'status' => false,
                'data' => $e
            ]);
        }
    }

    public function uploadFile(Request $request)
    {
        try {
            $url = [];
            if(count($request->picture) > 0)
            {
                $i = 0;
                foreach($request->picture as $picture)
                {
                    $get = $picture->storeAs('master/dashboard', md5($picture->getClientOriginalName().Carbon::now()->format('Ymdhis').$i).'.'.$picture->getClientOriginalExtension(), 'public');
                    $url[$i]['url'] = asset('storage/'.$get);
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

    public function destroy($id)
    {
        $record = DImg::find($id);
        if(file_exists(storage_path().'/app/public/'.$record->url))
        {
            unlink(storage_path().'/app/public/'.$record->url);
        }
        $record->delete();
        Trail::log('Master '.$this->getTitle(), 'deleted image', request()->ip(), auth()->user()->id);

        return response([
            'status' => true,
            'reload' => true
        ]);
    }
}
