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
            'trans_nome' => $transportadora->trans_nome,
            'trans_telefone' => (string) $transportadora->trans_telefone,
            'trans_limite_transporte' => (int) $transportadora->trans_limite_transporte,
        ];
    }
}
