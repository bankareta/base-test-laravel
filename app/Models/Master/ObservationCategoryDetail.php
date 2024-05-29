<?php
namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;
use App\Models\FreshEye\FreshEyeDetail;
use App\Models\She\ObservationCard;
use App\Models\User;
use Carbon;

class ObservationCategoryDetail extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

    protected $table        = 'ref_observation_category_detail';

    protected $fillable     = [
        'observation_category_id',
        'desc',
        'abbreviation'
    ];

    public function freshEyeDetail(){
    	return $this->hasMany(FreshEyeDetail::class, 'observation_category_detail_id');
    }

    public function obsrvCard()
    {
      	return $this->belongsToMany(ObservationCard::class, 'trans_observation_card_cat', 'category_id', 'observation_card_id');
    }
    public function obsrvCardRisk()
    {
      	return $this->belongsToMany(ObservationCard::class, 'trans_observation_card_cat', 'category_id', 'observation_card_id');
    }
    public function obsrvCardSafe()
    {
      	return $this->belongsToMany(ObservationCard::class, 'trans_observation_card_cat', 'category_id', 'observation_card_id');
    }
}
