<?php

namespace App\View\Components;

use Illuminate\View\Component;

class input extends Component
{
    public $type;
    public $name;
    public $value;
    public $ph;
    public $label;
    public $id;
    public $require;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type,$name,$value,$ph,$label,$id,$require)
    {
        $this->type = $type;
        $this->name = $name;
        $this->value = $value;
        $this->ph = $ph;
        $this->label = $label;
        $this->id = $id;
        $this->require = $require;

        
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input');
    }
}
