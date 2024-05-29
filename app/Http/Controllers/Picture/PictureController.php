<?php

namespace App\Http\Controllers\Picture;

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

class PictureController extends Controller
{

    public function unlink(Request $request)
    {
        try {
            if(file_exists(storage_path().'/app/public/'.$request->path))
            {
                unlink(storage_path().'/app/public/'.$request->path);
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

    public function fileUpload(Request $request)
    {
        try {
            $url = [];
            if($request->file)
            {
                $path = $request->file->storeAs('fileupload', md5($request->file->getClientOriginalName().Carbon::now()->format('Ymdhisu')).'.'.$request->file->getClientOriginalExtension(), 'public');

                return response([
                    'status' => true,
                    'filepath' => $path,
                    'filename' => $request->file->getClientOriginalName(),
                ]);
            }

        } catch (Exception $e) {
            return response([
                'status' => false,
                'errors' => $e
            ]);
        }
        return response([
            'status' => false,
        ]);
    }

    public function bulkUnlink(Request $request)
    {
        try {
            if($request->filedelete)
            {
                foreach($request->filedelete as $filedelete)
                {
                    if(file_exists(storage_path().'/app/public/'.$filedelete))
                    {
                        unlink(storage_path().'/app/public/'.$filedelete);
                    }
                }
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
}
