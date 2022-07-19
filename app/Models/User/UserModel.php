<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
   protected $table = "users";
   protected $fillable = ['user_name','profile_image', 'address'
   , 'position', 'department', 'email' ];
}
