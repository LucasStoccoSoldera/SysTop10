<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    /**
     * @param \App\Models\User $user
     * @return array
     */
    public function transformUser(User $user)
    {
        return [
            'id' => (int) $user->id,
            'usu_nome_completo' => $user->usu_nome_completo,
            'car_id' => $user->car_id,
            'usu_telefone' => (string) $user->usu_telefone,
            'usu_data_cadastro' => (string) $user->usu_data_cadastro,
        ];
    }

}
