<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categorie = ["Antipasti", "Primi", "Secondi", "Contorni", "Dolci", "Bevande", "Pizze"];

        foreach($categorie as $categoria){
            $newCategory = new Category();
            $newCategory->category = $categoria;
            $newCategory->save();
        }
    }
}
