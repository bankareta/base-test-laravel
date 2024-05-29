<?php

namespace App\Models\Master\Training;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

// Traits
use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;

use App\Models\Authentication\User;
use App\Models\Master\Site;
use App\Models\Master\TypeTraining;
use File;
use Carbon\Carbon;


use Mail;
use App\Models\Notification\Notification;
use App\Models\Jobs\JobsDeadline;
use App\Mail\TrainingMail;

class Course extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

	/* default */
    protected $table 		= 'ref_course';
    protected $fillable = [
        'title',
        'contents',
        'fileurl',
        'filename',
        'type_training_id',
        'status',
        'site_id'
    ];

    protected $appends = [
        'total_participant'
    ];

    /* data ke log */

    public function getTotalParticipantAttribute()
    {
        return $this->users->count();
    }

	/* relation */
	// insert code here

    public function quiz()
    {
      return $this->hasMany(Quiz::class, 'course_id');
    }

    public function users()
    {
      return $this->belongsToMany(User::class, 'ref_course_users', 'course_id', 'user_id');
    }

    public function company()
    {
      return $this->belongsTo(Site::class, 'site_id');
    }

    public function type()
    {
      return $this->belongsTo(TypeTraining::class, 'type_training_id');
    }

	/* mutator */
	// insert code here



	/* scope */
	// insert code here


	/* custom function */

    public function scopeByUserTraining($query)
    {
        return $query->whereHas('users', function ($user) {
            $user->where('user_id', auth()->user()->id);
        })->whereHas('quiz', function ($quiz) {
            $quiz->where('published', 1);
        });
    }

    public function getSeloptuser()
    {
        $return = [];
        if($this->users->count() > 0)
        {
            foreach($this->users->pluck('id') as $user)
            {
                $return[] = (string)$user;
            }
        }

        return json_encode($return);
    }

    public function refile($request)
    {
        if($request->fileurl && $request->filename)
        {
            if(file_exists(storage_path().'/app/public/'.$this->fileurl))
            {
                unlink(storage_path().'/app/public/'.$this->fileurl);
            }
        }
    }

    public function removefile()
    {
        if($this->fileurl && $this->filename)
        {
            if(file_exists(storage_path().'/app/public/'.$this->fileurl))
            {
                unlink(storage_path().'/app/public/'.$this->fileurl);
            }
        }
    }

    public function getEmbedFile($centered = 'centered')
    {
        if($this->fileurl != NULL)
        {
            $ext = File::extension(storage_path().'/app/public/'.$this->fileurl);
            if(file_exists(storage_path().'/app/public/'.$this->fileurl))
            {
                switch($ext)
                {
                    case 'xlsx':
                    return '<div class="ui dimmable '.$centered.' special cards">
                                <div class="small card">
                                    <div class="blurring dimmable image">
                                        <div class="ui dimmer">
                                            <div class="content">
                                                <div class="center">
                                                    <a href="'.url('download-file/'.base64_encode($this->fileurl)).'" target="_blank" class="ui inverted massive blue icon button"><i class="download icon"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <img src="'.asset('img/xlsx.png').'">
                                    </div>
                                </div>
                            </div>';
                    break;
                    case 'xls':
                    return '<div class="ui dimmable '.$centered.' special cards">
                                <div class="small card">
                                    <div class="blurring dimmable image">
                                        <div class="ui dimmer">
                                            <div class="content">
                                                <div class="center">
                                                    <a href="'.url('download-file/'.base64_encode($this->fileurl)).'" target="_blank" class="ui inverted massive blue icon button"><i class="download icon"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <img src="'.asset('img/xls.png').'">
                                    </div>
                                </div>
                            </div>';
                    break;
                    case 'pdf':
                    return '<embed src="'.asset('storage/'.$this->fileurl).'" width="500" height="375" type="application/pdf">';
                    break;
                    case 'mp4':
                    return ' <video width="320" height="240" controls>
                                <source src="'.asset('storage/'.$this->fileurl).'" type="video/mp4">
                            Your browser does not support the video tag.
                            </video> ';
                    break;
                    case 'png':
                    return '<div class="ui '.$centered.' card">
                                <a class="image" href="'.asset('storage/'.$this->fileurl).'" target="_blank">
                                    <img src="'.asset('storage/'.$this->fileurl).'">
                                </a>
                              </div>';
                    break;
                    case 'jpg':
                    return '<div class="ui '.$centered.' card">
                                <a class="image" href="'.asset('storage/'.$this->fileurl).'" target="_blank">
                                    <img src="'.asset('storage/'.$this->fileurl).'">
                                </a>
                              </div>';
                    break;
                    default:
                    return '<div class="ui dimmable '.$centered.' special cards">
                                <div class="small card">
                                    <div class="blurring dimmable image">
                                        <div class="ui dimmer">
                                            <div class="content">
                                                <div class="center">
                                                    <a href="'.url('download-file/'.base64_encode($this->fileurl)).'" target="_blank" class="ui inverted massive blue icon button"><i class="download icon"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <img src="'.asset('img/xls.png').'">
                                    </div>
                                </div>
                            </div>';
                    break;
                }
            }
        }
    }

     public function sendMailNotif(){
        $urls = URL::to('training/'.$this->id);
        $title = 'You Have Training Course Now';
        if ($this->users->count() > 0) {
            foreach ($this->users->where('status','1') as $value) {
                $emailUsers = isset($value->email) ? $value->email : '' ;
                $email = $emailUsers;
                if(strpos($email,'@supreme-energy.local') == true){
                    $email = str_replace('.local','.com',$emailUsers);
                }
                Mail::to($email)->queue(new TrainingMail($this,$title,$urls,'Training course available for you'));
                $n['modul'] = 'Training';
                $n['url'] = URL::to('training/'.$this->id);
                $n['fullurl'] = URL::to('training/');
                $n['user_id'] = $value->id;
                $n['form_type'] = 'training';
                $n['form_id'] = $this->id;
                $n['content'] = $title;
                $notification = new Notification;
                $notification->fill($n);
                $notification->save();
            }

        }
    }
}
