<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

// Traits
use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;
use App\Models\Master\Site;
use Mail;

use App\Models\Authentication\User;

use App\Mail\PolicyNotificationMail;

use App\Models\Notification\Notification;
use OneSignal;

class Policy extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

	/* default */
    protected $table 		= 'trans_policy';
    protected $fillable = [
        'title',
        'type_id',
        'content',
        'status',
        'print_page',
        // 'site_id'
    ];

    /* data ke log */

	/* relation */
	// insert code here
    public function lampiranberkas(){
	    return $this->hasMany(LampiranPolicy::class, 'policy_id');
	}

	public function review()
    {
      	return $this->belongsToMany(User::class, 'trans_policy_reviews', 'policy_id', 'user_id');
    }

    public function site()
    {
      	return $this->belongsToMany(Site::class, 'trans_policy_site', 'policy_id', 'site_id');
    }

    public function company(){
        return $this->belongsTo(Site::class, 'site_id');
	}

	public function scopebyFilterSite($query,$site_id)
    {
        if($site_id){
            return $query->where('site_id', $site_id);
        }
    }

	public function type()
	{
		return $this->belongsTo(TipePolicy::class, 'type_id');
	}

	public function getReviewedCount()
    {
		return $this->review->count();
    }

    public function getNotReviewedCount()
    {
      $totalUser = User::whereHas('site', function ($site) {
          $site->whereIn('id', $this->site->pluck('id'));
      })->count();
      $return = $totalUser - $this->review->count();

      return $return;
    }

	public function hasReviewed()
	{
		$return = false;
		if($this->review->where('id', auth()->user()->id)->count() > 0)
		{
			$return = true;
		}
		return $return;
	}

  	public function labelReviewed()
  	{
	    $return = '<a class="ui red tag label">Not Yet Viewed</a>';

	    if($this->hasReviewed())
	    {
	        $return = '<a class="ui green tag label">Viewed</a>';
	    }

    	return $return;
  	}

	public function labelStatus()
  	{
	    $return = '-';
	    switch ($this->status)
	    {
	        case 0: $return = '<a class="ui yellow tag label">Draft</a>';
	        break;
	        case 1: $return = '<a class="ui tag label">Published</a>';
	        break;
	    }

	    return $return;
  	}

  	public function sentEmailReviewing()
    {

        $urls = url('communication/policy/'.$this->id);
        $title = 'Policy/Procedure Report';
        $site = $this->site;
        foreach ($site as $key => $show) {
            $site_id[$key] = $show->id;
        }
        $site_user = User::whereHas('site', function ($user) use ($site_id) {
            $user->whereIn('id', $site_id);
        })->where('status','1')->get();

        if($site_user->count() > 0){
            foreach ($site_user as $user) {
                $email = $user->email;
                if(strpos($email,'@supreme-energy.local') == true){
                    $email = str_replace('.local','.com',$user->email);
                }
                Mail::to($email)->queue(new PolicyNotificationMail($this,$title,url('communication/policy/'.$this->id), 'There is new Policy/Procedure for you to view'));

                // $n['modul'] = 'Policy Report';
                // $n['url'] = url('communication/policy/'.$this->id);
                // $n['user_id'] = $user->id;
                // $n['form_type'] = 'communication';
                // $n['form_id'] = $this->id;
                // $n['content'] = $title;

                // $notification = new Notification;
                // $notification->fill($n);
                // $notification->save();
            }
        }
    }

    public function sendNotAndro($data,$typeVal){
      $arr = [];
      if($this->site){
        if($this->site->count() > 0){
          foreach ($this->site as $k => $value) {
            if($value->siteUser){
              if($value->siteUser->count() > 0){
                foreach ($value->siteUser as $k1 => $value1) {
                    if(isset($value1->token) && trim($value1->token) != ''){
                      $this->sendNowOneSignal($value1->token,$data,$typeVal);
                    }
                }
              }
            }
          }
        }
      }
      // dd($arr);
    }

     public function sendNowOneSignal($user,$data,$typeVal){
        $userId = $user;
        $thisData = [];
        $thisData = [
            'id' => $this->id,
            'type' => $typeVal,
        ];
        OneSignal::sendNotificationToUser(
            $data,
            $userId,
            $url = null,
            $data = $thisData,
            $buttons = null,
            $schedule = null,
            $headings = 'SHE SUPREME'
        );
    }
}
