<?php
namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;
use App\Models\Authentication\User;

class LeadingIndicator extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

    protected $table        = 'ref_leading_indicator';

    protected $fillable     = [
        'name',
        'description',
    ];
    
}
