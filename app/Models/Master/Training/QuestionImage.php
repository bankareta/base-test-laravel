<?php

namespace App\Models\Master\Training;

use Illuminate\Database\Eloquent\Model;

// Traits
use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;

use App\Models\Authentication\User;
use File;
use Helpers;

class QuestionImage extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

	/* default */
    protected $table 		= 'ref_question_image';
    protected $fillable = [
        'question_id',
        'filepath'
    ];
    public $timestamps = false;
	/* relation */
	// insert code here

    public function question()
    {
      return $this->hasMany(Question::class, 'question_id');
    }

	/* mutator */
	// insert code here



	/* scope */
	// insert code here


	/* custom function */


}
