<?php

namespace App\Http\Controllers\System;

/* Base App */
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
/* Validation */

/* Models */

/* Libraries */
use DataTables;
use Carbon;
use Hash;
use File;
use Helpers;

class DownloadController extends Controller
{
    public function file($filepath, $filename = NULL)
    {
        return Helpers::download_file($filepath, $filename);
    }
}
