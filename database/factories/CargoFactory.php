<?php

namespace Database\Factories;

use App\Models\Cargo;
use App\Models\Privilegio;
use Illuminate\Database\Eloquent\Factories\Factory;

class CargoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cargo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'car_descricao' => 'Nível ' . rand(1, 10),
            'pri_id' => Privilegio::factory()
        ];
    }
}
