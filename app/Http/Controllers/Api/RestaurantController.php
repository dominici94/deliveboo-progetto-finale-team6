<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Restaurant;
use App\Typology;

class RestaurantController extends Controller
{
    public function index(){
        $restaurants = Restaurant::with(['typologies'])->get();
        
        return response()->json($restaurants);
    }

    public function filter($filtri)
    {
        $filters = explode(',', $filtri);
        // return response()->json($filters);
        $restaurants = Restaurant::with(['typologies'])->get();

        foreach($restaurants as $restaurant){
            foreach($restaurant->typologies as $typo){
                foreach($filters as $filter){
                    if($typo->id == $filter){
                        $filter_restaurants[] = $restaurant;
                    }
                }
            }
        }

        $filter_restaurants = array_unique($filter_restaurants);
        
        return response()->json($filter_restaurants);
    }

    public function SingleRestaurant($slug){
        $restaurant = Restaurant::where('slug', $slug)->with(['typologies'])->first();

        if(empty($restaurant)) {
            return response()->json(["message" => "Restaurant Not Found"], 404);
        }

        return response()->json($restaurant);
    }

    public function typologies()
    {
        $typologies = Typology::orderBy('id', 'DESC')->get();

        return response()->json($typologies);
    }
}
