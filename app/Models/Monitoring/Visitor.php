<?php

namespace App\Models\Monitoring;

use Illuminate\Database\Eloquent\Model;

// Traits
use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;
use Helpers;

use App\Models\Authentication\User;


class Visitor extends Model
{
    
    // call traits
    use RaidModel;
    use Utilities;

    protected $table 		= 'trans_visitor';
    protected $fillable 	= [
        'visitor',
        'ip_address',
        'created_by',
    ];
}
