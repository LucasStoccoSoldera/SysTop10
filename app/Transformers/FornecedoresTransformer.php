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
            'for_nome' => $fornecedores->for_nome,
            'for_cpf_cnpj' => (string) $fornecedores->for_cpf_cnpj,
            'for_telefone' => (string) $fornecedores->for_telefone,
            'for_cidade' => $fornecedores->for_cidade,
        ];
    }
}
