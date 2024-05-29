<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

// Traits
use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;

class TipeBulletin extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

	/* default */
    protected $table 		= 'ref_bulletin_type';
    protected $fillable = [
        "name",
        "description",
    ];

    /* data ke log */
    
	/* relation */
	// insert code here


	/* mutator */
	// insert code here


	/* scope */
	// insert code here


	/* custom function */
}
