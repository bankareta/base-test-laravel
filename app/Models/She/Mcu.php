<?php

namespace App\Models\She;

use App\Mail\McuSendMail;
use App\Mail\McuSendNotifMail;
use Illuminate\Database\Eloquent\Model;
use Helpers;
use Carbon;
use App\Models\Notification\Notification;

// Traits
use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;

use App\Models\Authentication\User;
use App\Models\File\Files;
use App\Models\Master\Project;
use App\Models\Master\Contractor;
use App\Models\Master\Blood;
use App\Models\Master\Result;
use App\Models\Master\TypeMcu;
use App\Models\Master\Location;
use App\Models\Master\Site;

use Mail;


class Mcu extends Model
{
    
    // call traits
    use RaidModel;
    use Utilities;

    protected $table 		= 'trans_mcu';
    protected $fillable 	= [
        'site_id',
        'user_id',
        'name',
        'gender',
        'blood_id',
        'date_birth',
        'company',
        'department',
        'title',
        'type_id',
        'last_date',
        'result_id',
        'due_date',
        'employee_id',
        'provider',
        'doc_no',
        'reason_result',
        'type_reports',
        'mcu_id',
        'appointment_date',
        'appointment_location',
        'status',
    ];


    public function setDateBirthAttribute($value)
    {
        $this->attributes['date_birth'] = Helpers::DateToSql($value);
    }
    public function setLastDateAttribute($value)
    {
        $this->attributes['last_date'] = Helpers::DateToSql($value);
    }
    public function setDueDateAttribute($value)
    {
        $this->attributes['due_date'] = Helpers::DateToSql($value);
    }
    public function setAppointmentDateAttribute($value)
    {
        $this->attributes['appointment_date'] = Helpers::DateToSql($value);
    }
    
    public function primaryFiles(){
        return $this->hasOne(Files::class, 'target_id')->where('target_type','she-mcu')->where('type','primary');
    }

    public function history(){
        return $this->hasMany(Self::class, 'mcu_id');
    }

    public function mail(){
        return $this->hasOne(McuMail::class, 'mcu_id');
    }

    public function site(){
        return $this->belongsTo(Site::class, 'site_id');
    }

    public function creator(){
        return $this->belongsTo(User::class, 'created_by');
    }

    public function employee(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function blood(){
        return $this->belongsTo(Blood::class, 'blood_id');
    }
    public function type(){
        return $this->belongsTo(TypeMcu::class, 'type_id');
    }
    public function result(){
        return $this->belongsTo(Result::class, 'result_id');
    }
    
    public function ageConvert()
    {
        $birthDate = $this->date_birth;
        $birthDate = explode("-", $birthDate);
        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[2], $birthDate[1], $birthDate[0]))) > date("md")
            ? ((date("Y") - $birthDate[0]) - 1)
            : (date("Y") - $birthDate[0]));
        return $age;
    }
    public function noticeDueDate(){
        if($this->due_date != NULL)
        {
            $date = Helpers::DateParse($this->due_date);
            if(Carbon::parse($date)->isPast())
            {
                return '<b style="color:red">'.$date.'</b>';
            }else if(Carbon::parse($date) < Carbon::now()->addWeeks(2)){
                return '<b style="color:red">'.$date.'</b>';
            }
            return $date;
        }

        return '-';
    }
    public function positionlabel()
    {
        if($this->due_date){
            $date = Helpers::DateParse($this->due_date);
            if(Carbon::parse($date)->isPast())
            {
                return '<a class="ui red tag label">Overdue</a>';
            }else if(Carbon::parse($date) < Carbon::now()->addWeeks(2)){
                return '<a class="ui red tag label">Overdue</a>';
            }

            switch($this->status)
            {
                case 2:
                    return '<a class="ui blue tag label">On Approve</a>';
                break;
                case 1:
                    return '<a class="ui black tag label">On Approve<a>';
                break;
                case 0:
                    return '<a class="ui black tag label">On Propose</a>';
                break;
            }
        }
        return '<a class="ui yellow tag label">On Request</a>';
    }

    public function sentEmailReviewing()
    {
        $urls = url('she/medical-checkup/mcu-review/'.$this->id);
        $title = 'Medical Check Up Action Result';
        $email = $this->mail->user->email;
        
        if(strpos($email,'@supreme-energy.local') == true){
            $email = str_replace('.local','.com',$this->mail->user->email);
        }
        try {
            Mail::to($email)->queue(new McuSendMail($this,$title,url('she/medical-checkup/mcu-review/'.$this->id), 'There is new medical check up for you to action result '));
        }finally{

        }

        $n['modul'] = 'Medical Check Up Action Result';
        $n['url'] = url('she/medical-checkup/mcu-review/'.$this->id);
        $n['fullurl'] = url('she/medical-checkup/');

        $n['user_id'] = $this->mail->user->id;
        $n['form_type'] = 'mcu';
        $n['form_id'] = $this->id;
        $n['content'] = $title;

        $notification = new Notification;
        $notification->fill($n);
        $notification->save();
    }
    
    public function sentEmailEmployee()
    {
        $urls = url('she/medical-checkup/'.$this->id);
        $title = 'Medical Check Up Result';
        $email = $this->employee->email;
        
        if(strpos($email,'@supreme-energy.local') == true){
            $email = str_replace('.local','.com',$this->employee->email);
        }
        try {
            Mail::to($email)->queue(new McuSendMail($this,$title,url('she/medical-checkup/'.$this->id), 'There is new result medical check up for you'));
        }finally{

        }

        $n['modul'] = 'Medical Check Up Action Result';
        $n['url'] = url('she/medical-checkup/mcu-review/'.$this->id);
        $n['fullurl'] = url('she/medical-checkup/');

        $n['user_id'] = $this->employee->id;
        $n['form_type'] = 'mcu';
        $n['form_id'] = $this->id;
        $n['content'] = $title;

        $notification = new Notification;
        $notification->fill($n);
        $notification->save();
    }
    
    public function sentEmailApprove()
    {
        $urls = url('she/medical-checkup/'.$this->id);
        $title = 'Medical Check Up Appointment';
        $email = $this->mail->user->email;
        
        if(strpos($email,'@supreme-energy.local') == true){
            $email = str_replace('.local','.com',$this->mail->user->email);
        }
        try {
            Mail::to($email)->queue(new McuSendMail($this,$title,url('she/medical-checkup/'.$this->id), 'There is new medical check up Appointment for you'));
        }finally{

        }

        $n['modul'] = 'Medical Check Up Appointment';
        $n['url'] = url('she/medical-checkup/'.$this->id);
        $n['fullurl'] = url('she/medical-checkup/');

        $n['user_id'] = $this->mail->user->id;
        $n['form_type'] = 'mcu';
        $n['form_id'] = $this->id;
        $n['content'] = $title;

        $notification = new Notification;
        $notification->fill($n);
        $notification->save();
    }
    
    public function sentEmailReminder()
    {
        $urls = url('she/medical-checkup/'.$this->id);
        $title = 'Medical Check Up is overdue';
        $email = $this->employee->email;
        
        if(strpos($email,'@supreme-energy.local') == true){
            $email = str_replace('.local','.com',$this->employee->email);
        }
        try {
            Mail::to($email)->queue(new McuSendNotifMail($this,$title,url('she/medical-checkup/'.$this->id), 'There is Medical Check Up is overdue'));
        }finally{

        }

        $n['modul'] = 'Medical Check Up is overdue';
        $n['url'] = url('she/medical-checkup/'.$this->id);
        $n['fullurl'] = url('she/medical-checkup/');

        $n['user_id'] = $this->employee->id;
        $n['form_type'] = 'mcu';
        $n['form_id'] = $this->id;
        $n['content'] = $title;

        $notification = new Notification;
        $notification->fill($n);
        $notification->save();
    }
}
