<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SeoTags extends Component
{
    public $seo;

    public function __construct($seo)
    {
        $this->seo = $seo;
    }

    public function render()
    {
        return view('components.seo-tags');
    }
}
