@extends('frontend.layouts.main')

@php
    $seo = $item->seo ?? null;
@endphp

@section('content')
    <div class="header-form" id="tour-listing.php">
        <div class="container">
            <div class="row">
                <div class="for-generic ">
                    <form action="#" class="input-details generic-form">
                        <i class='bx bx-search'></i>
                        <input type="text" name="" placeholder="Search generic "
                            class="mobile-number-app app-input">
                        <button class="app-btn themeBtn">SEND</button>
                    </form>
                </div>
            </div>


            <div class="header-form__banner mt-5">
                <div class="row">
                    <div class="col-md-8">
                        <div class="header-form__title header-banner__heading">

                            <h1 class="banner-heading banner-alt-heading">
                                {{ explode(' ', $item->name)[0] }}
                                <div class="bannerMain-title">{{ implode(' ', array_slice(explode(' ', $item->name), 1)) }}
                                </div> <!-- Rest of the name -->
                            </h1>
                            <div class="highlights-item__container">
                                <div class="highlights-item__icon">
                                    <i class='bx bxs-purchase-tag-alt'></i>
                                </div>
                                <div class="highlights-item__pra">
                                    <p>Booked 3,000+ times last week</p>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="header-form__img">
                            <img data-src={{ asset($item->featured_image ?? 'admin/assets/images/placeholder.png') }}
                                alt="{{ $item->featured_image_alt_text ?? 'image' }}" class="imgFluid lazy" loading="lazy">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($featuredTours->isNotEmpty())
        <div class="section-padding">

            <div class="container">
                <div class="activity-sorting-block">
                    <div class="search-header__activity">
                        <div class="activities-found">
                            {{ $totalActivities }} activities found
                            <div class="activities-found__icon">
                                <i class='bx bxs-error-circle'></i>
                            </div>

                        </div>

                        {{-- <div class="sort-by">
                            <div class="sort-by__title">
                                Sort by :
                            </div>
                            <label class="dropdown-label">
                                <select class="dropdown-select">
                                    <option value="recommended">Recommended</option>
                                </select>
                            </label>
                        </div> --}}
                    </div>
                </div>
                <div class="row">
                    @foreach ($featuredTours as $tour)
                        <div class="col-md-3">
                            <div class=card-content>
                                <a href=# class=card_img>
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
                                        @else
                                            <div><span> {{ $item->name }}</span></div>
                                        @endif
                                        <div data-tooltip="tooltip" title="{{ $tour->title }}"
                                            class="tour-activity-card__details--title text-truncate">{{ $tour->title }}
                                        </div>
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

    <div class="offers-section">
        <div class="container">
            <div class="offers-section__details">
                <div class="offers-section__img">
                    <img src='{{ asset('assets/images/group_tour_desktop_banner_image.webp') }}' alt='image'
                        class='imgFluid' loading='lazy'>
                </div>
                <div class="GroupTourCard_content">
                    <span class="GroupTourCard_title">Bigger Group? Get special offers up to 50% Off!</span>
                    <span class="GroupTourCard_subtitle">We create unforgettable adventures, customised for your
                        group.</span>
                    <div class="GroupTourCard_callBackButton">
                        <span class="GroupTourCard_text app-btn themeBtn">Get A Callback</span>
                    </div>
                </div>
            </div>

        </div>
    </div>


    @if ($bottomFeaturedTours->isNotEmpty())
        <div class="section-padding">
            <div class="container">
                <div class="row">
                    @foreach ($bottomFeaturedTours as $tour)
                        <div class="col-md-3">
                            <div class=card-content>
                                <a href=# class=card_img>
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
                                        @else
                                            <div><span> {{ $item->name }}</span></div>
                                        @endif
                                        <div data-tooltip="tooltip" title="{{ $tour->title }}"
                                            class="tour-activity-card__details--title text-truncate">{{ $tour->title }}
                                        </div>
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
                @if ($bottomFeaturedTours->count() > 8)
                    <div class="show-more pt-3">
                        <button type="submit" class="app-btn themeBtn"> See more</button>
                    </div>
                @endif
            </div>
        </div>
    @endif


    @if (!empty($item->tour_count_heading))
        <div class="location-banner">
            <div class="container">
                <div class="location-banner__content">
                    <div class="location-banner__img">
                        <img data-src="{{ asset($item->tour_count_image ?? 'admin/assets/images/placeholder.png') }}"
                            alt="{{ $item->tour_count_image_alt_text ?? 'image' }}" class="imgFluid lazy" loading="lazy">
                    </div>
                    <div class="location-banner-wrapper">
                        <div class="banner-heading">
                            <h1>
                                <div class="bannerMain-title">{{ $item->tour_count_heading ?? '' }}</div>
                            </h1>
                        </div>
                        <a href="{{ sanitizedLink($item->tour_count_btn_link ?? 'javascript:void(0)') }}"
                            class="app-btn themeBtn" type="button">{{ $item->tour_count_btn_text ?? 'Click' }} </a>
                    </div>
                </div>
            </div>
        </div>
    @endif


    @if ($recomTours->isNotEmpty())
        <div class="pt-5">
            <div class="container">
                <div class="section-content">
                    <h2 class="subHeading">
                        Our most recommended {{ $item->name }}
                    </h2>
                </div>

                <div class="row">
                    @foreach ($recomTours as $tour)
                        <div class="col-md-6 mt-4">
                            <div class="highlight">
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="#" class="highlight__image" target="_blank">
                                            <img data-src={{ asset($tour->featured_image ?? 'admin/assets/images/placeholder.png') }}
                                                alt="{{ $tour->featured_image_alt_text ?? 'image' }}"
                                                class="imgFluid lazy" loading="lazy">
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="highlight__text-content">
                                            <div class="highlight__text">
                                                <a href="dubai-l173/burj-khalifa-ticket-t49019/"
                                                    class="highlight__text-link" target="_blank">
                                                    <p class="highlight__title">{{ $tour->title }}</p>
                                                </a>
                                                <div class="highlight__description editor-content">
                                                    {!! $tour->content !!}
                                                </div>
                                            </div>
                                            <div class="highlight__button-wrapper">
                                                <a class="" type="button">
                                                    See more
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <div class="comment">
        <img src="{{ asset('assets/images/comment.webp') }}" alt="image" class="peoples-img imgFluid"
            loading="lazy">
        <div class="ocizgi_imgs">
            <img src="{{ asset('assets/images/ocizgi.webp') }}" alt="image" class="ocizgi imgFluid" loading="lazy">
        </div>
        <div class="container">
            <div class="section-content">
                <h2 class="subHeading">
                    Comment
                </h2>
                <p>What are our customers saying?</p>
            </div>

            <div class="row pt-3">
                <div class="col-md-3">
                    <div class="comment-card">
                        <div class="comment-card__img comment-slider">
                            <img src="{{ asset('assets/images/comment1.webp') }}" alt="image" class="imgFluid">
                            <img src="{{ asset('assets/images/comment2.webp') }}" alt="image" class="imgFluid">
                        </div>
                        <div class="comment-card__content">
                            <div class="comment-details">
                                <div class="customer-name">
                                    neurontnP
                                </div>
                                <div class="card-rating">
                                    <i class="bx bxs-star yellow-star"></i>
                                    <i class="bx bxs-star yellow-star"></i>
                                    <i class="bx bxs-star yellow-star"></i>
                                    <i class="bx bxs-star yellow-star"></i>
                                    <i class="bx bxs-star"></i>
                                </div>
                            </div>
                            <div class="comment-pra">
                                I am not sure where you’re getting your information, but great topic.
                            </div>
                            <button class="app-btn themeBtn">Read</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="comment-card">
                        <div class="comment-card__img comment-slider">
                            <img src="{{ asset('assets/images/comment2.webp') }}" alt="image" class="imgFluid">
                            <img src="{{ asset('assets/images/comment1.webp') }}" alt="image" class="imgFluid">
                        </div>
                        <div class="comment-card__content">
                            <div class="comment-details">
                                <div class="customer-name">
                                    neurontnP
                                </div>
                                <div class="card-rating">
                                    <i class="bx bxs-star yellow-star"></i>
                                    <i class="bx bxs-star yellow-star"></i>
                                    <i class="bx bxs-star yellow-star"></i>
                                    <i class="bx bxs-star yellow-star"></i>
                                    <i class="bx bxs-star"></i>
                                </div>
                            </div>
                            <div class="comment-pra">
                                I am not sure where you’re getting your information, but great topic.
                            </div>
                            <button class="app-btn themeBtn">Read</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="comment-card">
                        <div class="comment-card__img comment-slider">
                            <img src="{{ asset('assets/images/comment3.webp') }}" alt="image" class="imgFluid">
                            <img src="{{ asset('assets/images/comment4.webp') }}" alt="image" class="imgFluid">
                        </div>
                        <div class="comment-card__content">
                            <div class="comment-details">
                                <div class="customer-name">
                                    neurontnP
                                </div>
                                <div class="card-rating">
                                    <i class="bx bxs-star yellow-star"></i>
                                    <i class="bx bxs-star yellow-star"></i>
                                    <i class="bx bxs-star yellow-star"></i>
                                    <i class="bx bxs-star yellow-star"></i>
                                    <i class="bx bxs-star"></i>
                                </div>
                            </div>
                            <div class="comment-pra">
                                I am not sure where you’re getting your information, but great topic.
                            </div>
                            <button class="app-btn themeBtn">Read</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="comment-card">
                        <div class="comment-card__img comment-slider">
                            <img src="{{ asset('assets/images/comment4.webp') }}" alt="image" class="imgFluid">
                            <img src="{{ asset('assets/images/comment3.webp') }}" alt="image" class="imgFluid">
                        </div>
                        <div class="comment-card__content">
                            <div class="comment-details">
                                <div class="customer-name">
                                    neurontnP
                                </div>
                                <div class="card-rating">
                                    <i class="bx bxs-star yellow-star"></i>
                                    <i class="bx bxs-star yellow-star"></i>
                                    <i class="bx bxs-star yellow-star"></i>
                                    <i class="bx bxs-star yellow-star"></i>
                                    <i class="bx bxs-star"></i>
                                </div>
                            </div>
                            <div class="comment-pra">
                                I am not sure where you’re getting your information, but great topic.
                            </div>
                            <button class="app-btn themeBtn">Read</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="newsletter pt-3 pb-5 mb-4">
        <div class=container>
            <div class="row g-0">
                <div class=col-md-6>
                    <div class=newsletter__img>
                        <img src="{{ asset('assets/images/173.webp') }}" alt="image" class="imgFluid"
                            loading="lazy">
                    </div>
                </div>
                <div class=col-md-6>
                    <div class=newsletter__content>
                        <div class=section-content>
                            <h2 class=subHeading>
                                Your Dubai itinerary is waiting.
                            </h2>
                        </div>
                        <p>Receive a curated 48-hour itinerary featuring the most iconic experiences in Dubai, straight to
                            your inbox.

                        </p>
                        <form class=line-form method="POST" action="#">
                            <div class=line-form__input>
                                <input id=email type=email name=email placeholder="Email" required>
                                <i class="bx bx-envelope"></i>
                            </div>
                            <button type=submit class="primary-btn">Sign up</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class=privacy-content>
                <p class="mb-0">By signing up, you agree to receive promotional emails on activities and insider tips.
                    You
                    can
                    unsubscribe or withdraw your consent at any time with future effect. For more information, read our
                    Privacy statement</p>
            </div>
        </div>
    </div>
@endsection
