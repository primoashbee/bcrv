<?php

namespace App\Models\PrimaryModels;

use Illuminate\Database\Eloquent\Model;

class StudentInfo extends Model
{
    protected $table = "student_info";
    protected $fillable = ['alternate_id', 'email', 'name', 'course', 'year', 'contact_number','education_level'];

    const EDUCATION_LEVEL = ['High School','College'];
}
