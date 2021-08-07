<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class RuleTelefone implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->validaTelefone($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Telefone informado inválido';
    }

    public function validaTelefone($telefone){
        // Extrai somente os números
        $telefone = preg_replace( '/[^0-9]/is', '', $telefone );

        // Verifica se foi informado todos os digitos corretamente
        if (strlen($telefone) != 11) {
            return false;
        }
    }
}
