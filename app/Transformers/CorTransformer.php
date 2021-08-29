<?php

namespace App\Transformers;

use App\Models\Cor;
use League\Fractal\TransformerAbstract;

class CorTransformer extends TransformerAbstract
{
    /**
     * @param \App\Models\Cor $cor
     * @return array
     */
    public function transform(Cor $cor)
    {
        return [
            'id' => (int) $cor->id,
            'cor_nome' => (string) $cor->cor_nome,
            'cor_hex_especial' => (string) $cor->cor_hex_especial,
        ];
    }
}
