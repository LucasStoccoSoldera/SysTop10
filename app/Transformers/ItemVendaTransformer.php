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
        $rota =  "'" . route('admin.delete.itemvenda') . "'";
        return [
            'pro_nome' => $ItemVenda->id,
            'det_qtde' => (int) $ItemVenda->pro_nome,
            'dim_descricao' => $ItemVenda->dim_id,
            'cor_nome' => $ItemVenda->cor_id,
            'det_valor_total' => (string) $ItemVenda->det_valor_total,
            'action' => '<a class="btn btn-primary alter-min" data-id="'.$ItemVenda->id.'"><i
            class="tim-icons icon-pencil" onclick="editItemVenda('.$ItemVenda->id.');"></i></a>

            <button type="button" class="btn btn-primary red-min" id="excluir-deta"
            name="excluir-itemvendaa"
             onclick="excluir('.$ItemVenda->id.', ' . $rota . ');"><i
            class="tim-icons icon-simple-remove"></i></button>'
        ];
    }
}
