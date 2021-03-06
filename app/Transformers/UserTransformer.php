<?php

namespace App\Transformers;

use App\Models\Usuario;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    /**
     * @param \App\Models\Usuario $Usuario
     * @return array
     */
    public function transform(Usuario $user)
    {
        $rota =  "'" . route('admin.delete.user') . "'";
        return [
            'id' => (int) $user->id,
            'usu_nome_completo' => $user->usu_nome_completo,
            'usu_usuario' => $user->usu_usuario,
            'car_descricao' => $user->cargo->car_descricao,
            'usu_celular' => (string) $user->usu_celular,
            'usu_data_cadastro' => (string) $user->usu_data_cadastro,
            'action' => '<a class="btn btn-primary alter" onclick="editUser('.$user->id.');"><i class="tim-icons icon-pencil"></i></a>

            <button type="button" class="btn btn-primary red" id="excluir-usu"
            name="excluir-user"
             onclick="excluir('.$user->id.', ' . $rota . ');"><i class="tim-icons icon-simple-remove"></i></button>'
        ];
    }

}
