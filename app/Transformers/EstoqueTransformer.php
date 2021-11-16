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
            'dim_descricao' => $estoque->dimensoes_estoque->dim_descricao,
            'cor_nome' => $estoque->cores_estoque->cor_nome,
            'est_data' => (string) $estoque->est_data,
            'est_time' => (string) $estoque->est_time,
            'action' => '<a class="btn btn-primary alter"><i
            class="tim-icons icon-pencil" onclick="demoeditEstoque('.$estoque->id.');"></i></a>'
        ];
    }
}
