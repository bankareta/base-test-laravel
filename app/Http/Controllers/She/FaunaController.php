<?php

namespace App\Http\Controllers\She;

/* Base App */
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/* Validation */
use App\Http\Requests\She\FaunaRequest;

/* Models */
use App\Models\She\Fauna;
use App\Models\She\FaunaMail;
use App\Models\Trail\Trail;
use App\Models\Authentication\User;

/* Libraries */
use DataTables;
// use Entrust;
use HasRoles;
use Carbon;
use Hash;
use Zipper;
use PDF;
use App\Libraries\Helpers;
use App\Models\File\Files;
use App\Models\Master\Site;
use App\Exports\FaunaExcel;
use Maatwebsite\Excel\Facades\Excel;

class FaunaController extends Controller
{
    protected $link = 'she/fauna-sighting/';
    protected $perms = 'fauna-sighting';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setPerms($this->perms);
        $this->setTitle("Fauna Sighting");
        $this->setModalSize("mini");
        $this->setSubtitle("E-Form");
        $this->setBreadcrumb(['E-Form' => '#', 'Fauna Sighting' => '#']);

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
            [
                'data' => 'site_id',
                'name' => 'site_id',
                'label' => 'Company',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",

            ],
            [
                'data' => 'name',
                'name' => 'name',
                'label' => 'Username',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",

            ],
            [
                'data' => 'contractor',
                'name' => 'contractor',
                'label' => 'Contractor',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",

            ],
            [
                'data' => 'no_telp',
                'name' => 'no_telp',
                'label' => 'Mobile Phone No.',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",

            ],
            [
                'data' => 'date_taken',
                'name' => 'date_taken',
                'label' => 'Datetime Taken',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",

            ],
            [
                'data' => 'flora',
                'name' => 'flora',
                'label' => 'Flora / Fauna',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",

            ],
            /* --------------------------- */
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
        $records = Fauna::whereIn('site_id', auth()->user()->site->pluck('id')->toArray())->select('*');
        //Init Sort
        if (!isset(request()->order[0]['column'])) {
            $records->orderBy('created_at', 'desc');
        }

        //Filters
        if ($company = $request->company) {
            $records->where('site_id',$company);
        }
        if ($start_date = $request->start_date) {
			$records->whereDate('date_taken', '>=', Helpers::DateToSql($start_date) );
		}

        if ($end_date = $request->end_date) {
			$records->whereDate('date_taken', '<=', Helpers::DateToSql($end_date) );
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
            ->editColumn('date_taken', function ($record) {
                return Helpers::DateToString(Carbon::createFromFormat('Y-m-d', $record->date_taken)).' '.$record->time_taken;
            })
            ->addColumn('action', function ($record) use ($link){
                $btn = '';

                // $btn .= $this->makeButton([
                //     'type' => 'print',
                //     'id'   => $record->id,
                //     'url'   => url($link.$record->id.'/print')
                // ]);

                $btn .= $this->makeButton([
                    'type' => 'detail-page',
                    'label' => '<i class="eye icon"></i>',
                    'tooltip' => 'Detail Data',
                    'id'   => $record->id,
                ]);

                // $btn .= $this->makeButton([
                //     'type' => 'url',
                //     'label' => '<i class="edit icon"></i>',
                //     'disabled' => auth()->user()->can($this->perms.'-edit'),
                //     'url'   => url($link.$record->id.'/edit')
                // ]);
                // Delete
                $btn .= $this->makeButton([
                    'type' => 'delete',
                    'id'   => $record->id,
                    'url'   => url($link.$record->id)
                ]);

                return $btn;
            })
            ->rawColumns(['action','covid_status'])
            ->make(true);
    }

    public function index()
    {
        $this->setSubtitle("E-Form");
        return $this->render('modules.she.fauna-sighting.index', ['mockup' => false]);
    }

    public function show($id)
    {
        $this->setTitle("Detail Fauna Sighting");
        $this->setSubtitle("E-Form");
        $this->setBreadcrumb(['E-Form' => '#', 'Fauna Sighting' => url($this->link), 'Detail' => '#']);

        $record = Fauna::find($id);
        return $this->render('modules.she.fauna-sighting.show', [
            'record' => $record,
            'lat' => explode(",",$record->location)[0],
            'lang' => explode(",",$record->location)[1],
        ]);
    }

    public function destroy($id)
    {
        $record = Fauna::find($id);
        if($record->photo){
            foreach ($record->photo as $key => $value) {
                if(file_exists(storage_path().'/app/public/'.$value->url))
                {
                    unlink(storage_path().'/app/public/'.$value->url);
                }
            }
            $record->photo()->delete();
        }
        if($record->video){
            if(file_exists(storage_path().'/app/public/'.$record->video->url))
            {
                unlink(storage_path().'/app/public/'.$record->video->url);
            }
            $record->video()->delete();
        }
        $record->delete();
        Trail::log($this->getTitle(), 'Has been deleted Fauna Sighting record', request()->ip(), auth()->user()->id);

        return response([
            'status' => true,
        ]);
    }
    public function downloadSummary(Request $request){
        try {
            $site_id = $request->company;
            $start_date = $request->start_date;
            $end_date = $request->end_date;
            $site = Site::find($site_id);
            $record = Fauna::where('site_id',$site_id)->whereBetween('date_taken',[Helpers::DateToSql($start_date),Helpers::DateToSql($end_date)])->get();
            if($record->count() > 0){
                $filename = 'Fauna Sighting - '.$site->name.' '.$start_date.' sampai '.$end_date;
                $filename = str_replace('.',' ',$filename);
                if(file_exists(storage_path().'/app/public/'.$filename.'.xlsx'))
                {
                    unlink(storage_path().'/app/public/'.$filename.'.xlsx');
                }
                $data = [
                    'routes' => $this->link,
                    'record' => $record,
                    'title' => 'Fauna Sighting',
                    'divisi' => $site->name,
                    'tgl_berlaku' => '-',
                    'periode' => Carbon::createFromFormat('Y-m-d',Helpers::DateToSql($start_date))->format('d/m/Y').' Sampai '.Carbon::createFromFormat('Y-m-d',Helpers::DateToSql($end_date))->format('d/m/Y'),
                    'name_file' => $filename.'.xlsx',
                ];

                Excel::store(new FaunaExcel($data), $filename.'.xlsx', 'public');
                $path = storage_path().'/app/public/';

                if(file_exists($path.$filename.'.xlsx'))
                {
                    if(file_exists(storage_path().'/app/public/Fauna-Zip/'.$filename.'.zip'))
                    {
                        unlink(storage_path().'/app/public/Fauna-Zip/'.$filename.'.zip');
                    }

                    $zip = Zipper::make(storage_path().'/app/public/Fauna-Zip/'.$filename.'.zip');
                    $zip->add($path.$filename.'.xlsx',$filename.'.xlsx');

                    foreach ($record as $key => $data) {
                        $key = $key+1;
                        if($data->photo()->count() > 0){
                            foreach ($data->photo as $key1 => $photo) {
                                if(file_exists(storage_path().'/app/public/'.$photo->url))
                                {
                                    $key1 = $key1+1;
                                    $files = storage_path().'/app/public/'.$photo->url;
                                    $zip->add($files,$key.'/Photo/'.$key1.'-'.$photo->filename);
                                }
                            }
                        }
                        if($data->video){
                            if(file_exists(storage_path().'/app/public/'.$data->video->url))
                            {
                                $key1 = $key1+1;
                                $files = storage_path().'/app/public/'.$data->video->url;
                                $zip->add($files,$key.'/Video/'.$data->video->filename);
                            }
                        }
                    }

                    $zip->close();

                    if(file_exists(storage_path().'/app/public/Fauna-Zip/'.$filename.'.zip'))
                    {
                        return response()->download(storage_path().'/app/public/Fauna-Zip/'.$filename.'.zip');
                    }
                    return $this->render('failed.file');
                }
                return $this->render('failed.file');
            }else{
                return response([
                    'status' => false,
                    'data' => '',
                    'message' => 'Data not found.'
                ]);
            }
        } catch (Exception $e) {
            return response([
                'status' => false,
                'data' => $e
            ]);
        }
    }
}
