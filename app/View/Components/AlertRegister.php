<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AlertRegister extends Component
{

    public $msgRegistrar;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($msgRegistrar)
    {
       $this->msgRegistrar = $msgRegistrar;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.alert-register');
    }
}
