<?php

namespace Database\Factories;

use App\Models\Usuario;
use App\Models\Cargo;
use Illuminate\Database\Eloquent\Factories\Factory;

class UsuarioFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Usuario::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'usu_nome_completo' => $this->faker->name(),
            'usu_usuario' => $this->faker->unique()->safeEmail(),
            'usu_celular' => '(19) 99999-9999',
            'usu_senha' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'usu_cpf' => $this->faker->cpf,
            'car_id' => Cargo::factory(),
            'usu_status' => 'Ativo'

        ];
    }
}
