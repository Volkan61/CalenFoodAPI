<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';

    public function parent()
    {
        return $this->hasMany('App\Category', 'parent_id');
    }


    public function liste()
    {
        return $this->hasMany('App\Entry');
    }


}
