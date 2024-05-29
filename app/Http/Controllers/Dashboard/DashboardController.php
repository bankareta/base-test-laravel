<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Master\Site;
use App\Models\Hira\Hira;
use App\Models\Hnmr\Reporting;
use App\Models\Inspection\InspectionVisit;
use App\Models\Accident\Report;
use App\Models\Master\ManRecord;
use App\Models\Master\DImg;
use App\Models\Equipment\Equipment;
use App\Models\ManPower\ManPower;

use Carbon\Carbon;
use Entrust;
use App\Libraries\Helpers;
use App\Models\Design\Acara;
use App\Models\Design\Prewed;
use App\Models\Monitoring\Gift;
use App\Models\Monitoring\Resv;
use App\Models\Monitoring\Visitor;
use App\Models\Monitoring\Whises;
use App\Models\Planning\SeserahanList;
use App\Models\Planning\WeddingList;
use App\Models\Undangan\Undangan;

class DashboardController extends Controller
{
    //
    protected $link = 'dashboard';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setTitle("Dashboard");
        $this->setModalSize("mini");
        $this->setBreadcrumb(['Dashboard' => '#']);
    }

    public function index()
    {
        if(auth()->user())
        {
            // if(auth()->user()->position == 1){
              return $this->render('modules.dashboard.index',  [
                  'mockup' => false,
                  'visitor' => Visitor::get()->count(),
                  'wishes' => Whises::get()->count(),
                  'resv_hadir' => Resv::where('kehadiran','Saya Akan Hadir')->get()->count(),
                  'resv_ragu' => Resv::where('kehadiran','Saya Masih Ragu')->get()->count(),
                  'resv_tidak' => Resv::where('kehadiran','Maaf, Saya Tidak Bisa Hadir')->get()->count(),
                  'digital' => Undangan::where('from','male')->get()->count(),
                  'fisik' => Undangan::where('from','female')->get()->count(),
                  'gift' => Gift::get()->count(),
                  'seserahan' => SeserahanList::where('real_budget','!=',0)->get()->count(),
                  'prewed' => Prewed::get()->count(),
                  'wedding_list' => WeddingList::orderBy('created_at','DESC')->get(),
                  'acara' => Acara::get()->first(),
                  'seserahan_list' => SeserahanList::get(),
                  'file' => DImg::get(),
              ]);
            // }else{
              // return redirect('/wp');
            // }
        }

        return redirect('/login');
    }

    public function showData($site_id)
    {
        $skip = (int)round(ManRecord::count() / 2, 0);
        $mrfirst = ManRecord::take($skip)->get();
        $mrsecond = ManRecord::offset($skip)->limit(ManRecord::count())->get();

        return $this->render('modules.dashboard.site', [
            'record' => Site::find($site_id),
            'mrfirst' => $mrfirst,
            'mrsecond' => $mrsecond,
            'hira' => Hira::whereBetween('position', [2,4])->where('site_id', $site_id)->get(),
            'inspection' => InspectionVisit::whereBetween('status', [1,4])->where('site_id', $site_id)->get(),
            'hazard' => Reporting::whereBetween('published', [1,3])->where('site_id', $site_id)->get(),
            'accident' => Report::whereIn('status', [1,2,4])->where('site_id', $site_id)->get(),
        ]);
    }

    public function showGraphicKpi($id)
    {
        $record = Site::find($id)->latestKpi();

        if($record)
        {
          $labels = [];
          $datasets = [];
          $datasets2 = [];
          $frek = [];
          $sesaran = [];
          $actual = [];
          $i = 0;
          $i1 = 0;
          $i2 = 0;

          if($record->lagging)
          {
            foreach($record->lagging as $k => $in)
            {
              $i++;
              $datasets[$k]['target'] = 'frekuensi';
              $datasets[$k]['label'] = isset($in->site_id) ? $in->desc.' ('.$in->site->name.')':$in->desc;
              $datasets[$k]['backgroundColor'] = Helpers::colorIndikator($i);
              $datasets[$k]['data'] = [$in->target,$in->realization];
            }
          }
          if($record->leading)
          {
            foreach($record->leading as $k => $in)
            {
              $i++;
              $datasets2[$k]['target'] = 'frekuensi';
              $datasets2[$k]['label'] = isset($in->site_id) ? $in->desc.' ('.$in->site->name.')':$in->desc;
              $datasets2[$k]['backgroundColor'] = Helpers::colorIndikator($i);
              $datasets2[$k]['data'] = [$in->target,$in->realization];
            }
          }

          return response([
            'status' => true,
            'labels' => ['1'],
            'datasets' => $datasets,
            'datasets2' => $datasets2,
          ]);
        }

        return response([
            'status' => false,
        ]);
    }

    public function showManPows(Request $request){
      $skip = (int)round(ManRecord::count() / 2, 0);
      $mrfirst = ManRecord::take($skip)->get();
      $mrsecond = ManRecord::offset($skip)->limit(ManRecord::count())->get();
      return $this->render('modules.dashboard.partial.man-pow',  [
          'mockup' => false,
          'mrfirst' => $mrfirst,
          'mrsecond' => $mrsecond,
          'req' => $request->month,
          'record' => Site::find($request->site_id),
      ]);
    }
}
