<?php

namespace Database\Factories;

use App\Models\Logistica;
use App\Models\Material_Base;
use App\Models\Produto;
use App\Models\TipoProduto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProdutoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Produto::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
    //
    }
}
