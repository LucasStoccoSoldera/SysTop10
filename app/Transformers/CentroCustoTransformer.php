<?php

namespace App\Transformers;

use App\Models\Centro_Custo;
use League\Fractal\TransformerAbstract;

class CentroCustoTransformer extends TransformerAbstract
{
    /**
     * @param \App\Models\Centro_Custo $centro_custo
     * @return array
     */
    public function transform(Centro_Custo $centro_Custo)
    {
        return [
            'cc_descricao' => $centro_Custo->cc_descricao,
        ];
    }
}
