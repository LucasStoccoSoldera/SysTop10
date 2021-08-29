<?php

namespace App\Transformers;

use App\Models\Venda;
use League\Fractal\TransformerAbstract;

class VendasTransformer extends TransformerAbstract
{
    /**
     * @param \App\Models\Venda $vendas
     * @return array
     */
    public function transformVenda(Venda $venda)
    {
        return [
            'id' => (int) $venda->id,
            'ven_valor_total' => (string) $venda->ven_valor_total,
            'tpg_id' => (int) $venda->tpg_id,
            'ven_status' => $venda->ven_status,
            'ven_data' => (string) $venda->ven_data,
        ];
    }
}
