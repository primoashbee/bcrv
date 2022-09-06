<?php

namespace App;

use App\BatchUser;
use App\BatchCertificate;
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


}
