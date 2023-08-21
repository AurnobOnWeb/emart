<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Textarea extends Component
{
    public $name;
    public $ph;
    public $label;
    public $val;
    public $require;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct( $label,$ph,$name,$val, $require)
    {
        $this->name =$name;
        $this->ph =$ph;
        $this->label =$label;
        $this->val =$val;
        $this->require = $require;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.textarea');
    }
}
