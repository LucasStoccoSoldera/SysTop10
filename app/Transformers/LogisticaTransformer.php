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
        return [
            'id' => (int) $logistica->id,
            'log_pacote' => $logistica->log_pacote,
            'log_transportadora' => $logistica->log_transportadora,
        ];
    }

}
