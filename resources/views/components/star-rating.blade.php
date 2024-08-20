@php
    $filledStars = $getFilledStars();
    $halfStar = $getHalfStar();
    $emptyStars = $getEmptyStars();
@endphp

@for ($i = 0; $i < $filledStars; $i++)
    <i class="bx bxs-star yellow-star"></i>
@endfor

@if ($halfStar)
    <i class="bx bxs-star-half yellow-star"></i>
@endif

@for ($i = 0; $i < $emptyStars; $i++)
    <i class="bx bx-star yellow-star"></i>
@endfor