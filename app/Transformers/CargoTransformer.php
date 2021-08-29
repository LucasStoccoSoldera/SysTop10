<?php

namespace App\Transformers;

use App\Models\Cargo;
use League\Fractal\TransformerAbstract;

class CargoTransformer extends TransformerAbstract
{

    /**
     * @param \App\Models\Cargo $cargo
     * @return array
     */
    public function transform(Cargo $cargo)
    {
        return [
            'id' => (int) $cargo->id,
            'car_descricao' => $cargo->car_descricao,
        ];
    }
}
