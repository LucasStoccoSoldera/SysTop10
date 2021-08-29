<?php

namespace App\Transformers;

use App\Models\Cliente;
use League\Fractal\TransformerAbstract;

class ClienteTransformer extends TransformerAbstract
{
    /**
     * @param \App\Models\Cliente $cliente
     * @return array
     */
    public function transform(Cliente $cliente)
    {
        return [
            'cli_nome' => $cliente->cli_nome,
            'cli_cpf_cnpj' => $cliente->cli_cpf_cnpj,
            'cli_celular' => $cliente->cli_celular,
            'cli_cidade' => $cliente->cli_cidade,
            'created_at' => $cliente->created_at,
        ];
    }
}
