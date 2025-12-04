<?php

namespace Database\Factories;

use App\Enums\AnimalStatus;
use App\Models\Animal;
use App\Models\Breed;
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
            'description' => $this->faker->sentence(50),
            'author' => $this->faker->word(),
            'age' => rand(1, 20),
            'breed_id' => Breed::factory(),
            'state' => AnimalStatus::cases()[array_rand(AnimalStatus::cases())]->value,
            'avatar' => UploadedFile::fake()->image('photo.jpg'),
            'accept_kids' => $this->faker->boolean(),
            'accept_dogs' => $this->faker->boolean(),
            'accept_cats' => $this->faker->boolean(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
