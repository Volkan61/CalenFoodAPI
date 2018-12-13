<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Listen extends Model
{
    protected $table = 'listen';


    public function category()
    {
        return $this->hasMany('App\Category');
    }

    public function listen()
    {
        return $this->hasMany('App\Lists','listen_id');
    }


}
