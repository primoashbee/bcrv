<?php

namespace App\Models\PrimaryModels;

use Illuminate\Database\Eloquent\Model;

class CourseModel extends Model
{
    protected $table = "courses";
    protected $fillable = ['course_name', 'course_description'];
}
