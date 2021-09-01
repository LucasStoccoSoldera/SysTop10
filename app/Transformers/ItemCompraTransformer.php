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
            'cde_produto' => (int) $ItemCompra->cde_produto,
            'cde_qtde' => $ItemCompra->cde_qtde,
            'cde_valoritem' => (string) $ItemCompra->cde_valoritem,
            'cde_valortotal' => (string) $ItemCompra->cde_valortotal,
        ];
    }
}
