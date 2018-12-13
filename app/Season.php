<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    protected $table = 'season';


    public function episode()
    {
        return $this->hasMany('App\Episode','season_id');
    }
}
