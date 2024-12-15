@extends('frontend.layouts.main')

@php
    $seo = $item->seo ?? null;
@endphp

@section('content')
    <div class="location-banner1">
        <div class="container-Fluid">
            <div class="location-banner1__img">
                <img data-src="{{ asset($item->featured_image ?? 'assets/images/placeholder.png') }}"
                    alt='{{ $item->featured_image_alt_text }}' class='imgFluid lazy' loading='lazy'>
            </div>
        </div>
    </div>

    <div class="location1-content__section pt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="location1-content__section--details">
                        <div class="location1-content__section--heading">
                            <h2>
                                {{ $item->name }}
                            </h2>

                        </div>
                        <div class="location1-content__section--pra editor-content">
                            {!! $item->content !!}
                        </div>
                        <a class="location1-content__section--btn">
                            <button class="app-btn">
                                Best Things to Do
                                <i class='bx bx-right-arrow-alt'></i>
                            </button>

                        </a>

                    </div>


                </div>
                <div class="col-md-5">
                    <div class="loaction-guide">
                        <div class="loaction-guide-content">
                            <div class="loaction-guide-heading">
                                Guide
                            </div>
                            <div class="loaction-guide-title">
                                Plan your trip with Guide, an AI travel planner!

                            </div>
                            <div class="loaction-guide-pra">
                                Create a personalized trip itinerary in seconds using artificial intelligence.
                            </div>
                            <div class="loaction-guide-btn">
                                <a href="">
                                    <button class="themeBtn-round">Create a trip</button>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($tours->isNotEmpty())
        <div class="section-padding">
            <div class="container">
                <div class="top-picks-experts__heading">
                    <div class="section-content">
                        <h2 class="subHeading">
                            {{ $tours->count() }} best things to do in {{ $item->name }}
                        </h2>
                    </div>
                </div>
                <div class="row four-items-slider pt-3">
                    @foreach ($tours as $tour)
                        <div class="col">
                            <div class=card-content>
                                <a href={{ route('tours.details', $tour->slug) }} class=card_img>
                                    <img data-src={{ asset($tour->featured_image ?? 'admin/assets/images/placeholder.png') }}
                                        alt="{{ $tour->featured_image_alt_text ?? 'image' }}" class="imgFluid lazy"
                                        loading="lazy">
                                    <div class=price-details>
                                        <div class=price>
                                            <span>
                                                Top pick
                                            </span>
                                        </div>
                                        <div class=heart-icon>
                                            <div class=service-wishlis>
                                                <i class="bx bx-heart"></i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <div class=tour-activity-card__details>
                                    <div class=vertical-activity-card__header>
                                        @if ($tour->category)
                                            <div><span> {{ $tour->category->name }}</span></div>
                                        @endif
                                        <div class="tour-activity-card__details--title">{{ $tour->title }}</div>
                                    </div>
                                    <div class=card-rating>
                                        <i class="bx bxs-star yellow-star"></i>
                                        <i class="bx bxs-star yellow-star"></i>
                                        <i class="bx bxs-star yellow-star"></i>
                                        <i class="bx bxs-star yellow-star"></i>
                                        <i class="bx bxs-star"></i>
                                        <span>1 Reviews</span>
                                    </div>
                                    <div class="baseline-pricing__value baseline-pricing__value--high">
                                        <p class=baseline-pricing__from>
                                            <span class="baseline-pricing__from--text receive">Receive voucher
                                                instantly</span>
                                        </p>
                                    </div>
                                    <div class="baseline-pricing__value baseline-pricing__value--high">
                                        <p class=baseline-pricing__from>
                                            <span class=baseline-pricing__from--text>From </span>
                                            <span class="baseline-pricing__from--value green">
                                                {{ formatPrice($tour->regular_price) }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    @if ($tours->isNotEmpty())
        <div class="container">
            <div class="top-picks-experts__heading">
                <div class="section-content text-center">
                    <h2 class="subHeading">
                        Book popular activities in {{ $item->name }}
                    </h2>
                </div>
            </div>
            <div class="row three-items-slider pt-3">
                @foreach ($tours as $tour)
                    <div class="col">
                        <div class=card-content>
                            <a href=# class=card_img>
                                <img data-src={{ asset($tour->featured_image ?? 'admin/assets/images/placeholder.png') }}
                                    alt="{{ $tour->featured_image_alt_text ?? 'image' }}" class="imgFluid lazy"
                                    loading="lazy">
                                <div class=price-details>
                                    <div class=heart-icon>
                                        <div class=service-wishlis>
                                            <i class="bx bx-heart"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <div class=tour-activity-card__details>
                                <div class=vertical-activity-card__header>
                                    <div><span> From {{ formatPrice($tour->regular_price) }}
                                        </span></div>
                                    <div class="tour-activity-card__details--title">
                                        {{ $tour->title }}
                                    </div>
                                </div>
                                <div class=tour-activity__RL>
                                    <div class=card-rating>
                                        <i class="bx bxs-star"></i>
                                        <span>5.0 1 Rating</span>
                                    </div>
                                    <div data-tooltip="tooltip" title="{{ $tour->cities->pluck('name')->implode(', ') }}"
                                        class=card-location>
                                        <i class="bx bx-location-plus"></i>
                                        {{ $tour->cities[0]->name }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif



    @if ($relatedCities->isNotEmpty())
        <div class="location1-beyond section-padding">
            <div class="container">
                <div class="latest-stories__details">
                    <div class="section-content">
                        <h2 class="subHeading">
                            {{ $item->name }} and beyond
                        </h2>
                    </div>
                </div>

                <div class="row pt-3">
                    @foreach ($relatedCities as $city)
                        <div class="col-md-3">
                            <div class="blog-more__dest-content">
                                <div class="location1-beyond__img">
                                    <a href="{{ route('city.details', $city->slug) }}">
                                        <img data-src="{{ asset($city->featured_image ?? 'assets/images/placeholder.png') }}"
                                            alt='{{ $city->featured_image_alt_text }}' class='imgFluid lazy'
                                            loading='lazy'>
                                    </a>
                                </div>
                                <div class="blog-more__dest-title">
                                    {{ $city->name }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
@endsection
