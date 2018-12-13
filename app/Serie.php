<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    protected $table = 'serie';

    public function season()
    {
        return $this->hasMany('App\Season','serie_id');
    }
}
