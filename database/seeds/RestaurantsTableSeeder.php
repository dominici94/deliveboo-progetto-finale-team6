<?php

use Illuminate\Database\Seeder;
use App\Restaurant;
use Illuminate\Support\Str;
use Faker\Generator as Faker;


class RestaurantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $restaurants = config('restaurants');

        foreach($restaurants as $restaurant){
            $newRestaurant = new Restaurant();
            $newRestaurant->user_id = $restaurant['user_id'];
            $newRestaurant->name = $restaurant['name'];
            $newRestaurant->slug = Str::of($newRestaurant->name)->slug('-');
            $newRestaurant->address = $restaurant['address'];
            $newRestaurant->vat = $faker->randomNumber(9, true).$faker->randomNumber(2, true);
            $newRestaurant->telephone = $faker->randomNumber(9, true).$faker->randomNumber(1, true);
            $newRestaurant->image = $restaurant['img'];
            $newRestaurant->description = $restaurant['description'];
            $newRestaurant->save();
        }
    }
}
