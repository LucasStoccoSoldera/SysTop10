<?php

namespace App\Transformers;

use App\Models\Contas_a_Receber;
use League\Fractal\TransformerAbstract;

class ContasaReceberTransformer extends TransformerAbstract
{
    /**
     * @param \App\Models\Contas_a_Receber $contasaReceber
     * @return array
     */
    public function transform(Contas_a_Receber $contasaReceber)
    {
        return [
            'id' => (int) $contasaReceber->id,
            'rec_descricao' => $contasaReceber->rec_descricao,
            'rec_valor' => (string) $contasaReceber->rec_valor,
            'tipo_pagto' => (string) $contasaReceber->tipo_pagto,
            'rec_data' => (string) $contasaReceber->rec_data,
            'rec_status' => $contasaReceber->rec_status,
        ];
    }
}
