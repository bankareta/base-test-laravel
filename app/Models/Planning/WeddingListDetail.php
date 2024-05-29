<?php

namespace App\Models\Planning;

use Illuminate\Database\Eloquent\Model;

// Traits
use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;
use Helpers;

use App\Models\Authentication\User;


class WeddingListDetail extends Model
{
    
    // call traits
    use RaidModel;
    use Utilities;

    protected $table 		= 'trans_wedding_list_detail';
    protected $fillable 	= [
        'wedding_list_id',
        'name',
        'qty',
        'vendor',
        'plan_budget',
        'real_budget',
        'dp',
        'debt',
        'status',
    ];
}
