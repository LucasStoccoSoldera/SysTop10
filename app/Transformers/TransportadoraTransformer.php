<?php

namespace App\Transformers;

use App\Models\Transportadora;
use League\Fractal\TransformerAbstract;

class TransportadoraTransformer extends TransformerAbstract
{
    /**
     * @param \App\Models\Transportadora $transportadora
     * @return array
     */
    public function transform(Transportadora $transportadora)
    {
        return [
            'id' => (int) $transportadora->id,
            'log_pacote' => $transportadora->log_pacote,
            'log_transportadora' => $transportadora->log_transportadora,
        ];
    }
}
