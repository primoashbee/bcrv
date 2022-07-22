<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    protected $guarded = [];

    public function scopeCollege($query){
        return $query->where('education_level','College');
    }

    public function scopeHighSchool($query){
        return $query->where('education_level','High School');
    }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function getMandatoryNameAttribute()
    {
        return $this->mandatory ? 'True' : 'False';
    }

    public function getActiveNameAttribute()
    {
        return $this->active ? 'True' : 'False';
    }
    
}
