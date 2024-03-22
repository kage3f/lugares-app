<?php

use App\Models\Place;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlaceFactory extends Factory
{
    protected $model = Place::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'city' => $this->faker->city,
            'state' => $this->faker->stateAbbr,
            // Gere o slug baseado no nome para manter a consistência
            'slug' => Str::slug($this->faker->name),
        ];
    }
}
