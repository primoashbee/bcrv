<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Learner extends Model
{
    protected $guarded = [];
    protected $dates = [
        'birthday'
    ];
    protected $appends = ['photo_preview_path'];
    public function user(){
        return $this->belongsTo(User::class,'id','user_id');
    }

    public function getPhotoPreviewPathAttribute()
    {

        if(is_null($this->photo_path)){
            return asset('admin_assets/dist/img/user.png');
        }
        $arr = explode("/", $this->photo_path);
        $filename = $arr[count($arr)-1];
        return route('image.preview',['disk'=>'photos','filename'=>$filename]); 
    }
}
