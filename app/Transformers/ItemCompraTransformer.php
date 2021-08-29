<?php

namespace App\Transformers;

use App\Models\Compras_Detalhe;
use League\Fractal\TransformerAbstract;

class ItemCompraTransformer extends TransformerAbstract
{

    /**
     * @param \App\Models\Compras_Detalhe $ItemCompra
     * @return array
     */
    public function transform(Compras_Detalhe $ItemCompra)
    {
        return [
            'cde_produto' => (int) $ItemCompra->id,
            'cde_qtde' => $ItemCompra->id,
            'valor_unitario' => (string) $ItemCompra->id,
            'valor_final' => (string) $ItemCompra->id,
        ];
    }
}
