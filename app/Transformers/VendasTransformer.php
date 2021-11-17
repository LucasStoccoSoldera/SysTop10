<?php

namespace App\Transformers;

use App\Models\Venda;
use App\Models\Venda_Detalhe;
use League\Fractal\TransformerAbstract;

class VendasTransformer extends TransformerAbstract
{
    /**
     * @param \App\Models\Venda $vendas
     * @return array
     */
    public function transform(Venda $venda)
    {
        $total = Venda_Detalhe::where('ven_id', '=', $venda->id)->sum('det_valor_total');

        $rota =  "'" . route('admin.delete.venda') . "'";
        return [
            'id' => (int) $venda->id,
            'cli_id' => (int) $venda->cli_id,
            'cli_nome' => $venda->cliente_venda->cli_nome,
            'ven_valor_total' => (string) $total,
            'ven_status' => $venda->ven_status,
            'ven_parcelas' => $venda->ven_parcelas,
            'ven_data' => (string) $venda->ven_data,
            'action' => '<button type="button" class="btn btn-primary visu" id="visu-pro"
            name="visu-produto" data-id="'.$venda->id.'"
            onclick="visualizar('.$venda->id.');"><i
            class="tim-icons icon-chart-pie-36"></i></button>

            <a class="btn btn-primary alter-min" onclick="editVenda('.$venda->id.');"><i
            class="tim-icons icon-pencil"></i></a>

           <button type="button" class="btn btn-primary red-min" id="excluir-ven"
            name="excluir-venda"
             onclick="excluir('.$venda->id.', ' . $rota . ');"><i
            class="tim-icons icon-simple-remove"></i></button>',
        ];
    }
}
