<?php

namespace App\Models\Monitoring;

use Illuminate\Database\Eloquent\Model;

// Traits
use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;
use Helpers;

use App\Models\Authentication\User;


class Whises extends Model
{
    
    // call traits
    use RaidModel;
    use Utilities;

    protected $table 		= 'trans_whises';
    protected $fillable 	= [
        'ip_address',
        'name',
        'ucapan',
    ];
}
