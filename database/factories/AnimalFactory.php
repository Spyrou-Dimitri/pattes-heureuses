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
        $images = [
            'public/img/animal/Bastien.jpg',
            'public/img/animal/Benoit.jpg',
            'public/img/animal/Carlos.jpg',
            'public/img/animal/jean.jpeg',
            'public/img/animal/Larry.jpg',
            'public/img/animal/Pablo.jpg',
            'public/img/animal/Samantha.jpg',
            'public/img/animal/Kenny.jpg',
        ];

        return [
            'name' => $this->faker->firstName(),
            'description' => $this->faker->sentence(50),
            'author' => $this->faker->word(),
            'age' => rand(1, 20),
            'breed_id' => Breed::factory(),
            'state' => AnimalStatus::cases()[array_rand(AnimalStatus::cases())]->value,
            'avatar' => $images[array_rand($images)],
            'accept_kids' => $this->faker->boolean(),
            'accept_dogs' => $this->faker->boolean(),
            'accept_cats' => $this->faker->boolean(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
