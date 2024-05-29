<?php
namespace App\Models\Master\Training;

use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;
use App\Models\User;
use App\Libraries\Helpers;
use App\Models\Master\Site;

class TrainingOfflineFile extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

    protected $table        = 'trans_offline_training_file';

    protected $fillable     = [
        'offline_id',
        'filespath',
        'filename',
    ];

}
