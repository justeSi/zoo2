<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Manager;
use App\Models\Animal;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    static function getManager($specieId){
        $managers = Manager::all();
        
        foreach ($managers as $manager) {
            if ($specieId == $manager->specie_id) {
                return $manager->id;
            }
        }
    }
   
    public function run()
    {
        $faker = Faker::create();

        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123'),
        ]);
        $species = ['Tiger', 'Gorilla', 'Elephant', 'Chimpanzee', 'Penguin', 'Turtle', 'Panda', 'Lions', 'Rhino', 'Beaver', 'Polar Bear', 'Hippopotamus', 'Snow Leopard', 'Jaguar', 'Arctic Fox', 'Arctic Wolf'];
        sort($species);
        $spiecesCount = count($species);
        $i = 0;
        foreach(range(1, $spiecesCount) as $_) {
            $specie = $species[$i];
            DB::table('species')->insert([
                'name' => $specie,
            ]);
            $i++;
        }
        
        $i = 1;
        foreach(range(1, $spiecesCount) as $_) {
            DB::table('managers')->insert([
                'name' => $faker->firstName(),
                'surname' => $faker->lastName(),
                'specie_id' => $i,
            ]);
            $i++;
        }
        
        foreach(range(1, 100) as $_) {
            $specie_id = rand(1, $spiecesCount);
            DB::table('animals')->insert([
                'name' => $faker->firstName(),
                'specie_id' => $specie_id,
                'birth_year' => $faker->year($max = 'now'),
                'animal_book' => $faker->realText(200),
                'manager_id' => self::getManager($specie_id),
            ]);
        }
    }
        
}