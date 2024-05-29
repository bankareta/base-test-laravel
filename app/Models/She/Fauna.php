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
use App\Models\Master\Blood;
use App\Models\Master\Result;
use App\Models\Master\Contractor;
use App\Models\Master\Location;
use App\Models\Master\Site;


class Fauna extends Model
{
    
    // call traits
    use RaidModel;
    use Utilities;

    protected $table 		= 'trans_fauna';
    protected $fillable 	= [
        'site_id',
        'name',
        'no_telp',
        'date_taken',
        'time_taken',
        'location',
        'flora',
        'status',
        'created_by',
        'contractor',
        'location_details',
    ];


    public function setDateTakenAttribute($value)
    {
        $this->attributes['date_taken'] = Helpers::DateToSql($value);
    }
    
    public function photo(){
        return $this->hasMany(Files::class, 'target_id')->where('target_type','she-fauna')->where('type','foto');
    }
    public function video(){
        return $this->hasOne(Files::class, 'target_id')->where('target_type','she-fauna')->where('type','video');
    }

    public function site(){
        return $this->belongsTo(Site::class, 'site_id');
    }
    
    public function showCardFile($param = null)
    {
        $perm = '';
        $return = '';
        $file = $this->photo();
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
        }

        return $return;
    }
}
