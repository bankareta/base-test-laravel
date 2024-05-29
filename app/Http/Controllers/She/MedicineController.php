<?php

namespace App\Http\Controllers\She;

/* Base App */
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/* Validation */
use App\Http\Requests\She\MedicineRequest;

/* Models */
use App\Models\She\Medicine;
use App\Models\She\MedicineStock;
use App\Models\Trail\Trail;
use App\Models\Authentication\User;
use App\Models\Master\Site;

/* Libraries */
use DataTables;
// use Entrust;
use Carbon\CarbonPeriod;
use HasRoles;
use Carbon;
use Hash;
use PDF;
use App\Libraries\Helpers;
use App\Models\File\Files;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MedicineExcel;
use App\Exports\MedicineManageSheetExcel;

class MedicineController extends Controller
{
    protected $link = 'she/drugs-medicine/';
    protected $perms = 'drugs-medicine';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setPerms($this->perms);
        $this->setTitle("Drugs & Medicine Status");
        $this->setModalSize("mini");
        $this->setSubtitle("E-Form");
        $this->setBreadcrumb(['E-Form' => '#', 'Drugs & Medicine Status' => '#']);

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
                'data' => 'medicine_id',
                'name' => 'medicine_id',
                'label' => 'Obat',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",

            ],
            [
                'data' => 'trademark_id',
                'name' => 'trademark_id',
                'label' => 'Merk',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",

            ],
            [
                'data' => 'year',
                'name' => 'year',
                'label' => 'Tahun',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",

            ],
            [
                'data' => 'dose',
                'name' => 'dose',
                'label' => 'Dosis',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",

            ],
            [
                'data' => 'unit_id',
                'name' => 'unit_id',
                'label' => 'Sediaan',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",
                
            ],
            [
                'data' => 'min_stock',
                'name' => 'min_stock',
                'label' => 'Min Stok',
                'searchable' => false,
                'sortable' => true,
                'className' => "center aligned",

            ],
            [
                'data' => 'stock',
                'name' => 'stock',
                'label' => 'Stok',
                'searchable' => false,
                'sortable' => false,
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
                'width' => '150px',
            ]
        ]);
    }

    public function grid(Request $request)
    {
        $records = Medicine::whereIn('site_id', auth()->user()->site->pluck('id')->toArray())->select('*');
        //Init Sort
        if (!isset(request()->order[0]['column'])) {
            $records->orderBy('created_at', 'desc');
        }

        //Filters
        if ($company = $request->company) {
            $records->where('site_id',$company);
        }

        // if ($year = $request->year) {
        //     $records->where('year', 'like', '%' . $year . '%');
        // }
        if ($year = $request->year) {
            $records->where('year',$year);
        }

         if ($contract_no = $request->contract_no) {
            $records->whereHas('contractor',function($q) use($contract_no){
                $q->where('reference',$contract_no);
            })->get();
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
            ->editColumn('medicine_id', function ($record) {
                return $record->medicine->name;
            })
            ->editColumn('trademark_id', function ($record) {
                return $record->trademark_id ? $record->trademark->name:'';
            })
            ->editColumn('dose', function ($record) {
                return $record->dose.' gr';
            })
            ->editColumn('min_stock', function ($record) {
                return $record->min_stock.' pcs';
            })
            ->editColumn('unit_id', function ($record) {
                return $record->unit ? $record->unit->name:'-';
            })
            ->addColumn('stock', function ($record) {
                $insert = $record->stock->where('number_stock',1)->sum('update_stock');
                $out = $record->stock->where('number_stock',0)->sum('update_stock');
                $total = $insert - $out;
                return $total.' pcs';
            })
            ->addColumn('action', function ($record) use ($link){
                $btn = '';

                $btn .= $this->makeButton([
                    'type' => 'detail-page',
                    'label' => '<i class="eye icon"></i>',
                    'tooltip' => 'Detail Data',
                    'id'   => $record->id,
                ]);

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
            ->rawColumns(['action','covid_status'])
            ->make(true);
    }

    public function index()
    {
        $this->setSubtitle("E-Form");
        return $this->render('modules.she.drugs-medicine.index', ['mockup' => false]);
    }

    public function create()
    {
        $this->setTitle("Create Drugs & Medicine Status");
        $this->setSubtitle("E-Form");
        $this->setBreadcrumb(['E-Form' => '#', 'Drugs & Medicine Status' => url($this->link), 'Create' => '#']);

        return $this->render('modules.she.drugs-medicine.create');
    }
    
    public function recap()
    {
        $this->setTitle("Print Summary Drugs & Medicine Status");
        $this->setSubtitle("E-Form");
        $this->setBreadcrumb(['E-Form' => '#', 'Drugs & Medicine Status' => url($this->link), 'Print Summary' => '#']);

        return $this->render('modules.she.drugs-medicine.recap');
    }

    public function restock()
    {
        $this->setTitle("Transaction Drugs & Medicine");
        $this->setSubtitle("E-Form");
        $this->setBreadcrumb(['E-Form' => '#', 'Drugs & Medicine Status' => url($this->link), 'Transaction' => '#']);

        return $this->render('modules.she.drugs-medicine.restock');
    }

    public function printSummary(Request $request)
    {
        $this->validate($request, [
            'site_id' => 'required',
            'year' => 'required',
        ], [
            'site_id.required' => 'Cannot be empty',
            'year.required' => 'Cannot be empty',
        ]);
        try {
            $record = Medicine::where('site_id',$request->site_id)->where('year',$request->year)->get();
            if($record->count() > 0){
                $data = $this->exportExcel($request,$record);
                return response()->download($data.'.xlsx');
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

    public function exportExcel($request,$record){
        $site_id = $request->site_id;
        $site = Site::find($site_id);
        $date = Carbon::createFromFormat('Y',request()->year);
        $startday = $date->copy()->startOfYear();
        $lastday = $date->copy()->endOfYear();
        $periode = CarbonPeriod::create($startday, '1 month',$lastday);

        $filename = 'Summary Drugs & Medicine Status - '.$site->name.' '.$request->year;

        if(file_exists(storage_path().'/app/public/'.$filename.'.xlsx'))
        {
            unlink(storage_path().'/app/public/'.$filename.'.xlsx');
        }
        $data = [
            'routes' => $this->link,
            'record' => $record,
            'month' => $periode,
            'title' => 'Summary Drugs & Medicine Status',
            'divisi' => $site->name,
            'tgl_berlaku' => '-',
            'periode' => $request->year,
            'name_file' => $filename.'.xlsx',
        ];

        Excel::store(new MedicineManageSheetExcel($data), $filename.'.xlsx', 'public');
        $path = storage_path().'/app/public/';

        if(file_exists($path.$filename.'.xlsx'))
        {
            return $path.$filename;
        }
        return $this->render('failed.file');
    }
    
    public function store(MedicineRequest $request)
    {
        try {
            if(isset($request->type)){
                if($request->type == 'update-stock'){
                    $existing = Medicine::find($request->medicine_id);
                    $insert = $existing->stock->where('number_stock',1)->sum('update_stock');
                    $out = $existing->stock->where('number_stock',0)->sum('update_stock');
                    $stock_exist = $insert - $out;
                    $stock_update = $stock_exist + $request->stock;

                    $request['medicine_id'] = $request->medicine_id;
                    $request['last_stock'] = $stock_update;
                    $request['update_stock'] = $request->stock;
                    $request['number_stock'] = 1;
                    $request['expire_date'] = $request->expire_date;
                    $record = MedicineStock::saveData($request);
                    Trail::log($this->getTitle(), 'Has been updated stock Drugs & Medicine Status record', request()->ip(), auth()->user()->id);
                }else{
                    $expire_date = $request->expire_date_trans;
                    $existingStock = MedicineStock::where('medicine_id', $request->medicine_trans_id)->whereDate('expire_date', $expire_date);
                    $insertStock = with(clone $existingStock)->where('number_stock',1)->sum('update_stock');
                    $outStock = with(clone $existingStock)->where('number_stock',0)->sum('update_stock');
                    $data = $insertStock - $outStock;
                    if($request->trans_stock > $data){
                        $this->validate($request, [
                            'trans_stock' => 'email',
                        ], [
                            'trans_stock.email' => 'Maximal transaksi harus '.$data.' pcs',
                        ]);
                    }
                    $existing = Medicine::find($request->medicine_trans_id);
                    $min_stock = $existing->min_stock;
                    $insert = $existing->stock->where('number_stock',1)->sum('update_stock');
                    $out = $existing->stock->where('number_stock',0)->sum('update_stock');
                    $stock_exist = $insert - $out;
                    $stock_update = $stock_exist - $request->trans_stock;
                    if($min_stock > $stock_update){
                        $this->validate($request, [
                            'trans_stock' => 'email',
                        ], [
                            'trans_stock.email' => 'Minimal stok harus '.$min_stock.' pcs',
                        ]);
                    }

                    $request['medicine_id'] = $request->medicine_trans_id;
                    $request['last_stock'] = $stock_update;
                    $request['update_stock'] = $request->trans_stock;
                    $request['number_stock'] = 0;
                    $request['expire_date'] = Helpers::DateToString(Carbon::createFromFormat('Y-m-d', $request->expire_date_trans));
                    $record = MedicineStock::saveData($request);
                    if($request->trans_stock == $data){
                        MedicineStock::where('medicine_id', $request->medicine_trans_id)->where('number_stock',1)->whereDate('expire_date', $expire_date)->update(['reusable' => 1]);
                    }
                    Trail::log($this->getTitle(), 'Has been transaction Drugs & Medicine Status record', request()->ip(), auth()->user()->id);
                }
            }else{
                $request['dose'] = str_replace('.',',',$request->dose);
                $record = Medicine::saveData($request);
                Trail::log($this->getTitle(), 'Has been created Drugs & Medicine Status record', request()->ip(), auth()->user()->id);
            }

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

    public function filterMedicine($id)
    {
        $filter = '';
        $type = '';
        if(isset(request()->type)){
           if(request()->type == 'stock'){
                $type = 'stock';
           }else if(request()->type == 'stockExpire'){
                $type = 'stockExpire'; 
           }else{
                $filter = 'disabled-medicine'; 
           }
        }
        if($type){
            if($type == 'stockExpire'){
                if($id == '-'){
                    $data = 0;
                }else{
                    if(!isset(request()->expire_date)){
                        $data = 0;
                    }else{
                        $expire_date = request()->expire_date;
                        $existing = MedicineStock::where('medicine_id', $id)->whereDate('expire_date', $expire_date);
                        $insert = with(clone $existing)->where('number_stock',1)->sum('update_stock');
                        $out = with(clone $existing)->where('number_stock',0)->sum('update_stock');
                        $data = $insert - $out;
                    }
                }
                return response([
                    'status' => true,
                    'data' => $data,
                ]);
            }else{
                if($id == '-'){
                    $data = 0;
                    $expire = MedicineStock::options(function ($data) {
                            return $data->expire_date;
                        },'id',['filters' => [
                        function ($site) {
                            $site->where('medicine_id', 0);
                        },
                        ]
                    ], 'Choose One');
                }else{
                    $existing = Medicine::find($id);
                    $min_stock = $existing->min_stock;
                    $insert = $existing->stock->where('number_stock',1)->sum('update_stock');
                    $out = $existing->stock->where('number_stock',0)->sum('update_stock');
                    $data = $insert - $out;
    
                    $expire = MedicineStock::options(function ($data) {
                            return Helpers::DateToString(Carbon::createFromFormat('Y-m-d', $data->expire_date));
                        },'expire_date',[
                            'filters' => [
                                function ($site) use ($id) {
                                    $site->where('medicine_id', $id)->where('number_stock',1)->whereNull('reusable');
                                },
                            ],
                            'orders' => ['expire_date' => 'asc']
                        ], 'Choose One','','remove-duplicate','expire_date');
                }
                return response([
                    'status' => true,
                    'data' => $data,
                    'expire' => $expire,
                ]);
            }
        }else{
            if($id == '-'){
                $list = Medicine::options(function ($data) {
                        return $data->trademark_id ? $data->medicine->name.' ('.$data->trademark->name.') /'.$data->unit->name:$data->medicine->name.' / '.$data->unit->name;
                    },'id',['filters' => [
                    function ($site) {
                        $site->where('site_id', 0);
                      },
                    ]
                  ], 'Choose One');
            }else{
                $year = request()->year;
                $list = Medicine::options(function ($data) {
                        return $data->trademark_id ? $data->medicine->name.' ('.$data->trademark->name.') /'.$data->unit->name:$data->medicine->name.' / '.$data->unit->name;
                    },'id',['filters' => [
                    function ($site) use ($id,$year) {
                        $site->where('site_id', $id)->where('year',$year);
                      },
                    ]
                  ], 'Choose One','',$filter);
            }

            return response([
                'status' => true,
                'data' => $list,
            ]);
        }
    }
    
    public function filterYear($id)
    {
        $date = Carbon::createFromFormat('Y',request()->year);
        $startday = $date->copy()->startOfYear();
        $lastday = $date->copy()->endOfYear();
        $periode = CarbonPeriod::create($startday, '1 month',$lastday);
        $record = Medicine::find($id);
        $insert = $record->stock->where('number_stock',1)->sum('update_stock');
        $out = $record->stock->where('number_stock',0)->sum('update_stock');
        $stock = $insert - $out;
        return $this->render('modules.she.drugs-medicine.table-filter', [
            'record' => $record,
            'stock' => $stock,
            'periode' => $periode
        ]);
    }
    
    public function edit($id)
    {
        $this->setTitle("Edit Drugs & Medicine Status");
        $this->setSubtitle("E-Form");
        $this->setBreadcrumb(['E-Form' => '#', 'Drugs & Medicine Status' => url($this->link), 'Edit' => '#']);

        $record = Medicine::find($id);
        return $this->render('modules.she.drugs-medicine.edit', [
            'record' => $record
        ]);
    }

    public function update(MedicineRequest $request, $id)
    {
        try {
            $request['dose'] = str_replace('.',',',$request->dose);
            $record = Medicine::saveData($request);
            Trail::log($this->getTitle(), 'Has been edited Drugs & Medicine Status record', request()->ip(), auth()->user()->id);
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
        $this->setTitle("Detail Drugs & Medicine Status");
        $this->setSubtitle("E-Form");
        $this->setBreadcrumb(['E-Form' => '#', 'Drugs & Medicine Status' => url($this->link), 'Detail' => '#']);

        $startday = Carbon::now()->startOfYear();
        $lastday = Carbon::now()->endOfYear();
        $periode = CarbonPeriod::create($startday, '1 month',$lastday);
        $record = Medicine::find($id);
        $insert = $record->stock->where('number_stock',1)->sum('update_stock');
        $out = $record->stock->where('number_stock',0)->sum('update_stock');
        $stock = $insert - $out;
        return $this->render('modules.she.drugs-medicine.show', [
            'record' => $record,
            'stock' => $stock,
            'periode' => $periode
        ]);
    }
    public function destroy($id)
    {
        $record = Medicine::find($id);
        $record->stock()->delete();
        Trail::log($this->getTitle(), 'Has been deleted Drugs & Medicine Status record', request()->ip(), auth()->user()->id);
        $record->delete();

        return response([
            'status' => true,
        ]);
    }

    public function printPdf($id)
    {
        $record = Medicine::find($id);
        $pdf = PDF::loadView('modules.she.drugs-medicine.pdf', [
            'record' => $record,
            'today' => Helpers::DateToString(Carbon::now()),
            'title' => 'CERTIFICATE OF FITNESS',
            'date' => Helpers::DateToString(Carbon::parse($record->last_date)),
          ])->setPaper('a4', 'potrait')->setOptions(
            [
              'defaultFont' => 'times-roman',
              'isHtml5ParserEnabled' => true,
              'isRemoteEnabled' => true,
              'isPhpEnabled' => true
            ]
          );
          return $pdf->stream('Certificate Of Fitness'.Carbon::now()->format('d-m-Y H:i:s').'.pdf');
    }
}
