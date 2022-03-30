<?php

use Illuminate\Database\Seeder;

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        //name, email, password

        for($i = 0; $i<9; $i++){
            $newUser = new User();
            $newUser->name = $faker->firstName($gender = 'male'|'female');
            $newUser->email = Str::lower($newUser->name).'@'.$faker->freeEmailDomain();
            $newUser->password = Hash::make("Prova123");
            $newUser->save();
        }
    }
}
