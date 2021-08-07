<?php

namespace App\View\Components;

use Illuminate\View\Component;

class bloco_tabela extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $col01;
    public $col02;
    public $col03;
    public $col04;
    public $lineCol01;
    public $lineCol02;
    public $lineCol03;
    public $lineCol04;

    public function __construct($col01, $col02, $col03, $col04, $lineCol01, $lineCol02, $lineCol03, $lineCol04)
    {
        $this->col01 = $col01;
        $this->col02 = $col02;
        $this->col03 = $col03;
        $this->col04 = $col04;
        $this->lineCol01 = $lineCol01;
        $this->lineCol02 = $lineCol02;
        $this->lineCol03 = $lineCol03;
        $this->lineCol04 = $lineCol04;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.bloco-tabela');
    }
}
