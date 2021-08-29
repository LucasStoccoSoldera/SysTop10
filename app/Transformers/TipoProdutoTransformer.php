<?php

namespace App\Transformers;

use App\Models\TipoProduto;
use League\Fractal\TransformerAbstract;

class TipoProdutoTransformer extends TransformerAbstract
{

    /**
     * @param \App\Models\TipoProduto $tipo
     * @return array
     */
    public function transform(TipoProduto $tipo)
    {
        return [
            'id' => (int) $tipo->id,
            'tpp_descricao' => $tipo->tpp_descricao,
        ];
    }
}
