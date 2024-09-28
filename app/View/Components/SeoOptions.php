<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SeoOptions extends Component
{
    public $seo;

    public function __construct($seo = null)
    {
        $this->seo = $seo;
    }

    public function render()
    {
        return view('components.seo-options');
    }
}
