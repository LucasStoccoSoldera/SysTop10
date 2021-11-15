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
    public function transform(Produto $produto)
    {
        $rota =  "'" . route('admin.delete.produto') . "'";
        return [
            'id' => (int) $produto->id,
            'pro_nome' => $produto->pro_nome,
            'tpp_descricao' => $produto->tipoproduto_produto->tpp_descricao,
            'pro_precocusto' => (string) $produto->pro_precocusto,
            'pro_precovenda' => (string) $produto->pro_precovenda,
            'action' => '
            <a class="btn btn-primary alter" data-id= '.$produto->id.'"><i
            class="tim-icons icon-pencil" onclick="editProduto('.$produto->id.');"></i></a>

           <button type="button" class="btn btn-primary red" id="excluir-pro"
            name="excluir-produto"
            onclick="excluir('.$produto->id.', ' . $rota . ');"><i
            class="tim-icons icon-simple-remove"></i></button>',
        ];
    }
}
