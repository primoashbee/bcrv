<?php

namespace App;

use App\BatchUser;
use App\Models\PrimaryModels\CourseModel;
use App\Models\PrimaryModels\StudentInfo;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class,'batch_users');
        // return $this->hasManyThrough(User::class, BatchUser::class, 'first', 'id','third','user_id');
    }

    public function course()
    {
        return $this->belongsTo(CourseModel::class, 'course_id', 'id');
    }


}
