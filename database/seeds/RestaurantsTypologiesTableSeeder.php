<?php

use Illuminate\Database\Seeder;
use App\Restaurant;
use Illuminate\Support\Facades\DB;

class RestaurantsTypologiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $restaurants = Restaurant::all();

        //dolci = 1
        //fast food = 2
        //giapponese = 3
        //indiano = 4
        //italiano = 5
        //messicano = 6
        //pizze = 7

        // DB::table('restaurant_typology')->insert([
        //     'restaurant_id' => 1,
        //     'typology_id' => 1,
        // ]);

        foreach($restaurants as $restaurant){
            if($restaurant->name == "I Lestofanti"){
                DB::table('restaurant_typology')->insert([
                    'restaurant_id' => $restaurant->id,
                    'typology_id' => 7
                ]);
                DB::table('restaurant_typology')->insert([
                    'restaurant_id' => $restaurant->id,
                    'typology_id' => 5
                ]);
            }
            if($restaurant->name == "El Mariachi"){
                DB::table('restaurant_typology')->insert([
                    'restaurant_id' => $restaurant->id,
                    'typology_id' => 6
                ]);
            }
            if($restaurant->name == "Zio Ciccio"){
                DB::table('restaurant_typology')->insert([
                    'restaurant_id' => $restaurant->id,
                    'typology_id' => 5
                ]);
            }
            if($restaurant->name == "Il Veliero"){
                DB::table('restaurant_typology')->insert([
                    'restaurant_id' => $restaurant->id,
                    'typology_id' => 5
                ]);
            }
            if($restaurant->name == "Taj Mahal"){
                DB::table('restaurant_typology')->insert([
                    'restaurant_id' => $restaurant->id,
                    'typology_id' => 4
                ]);
            }
            if($restaurant->name == "Sushi Yoki"){
                DB::table('restaurant_typology')->insert([
                    'restaurant_id' => $restaurant->id,
                    'typology_id' => 3
                ]);
            }
            if($restaurant->name == "McDonald's"){
                DB::table('restaurant_typology')->insert([
                    'restaurant_id' => $restaurant->id,
                    'typology_id' => 2
                ]);
            }
            if($restaurant->name == "Burger King"){
                DB::table('restaurant_typology')->insert([
                    'restaurant_id' => $restaurant->id,
                    'typology_id' => 2
                ]);
            }
            if($restaurant->name == "The Big Muffin"){
                DB::table('restaurant_typology')->insert([
                    'restaurant_id' => $restaurant->id,
                    'typology_id' => 1
                ]);
            }
        }
    }
}
