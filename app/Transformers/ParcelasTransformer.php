<?php

namespace App\Transformers;

use App\Models\Parcelas;
use League\Fractal\TransformerAbstract;

class ParcelasTransformer extends TransformerAbstract
{
    /**
     * @param \App\Models\Parcelas $parcelas
     * @return array
     */
    public function transform(Parcelas $parcelas)
    {
        return [
            'par_numero' => (int) $parcelas->par_numero,
            'par_conta' => (int) $parcelas->par_conta,
            'tpg_id' => (int) $parcelas->tpg_id,
            'par_valor' => (string) $parcelas->par_valor,
            'par_status' => $parcelas->par_status,
        ];
    }
}
