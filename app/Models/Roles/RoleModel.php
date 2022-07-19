<?php

namespace App\Models\Roles;

use Illuminate\Database\Eloquent\Model;

class RoleModel extends Model
{
    //declaring the table name and the primaryKey
    protected $table = 'roles';
    protected $primaryKey = 'id';
}
