<?php

namespace App\Transformers;

use App\Models\Venda;
use League\Fractal\TransformerAbstract;

class VendasTransformer extends TransformerAbstract
{
    /**
     * @param \App\Models\Venda $vendas
     * @return array
     */
    public function transformVenda(Venda $venda)
    {
        return [
            'id' => (int) $venda->id,
            'cli_nome' => (int) $venda->cli_nome,
            'ven_valor_total' => (string) $venda->ven_valor_total,
            'ven_status' => $venda->ven_status,
            'ven_parcelas' => $venda->ven_parcelas,
            'ven_data' => (string) $venda->ven_data,
            'action' => '<button type="button" class="btn btn-primary visu" id="visu-pro"
            name="visu-produto" data-id="'.$venda->id.'"
           ><i
            class="tim-icons icon-chart-pie-36"></i></button>

            <a href="#" class="btn btn-primary alter-min" data-id= '.$venda->id.'"><i
            class="tim-icons icon-pencil"></i></a>

           <button type="button" class="btn btn-primary red-min" id="excluir-ven"
            name="excluir-venda" data-id="'.$venda->id.'" data-rota="'. route('admin.delete.venda') .'"
            onclick="excluir();"><i
            class="tim-icons icon-simple-remove"></i></button>',
        ];
    }
}
