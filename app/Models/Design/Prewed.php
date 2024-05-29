<?php

namespace App\Models\Design;

use Illuminate\Database\Eloquent\Model;

// Traits
use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;
use Helpers;

use App\Models\Authentication\User;


class Prewed extends Model
{
    
    // call traits
    use RaidModel;
    use Utilities;

    protected $table 		= 'trans_prewed';
    protected $fillable 	= [
        'type',
        'filename',
        'url',
    ];
}
