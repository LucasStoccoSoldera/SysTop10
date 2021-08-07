<?php

namespace App\View\Components;

use Illuminate\View\Component;

class bloco_resumo extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */


     public  $dado1;
     public  $dado2;
     public  $dado3;

    public function __construct($dado1, $dado2, $dado3)
    {
        $this->dado1 = $dado1;
        $this->dado2 = $dado2;
        $this->dado3 = $dado3;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.bloco-resumo');
    }
}
