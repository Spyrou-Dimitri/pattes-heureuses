<?php

namespace Database\Seeders;

use App\Enums\AdoptionStatus;
use App\Enums\AnimalStatus;
use App\Enums\RoleVolunteer;
use App\Enums\SexeAnimal;
use App\Models\Adoption;
use App\Models\Animal;
use App\Models\Behavior;
use App\Models\Breed;
use App\Models\Coat;
use App\Models\Message;
use App\Models\Specie;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Vaccin;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {



        /* User seeding */
        User::factory()->create([
            'first_name' => 'Elise',
            'last_name' => 'Dieu',
            'email' => 'admin@example.com',
            'telephone' => '+32 036 27 20 17',
            'role' => RoleVolunteer::Admin,
        ]);
        User::factory()->create([
            'first_name' => 'Thomas',
            'last_name' => 'Gueux',
            'email' => 'test@example.com',
            'telephone' => '+32 036 27 20 17',
            'role' => RoleVolunteer::Volunteer,
        ]);

        /* Seed des breeds par rapport aux species */
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

        /* Seeding des vaccins par rapport aux species */
        $vaccinesBySpecie = [
            'Chien' => [
                'Rage',
                'CHPPi',
                'Leptospirose',
            ],
            'Chat' => [
                'Rage',
                'Typhus félin',
                'Coryza',
            ],
            'Raton-laveur' => [
                'Rage',
                'Maladie de Carré',
            ],
        ];

        foreach ($vaccinesBySpecie as $specieName => $vaccines) {

            $specie = Specie::where('name', $specieName)->first();

            foreach ($vaccines as $vaccineName) {

                $vaccine = Vaccin::firstOrCreate([
                    'name' => $vaccineName
                ]);

                $specie->vaccins()->syncWithoutDetaching($vaccine->id);
            }
        }

        /* Seed des coat */
        $coats = [
            'Noir', 'Doré', 'Brun', 'Roux'
        ];

        foreach ($coats as $coat) {
            $coat = Coat::create(['name' => $coat]);
        }

        $allCoats = Coat::all();

        /* Seeding des behaviors */
        $behaviors = [
           'Malicieux', 'Foutu', 'Exponentiel', 'Verbe irrégulier', 'La Croatie'
        ];
        foreach ($behaviors as $behavior) {
            $behavior = Behavior::create(['name' => $behavior]);
        }
    }
}
