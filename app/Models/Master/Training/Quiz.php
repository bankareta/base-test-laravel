<?php

namespace App\Models\Master\Training;

use Illuminate\Database\Eloquent\Model;

// Traits
use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;

use App\Models\Authentication\User;
use App\Models\Training\QuizAnswer;
use App\Models\Master\TypeTraining;
use App\Models\Master\Site;

use File;
use Helpers;

class Quiz extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

	/* default */
    protected $table 		= 'ref_quiz';
    protected $fillable = [
        'type_training_id',
        'site_id',
        'title',
        'typefile',
        'youtube_url',
        'website_url',
        'fileurl',
        'filename',
        'contents',
        'time_limit',
        'time_limit_minutes',
        'min_score',
        'min_score_percentage',
        'retake',
        'retake_days',
        'effective_date',
        'expired',
        'expired_date',
        'repeat',
        'repeat_months',
        'sent_email',
        'mandatory',
        'published'
    ];

    protected $appends = [
        'done',
        'statusdone',
        'booldone',
        'lastanswerid',
        'mandat'
    ];

    protected $dates = ['expired_date', 'effective_date'];
	/* relation */
	// insert code here

    public function course()
    {
      return $this->belongsTo(Course::class, 'course_id');
    }

    public function company()
    {
      return $this->belongsTo(Site::class, 'site_id');
    }

    public function question()
    {
      return $this->hasMany(Question::class, 'quiz_id');
    }

    public function files()
    {
      return $this->hasMany(QuizFiles::class, 'quiz_id');
    }

    public function users()
    {
      return $this->belongsToMany(User::class, 'ref_quiz_users', 'quiz_id', 'user_id');
    }

    public function quizAnswer()
    {
      return $this->hasMany(QuizAnswer::class, 'quiz_id');
    }

    public function type()
    {
      return $this->belongsTo(TypeTraining::class, 'type_training_id');
    }

	/* mutator */
	// insert code here

    public function getMandatAttribute()
    {
        switch($this->mandatory)
        {
            case 1 : return 'Required';
            break;
            case 0 : return 'N/A';
            break;
        }
    }

    public function getDoneAttribute()
    {
        if($this->quizAnswer->count() > 0)
        {
            $check = $this->quizAnswer()->orderBy('created_at', 'DESC')->first();
            if($check->getPassed())
            {
                return '<br><a class="ui black tag label">Passed</a>';
            }
            return '<br><a class="ui green tag label">Not Passed</a>';
        }

        return '<br><a class="ui red tag label">Never taken</a>';
    }

    public function answerdone()
    {
        if($this->quizAnswer->count() > 0)
        {
            $check = $this->quizAnswer()->orderBy('created_at', 'DESC')->first();
            if($check)
            {
                return $check;
            }
            return NULL;
        }

        return NULL;
    }

    public function getStatusdoneAttribute()
    {
        if($this->quizAnswer->count() > 0)
        {
            $check = $this->quizAnswer()->orderBy('created_at', 'DESC')->first();
            if($check)
            {
                return $check->done;
            }
            return 0;
        }

        return 0;
    }

    public function getLastansweridAttribute()
    {
        if($this->quizAnswer->count() > 0)
        {
            $check = $this->quizAnswer()->orderBy('created_at', 'DESC')->first();
            if($check)
            {
                return $check->id;
            }
        }
    }

    public function getBoolDoneAttribute()
    {
        if($this->quizAnswer->count() > 0)
        {
            $check = $this->quizAnswer()->orderBy('created_at', 'DESC')->first();
            if($check)
            {
                return 1;
            }
            return 0;
        }

        return 0;
    }

    public function getPassed()
    {
        if($this->quizAnswer->count() > 0)
        {
            $check = $this->quizAnswer()->orderBy('created_at', 'DESC')->first();
            if($check->getPassed())
            {
                return true;
            }
            return false;
        }

        return false;
    }

    public function retakeDate()
    {
        if($this->retake != 0)
        {
            if($this->retake == 2)
            {
                $check = $this->quizAnswer()->orderBy('created_at', 'DESC')->first();

                if($check)
                {
                  return $check->created_at->addDays($this->retake_days)->startOfDay();
                }
            }
        }
    }

    public function retakeDay()
    {
        if($this->retake != 0)
        {
            if($this->retake == 2)
            {
                $check = $this->quizAnswer()->orderBy('created_at', 'DESC')->first();

                if($check)
                {
                    $day = $check->created_at->addDays($this->retake_days)->startOfDay();
                    if($day->isPast())
                    {
                        return true;
                    }

                    return false;
                }
            }
            return true;
        }

        return false;
    }

    public function expired()
    {
       if($this->expired == 1)
       {
          if($this->expired_date->isPast())
          {
             return false;
          }
          return true;
       }
       return true;
    }

    public function repeated()
    {
      if($this->expired == 1)
      {
        if($this->repeat == 1)
        {
          if($this->repeat_months != NULL)
          {
            if($this->$this->expired_date->addMonths($this->repeat_months)->isPast())
            {
              return true;
            }
          }
          return true;
        }
        return false;
      }

      return true;
    }

    public function minScore()
    {
       if($this->min_score == 1)
       {
         return $this->min_score_percentage.'%';
       }

       return '-';
    }

    public function repeatDate()
    {
       if($this->expired == 1)
       {
         if($this->repeat_months != NULL)
         {
           return $this->expired_date->addMonths($this->repeat_months);
         }
         return '-';
       }

       return '-';
    }

    public function notExpired()
    {
        if($this->expired == 1)
        {
            if(!$this->expired_date->isPast())
            {
                if($this->booldone == 1)
                {
                    return false;
                }else{
                    return true;
                }
            }else{
                if($this->repeat == 1)
                {
                    if($this->effective_date != NULL)
                    {
                        $next = $this->effective_date->addYears(1);

                        if($next->isPast())
                        {
                            if($this->expired == 1)
                            {
                                $expired = $this->expired_date->addYears(1);

                                if(!$expired->isPast())
                                {
                                    return true;
                                }
                                return false;
                            }
                            return true;
                        }
                    }
                }
            }
        }
    }

    public function setEffectiveDateAttribute($value = '')
    {
      $this->attributes["effective_date"] = Helpers::DateToSql($value);
    }

    public function setExpiredDateAttribute($value = '')
    {
      $this->attributes["expired_date"] = Helpers::DateToSql($value);
    }


	/* scope */
	// insert code here

    public function scopeByUserTraining($query)
    {
        return $query->whereHas('users', function ($user) {
            $user->where('id', auth()->user()->id);
        })->where('published', 1);
    }


	/* custom function */

    public function getlastanswer()
    {
        if($this->quizAnswer->count() > 0)
        {
            $check = $this->quizAnswer()->orderBy('created_at', 'DESC')->first();
            if($check->getPassed())
            {
                return $check;
            }
            return NULL;
        }

        return NULL;
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
        foreach ($this->files as $key => $files) {
            if($files->fileurl && $files->filename)
            {
                if(file_exists(storage_path().'/app/public/'.$files->fileurl))
                {
                    unlink(storage_path().'/app/public/'.$files->fileurl);
                }
            }
        }
        $this->files()->delete();
    }

    public function getEmbedFile($centered = 'centered')
    {
        $return = '';
        $other = '';
        $pdf = '';
        $as = 0;
        if($this->files->count() > 0)
        {

            foreach($this->files as $file)
            {
                // if(File::extension(storage_path().'/app/public/'.$file->fileurl) == 'pdf'){
                //     $pdf .= '<div class="ui dimmable '.$centered.' special cards">';
                //     $pdf .= $file->getEmbedFile();
                //     $pdf .= '</div>';
                // }else{
                $other .= $file->getEmbedFile();
                // }
                $as = 1;
            }
            if($as == 1){
                $return .= '<div class="ui dimmable '.$centered.' special cards">';
                $return .= $other;
                $return .= '</div>';
                $return .= $pdf;
            }

              $return .= '
                        <div class="ui horizontal divider">
                          File
                        </div>';
        }
        return $return;
    }

    public function getEmbedYoutube($centered = null)
    {

      if($this->youtube_url != NULL)
      {
            preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $this->youtube_url, $id);
            return '<div class="ui embed" data-source="youtube" data-id="'.$id[1].'" style="height:300px"></div>
            <div class="ui horizontal divider">
                YOUTUBE
            </div>
            ';
      }
    }

    public function getEmbedWebsite($centered = null)
    {
      if($this->website_url != NULL)
      {
        return $this->website_url.'
        <div class="ui horizontal divider">
          Website URL
        </div>
        ';
      }
    }


}
