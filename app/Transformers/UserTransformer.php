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
        return [
            'id' => (int) $user->id,
            'usu_nome_completo' => $user->usu_nome_completo,
            'usu_usuario' => $user->usu_usuario,
            'car_descricao' => $user->car_descricao,
            'usu_celular' => (string) $user->usu_celular,
            'usu_data_cadastro' => (string) $user->usu_data_cadastro,
            'action' => '<a href="#" class="btn btn-primary alter" data-id="'.$user->id.'"><i class="tim-icons icon-pencil"></i></a>

            <button type="button" class="btn btn-primary red" id="excluir-usu"
            name="excluir-user" data-id="'.$user->id.'" data-rota="'. route('admin.delete.user') .'"
            onclick="excluir();"><i class="tim-icons icon-simple-remove"></i></button>'
        ];
    }

}
