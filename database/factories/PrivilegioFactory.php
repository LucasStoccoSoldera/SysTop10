<?php

namespace Database\Factories;

use App\Models\Privilegio;
use Illuminate\Database\Eloquent\Factories\Factory;

class PrivilegioFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Privilegio::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'pri_usuarios' => rand(0, 1),
            'pri_clientes' => rand(0, 1),
            'pri_financeiro' => rand(0, 1),
            'pri_produtos' => rand(0, 1),
            'pri_estoque' => rand(0, 1),
            'pri_fornecedores' => rand(0, 1),
            'pri_detalhes' => rand(0, 1),
            'pri_logistica' => rand(0, 1)
        ];
    }
}
