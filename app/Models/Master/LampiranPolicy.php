<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

// Traits
use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;

class LampiranPolicy extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

	/* default */
    protected $table 		= 'trans_policy_lampiran';
    protected $fillable = [
        'policy_id',
        'filename',
        'url',
        // 'print_page'
    ];

    /* data ke log */
    // protected $log_table    = 'log_trans_bulletin';
    // protected $log_table_fk = 'ref_id';

	/* relation */
	// insert code here


	/* mutator */
	// insert code here


	/* scope */
	// insert code here


	/* custom function */
}
