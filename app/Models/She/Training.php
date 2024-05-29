<?php

namespace App\Models\She;

use Illuminate\Database\Eloquent\Model;

// Traits
use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;
use Helpers;

use App\Models\Authentication\User;
use App\Models\File\Files;
use App\Models\Master\Project;
use App\Models\Master\Contractor;
use App\Models\Master\Blood;
use App\Models\Master\InstitutionTraining;
use App\Models\Master\Result;
use App\Models\Master\TypeTraining;
use App\Models\Master\Location;
use App\Models\Master\Site;


class Training extends Model
{
    
    // call traits
    use RaidModel;
    use Utilities;

    protected $table 		= 'trans_training_employee';
    protected $fillable 	= [
        'site_id',
        'type_id',
        'number',
        'training_date',
        'expire_date',
        'issued_by',
        'status',
        'title',
        'department',
        'employee_name',
    ];


    public function setExpireDateAttribute($value)
    {
        $this->attributes['expire_date'] = Helpers::DateToSql($value);
    }
    public function setTrainingDateAttribute($value)
    {
        $this->attributes['training_date'] = Helpers::DateToSql($value);
    }
    
    public function files(){
        return $this->hasMany(Files::class, 'target_id')->where('target_type','she-employee-training')->where('type','primary');
    }

    public function site(){
        return $this->belongsTo(Site::class, 'site_id');
    }
    
    public function type(){
        return $this->belongsTo(TypeTraining::class, 'type_id');
    }
    public function employee(){
        return $this->belongsTo(InstitutionTraining::class, 'issued_by');
    }
    public function showCardFile($param = null)
    {
        $perm = '';
        $return = '';
        $file = $this->files();
        if($file->count() > 0)
        {
            foreach($file->get() as $files)
            {
                if(!$param){
                    $perm = '<div data-id="'.$files->id.'" class="ui bottom attached red mfs remove pictureexist button">
                    <i class="trash icon"></i>
                    Remove File
                  </div>';
                }
                $return .= '<div class="small card">
                    <a class="image" href="'.asset('storage/'.$files->url).'" target="_blank">
                        <img src="'.Helpers::showImgExtension($files->url,'viewer').'" style="height:120px !important;">
                    </a>
                    <input type="hidden" class="mfs path hidden input" name="filespathexist[]" value="'.$files->url.'">
                    '.$perm.'
                  </div><input type="hidden" class="mfs path hidden input" name="filesexist[]" value="'.$files->url.'">';
            }
        }else{
            if($param){
                $return .= '<div class="small card">
                        <img src="'.url('img/no-images.png').'" style="height:120px !important;">
                  </div>';
            }
        }

        return $return;
    }
}
