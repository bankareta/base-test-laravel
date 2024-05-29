<?php

namespace App\Models\Master\Training;

use Illuminate\Database\Eloquent\Model;

// Traits
use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;

use App\Models\Authentication\User;
use File;
use Helpers;

class Answer extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

	/* default */
    protected $table 		= 'ref_answer';
    protected $fillable = [
        'question_id',
        'answer',
        'number',
        'true'
    ];
	/* relation */
	// insert code here

    public function question()
    {
      return $this->belongsTo(Question::class, 'question_id');
    }

	/* mutator */
	// insert code here



	/* scope */
	// insert code here


	/* custom function */


}
