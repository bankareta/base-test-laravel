<?php
namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;
use App\Models\User;
use App\Models\Master\Site;

class Location extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

    protected $table        = 'ref_location';

    protected $fillable     = [
        'site_id',
        'name',
    ];

    public function site(){
        return $this->belongsTo(Site::class, 'site_id');
    }
}	
