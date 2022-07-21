<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentRequirement extends Model
{
    protected $guarded = [];
    const PENDING = 1;
    const APPROVED = 2;
}
