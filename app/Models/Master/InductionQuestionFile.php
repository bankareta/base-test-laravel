<?php
namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;
use App\Models\User;

class InductionQuestionFile extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

    protected $table        = 'ref_induction_set_question_file';

    protected $fillable     = [
        'question_id',
        'fileurl',
        'filename',
    ];

}
