<?php

use Illuminate\Database\Seeder;
use App\Typology;
use Illuminate\Support\Str;

class TypologiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipologie = ["Dolci", "Fast Food", "Giapponese", "Indiano", "Italiano", "Messicano", "Pizze"];

        foreach($tipologie as $tipologia){
            $newTipologia = new Typology();
            $newTipologia->category = $tipologia;
            $newTipologia->slug = Str::of($newTipologia->category)->slug('-');
            $newTipologia->save();
        }
    }
}
