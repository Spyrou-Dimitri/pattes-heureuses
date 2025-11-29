<?php

namespace Database\Factories;

use App\Models\Animal;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Http\UploadedFile;


class AnimalFactory extends Factory
{
    protected $model = Animal::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'coat' => $this->faker->word(),
            'type' => $this->faker->word(),
            'breed' => $this->faker->word(),
            'state' => $this->faker->word(),
            'avatar' => UploadedFile::fake()->image('photo.jpg'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
