<?php

namespace App;

use App\BatchUser;
use App\BatchCertificate;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Models\PrimaryModels\CourseModel;
use App\Models\PrimaryModels\StudentInfo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Batch extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class,'batch_users')->withPivot('status');
        // return $this->hasManyThrough(User::class, BatchUser::class, 'first', 'id','third','user_id');
    }

    public function course()
    {
        return $this->belongsTo(CourseModel::class, 'course_id', 'id');
    }

    public function certificates()
    {
        return $this->hasMany(BatchCertificate::class);
    }

    public function enlisted()
    {
        return $this->users()->whereIn('batch_users.status', [BatchUser::COMPLETED, BatchUser::NOT_COMPLETED]);
    }

    public function getIsFinishedAttribute()
    {
        return Carbon::parse($this->end_date)->isPast();
    }


    public function getStartDateFormattedAttribute()
    {
        if(is_null($this->getOriginal('start_date'))){
            return null;
        }
        return Carbon::parse($this->getOriginal('start_date'))->format('F d, Y');
    }

    public function getEndDateFormattedAttribute()
    {
        if(is_null($this->getOriginal('end_date'))){
            return null;
        }
        return Carbon::parse($this->getOriginal('end_date'))->format('F d, Y');
    }

    public function getStatusFormattedAttribute()
    {

        if($this->is_finished)
        {
            return 'Finished';
        }

        if(Carbon::parse($this->getOriginal('start_date'))->isFuture())
        {
            return 'Not yet started';
        }

        return 'On-going';
    }

    public function getStatusHtmlAttribute()
    {
        if($this->status_formatted == 'Finished')
        {
            return "<span class=\"badge badge-success\">Finished</span>";
        }
        if($this->status_formatted == 'Not yet started')
        {
            return "<span class=\"badge badge-info\">Not Yet Started</span>";
        }
        if($this->status_formatted == 'On-going')
        {
            return "<span class=\"badge badge-primary\">On-Going</span>";
        }
    }
}
