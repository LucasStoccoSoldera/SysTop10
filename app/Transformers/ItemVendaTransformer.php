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
            'pro_nome' => (int) $ItemVenda->pro_nome,
            'det_qtde' => $ItemVenda->det_qtde,
            'det_valor_total' => (string) $ItemVenda->det_valor_total,
            'action' => '<a href="#" class="btn btn-primary alter-min" data-id="'.$ItemVenda->id.'"><i
            class="tim-icons icon-pencil"></i></a>

            <button type="button" class="btn btn-primary red-min" id="excluir-deta"
            name="excluir-itemvendaa" data-id="'.$ItemVenda->id.'" data-rota="'. route('admin.delete.itemvenda') .'"
            onclick="excluir();"><i
            class="tim-icons icon-simple-remove"></i></button>'
        ];
    }
}
