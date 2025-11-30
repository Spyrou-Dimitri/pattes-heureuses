<?php

namespace Database\Factories;

use App\Enums\AnimalStatus;
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
            'author' => $this->faker->word(),
            'age' => rand(1, 20),
            'breed' => $this->faker->word(),
            'state' => AnimalStatus::cases()[array_rand(AnimalStatus::cases())]->value,
            'avatar' => UploadedFile::fake()->image('photo.jpg'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
