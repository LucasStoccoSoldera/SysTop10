<?php

namespace App\Transformers;

use App\Models\TipoPagto;
use League\Fractal\TransformerAbstract;

class TipoPagtoTransformer extends TransformerAbstract
{

    /**
     * @param \App\Models\TipoPagto $tpgpagto
     * @return array
     */
    public function transform(TipoPagto $tpgpagto)
    {
        return [
            'tpg_descricao' => $tpgpagto->tpg_descricao,
        ];
    }
}
