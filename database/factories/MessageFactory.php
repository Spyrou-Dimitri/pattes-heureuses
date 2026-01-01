<?php

namespace Database\Factories;

use App\Models\Message;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class MessageFactory extends Factory
{
    protected $model = Message::class;

    public function definition(): array
    {
        return [
            'last_name' => $this->faker->lastName(),
            'first_name' => $this->faker->firstName(),
            'email' => $this->faker->unique()->safeEmail(),
            'telephone' => $this->faker->word(),
            'topic' => $this->faker->word(),
            'description' => $this->faker->text(),
            'created_at' => Carbon::instance($this->faker->dateTimeBetween('-30 days', 'now')),
            'updated_at' => Carbon::instance($this->faker->dateTimeBetween('-30 days', 'now'))
        ];
    }
}
