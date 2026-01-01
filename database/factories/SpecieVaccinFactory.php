<?php

namespace Database\Factories;

use App\Models\Specie;
use App\Models\SpecieVaccin;
use App\Models\Vaccin;
use Illuminate\Database\Eloquent\Factories\Factory;

class SpecieVaccinFactory extends Factory
{
    protected $model = SpecieVaccin::class;

    public function definition(): array
    {
        return [

            'specie_id' => Specie::factory(),
            'vaccin_id' => Vaccin::factory(),
        ];
    }
}
