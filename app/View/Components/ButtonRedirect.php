<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ButtonRedirect extends Component
{
    public $text;
    public $class;
    public $route;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($text,$route,$class = '')
    {
        $this->text  = $text;
        $this->class = $class;
        $this->route = $route;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.button-redirect');
    }
}
