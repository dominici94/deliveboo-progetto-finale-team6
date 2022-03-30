<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function typologies(){
        return $this->belongsToMany('App\Typology');
    }

    public function dishes(){
        return $this->hasMany('App\Dish');
    }
}
