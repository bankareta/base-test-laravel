<?php

namespace App\Http\Controllers\Undangan;

/* Base App */
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/* Validation */
// use App\Http\Requests\She\TrainingRequest;

/* Models */

/* Libraries */
use DataTables;
// use Entrust;
use HasRoles;
use Carbon;
use Hash;
use PDF;
use App\Libraries\Helpers;
use App\Models\Design\Acara;
use App\Models\File\Files;

class PreweddingController extends Controller
{
    protected $link = 'undangan/prewedding/';
    protected $perms = 'prewedding';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setPerms($this->perms);
        $this->setTitle("Prewedding");
        $this->setModalSize("mini");
        $this->setSubtitle("Prewedding");
        $this->setBreadcrumb(['Dokumentasi' => '#', 'Prewedding' => '#']);
    }

    public function index()
    {
        $this->setSubtitle("Prewedding");
        return $this->render('modules.undangan.prewedding.index', [
            'mockup' => false,
            'record' => Acara::get()
        ]);
    }

    public function destroy($id)
    {
        $record = Acara::find($id);
        $record->delete();

        return response([
            'status' => true,
        ]);
    }
}
