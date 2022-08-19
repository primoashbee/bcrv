<?php

namespace App\Models\PrimaryModels;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentInfo extends Model
{
    use SoftDeletes;
    protected $table = "student_info";
    // protected $fillable = ['alternate_id', 'email', 'name', 'course', 'year', 'contact_number','education_level'];
    protected $guarded  = [];
    const EDUCATION_LEVEL = ['High School','College','College Undergrad','ALS'];
    protected static function boot()
    {
        parent::boot();
    
        static::created(function ($model) {
            $model->name = "{$model->firstname} {$model->lastname}"; 
        });
        static::updated(function ($model) {
            $model->name = "{$model->firstname} {$model->lastname}";     
        });
        static::saved(function ($model) {
            $model->name = "{$model->firstname} {$model->lastname}";     
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class,'email','email');
    }

    public function getNameAttribute()
    {
        return "{$this->firstname} {$this->lastname}";
    }
}
