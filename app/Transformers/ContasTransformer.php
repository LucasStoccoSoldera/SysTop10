<?php

namespace App\Transformers;

use App\Models\Contas_a_Pagar;
use League\Fractal\TransformerAbstract;

class ContasTransformer extends TransformerAbstract
{
    /**
     * @param \App\Models\Contas_a_Pagar $contas
     * @return array
     */
    public function transformConta(Contas_a_Pagar $contas)
    {
        return [
            'con_descricao' => $contas->con_descricao,
            'con_valor_final' => (string) $contas->con_valor_final,
            'cc_id' => (int) $contas->cc_id,
            'con_data_venc' => (string) $contas->con_data_venc,
            'con_data_pag' => (string) $contas->con_data_pag,
        ];
    }

}
