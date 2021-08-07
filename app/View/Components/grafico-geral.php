<?php

namespace App\View\Components;

use Illuminate\View\Component;

class grafico_geral extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $gTitulo;
    public $gSubtitulo;
    public $prof1;
    public $prof2;
    public $prof3;
    public $prof4;

    public function __construct($gTitulo, $gSubtitulo, $prof1, $prof2, $prof3, $prof4)
    {
        $this->gTitulo = $gTitulo;
        $this->gSubtitulo = $gSubtitulo;
        $this->prof1 = $prof1;
        $this->prof2 = $prof2;
        $this->prof3 = $prof3;
        $this->prof4 = $prof4;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.grafico-geral');
    }
}
