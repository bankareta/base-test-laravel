<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

// Traits
use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;

class LampiranBulletin extends Model
{
    
    // call traits
    use RaidModel;
    use Utilities;
    
	/* default */
    protected $table 		= 'trans_bulletin_lampiran';
    protected $fillable = [
    	'bulletin_id',
        'filename',
        'url',
        // 'print_page'
    ];

    /* data ke log */
    // protected $log_table    = 'log_trans_bulletin';
    // protected $log_table_fk = 'ref_id';

	/* relation */
	// insert code here 
    public function bulletin(){
        return $this->belongsTo(Bulletin::class, 'bulletin_id');
    }
  
	/* mutator */
	// insert code here
  
  
	/* scope */
	// insert code here


	/* custom function */
}
