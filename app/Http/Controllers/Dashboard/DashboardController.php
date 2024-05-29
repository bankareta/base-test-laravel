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
      return $this->render('modules.dashboard.index',  [
          'mockup' => false,
      ]);
    }
    return redirect('/login');
  }

  public function welcome()
  {
    $user = false;
    if(auth()->user())
    {
      $user = true;
    }
    return $this->render('modules.dashboard.welcome',  [
      'mockup' => false,
      'login' => $user
    ]);
  }
}
