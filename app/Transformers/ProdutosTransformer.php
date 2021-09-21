<?php

namespace App\Transformers;

use App\Models\Produto;
use League\Fractal\TransformerAbstract;

class ProdutosTransformer extends TransformerAbstract
{
    /**
     * @param \App\Models\Produto $produto
     * @return array
     */
    public function transformProduto(Produto $produto)
    {
        return [
            'id' => (int) $produto->id,
            'pro_nome' => $produto->pro_nome,
            'tpp_descricao' => (int) $produto->tpp_descricao,
            'pro_precovenda' => (string) $produto->pro_precovenda,
            'action' => '<button type="button" class="btn btn-primary visu" id="visu-pro"
            name="visu-produto" data-id="'.$produto->id.'"
           ><i
            class="tim-icons icon-chart-pie-36"></i></button>

            <a href="#" class="btn btn-primary alter-min" data-id= '.$produto->id.'"><i
            class="tim-icons icon-pencil"></i></a>

           <button type="button" class="btn btn-primary red-min" id="excluir-pro"
            name="excluir-produto" data-id="'.$produto->id.'" data-rota="'. route('admin.delete.produto') .'"
           ><i
            class="tim-icons icon-simple-remove"></i></button>',
        ];
    }
}
