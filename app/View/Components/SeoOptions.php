<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SeoOptions extends Component
{
    public $seo;

    public $resource;

    public $slug;

    public function __construct($seo = null, $resource = null, $slug = null)
    {
        $this->seo = $seo;
        $this->resource = $resource;
        $this->slug = $slug;
    }

    public function render()
    {
        return view('components.seo-options');
    }
}
