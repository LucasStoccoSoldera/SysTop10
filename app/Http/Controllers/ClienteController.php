<?php

namespace App\Http\Controllers;

use App\Models\Cliente;

class ClienteController extends Controller
{

    public function Cliente(){

        $dado1 = Cliente::count();
        $dado2 = Cliente::count();
        $dado3 = Cliente::count();

        $data = Cliente::limit(25)->get();

 //     public function validaCEP($cep){

 //         // Extrai somente os números
 //         $cep = preg_replace( '/[^0-9]/', '', $cep );

 //          // Verifica se foi informado todos os digitos corretamente
 //         if (strlen($cep) != 11) {
 //             return false;
 //         }


 //          // WebService de verificação que retorna XML
 //          // $url = "viacep.com.br/ws/$cep/xml/";

 //          // $xml = simplexml_load_file($url);
 //          // return $xml;
 //     }


        return view('dashboard.clientes', [

            'dado1' => $dado1,
            'dado2' => $dado2,
            'dado3' => $dado3,
            'clientes' => $data
        ]);
    }
}
