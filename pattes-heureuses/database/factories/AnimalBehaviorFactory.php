<?php

namespace Database\Factories;

use App\Models\Animal;
use App\Models\AnimalBehavior;
use App\Models\Behavior;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnimalBehaviorFactory extends Factory
{
    protected $model = AnimalBehavior::class;

    public function definition(): array
    {
        return [

            'animal_id' => Animal::factory(),
            'behavior_id' => Behavior::factory(),
        ];
    }
}
