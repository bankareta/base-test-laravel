<?php

namespace App\Models\Design;

use Illuminate\Database\Eloquent\Model;

// Traits
use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;
use Helpers;

use App\Models\Authentication\User;


class Segment extends Model
{
    
    // call traits
    use RaidModel;
    use Utilities;

    protected $table 		= 'trans_segment';
    protected $fillable 	= [
        'welcome_img_url',
        'header_img_url',
        'cpp_img_url',
        'cpw_img_url',
        'teaser_vid_url',
        'footer_img_url',
        'backsound_url',
    ];
}
