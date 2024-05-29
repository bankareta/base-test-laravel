<?php
namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;
use App\Models\User;

class InductionQuestion extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

    protected $table        = 'ref_induction_set_question';

    protected $fillable     = [
        'materi_id',
        'desc',
        'status',
    ];

    public function materi()
    {
        return $this->belongsTo(Induction::class, 'materi_id');
    }
    
    public function files()
    {
        return $this->hasMany(InductionQuestionFile::class, 'question_id');
    }
    
    public function answer()
    {
        return $this->hasOne(InductionQuestionAnswer::class, 'question_id');
    }

    public function showCardFileOnce($param = null)
    {
        $perm = '';
        $return = '';
        if($this->files->count() > 0)
        {
            foreach($this->files as $files)
            {
                if(!$param){
                    $perm = '<div data-id="'.$files->id.'" class="ui bottom attached red mfs remove pictureexist button">
                    <i class="trash icon"></i>
                    Remove Evidence
                  </div>';
                }
                $return .= '<div class="small card">
                            <a class="image" href="'.asset('storage/'.$files->fileurl).'" target="_blank">
                                <img src="'.asset('storage/'.$files->fileurl).'" style="height:120px !important;">
                            </a>
                            <input type="hidden" class="mfs path hidden input" name="filespathexist[]" value="'.$files->fileurl.'">
                            '.$perm.'
                          </div>';
            }
        }

        return $return;
    }
}
