<?php

namespace App\Http\Controllers\Auth;

/* Base App */
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/* Validation */
use App\Http\Requests\User\UserRequest;

/* Models */
use App\Models\Authentication\User;

/* Libraries */
use DataTables;
// use Entrust;
use HasRoles;
use Carbon;
use Hash;

class ProfileController extends Controller
{
    protected $link = 'profile/';
    protected $perms = '';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setPerms($this->perms);
        $this->setTitle("Induction");
        $this->setModalSize("mini");
        $this->setBreadcrumb(['Induction' => '#']);
    }

    public function index()
    {
        return $this->render('modules.authentication.profile', ['record' => auth()->user()]);
    }

    public function store(UserRequest $request)
    {
        $record = User::find($request->id);
        $record->fill($request->all());
        $record->save();

        return response([
            'status' => true
        ]);
    }

    public function picUpload(Request $request)
    {
        try{
            $record = User::find($request->id);
            $url = $record->picUpload($request->picture);

            return response([
                'status' => true,
                'url' => asset('storage/'.$url)
            ]);

        } catch (Exception $e) {
              return response([
                'status' => false,
                'errors' => $e
            ]);
        }
    }

    public function signUpload(Request $request)
    {
        try{
            $record = User::find($request->id);
            $url = $record->signUpload($request->picture);

            return response([
                'status' => true,
                'url' => asset('storage/'.$url)
            ]);

        } catch (Exception $e) {
              return response([
                'status' => false,
                'errors' => $e
            ]);
        }
    }

    public function getsign($id)
    {
        $record = User::find($id);

        return response([
            'status' => true,
            'url' => $record->showsignaturepath()
        ]);
    }
}
