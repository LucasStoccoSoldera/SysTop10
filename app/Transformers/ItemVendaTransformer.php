<?php

namespace App\Transformers;

use App\Models\Venda_Detalhe;
use League\Fractal\TransformerAbstract;

class ItemVendaTransformer extends TransformerAbstract
{

    /**
     * @param \App\Models\Venda_Detalhe $ItemVenda
     * @return array
     */
    public function transform(Venda_Detalhe $ItemVenda)
    {
        return [
            'id' => (int) $ItemVenda->id,
            'pro_id' => (int) $ItemVenda->pro_id,
            'det_qtde' => $ItemVenda->det_qtde,
            'det_valor_total' => (string) $ItemVenda->det_valor_total,
        ];
    }
}
