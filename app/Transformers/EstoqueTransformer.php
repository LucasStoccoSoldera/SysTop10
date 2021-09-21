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
            'dim_descricao' => (int) $estoque->dim_descricao,
            'cor_nome' => (int) $estoque->cor_nome,
            'created_at' => (string) $estoque->created_at,
            'action' => '<a href="#" class="btn btn-primary alter" data-id=" '.$estoque->id.' "><i
            class="tim-icons icon-pencil"></i></a>'
        ];
    }
}
