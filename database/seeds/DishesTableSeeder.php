<?php

use Illuminate\Database\Seeder;
use App\Dish;

class DishesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ristoranti = config('dishes');

        foreach ($ristoranti as $ristorante) {
            //id
            foreach ($ristorante as $piatto) {
                $newPiatto = new Dish();
                $newPiatto->restaurant_id = $piatto['restaurant_id'];
                $newPiatto->category_id = $piatto['category_id'];
                $newPiatto->name = $piatto['name'];
                $newPiatto->description = $piatto['description'];
                $newPiatto->price = $piatto['price'];
                $newPiatto->visible = $piatto['visible'];
                $newPiatto->image = $piatto['image'];
                $newPiatto->save();
            }
        }
    }
}
