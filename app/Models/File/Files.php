<?php
namespace App\Models\File;

use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;
use App\Models\User;

class Files extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

    protected $table 		= 'sys_file';
    // protected $dates 	= ['taken_at'];

    protected $fillable 	= [
        'filename',
        'url',
        'target_type',
        'target_id',
        'type',
    ];

    public function target()
    {
        return $this->morphTo();
    }
}
