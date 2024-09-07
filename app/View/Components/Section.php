<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Section extends Component
{
    public $section;

    /**
     * Create a new component instance.
     */
    public function __construct($section)
    {
        $this->section = $section;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        if ($this->section === null) {
            return null;
        }

        $view = 'components.sections.'.$this->section->section_name;

        return view($view, ['section' => $this->section]);
    }
}
