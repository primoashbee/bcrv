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

    public function getFullAddressAttribute()
    {
        if($this->finished){
            return "$this->street, $this->barangay, District $this->district, $this->city, Region $this->region, $this->province";
        }
        return $this->user->address;
    }

    public function getPhoneAttribute()
    {
        if($this->finished){
            return $this->contact_number;
        }
        return $this->user->phone;
    }
}
