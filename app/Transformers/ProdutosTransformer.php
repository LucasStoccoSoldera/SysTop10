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
            'tpp_descricao' => $produto->tpp_descricao,
            'pro_precocusto' => (string) $produto->pro_precocusto,
            'pro_precovenda' => (string) $produto->pro_precovenda,
            'action' => '<button type="button" class="btn btn-primary visu" id="visu-pro"
            name="visu-produto"
            onclick="visualizar('.$produto->id.');"><i
            class="tim-icons icon-chart-pie-36"></i></button>

            <a class="btn btn-primary alter-min" data-id= '.$produto->id.'"><i
            class="tim-icons icon-pencil" onclick="edit.editProduto('.$produto->id.');"></i></a>

           <button type="button" class="btn btn-primary red-min" id="excluir-pro"
            name="excluir-produto"
            onclick="excluir('.$produto->id.', ' . $rota . ');"><i
            class="tim-icons icon-simple-remove"></i></button>',
        ];
    }
}
