<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function dishes(){
        return $this->belongsToMany('App\Dish')->withPivot('dish_id', 'order_id', 'quantity');
    }
}
