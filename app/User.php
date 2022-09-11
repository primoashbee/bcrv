<?php

namespace App;

use App\Announcement;
use App\StudentCourse;
use App\StudentRequirement;
use Illuminate\Notifications\Notifiable;
use App\Models\PrimaryModels\StudentInfo;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'user_name', 'email', 'password',
    // ];

    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function studentRequirements()
    {
        return $this->hasMany(StudentRequirement::class,'user_id','id');
    }

    public function studentInfo()
    {
        return $this->hasOne(StudentInfo::class,'email','email');
    }


    public function announcement()
    {
        return $this->hasMany(Announcement::class);
    }

    public function courses()
    {
        return $this->hasMany(StudentCourse::class,'student_id','id');

    }

    public function getCourseListAttribute()
    {
        $courses = $this->courses;
        $str = "";

        if(is_null($courses)){
            return "";
        }
        $total = count($courses)-1;
        foreach($courses as $key=>$course)
        {
            if($key==$total){
                $str.=$course->course->course_name ."";
            }else{
                $str.=$course->course->course_name ." , ";
            }
        }

        return $str;
    }
    

    public function notificationData()
    {
        $user = Sentinel::findUserById($this->id);
        if(!Activation::completed($user)){
            return [
                'message' => '[STDNT-'.$this->studentInfo->alternate_id.']'.$this->studentInfo->name . ' joined BCRV',
                'title' => 'New Account Registration'
            ];
        }
        return [
            'message' => '[STDNT-'.$this->studentInfo->alternate_id.']'.$this->studentInfo->name. ' activated his/her account',
            'title' => 'Account Activation'
        ];
    }

    public function isActivated()
    {
        $user = Sentinel::findUserById($this->id);
        $result = Activation::completed($user);
        return  $result == false ? false : true;  
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class,'role_users');
        // return $this->hasManyThrough(Role::class, RoleUser::class, 'role_id','id','thirdkey','role_id');
    }

    public function batches()
    {
        return $this->belongsToMany(Batch::class,'batch_users')->withPivot('status');
    }

    public function getRequirementsCompleteAttribute()
    {
        $requirements = $this->studentRequirements();
        $count = $requirements->count();
        $uploaded = $requirements->whereIn('status', [StudentRequirement::PENDING, StudentRequirement::APPROVED])->count();

        return $count == $uploaded;
    }

    public function learner()
    {
        return $this->hasOne(Learner::class,'user_id','id');
    }
    
}
