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
            'pac_dimensao' => (string) $pacote->id,
            'pac_descricao' => $pacote->id,
        ];
    }
}
