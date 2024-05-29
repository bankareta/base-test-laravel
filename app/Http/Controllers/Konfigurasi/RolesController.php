<?php

namespace App\Http\Controllers\Konfigurasi;

/* Base App */
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
/* Validation */
use App\Http\Requests\Konfigurasi\RolesRequest;

/* Models */
use App\Models\Authentication\User;
use Spatie\Permission\Models\Role;
use App\Models\Trail\Trail;

/* Libraries */
use DataTables;
use Carbon;
use Hash;

class RolesController extends Controller
{
    protected $link = 'konfigurasi/roles/';
    protected $perms = 'konfigurasi-roles';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setPerms($this->perms);
        $this->setTitle("Permissions & Roles");
        $this->setModalSize("mini");
        $this->setBreadcrumb(['Configuration' => '#', 'Permissions & Roles' => '#']);

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
                'label' => 'Roles',
                'searchable' => false,
                'sortable' => true,
                'width' => '120px',
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
        $records = Role::select('*');
        //Init Sort
        if (!isset(request()->order[0]['column'])) {
            $records->orderBy('created_at', 'desc');
        }
        if ($name = $request->name) {
            $records->where('name', 'like', '%' . $name . '%');
        }
        $link = $this->link;
        return DataTables::of($records)
            ->addColumn('num', function ($record) use ($request) {
                return $request->get('start');
            })
            ->editColumn('created_at', function ($record) {
                return is_null($record->created_at)
                    ? '<i class="calendar icon"></i> ? &nbsp; <i class="clock icon"></i> ?'
                    : '<i class="calendar icon"></i>' . $record->created_at->format('d/m/Y') . '&nbsp; <i class="clock icon"></i>' . $record->created_at->format('H:i');
            })
            ->addColumn('action', function ($record) use ($link){
                $btn = '';

                $btn .= $this->makeButton([
                    'type' => 'url',
                    'class'   => 'teal icon detail',
                    'label'   => '<i class="file text icon"></i>',
                    'tooltip' => 'Detail',
                    'url'  => url($link.$record->id),
                    'disabled' => auth()->user()->can($this->perms.'-edit'),
                ]);

                $btn .= $this->makeButton([
                    'type' => 'modal',
                    'datas' => [
                        'id' => $record->id
                    ],
                    'id'   => $record->id,
                    'disabled' => auth()->user()->can($this->perms.'-edit'),
                ]);
                // Delete
                $btn .= $this->makeButton([
                    'type' => 'delete',
                    'id'   => $record->id,
                    'url'   => url($link.$record->id)
                ]);

                return $btn;
            })
            ->rawColumns(['action', 'created_at', 'created_by'])
            ->make(true);
    }

    public function index()
    {
        return $this->render('modules.konfigurasi.roles.index', ['mockup' => false]);
    }

    public function create()
    {
        return $this->render('modules.konfigurasi.roles.create');
    }

    public function store(RolesRequest $request)
    {
        $record = new Role;
        $record->fill($request->all());
        $record->created_by = auth()->user()->id;
        $record->save();

        return response([
            'status' => true
        ]);
    }

    public function edit($id)
    {
        $record = Role::find($id);

        return $this->render('modules.konfigurasi.roles.edit', [
            'record' => $record
        ]);
    }

    public function show($id)
    {
        $record = Role::find($id);

        return $this->render('modules.konfigurasi.roles.detail', [
            'record' => $record
        ]);
    }

    public function update(RolesRequest $request, $id)
    {
        $record = Role::find($id);
        $record->fill($request->all());
        $record->updated_by = auth()->user()->id;
        $record->save();

        return response([
            'status' => true
        ]);
    }

    public function grant(Request $request, $id)
    {
        foreach ($request->check as $key => $value) {
            $temp = [
                'name' => $value,
            ];
            if(Permission::where('name', $value)->count() == 0){
                Permission::create($temp);
            }
        }
        $permsi = Permission::whereIn('name', $request->check)->get()->pluck('id');
        $record = Role::findById($id);
        $record->permissions()->sync($permsi);
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

        return response([
            'status' => true
        ]);
    }

    public function destroy($id)
    {
        $record = Role::find($id);
        if($record->users()->count() > 0){
            return response([
                'status' => false,
            ]);
        }else{
            $record->delete();
            return response([
                'status' => true,
            ]);
        }


    }
}
