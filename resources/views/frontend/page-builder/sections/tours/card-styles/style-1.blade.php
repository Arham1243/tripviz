<div
    class="row {{ in_array($content->box_type, ['slider_carousel', 'slider_carousel_with_background_color']) ? 'five-items-slider' : 'row-cols-1 row-cols-md-3 row-cols-lg-3 row-cols-xl-5' }}">
    @foreach ($tours as $tour)
        <div class="col">
            <div class=card-content>
                <a href={{ route('tours.details', $tour->slug) }} class=card_img>
                    <img data-src={{ asset($tour->featured_image ?? 'admin/assets/images/placeholder.png') }}
                        alt="{{ $tour->featured_image_alt_text ?? 'image' }}" class="imgFluid lazy" loading="lazy">
                    <div class=price-details>
                        <div class=price>
                            <span>
                                <b>{{ formatPrice($tour->regular_price) }}</b>
                                From
                            </span>
                        </div>
                        <div class=heart-icon>
                            <div class=service-wishlis>
                                <i class="bx bx-heart"></i>
                            </div>
                        </div>
                    </div>
                </a>
                <div class=card-details>
                    <a href=# data-tooltip="tooltip" class=card-title title="{{ $tour->title }}">{{ $tour->title }}</a>
                    @if ($tour->cities->isNotEmpty())
                        <div data-tooltip="tooltip" title="{{ $tour->cities->pluck('name')->implode(', ') }}"
                            class=location-details><i class="bx bx-location-plus"></i>
                            {{ $tour->cities[0]->name }}
                        </div>
                    @endif
                    <div class=card-rating>
                        <i class="bx bxs-star yellow-star"></i>
                        <i class="bx bxs-star yellow-star"></i>
                        <i class="bx bxs-star yellow-star"></i>
                        <i class="bx bxs-star yellow-star"></i>
                        <i class="bx bxs-star"></i>
                        <span>10 Reviews</span>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
