<?php

namespace Database\Seeders;

use App\Enums\SexeAnimal;
use App\Models\Animal;
use App\Models\Behavior;
use App\Models\Breed;
use App\Models\Coat;
use App\Models\Specie;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        /* User seeding */
        User::factory(10)->create();
        User::factory()->create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'test@example.com',

        ]);

        /* Species and breed seeding */
        $species = [
            'Chien' =>
                [
                    'Labrador',
                    'Berge-allemand',
                    'Husky',
                    'Beagle'
                ],
            'Chat' =>
                [
                    'Européen',
                    'Goutière',
                    'Siamois'
                ],
            'Raton-laveur' =>
                [
                    'Kenny',
                    'KeskeTuFais'
                ]
        ];
        $seedingBreeds = [];
        foreach ($species as $specie => $breeds) {

            $specie = Specie::create(['name' => $specie]);

            foreach ($breeds as $breed) {
                $breed = Breed::create([
                    'name' => $breed,
                    'specie_id' => $specie->id
                ]);

                $seedingBreeds[] = $breed->id;
            }
        }

        /* Seeding coat */

        $coats = [
            'Noir', 'Doré', 'Brun', 'Roux'
        ];

        foreach ($coats as $coat) {
            $coat = Coat::create(['name' => $coat]);
        }

        $allCoats = Coat::all();

        /* Seeding behaviors */

        $behaviors = [
           'Malicieux', 'Foutu', 'Exponentiel', 'Verbe irrégulier', 'La Croatie'
        ];
        foreach ($behaviors as $behavior) {
            $behavior = Behavior::create(['name' => $behavior]);
        }

        $allBehaviors = Behavior::all();
        /* Animals seeding */
        for ($i = 0; $i < 50; $i++) {
            $animals = Animal::factory()->create([
                'sexe' => SexeAnimal::cases()[array_rand(SexeAnimal::cases())]->value,
                'breed_id' => $seedingBreeds[array_rand($seedingBreeds)]
            ]);

            $animals->coats()->attach(
                $allCoats->random(rand(1, 2))->pluck('id')->toArray()
            );

            $animals->behaviors()->attach(
                $allBehaviors->random(rand(1,3))->pluck('id')->toArray()
            );

        }

    }

}
