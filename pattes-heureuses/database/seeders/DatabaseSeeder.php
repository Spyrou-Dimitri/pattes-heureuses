<?php

namespace Database\Seeders;

use App\Models\Animal;
use App\Models\Breed;
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


        /* Animals seeding */
        for ($i = 0; $i < 50; $i++) {
            Animal::factory()->create([
                'breed_id' => $seedingBreeds[array_rand($seedingBreeds)]
            ]);
        }

    }
}
