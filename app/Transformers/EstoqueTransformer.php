<?php

namespace App\Transformers;

use App\Models\Estoque;
use League\Fractal\TransformerAbstract;

class EstoqueTransformer extends TransformerAbstract
{
    /**
     * @param \App\Models\Estoque $estoque
     * @return array
     */
    public function transformEstoque(Estoque $estoque)
    {
        return [
            'pro_id' => (int) $estoque->pro_id,
            'est_qtde' => $estoque->est_qtde,
            'dim_id' => (int) $estoque->dim_id,
            'cor_id' => (int) $estoque->cor_id,
            'est_status' => $estoque->est_status,
            'created_at' => (string) $estoque->created_at,
        ];
    }
}
