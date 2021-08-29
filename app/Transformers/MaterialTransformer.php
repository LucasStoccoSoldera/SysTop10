<?php

namespace App\Transformers;

use App\Models\Material_Base;
use League\Fractal\TransformerAbstract;

class MaterialTransformer extends TransformerAbstract
{

    /**
     * @param \App\Models\Material_Base $material
     * @return array
     */
    public function transform(Material_Base $material)
    {
        return [
            'id' => (int) $material->id,
            'mat_descricao' => $material->mat_descricao,
        ];
    }
}
