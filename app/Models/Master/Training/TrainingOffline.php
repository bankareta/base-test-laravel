<?php
namespace App\Models\Master\Training;

use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;
use App\Libraries\Helpers;
use App\Models\Master\Site;
use App\Models\Master\TypeTraining;
use App\Models\Authentication\User;

class TrainingOffline extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

    protected $table        = 'trans_offline_training';

    protected $fillable     = [
        'name',
        'dept',
        'site_id',
        'type_id',
        'date',
        'location',
        'participant',
        'end_date',
        'remarks',
    ];
    protected $dates 	= ['date', 'end_date'];

    public function setDateAttribute($value = '')
    {
      $this->attributes["date"] = Helpers::DateToSql($value);
    }

    public function setEndDateAttribute($value = '')
    {
      $this->attributes["end_date"] = Helpers::DateToSql($value);
    }

    public function site(){
        return $this->belongsTo(Site::class, 'site_id');
    }
    
    public function type(){
        return $this->belongsTo(TypeTraining::class, 'type_id');
    }
    
    public function files(){
        return $this->hasMany(TrainingOfflineFile::class, 'offline_id');
    }
    
    public function attendance(){
        return $this->hasMany(TrainingOfflineParticipant::class, 'record_id');
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
                    Remove File
                  </div>';
                }else{
                    $perm = '
                    '.$files->filename.'
                  ';
                }
                
                $return .= '<div class="small card">
                            <a class="image" href="'.asset('storage/'.$files->filespath).'" target="_blank" download="'.$files->filename.'">
                                <img src="'.Helpers::showImgExtension($files->filespath,'audit').'" style="height:120px !important;">
                            </a>
                            <input type="hidden" class="mfs path hidden input" name="filespathexist[]" value="'.$files->filespath.'">
                            '.$perm.'
                          </div>';
            }
        }

        return $return;
    }

}
