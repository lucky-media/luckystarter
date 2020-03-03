<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component
{
    public $name;
    public $type;
    public $required;
    public $label;

    /**
     * Create a new component instance.
     *
     * @param $name
     * @param $type
     * @param $required
     */
    public function __construct($name, $type, $required, $label)
    {
        $this->name = $name;
        $this->type = $type;
        $this->required = $required;
        $this->label = $label;
    }

    /**
     * Return a capital letter from name
     *
     */
    public function capital()
    {
        return ucfirst($this->label);
    }

    /**
     * Check if its required or not
     *
     */
    public function isRequired()
    {
        if ($this->required === 'true')
        {
            return 'required';
        }

        return '';
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.input');
    }
}
