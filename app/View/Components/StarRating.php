<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StarRating extends Component
{
    public $rating;

    public function __construct($rating)
    {
        $this->rating = $rating;
    }

    public function render()
    {
        return view('components.star-rating');
    }

    public function getFilledStars()
    {
        return floor($this->rating);
    }

    public function getHalfStar()
    {
        return $this->rating - floor($this->rating) >= 0.5 ? 1 : 0;
    }

    public function getEmptyStars()
    {
        return 5 - ($this->getFilledStars() + $this->getHalfStar());
    }
}
