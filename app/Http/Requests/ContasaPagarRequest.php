<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContasaPagarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'descricaoContas' => ['required', 'string'],
            'tipoContas' => ['required', 'string'],
            'valorContas' => ['required'],
            'valorfContas' => ['required'],
            'parcelasContas' => ['required', 'integer'],
            'datavContas' => ['required', 'date'],
            'datapContas' => ['date'],
            'tpgpagtoContas' => ['string'],
            'centrocustoContas' => ['required', 'string'],
        ];
    }

    public function message()
    {

        $validacao = [
            'descricaoContas.required',
            'tipoContas.required',
            'valorContas.required',
            'valorfContas.required',
            'parcelasContas.required',
            'datavContas.required',
            'centrocustoContas.required',
        ];

        $mensagem = [
            'descricaoContas.required' => 'Descrição obrigatória.',
            'tipoContas.required' => 'Tipo obrigatório.',
            'valorContas.required' => 'Valor obrigatório.',
            'valorfContas.required' => 'Valor final obrigatório.',
            'parcelasContas.required' => 'Quantidade de parcelas obrigatória.',
            'datavContas.required' => 'Data de vencimento obrigatória.',
            'centrocustoContas.required' => 'Centro de custo obrigatório.',
        ];

        $conta['success'] = false;

        switch($mensagem){

            case $validacao['descricaoContas.required']:
                $conta['message'] = $mensagem['descricaoContas.required'];
                echo json_encode($conta);

                case $validacao['tipoContas.required']:
                    $conta['message'] = 'Descrição obrigatória.';
                    echo json_encode($conta);

                    case $validacao['valorContas.required']:
                        $conta['message'] = $mensagem['tipoContas.required'];
                        echo json_encode($conta);

                        case $validacao['valorfContas.required']:
                            $conta['message'] = $mensagem['valorfContas.required'];
                            echo json_encode($conta);

                            case $validacao['parcelasContas.required']:
                                $conta['message'] = $mensagem['parcelasContas.required'];
                                echo json_encode($conta);

                                case $validacao['datavContas.required']:
                                    $conta['message'] = $mensagem['datavContas.required'];
                                    echo json_encode($conta);
                                    case $validacao['centrocustoContas.required']:
                                        $conta['message'] = $mensagem['centrocustoContas.required'];
                                        echo json_encode($conta);
        }

        return;
    }

}
