<?php

namespace App\Transformers;

use App\Models\Fornecedores;
use League\Fractal\TransformerAbstract;

class FornecedoresTransformer extends TransformerAbstract
{
    /**
     * @param \App\Models\Fornecedores $fornecedores
     * @return array
     */
    public function transform(Fornecedores $fornecedores)
    {
        return [
            'id' => (int) $fornecedores->id,
            'for_nome' => $fornecedores->id,
            'for_cpf_cnpj' => (string) $fornecedores->id,
            'for_telefone' => (string) $fornecedores->id,
            'for_cidade' => $fornecedores->id,
        ];
    }
}
