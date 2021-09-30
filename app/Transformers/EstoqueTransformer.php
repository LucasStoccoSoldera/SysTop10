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
    public function transform(Estoque $estoque)
    {
        return [
            'pro_id' => (int) $estoque->pro_id,
            'est_qtde' => $estoque->est_qtde,
            'dim_descricao' => $estoque->dim_descricao,
            'cor_nome' => $estoque->cor_nome,
            'est_data' => (string) $estoque->est_data,
            'est_time' => (string) $estoque->est_time,
            'action' => '<a href="#" class="btn btn-primary alter" data-id=" '.$estoque->id.' "><i
            class="tim-icons icon-pencil"></i></a>'
        ];
    }
}
