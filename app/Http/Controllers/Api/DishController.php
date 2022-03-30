<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dish;
use Illuminate\Support\Facades\DB;

class DishController extends Controller
{
    // Passo tutti i piatti che sono dichiarati visibili dal ristoratore
    public function index($restaurant_id)
    {
        $dishes = Dish::where('visible', true)->with('restaurant', 'category')->where("restaurant_id", $restaurant_id)->get();
        
        return response()->json($dishes);
    }
}
