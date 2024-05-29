<?php

namespace App\Models\She;

use App\Mail\PobSendMail;
use Illuminate\Database\Eloquent\Model;

// Traits
use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;
use Helpers;

use App\Models\Authentication\User;
use App\Models\File\Files;
use App\Models\Master\Project;
use App\Models\Master\Contractor;
use App\Models\Master\Departemen;
use App\Models\Master\EnergySources;
use App\Models\Master\KategoriObsCard;
use App\Models\Master\Location;
use App\Models\Master\Site;
use App\Models\Master\ObservationCategoryDetail;
use App\Models\Notification\Notification;
use Mail;

class ObservationCard extends Model
{
    
    // call traits
    use RaidModel;
    use Utilities;

    protected $table 		= 'trans_observation_card';
    protected $fillable 	= [
        'site_id',
        'company',
        'location',
        'location_detail',
        'date',
        'observer_name',
        'finding',
        'type',
        'action',
        'note',
        'corrective',
        'follow_up',
        'sources',
        'comments',
        'obs_department_id',
        'department_id',
        'status'
    ];


    public function setDateAttribute($value)
    {
        $this->attributes['date'] = Helpers::DateToSql($value);
    }
    
    public function site(){
        return $this->belongsTo(Site::class, 'site_id');
    }
    public function locations(){
        return $this->belongsTo(Location::class, 'location');
    }
    public function energySources(){
        return $this->belongsTo(EnergySources::class, 'sources');
    }
    public function department(){
        return $this->belongsTo(Departemen::class, 'obs_department_id');
    }
    public function pic(){
        return $this->belongsTo(Departemen::class, 'department_id');
    }
    public function category()
    {
        return $this->belongsToMany(ObservationCategoryDetail::class, 'trans_observation_card_cat', 'observation_card_id', 'category_id')->withPivot('nilai');
    }
    public function primaryFiles(){
        return $this->hasOne(Files::class, 'target_id')->where('target_type','she-observation-card')->where('type','primary');
    }

    public function secFiles(){
        return $this->hasOne(Files::class, 'target_id')->where('target_type','she-observation-card')->where('type','secondary');
    }

    public function typelabel(){
        switch($this->type)
        {
            case 4:
                return '<a class="ui yellow tag label">Open</a>';
            break;
            case 3:
                return '<a class="ui red tag label">Reject</a>';
            break;
            case 2:
                return '<a class="ui black tag label">Approved</a>';
            break;
            case 1:
                return '<a class="ui blue tag label">Reviewed</a>';
            break;
            case 0:
                return '<a class="ui yellow tag label">Open</a>';
            break;
        }
    }

    public function typeText(){
        switch($this->type)
        {
            case 4:
                return 'Open';
            break;
            case 3:
                return 'Reject';
            break;
            case 2:
                return 'Approved';
            break;
            case 1:
                return 'Reviewed';
            break;
            case 0:
                return 'Open';
            break;
        }
    }
    public function findingStr(){
        return $this->finding == 1 ? 'Unsafe Action':($this->finding == 2 ? 'Unsafe Condition':'Positive Observation');
    }

    public function statusLabel()
    {
        if($this->type == 1){
            switch($this->status)
            {
                case 2:
                    return '<a class="ui blue tag label">Closed</a>';
                break;
                case 1:
                    return '<a class="ui red tag label">Open</a>';
                break;
                case 3:
                    return '<a class="ui green tag label">Positive Finding</a>';
                break;
            }
        }
        return '<a class="ui blue tag label">Closed</a>';
    }

    public function statusText()
    {
        if($this->type == 1){
            switch($this->status)
            {
                case 2:
                    return 'Closed';
                break;
                case 1:
                    return 'Open';
                break;
                case 3:
                    return 'Positive Finding';
                break;
            }
        }
        return 'Closed';
    }

    public function sentEmailReviewing()
    {
        $urls = url('she/observation-card/'.$this->id);
        $title = 'SHE Observation Card Result';
        $email = $this->pic->person->email;
        
        if(strpos($email,'@supreme-energy.local') == true){
            $email = str_replace('.local','.com',$this->pic->person->email);
        }
        try {
            Mail::to($email)->queue(new PobSendMail($this,$title,url('she/observation-card/'.$this->id), 'There is new SHE Observation Card for you to review result '));
        }finally{

        }

        $n['modul'] = 'SHE Observation Card Result';
        $n['url'] = url('she/observation-card/'.$this->id);
        $n['fullurl'] = url('she/observation-card/');

        $n['user_id'] = $this->pic->person->id;
        $n['form_type'] = 'pob';
        $n['form_id'] = $this->id;
        $n['content'] = $title;

        $notification = new Notification;
        $notification->fill($n);
        $notification->save();
    }
    
    public function sentEmailAction()
    {
        $urls = url('she/observation-card/'.$this->id);
        $title = 'Reviewed SHE Observation Card';
        $user = User::find($this->created_by);
        $email = $user->email;
        
        if(strpos($email,'@supreme-energy.local') == true){
            $email = str_replace('.local','.com',$user->email);
        }
        try {
            Mail::to($email)->queue(new PobSendMail($this,$title,url('she/observation-card/'.$this->id), 'There is SHE Observation Card for you has been review'));
        }finally{

        }

        $n['modul'] = 'Reviewed SHE Observation Card';
        $n['url'] = url('she/observation-card/'.$this->id);
        $n['fullurl'] = url('she/observation-card/');

        $n['user_id'] = $user->id;
        $n['form_type'] = 'pob';
        $n['form_id'] = $this->id;
        $n['content'] = $title;

        $notification = new Notification;
        $notification->fill($n);
        $notification->save();
    }
}
