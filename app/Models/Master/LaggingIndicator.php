<?php
namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;
use App\Models\Authentication\User;

class LaggingIndicator extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

    protected $table        = 'ref_lagging_indicator';

    protected $fillable     = [
        'name',
        'description',
    ];
    
}
