<?php
namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;
use App\Models\User;

class AuditPermitType extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

    protected $table        = 'ref_permit_type';

    protected $fillable     = [
        'name',
    ];
}	
