<?php
namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;
use App\Models\User;

class InductionQuestionAnswer extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

    protected $table        = 'ref_induction_set_question_answer';

    protected $fillable     = [
        'question_id',
        'answer_1',
        'answer_2',
        'answer_3',
        'answer_4',
        'result',
    ];
    public function files()
    {
        return $this->hasOne(InductionQuestionFile::class, 'question_id');
    }
}
