<?php
namespace App\Models\Master;

use App\Models\Inspection\PreTrip;
use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;
use App\Models\User;

class PreTripCriteria extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

    protected $table        = 'ref_trip_criteria';

    protected $fillable     = [
        'name',
        'desc',
    ];

    public function preTripData()
    {
      	return $this->belongsToMany(PreTrip::class, 'trans_trip_criteria', 'criteria_id', 'trip_id');
    }
}	
