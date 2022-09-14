<?php

namespace App;

use App\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Learner extends Model
{
    protected $guarded = [];
    protected $casts = [
        'birthday' => 'date'
    ];
    protected $appends = ['photo_preview_path'];
    public function user(){
        return $this->belongsTo(User::class,'id','user_id');
    }

    public function getPhotoPreviewPathAttribute()
    {
    //     dd(file_exists())
    //     return url('storage/images/'.$article->image);
        return str_replace(" ", "%20", url('/images/photos/' . $this->photo_path) );
        // return Storage::disk('photos')->path($this->photo_path);
        // if(is_null($this->photo_path)){
        //     return asset('admin_assets/dist/img/user.png');
        // }
        // $arr = explode("/", $this->photo_path);
        // $filename = $arr[count($arr)-1];
        // return route('image.preview',['disk'=>'photos','filename'=>$filename]); 
    }

    public function getFullAddressAttribute()
    {
        if($this->finished){
            return "$this->street, $this->barangay, District $this->district, $this->city, Region $this->region, $this->province";
        }

        
        
        // if(!is_null($this->user)){
        //     return $this->user->address;
        // }
        // return "";
    }
    public function getFullnameAttribute()
    {
        return "{$this->firstname} {$this->middlename} {$this->lastname}";
    }

    public function getPhoneAttribute()
    {
        if($this->finished){
            return $this->contact_number;
        }
        return $this->user->phone;
    }

    public function getBirthdayAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }
}
