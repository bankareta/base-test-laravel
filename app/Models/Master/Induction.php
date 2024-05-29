<?php
namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;
use App\Models\User;

class Induction extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

    protected $table        = 'ref_induction_materi';

    protected $fillable     = [
        'type_id',
        'name',
        'status',
        'type_materi',
        'fileurl',
        'filename',
        'type_file',
        'link_yt',
        'without_quiz',
        'parent_id'
    ];

    public function type()
    {
        return $this->belongsTo(TypeInduction::class, 'type_id');
    }

    public function question()
    {
        return $this->hasMany(InductionQuestion::class, 'materi_id');
    }
    
    public function child()
    {
        return $this->hasMany(Self::class, 'parent_id');
    }

    public function plan()
    {
        return $this->hasMany(InductionPlan::class, 'materi_id');
    }

    public function typeMaterialFile()
    {
        if(isset($this->filename) AND isset($this->link_yt)){
            $show = 'File & URL Youtube';
        }else{
            if(isset($this->filename)){
                $show = 'File Attachment';
            }else{
                $show = 'URL Youtube';
            }
        }
        return $show;
    }

}
