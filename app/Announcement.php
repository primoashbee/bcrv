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
        return self::orderBy('id','desc')->first();
    }


    public static function pinned()
    {
        return self::where('pinned', true)->orderBy('id','desc')->first();

    }

    public function markAsPinned()
    {
        self::query()->update(['pinned'=>false]);
        // return $this->update(['pinned', true]);
        return $this->update([
            'pinned'=> true
        ]);
    }
}
