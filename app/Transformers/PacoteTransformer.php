<?php

namespace App\Transformers;

use App\Models\Pacote;
use League\Fractal\TransformerAbstract;

class PacoteTransformer extends TransformerAbstract
{

    /**
     * @param \App\Models\Pacote $pacote
     * @return array
     */
    public function transform(Pacote $pacote)
    {
        return [
            'id' => (int) $pacote->id,
            'trans_nome' => $pacote->trans_nome,
            'trans_telefone' => (string) $pacote->trans_telefone,
            'trans_limite_transporte' => (int) $pacote->trans_limite_transporte,
        ];
    }
}
