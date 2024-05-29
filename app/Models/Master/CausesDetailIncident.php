<?php
namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;
use App\Models\User;

class CausesDetailIncident extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

    protected $table        = 'ref_causes_incident_detail';

    protected $fillable     = [
        'causes_incident_id',
        'detail',
    ];

    public function causes()
    {
       return $this->belongsTo(CausesIncident::class, 'causes_incident_id');
    }
}
