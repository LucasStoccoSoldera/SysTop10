<?php

namespace App\Transformers;

use App\Models\Logistica;
use League\Fractal\TransformerAbstract;

class LogisticaTransformer extends TransformerAbstract
{
    /**
     * @param \App\Models\Logistica $logistica
     * @return array
     */
    public function transformLogistica(Logistica $logistica)
    {
        $rota = "`{{route('admin.delete.logistica')}}`";
        return [
            'id' => (int) $logistica->id,
            'pac_descricao' => $logistica->pac_descricao,
            'trans_descricao' => $logistica->trans_descricao,
            'action' => '<a href="#" class="btn btn-primary alter" data-id="'.$logistica->id.'"><i
            class="tim-icons icon-pencil"></i></a>

            <button type="button" class="btn btn-primary red" id="excluir-log"
            name="excluir-logistica"
             onclick="excluir('.$logistica->id.', ' . $rota . ');"><i
            class="tim-icons icon-simple-remove"></i></button>',
        ];
    }

}
