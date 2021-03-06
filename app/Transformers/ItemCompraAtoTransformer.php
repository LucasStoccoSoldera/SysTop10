<?php

namespace App\Transformers;

use App\Models\Compras_Detalhe;
use League\Fractal\TransformerAbstract;

class ItemCompraAtoTransformer extends TransformerAbstract
{

    /**
     * @param \App\Models\Compras_Detalhe $ItemCompra
     * @return array
     */
    public function transform(Compras_Detalhe $ItemCompra)
    {
        $rota = "'" . route('admin.delete.itemcompra') . "'";
        return [
            'cde_produto' => $ItemCompra->cde_produto,
            'cde_qtde' => $ItemCompra->cde_qtde,
            'cde_valoritem' => (string) $ItemCompra->cde_valoritem,
            'cde_valortotal' => (string) $ItemCompra->cde_valortotal,
            'action' => '<a class="btn btn-primary alter-min"><i
            class="tim-icons icon-pencil" onclick="editItemCompra('.$ItemCompra->id.');"></i></a>

            <button type="button" class="btn btn-primary red-min" id="excluir-cde"
            name="excluir-itemcompra"
             onclick="excluir('.$ItemCompra->id.', ' . $rota . ');"><i
            class="tim-icons icon-simple-remove"></i></button>'
        ];
    }
}
