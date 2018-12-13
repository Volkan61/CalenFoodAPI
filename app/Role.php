<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $table = 'role';

    public function user()
{
    return $this->belongsToMany(User::class,'user_role','role_id');
}
}
