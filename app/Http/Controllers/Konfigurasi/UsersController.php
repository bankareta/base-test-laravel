<?php

namespace App\Http\Controllers\Konfigurasi;

/* Base App */
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/* Validation */
use App\Http\Requests\Konfigurasi\UsersRequest;

/* Models */
use App\Models\Authentication\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Trail\Trail;

/* Libraries */
use DataTables;
// use Entrust;
use HasRoles;
use Carbon;
use Hash;
use Auth;

class UsersController extends Controller
{
    protected $link = 'konfigurasi/users/';
    protected $perms = 'konfigurasi-users';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setPerms($this->perms);
        $this->setTitle("User Management");
        $this->setModalSize("mini");
        $this->setBreadcrumb(['Configuration' => '#', 'User Management' => '#']);

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
                'data' => 'username',
                'name' => 'username',
                'label' => 'Username',
                'searchable' => false,
                'sortable' => true,
            ],
            [
                'data' => 'fullname',
                'name' => 'fullname',
                'label' => 'Display Name',
                'searchable' => false,
                'sortable' => true,
            ],
            [
                'data' => 'email',
                'name' => 'email',
                'label' => 'Email',
                'searchable' => false,
                'sortable' => true,
            ],
            [
                'data' => 'roles',
                'name' => 'roles',
                'label' => 'Roles',
                'searchable' => false,
                'sortable' => true,
            ],
            [
                'data' => 'last_login',
                'name' => 'last_login',
                'label' => 'Last Login',
                'searchable' => false,
                'sortable' => true,
            ],
            [
                'data' => 'created_at',
                'name' => 'created_at',
                'label' => 'Created At',
                'searchable' => false,
                'sortable' => true,
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
        $records = User::with('roles')->select('*');

        //Filters
        if ($username = $request->username) {
            $records->where('username', 'like', '%' . $username . '%');
        }

        if ($email = $request->email) {
            $records->where('email', 'like', '%' . $email . '%');
        }
        $records = $records->get();
        $link = $this->link;
        return DataTables::of($records)
            ->addColumn('num', function ($record) use ($request) {
                return $request->get('start');
            })
            ->addColumn('roles', function ($record) {
                $roles = '';
                foreach ($record->roles as $i => $role) {
                    $roles .= $role->name;
                    if($i < $record->roles->count() - 1){
                        $roles .= ', ';
                    }
                }
                return $roles;
            })
            ->editColumn('last_login', function ($record) {
                // return $record->last_login->formatLocalized("%d %B");
                return $record->last_login->diffForHumans();
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
            ->rawColumns(['action'])
            ->make(true);
    }

    public function index()
    {
        if(Auth::check()){
            return $this->render('modules.konfigurasi.users.index', ['mockup' => false]);
        }else{
            return redirect('/login');
        }
    }

    public function create()
    {
        return $this->render('modules.konfigurasi.users.create');
    }

    public function store(UsersRequest $request)
    {
        $record = new User;
        $record->fill($request->all());
        $record->password = bcrypt($request->password);
        $record->last_login = Carbon::now();
        $record->save();
        if($request->roles[0]){
            $record->roles()->sync($request->roles);
        }
        if($request->sites[0]){
            $record->site()->sync($request->sites);
        }
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
        Trail::log('Master '.$this->getTitle(), 'created new user', request()->ip(), auth()->user()->id);

        return response([
            'status' => true
        ]);
    }

    public function edit($id)
    {
        $record = User::find($id);

        return $this->render('modules.konfigurasi.users.edit', [
            'record' => $record
        ]);
    }


    public function update(UsersRequest $request, $id)
    {
        $record = User::find($id);
        $record->username = $request->username;
        $record->fullname = $request->fullname;
        $record->email = $request->email;
        if($request->password){
            $pass = $request->password;
            if(!Hash::check($request->password_lama, $record->password) && $request->password_lama != NULL){
                return response([
                    'message' => 'Wrong old password',
                    'errors' => [
                        'password_lama' => ['Wrong old password']
                    ]
                ], 422);
            }elseif($pass && $request->password == $request->confirm_password){
                $record->password = bcrypt($pass);
            }
        }

        $record->save();

        if($request->roles[0]){
            $record->roles()->sync($request->roles);
        }else{
            $record->roles()->delete();
        }
        if($request->sites[0]){
            $record->site()->sync($request->sites);
        }else{
            $record->site()->delete();
        }
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
        Trail::log('Master '.$this->getTitle(), 'edited user', request()->ip(), auth()->user()->id);

        if(auth()->user()->id == $record->id){
            auth()->user()->flushActivity();
            Auth::logout();
            return response([
                'status' => true,
                'toLogout' => true,
                'message' => 'Data successfully saved, Your account will be renewed, please re-login again'
            ]);
        }else{
            return response([
                'status' => true,
            ]);
        }
        // return redirect('/login');
    }

    public function destroy($id)
    {
      $record = User::find($id);
      $roles = $record->roles->pluck('id')->toArray();
      try {
        if($record->id == auth()->user()->id){
             header('HTTP/1.1 500 Internal Server Booboo');
                header('Content-Type: application/json; charset=UTF-8');
                die(json_encode(array('message' => 'ERROR', 'errors' => 'failed to delete')));
        }
        Trail::log('Master '.$this->getTitle(), 'deleted user', request()->ip(), auth()->user()->id);
        $record->delete();
      } catch (\Exception $e) {
          $record->roles()->sync($roles);
          return response([
              'status' => false,
              'data' => $e
          ]);
      }

      return response([
          'status' => true,
      ]);
    }

    public function changeStatus($id)
    {
        $status = 0;
        $record = User::find($id);
        if($record->status == 0){
            $status = 1;
        }
        $record->status = $status;
        $record->save();

        return response([
            'status' => true,
        ]);
    }

    public function optionSite($id)
    {
      return User::options(function ($user) {
              return $user->display;
            }, 'id', [
                    'filters' => [
                        function ($u) use ($id) {
                            $u->whereHas('site', function ($site) use ($id) {
                                $site->where('id', $id);
                            });
                        },
                        'status' => 1,
                    ],
                  ]);
    }

    public function optionHira($perms, $id)
    {
      if($pems == 1)
      {

      }
      if($perms == 2)
      {

      }
      return User::options(function ($user) {
              return $user->display;
            }, 'id', [
                    'filters' => [
                        function ($u) use ($id) {
                            $u->whereHas('site', function ($site) use ($id) {
                                $site->where('id', $id);
                            });
                        },
                        'status' => 1,
                    ],
                  ]);
    }
}
