<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public static function latest()
    {
        return self::orderBy('id','desc')->firstOrFail();
    }
}
