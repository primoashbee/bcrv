<?php

namespace App;

use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use App\Models\PrimaryModels\CourseModel;

class StudentCourse extends Model
{
    protected $guarded = [];

    public function course()
    {
        return $this->hasOne(CourseModel::class,'id','course_id');
    }
    public function user()
    {
        return $this->hasOne(User::class,'id','student_id');
    }
}
