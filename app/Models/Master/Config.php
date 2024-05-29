<?php
namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;

class Config extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

    protected $table        = 'sys_config';

    protected $fillable     = [
        'parent',
        'status',
    ];
}	
