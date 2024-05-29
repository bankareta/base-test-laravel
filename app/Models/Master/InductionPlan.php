<?php
namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;
use App\Models\Induction\InductionAnswer;
use App\Models\Authentication\User;
use Helpers;
use Mail;

use App\Models\Notification\Notification;
use App\Mail\InductionMaterialMail;

class InductionPlan extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

    protected $table        = 'ref_induction_set_induction';

    protected $fillable     = [
        'materi_id',
        'title',
        'date_induction_start',
        'date_induction_end',
        'status',
    ];

    protected $dates = ['date_induction_start','date_induction_end'];

    public function setDateInductionStartAttribute($value = '')
    {
      $this->attributes["date_induction_start"] = Helpers::DateToSql($value);
    }

    public function setDateInductionEndAttribute($value = '')
    {
      $this->attributes["date_induction_end"] = Helpers::DateToSql($value);
    }

    public function materi()
    {
        return $this->belongsTo(Induction::class, 'materi_id');
    }

    public function answer()
    {
        return $this->hasMany(InductionAnswer::class, 'plan_id');
    }

    public function users()
    {
      return $this->belongsToMany(User::class, 'ref_induction_set_participant', 'set_induction_id', 'user_id');
    }

    public function failedusers()
    {
      return $this->belongsToMany(User::class, 'trans_induction_failed', 'plan_id', 'user_id');
    }
    
    public function doneusers()
    {
      return $this->belongsToMany(User::class, 'trans_induction_done', 'plan_id', 'user_id');
    }

    public function scopeByUsers($query) {
      $user_id = auth()->user()->id;
      return $query->whereHas('users', function($q)use($user_id){
        $q->where('user_id',$user_id);
      })->where('status',1)->whereHas('materi', function($materi) {
          $materi->where('status', 1);
      });
    }

    public function getHasbeenInductionCount()
    {
      $check = InductionAnswer::where('plan_id',$this->id)->whereIn('user_id',$this->users->pluck('id'))->get();
      return $check->count();
    }

    public function getHaventJoinedCount()
    {
      $check = InductionAnswer::where('plan_id',$this->id)->whereIn('user_id',$this->users->pluck('id'))->get();
      return $this->users->count() - $check->count();
    }

    public function sentEmailAction()
    {
        $urls = url('induction-material');
        $title = 'There is new Induction Material for you';

        if($this->users->count() > 0){
            foreach ($this->users as $key => $users) {
                $email = $users->email;
                if(strpos($email,'@supreme-energy.local') == true){
                    $email = str_replace('.local','.com',$users->email);
                }
                Mail::to($email)->queue(new InductionMaterialMail($users,$title,url('induction-material'), 'There is new Induction Material for you'));
                $n['modul'] = 'Induction Material';
                $n['url'] = url('induction-material');
                $n['fullurl'] = url('induction-material');

                $n['user_id'] = $users->id;
                $n['form_type'] = 'induction-material';
                $n['form_id'] = $this->id;
                $n['content'] = $title;

                $notification = new Notification;
                $notification->fill($n);
                $notification->save();
            }
        }
    }

}
