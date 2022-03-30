<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dish;


class TypoController extends Controller
{
    // Passo tutti i piatti che sono dichiarati visibili dal ristoratore
    public function index($slug)
    {

        $dishes = Dish::where('visible', true)->get();

        $piatto = array();

        foreach($dishes as $dish) {
            if ($dish->restaurant->slug == $slug) {
                // $piatto.push($dish);
                $piatto[] = $dish;
                // $piatto += $dish;
            }
        }

        return response()->json($piatto);
    }
}

