<?php
namespace App\Models\Master\Training;

use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;
use App\Libraries\Helpers;
use App\Models\Master\Site;
use App\Models\Authentication\User;

class TrainingOfflineParticipant extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

    protected $table        = 'trans_offline_training_participant';
    
    protected $fillable     = [
        'record_id',
        'user_id',
        'name',
        'status',
    ];


    public function training()
    {
        return $this->belongsTo(TrainingOffline::class, 'record_id');
    }
    
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
