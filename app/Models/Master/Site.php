<?php
namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;
use App\Models\Authentication\User;
use App\Models\Master\Bulletin;
use App\Models\Master\Policy;
use App\Models\Master\Training\TrainingOffline;
use App\Models\Kpi\Report as Kpi;
use App\Models\Monitoring\PobReporting;
use Carbon\Carbon;

class Site extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

    protected $table        = 'ref_site';

    protected $fillable     = [
        'code',
        'name',
        'description',
    ];

    protected $appends = [
      'training_total_participants',
      'training_total'
    ];

    public function getTrainingTotalParticipantsAttribute()
    {
        return $this->offlineTraining->sum('participant');
    }

    public function getTrainingTotalAttribute()
    {
        return $this->offlineTraining->count();
    }

    public function offlineTraining()
    {
        return $this->hasMany(TrainingOffline::class, 'site_id');
    }

    public function site()
    {
        return $this->hasMany(User::class, 'site_id');
    }

    public function bulletin()
    {
        return $this->hasMany(Bulletin::class, 'site_id');
    }

    public function pob()
    {
        return $this->hasMany(PobReporting::class, 'site_id');
    }

    public function pobOnSite()
    {
        return $this->hasMany(PobReporting::class, 'site_id')->whereNull('date_exit');
    }

    public function pobOffSite()
    {
        return $this->hasMany(PobReporting::class, 'site_id')->whereNotNull('date_exit');
    }

    public function personel()
    {
        return $this->hasMany(User::class, 'site_id');
    }

    public function policy()
    {
        return $this->hasMany(Policy::class, 'site_id');
    }

    public function kpi()
    {
        return $this->hasMany(Kpi::class, 'site_id');
    }

    public function latestBulletin()
    {
        return $this->bulletin->where('status', 1)->sortByDesc('created_at')->take(2);
    }

    public function latestPolicy()
    {
        return $this->policy->where('status', 1)->sortByDesc('created_at')->take(2);
    }

    public function latestKpi()
    {
        return $this->kpi->where('year', Carbon::now()->format('Y'))->last();
    }

     public function siteUser()
    {
        return $this->belongsToMany(User::class, 'sys_users_site', 'user_id', 'site_id');
    }
}
