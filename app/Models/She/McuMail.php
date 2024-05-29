<?php

namespace App\Models\She;

use Illuminate\Database\Eloquent\Model;

// Traits
use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;
use Helpers;

use App\Models\Authentication\User;
use App\Models\File\Files;
use App\Models\Master\Project;
use App\Models\Master\Contractor;
use App\Models\Master\Blood;
use App\Models\Master\Result;
use App\Models\Master\TypeMcu;
use App\Models\Master\Location;
use App\Models\Master\Site;


class McuMail extends Model
{
    
    // call traits
    use RaidModel;
    use Utilities;

    protected $table 		= 'trans_mcu_mail';
    protected $fillable 	= [
        'mcu_id',
        'employee',
        'mail',
        'user_id',
        'flag',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
