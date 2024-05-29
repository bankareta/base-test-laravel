<?php
namespace App\Models\Master;

use App\Models\She\ObservationCard;
use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;
use App\Models\User;

class KategoriObsCard extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

    protected $table        = 'ref_cat_she_obs_card';

    protected $fillable     = [
        'name',
        'category',
    ];

    public function ppe(){
        return $this->hasOne(ObservationCard::class, 'apd_id');
    }
    public function position(){
        return $this->hasOne(ObservationCard::class, 'position_id');
    }
    public function procedure(){
        return $this->hasOne(ObservationCard::class, 'procedure_id');
    }
    public function tools(){
        return $this->hasOne(ObservationCard::class, 'tools_id');
    }
    public function env(){
        return $this->hasOne(ObservationCard::class, 'env_id');
    }
    public function others(){
        return $this->hasOne(ObservationCard::class, 'others_id');
    }
}	
