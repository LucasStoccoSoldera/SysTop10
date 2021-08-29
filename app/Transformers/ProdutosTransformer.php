<?php

namespace App\Transformers;

use App\Models\Produto;
use League\Fractal\TransformerAbstract;

class ProdutosTransformer extends TransformerAbstract
{
    /**
     * @param \App\Models\Produto $produto
     * @return array
     */
    public function transformProduto(Produto $produto)
    {
        return [
            'id' => (int) $produto->id,
            'pro_nome' => $produto->pro_nome,
            'tpp_id' => (int) $produto->tpp_id,
            'pro_pedidominimo' => (int) $produto->pro_pedidominimo,
            'pro_precovenda' => (string) $produto->pro_precovenda,
        ];
    }
}
