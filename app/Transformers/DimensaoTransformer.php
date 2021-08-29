<?php

namespace App\Transformers;

use App\Models\Dimensao;
use League\Fractal\TransformerAbstract;

class DimensaoTransformer extends TransformerAbstract
{

    /**
     * @param \App\Models\Dimensao $pacote
     * @return array
     */
    public function transform(Dimensao $dimensao)
    {
        return [
            'id' => (int) $dimensao->id,
            'dim_descricao' => $dimensao->dim_descricao,
        ];
    }

}
