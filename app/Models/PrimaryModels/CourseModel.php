<?php

namespace App\Models\PrimaryModels;

use App\Batch;
use Illuminate\Database\Eloquent\Model;

class CourseModel extends Model
{
    protected $table = "courses";
    protected $fillable = ['course_name', 'course_description'];

    public function batches()
    {
        return $this->hasMany(Batch::class,'course_id','id');
    }
}
