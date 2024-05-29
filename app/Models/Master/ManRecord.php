<?php
namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;
use App\Models\User;
use App\Libraries\Helpers;
use App\Models\ManPower\ManPower;
use App\Models\ManPower\ManPowerDetail;

use Carbon\Carbon;

class ManRecord extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

    protected $table        = 'ref_man_record';

    protected $fillable     = [
        'name',
        'hitung',
    ];

    public function detail(){
    	return $this->hasMany(ManPowerDetail::class, 'record_id');
    }

    public function record(){
        return $this->hasOne(ManPowerDetail::class, 'record_id');
    }

    public function getValue($month, $trans_id){
        $return = '-';
        if($this->detail->where('month', $month)->where('trans_id',$trans_id)->first() != null)
        {
            $return = $this->detail->where('month', $month)->where('trans_id',$trans_id)->first();
        }

        return $return;
    }

    public function siteTotal($site_id, $month=null)
    {
        $result = 0;
        $monthYear = Carbon::parse($month);
        $total = $this->detail()->whereHas('trans', function ($trans) use ($site_id,$monthYear) {
            $trans->where('year', $monthYear->format('Y'))->where('site_id', $site_id);
        });
        if($total->count() > 0 ){
            $rests = [];
            $arrs = [];
            if($total->first()->record){
                if($total->first()->record->hitung == 'avg'){
                    $result = $total->avg(Helpers::nummonth($monthYear->format('n')));
                }else{
                    $result = $total->sum(Helpers::nummonth($monthYear->format('n')));
                }

            }
        }
        return round($result);
    }
}
