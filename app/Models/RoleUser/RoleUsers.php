<?php

namespace App\Models\RoleUser;

use Illuminate\Database\Eloquent\Model;

class RoleUsers extends Model
{
    //declaring the table name and the primaryKey
    protected $table = 'role_users';
    protected $primaryKey = 'id';
}
