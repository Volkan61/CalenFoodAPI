<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    protected $table = 'episode';

    public function source()
    {
        return $this->hasMany('App\Source','episode_id');
    }

    public function subtitle()
    {
        return $this->hasMany('App\Subtitle','episode_id');
    }
}
