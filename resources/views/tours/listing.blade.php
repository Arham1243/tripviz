@extends('layouts.main')
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

                <!-- <div class="col-4">
                                                                                                                        <div class="for-dates">
                                                                                                                            <form action="#" class="input-details generic-form"><i class='bx bx-calendar'></i>
                                                                                                                                <input type="text" name="" placeholder="Add Dates" class="mobile-number-app app-input ">
                                                                                                                                <i class='bx bx-chevron-down'></i>
                                                                                                                            </form>
                                                                                                                        </div>
                                                                                                                    </div> -->

            </div>


            <div class="header-form__banner mt-4">
                <div class="row">
                    <div class="col-md-8">
                        <div class="header-form__title header-banner__heading">
                            <div class="banner-heading">
                                <h1>
                                    Dubai
                                    <div class="bannerMain-title">Desert safaris</div>
                                </h1>
                            </div>
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
                            <img src="{{ asset('assets/images/49.webp') }}" alt='image' class='imgFluid' loading='lazy'>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <div class="header-form__bannerBtns">
                                                                                                                    <div class="header-btns mt-4">
                                                                                                                        <div class="currencys">
                                                                                                                            <div class="themeBtn themeBtn-white">Price</div>
                                                                                                                            <div class="themeBtn themeBtn-white">Languages</div>
                                                                                                                            <div class="themeBtn themeBtn-white">Duration</div>
                                                                                                                            <div class="themeBtn themeBtn-white">Time</div>

                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div class="header-btns mt-4">
                                                                                                                        <div class="currencys">
                                                                                                                            <div class="themeBtn themeBtn-white filter-icon">

                                                                                                                                <i class='bx bx-filter'></i>


                                                                                                                                filter
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                  </div>

                                                                                                                </div>
                                                                                                                 -->
            <div class="activity-sorting-block">
                <div class="search-header__activity">
                    <div class="activities-found">
                        {{ count($total_tours) }} activities found
                        <div class="activities-found__icon">
                            <i class='bx bxs-error-circle'></i>
                        </div>

                    </div>

                    <div class="sort-by">
                        <div class="sort-by__title">
                            Sort by :
                        </div>
                        <label class="dropdown-label">
                            <select class="dropdown-select">
                                <option value="recommended">Recommended</option>
                            </select>
                        </label>
                    </div>
                </div>



            </div>

        </div>
    </div>

    <!--<div class="tour-activity__cards">-->
    <!--    <div class="container">-->
    <!--        <div class="row">-->
    <!--            <div class="col-md-3">-->
    <!--                <div class="card-content">-->
    <!--                    <a href="#" class="card_img">-->
    <!--                        <img src="{{ asset('assets/images/132.webp') }}" alt='image' class='imgFluid' loading='lazy'>-->
    <!--                        <div class="price-details">-->
    <!--                            <div class="price">-->
    <!--                                <span>-->
    <!--                                    Top pick-->
    <!--                                </span>-->
    <!--                            </div>-->
    <!--                            <div class="heart-icon">-->
    <!--                                <div class="service-wishlis">-->
    <!--                                    <i class='bx bx-heart'></i>-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </a>-->
    <!--                    <div class="tour-activity-card__details">-->
    <!--                        <div class="vertical-activity-card__header">-->
    <!--                            <div class=""><span>Day trip</span></div>-->
    <!--                            <div class="tour-activity-card__details--title">Dubai: Safari, Quad Bike, Camel Ride, and-->
    <!--                                Buffet Dinner</div>-->
    <!--                        </div>-->





    <!--                        <div class="card-rating">-->
    <!--                            <i class='bx bxs-star yellow-star'></i>-->
    <!--                            <i class='bx bxs-star yellow-star'></i>-->
    <!--                            <i class='bx bxs-star yellow-star'></i>-->
    <!--                            <i class='bx bxs-star yellow-star'></i>-->
    <!--                            <i class='bx bxs-star'></i>-->
    <!--                            <span>1 Reviews</span>-->
    <!--                        </div>-->


    <!--                        <div class="baseline-pricing__value baseline-pricing__value--high">-->
    <!--                            <p class="baseline-pricing__from">-->
    <!--                                <span class="baseline-pricing__from--text">From</span>-->
    <!--                                <span class="baseline-pricing__from--value">$50.77</span>-->
    <!--                            </p>-->
    <!--                        </div>-->
    <!--                        <div class="baseline-pricing__value baseline-pricing__value--low">-->
    <!--                            <p class="baseline-pricing__from">From $33.00</p>-->

    <!--                            <p class="baseline-pricing__category">per person</p>-->
    <!--                        </div>-->

    <!--                    </div>-->



    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="col-md-3">-->
    <!--                <div class="card-content">-->
    <!--                    <a href="#" class="card_img">-->
    <!--                        <img src="{{ asset('assets/images/132 (1).webp') }}" alt='image' class='imgFluid'-->
    <!--                            loading='lazy'>-->
    <!--                        <div class="price-details">-->
    <!--                            <div class="price">-->
    <!--                                <span>-->
    <!--                                    Top pick-->
    <!--                                </span>-->
    <!--                            </div>-->
    <!--                            <div class="heart-icon">-->
    <!--                                <div class="service-wishlis">-->
    <!--                                    <i class='bx bx-heart'></i>-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </a>-->
    <!--                    <div class="tour-activity-card__details">-->
    <!--                        <div class="vertical-activity-card__header">-->
    <!--                            <div class=""><span>Day trip</span></div>-->
    <!--                            <div class="tour-activity-card__details--title">Dubai: Safari, Quad Bike, Camel Ride, and-->
    <!--                                Buffet Dinner</div>-->
    <!--                        </div>-->





    <!--                        <div class="card-rating">-->
    <!--                            <i class='bx bxs-star yellow-star'></i>-->
    <!--                            <i class='bx bxs-star yellow-star'></i>-->
    <!--                            <i class='bx bxs-star yellow-star'></i>-->
    <!--                            <i class='bx bxs-star yellow-star'></i>-->
    <!--                            <i class='bx bxs-star'></i>-->
    <!--                            <span>1 Reviews</span>-->
    <!--                        </div>-->


    <!--                        <div class="baseline-pricing__value baseline-pricing__value--high">-->
    <!--                            <p class="baseline-pricing__from">-->
    <!--                                <span class="baseline-pricing__from--text">From</span>-->
    <!--                                <span class="baseline-pricing__from--value">$50.77</span>-->
    <!--                            </p>-->
    <!--                        </div>-->
    <!--                        <div class="baseline-pricing__value baseline-pricing__value--low">-->
    <!--                            <p class="baseline-pricing__from">From $33.00</p>-->

    <!--                            <p class="baseline-pricing__category">per person</p>-->
    <!--                        </div>-->

    <!--                    </div>-->



    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="col-md-3">-->
    <!--                <div class="card-content">-->
    <!--                    <a href="#" class="card_img">-->
    <!--                        <img src="{{ asset('assets/images/132 (2).webp') }}" alt='image' class='imgFluid'-->
    <!--                            loading='lazy'>-->
    <!--                        <div class="price-details">-->
    <!--                            <div class="price">-->
    <!--                                <span>-->
    <!--                                    Top pick-->
    <!--                                </span>-->
    <!--                            </div>-->
    <!--                            <div class="heart-icon">-->
    <!--                                <div class="service-wishlis">-->
    <!--                                    <i class='bx bx-heart'></i>-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </a>-->
    <!--                    <div class="tour-activity-card__details">-->
    <!--                        <div class="vertical-activity-card__header">-->
    <!--                            <div class=""><span>Day trip</span></div>-->
    <!--                            <div class="tour-activity-card__details--title">Dubai: Safari, Quad Bike, Camel Ride, and-->
    <!--                                Buffet Dinner</div>-->
    <!--                        </div>-->





    <!--                        <div class="card-rating">-->
    <!--                            <i class='bx bxs-star yellow-star'></i>-->
    <!--                            <i class='bx bxs-star yellow-star'></i>-->
    <!--                            <i class='bx bxs-star yellow-star'></i>-->
    <!--                            <i class='bx bxs-star yellow-star'></i>-->
    <!--                            <i class='bx bxs-star'></i>-->
    <!--                            <span>1 Reviews</span>-->
    <!--                        </div>-->


    <!--                        <div class="baseline-pricing__value baseline-pricing__value--high">-->
    <!--                            <p class="baseline-pricing__from">-->
    <!--                                <span class="baseline-pricing__from--text">From</span>-->
    <!--                                <span class="baseline-pricing__from--value">$50.77</span>-->
    <!--                            </p>-->
    <!--                        </div>-->
    <!--                        <div class="baseline-pricing__value baseline-pricing__value--low">-->
    <!--                            <p class="baseline-pricing__from">From $33.00</p>-->

    <!--                            <p class="baseline-pricing__category">per person</p>-->
    <!--                        </div>-->

    <!--                    </div>-->



    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="col-md-3">-->
    <!--                <div class="card-content">-->
    <!--                    <a href="#" class="card_img">-->
    <!--                        <img src="{{ asset('assets/images/132 (3).webp') }}" alt='image' class='imgFluid'-->
    <!--                            loading='lazy'>-->
    <!--                        <div class="price-details">-->
    <!--                            <div class="price">-->
    <!--                                <span>-->
    <!--                                    Top pick-->
    <!--                                </span>-->
    <!--                            </div>-->
    <!--                            <div class="heart-icon">-->
    <!--                                <div class="service-wishlis">-->
    <!--                                    <i class='bx bx-heart'></i>-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </a>-->
    <!--                    <div class="tour-activity-card__details">-->
    <!--                        <div class="vertical-activity-card__header">-->
    <!--                            <div class=""><span>Day trip</span></div>-->
    <!--                            <div class="tour-activity-card__details--title">Dubai: Safari, Quad Bike, Camel Ride, and-->
    <!--                                Buffet Dinner</div>-->
    <!--                        </div>-->





    <!--                        <div class="card-rating">-->
    <!--                            <i class='bx bxs-star yellow-star'></i>-->
    <!--                            <i class='bx bxs-star yellow-star'></i>-->
    <!--                            <i class='bx bxs-star yellow-star'></i>-->
    <!--                            <i class='bx bxs-star yellow-star'></i>-->
    <!--                            <i class='bx bxs-star'></i>-->
    <!--                            <span>1 Reviews</span>-->
    <!--                        </div>-->


    <!--                        <div class="baseline-pricing__value baseline-pricing__value--high">-->
    <!--                            <p class="baseline-pricing__from">-->
    <!--                                <span class="baseline-pricing__from--text">From</span>-->
    <!--                                <span class="baseline-pricing__from--value">$50.77</span>-->
    <!--                            </p>-->
    <!--                        </div>-->
    <!--                        <div class="baseline-pricing__value baseline-pricing__value--low">-->
    <!--                            <p class="baseline-pricing__from">From $33.00</p>-->

    <!--                            <p class="baseline-pricing__category">per person</p>-->
    <!--                        </div>-->

    <!--                    </div>-->



    <!--                </div>-->
    <!--            </div>-->

    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->



    @if (!$tours->isEmpty())
        <div class="tour-activity__cards">
            <div class="container">
                <div class="row" id="tours-row">
                    @foreach ($tours as $tour)
                        <div class="col-md-3">
                            <div class="card-content">
                                <a href="{{ route('tours.details', $tour->slug) }}" class="card_img">
                                    <img src="{{ asset($tour->img_path ?? 'assets/images/placeholder.png') }}"
                                        alt='image' class='imgFluid' loading='lazy'>
                                    <div class="price-details">
                                        <div class="price">
                                            <span>
                                                Top pick
                                            </span>
                                        </div>
                                        <div class="heart-icon">
                                            <div class="service-wishlis">
                                                <i class='bx bx-heart'></i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <div class="tour-activity-card__details">
                                    <div class="vertical-activity-card__header">
                                        @if ($tour->categories && !$tour->categories->isEmpty())
                                            @php
                                                $categories = '';
                                                foreach ($tour->categories as $category) {
                                                    $categories .= $category->name . '<br>';
                                                }
                                            @endphp
                                            <div class="tours-categories"><span>{{ $tour->categories[0]->name }}</span>
                                                <button type="button" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="{!! $categories !!}">
                                                    <i class='bx bxs-info-circle'></i>
                                                </button>
                                            </div>
                                        @endif
                                        <a href="{{ route('tours.details', $tour->slug) }}"
                                            class="tour-activity-card__details--title">{{ $tour->title }}</a>
                                    </div>



                                    <div class="card-rating">
                                        <x-star-rating :rating="$tour->average_rating" />
                                        @if ($tour->reviews && $tour->reviews->count() > 0)
                                            <span>{{ $tour->reviews->count() }}
                                                Review{{ $tour->reviews->count() > 1 ? 's' : '' }}</span>
                                        @else
                                            <span>No Reviews Yet</span>
                                        @endif
                                    </div>


                                    <!--<div class="baseline-pricing__value baseline-pricing__value--high">-->
                                    <!--    <p class="baseline-pricing__from">-->
                                    <!--        <span class="baseline-pricing__from--text">From</span>-->
                                    <!--        <span class="baseline-pricing__from--value">$50.77</span>-->
                                    <!--    </p>-->
                                    <!--</div>-->
                                    @if ($tour->price_type == 'per_person')
                                        <div class="baseline-pricing__value baseline-pricing__value--low">
                                            <p class="baseline-pricing__from">From</p>
                                            <p class="baseline-pricing__from">{{ $tour->for_adult_price }}</p>

                                            <p class="baseline-pricing__category">Per Person</p>
                                        </div>
                                    @elseif($tour->price_type == 'per_car')
                                        <div class="baseline-pricing__value baseline-pricing__value--low">
                                            <p class="baseline-pricing__from">From</p>
                                            <p class="baseline-pricing__from">{{ $tour->for_car_price }}</p>

                                            <p class="baseline-pricing__category">Per Car</p>
                                        </div>
                                    @endif

                                </div>



                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        @php
            // Example URL from data attribute
            $nextPageUrl = $tours->nextPageUrl();

            // Parse the URL and extract query parameters
            $parsedUrl = parse_url($nextPageUrl);
            parse_str($parsedUrl['query'] ?? '', $params);

            // Get the page number
            $pageNumber = $params['page'] ?? 'not found';
        @endphp

        @if (count($total_tours) > 8)
            <div id="load-more-container" class="show-more pt-3">
                <button class="app-btn themeBtn" id="load-more"
                    data-next-page-url="{{ route('tours.loadMore', ['page' => $pageNumber]) }}">Show More</button>
            </div>
        @endif
    @else
        <div class="section-content text-center">
            <div class="subHeading">No Tours Available at the Moment</div>
        </div>
    @endif

    <div class="offers-section">
        <div class="container">
            <div class="offers-section__details">
                <div class="offers-section__img">
                    <img src="{{ asset('assets/images/group_tour_desktop_banner_image.webp') }}" alt='image'
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


    <div class="location-banner">
        <div class="container">
            <div class="location-banner__content">
                <div class="location-banner__img">
                    <img src="{{ asset('assets/images/90.webp') }}" alt='image' class='imgFluid' loading='lazy'>
                </div>
                <div class="location-banner-wrapper">
                    <div class="banner-heading">
                        <h1>

                            <div class="bannerMain-title">Dubai</div>
                        </h1>
                    </div>
                    <button class="app-btn themeBtn" type="button">See all 1192 tickets &amp; tours</button>
                </div>

            </div>
        </div>
    </div>

    <div class="most-recommended">
        <div class="container">
            <div class="section-content">
                <h2 class="subHeading">
                    Our most recommended Dubai Desert safaris
                </h2>
            </div>


            <div class="row">
                <div class="col-md-6 mt-4">
                    <div class="highlight">
                        <a href="#" class="highlight__image-link" target="_blank">
                            <div class="highlight__image">
                                <img alt="Dubai: Burj Khalifa Level 124 and 125 Entry Ticket"
                                    src="{{ asset('assets/images/97.webp') }}">
                            </div>
                        </a>
                        <div class="highlight__text-content">
                            <div class="highlight__text">
                                <a href="#" class="highlight__text-link" target="_blank">
                                    <p class="highlight__title">Dubai: Burj Khalifa Level 124 and 125 Entry Ticket</p>
                                </a>
                                <p class="highlight__description">
                                    Take the world’s fastest elevator as you ascend Dubai’s iconic Burj Khalifa skyscraper.
                                    Holding the title as the world's tallest building, ride...
                                </p>
                            </div>
                            <div class="highlight__button-wrapper">
                                <a class="" type="button">
                                    See more
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-6 mt-4">
                    <div class="highlight">
                        <a href="#" class="highlight__image-link" target="_blank">
                            <div class="highlight__image">
                                <img alt="Dubai: Burj Khalifa Level 124 and 125 Entry Ticket"
                                    src="{{ asset('assets/images/97.webp') }}">
                            </div>
                        </a>
                        <div class="highlight__text-content">
                            <div class="highlight__text">
                                <a href="#" class="highlight__text-link" target="_blank">
                                    <p class="highlight__title">Dubai: Burj Khalifa Level 124 and 125 Entry Ticket</p>
                                </a>
                                <p class="highlight__description">
                                    Take the world’s fastest elevator as you ascend Dubai’s iconic Burj Khalifa skyscraper.
                                    Holding the title as the world's tallest building, ride...
                                </p>
                            </div>
                            <div class="highlight__button-wrapper">
                                <a class="" type="button">
                                    See more
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-6 mt-4">
                    <div class="highlight">
                        <a href="#" class="highlight__image-link" target="_blank">
                            <div class="highlight__image">
                                <img alt="Dubai: Burj Khalifa Level 124 and 125 Entry Ticket"
                                    src="{{ asset('assets/images/97.webp') }}">
                            </div>
                        </a>
                        <div class="highlight__text-content">
                            <div class="highlight__text">
                                <a href="#" class="highlight__text-link" target="_blank">
                                    <p class="highlight__title">Dubai: Burj Khalifa Level 124 and 125 Entry Ticket</p>
                                </a>
                                <p class="highlight__description">
                                    Take the world’s fastest elevator as you ascend Dubai’s iconic Burj Khalifa skyscraper.
                                    Holding the title as the world's tallest building, ride...
                                </p>
                            </div>
                            <div class="highlight__button-wrapper">
                                <a class="" type="button">
                                    See more
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-6 mt-4">
                    <div class="highlight">
                        <a href="#" class="highlight__image-link" target="_blank">
                            <div class="highlight__image">
                                <img alt="Dubai: Burj Khalifa Level 124 and 125 Entry Ticket"
                                    src="{{ asset('assets/images/97.webp') }}">
                            </div>
                        </a>
                        <div class="highlight__text-content">
                            <div class="highlight__text">
                                <a href="#" class="highlight__text-link" target="_blank">
                                    <p class="highlight__title">Dubai: Burj Khalifa Level 124 and 125 Entry Ticket</p>
                                </a>
                                <p class="highlight__description">
                                    Take the world’s fastest elevator as you ascend Dubai’s iconic Burj Khalifa skyscraper.
                                    Holding the title as the world's tallest building, ride...
                                </p>
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
    </div>

    <div class="comment">
        <img src="{{ asset('assets/images/comment.webp') }}" alt='image' class='peoples-img imgFluid'
            loading='lazy'>
        <div class="ocizgi_imgs">
            <img src="{{ asset('assets/images/ocizgi.webp') }}" alt='image' class='ocizgi imgFluid' loading='lazy'>

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
                    <div class='comment-card'>
                        <div class='comment-card__img comment-slider '>
                            <img src="{{ asset('assets/images/comment1.webp') }}" alt='image' class='imgFluid'>
                            <img src="{{ asset('assets/images/comment2.webp') }}" alt='image' class='imgFluid'>
                        </div>
                        <div class='comment-card__content'>
                            <div class="comment-details">
                                <div class="customer-name">
                                    neurontnP
                                </div>
                                <div class="card-rating">
                                    <i class='bx bxs-star yellow-star'></i>
                                    <i class='bx bxs-star yellow-star'></i>
                                    <i class='bx bxs-star yellow-star'></i>
                                    <i class='bx bxs-star yellow-star'></i>
                                    <i class='bx bxs-star'></i>
                                </div>
                            </div>
                            <div class="comment-pra">
                                I am not sure where you’re getting your information, but great topic.
                            </div>
                            <button class="app-btn themeBtn ">Read</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class='comment-card'>
                        <div class='comment-card__img comment-slider '>
                            <img src="{{ asset('assets/images/comment2.webp') }}" alt='image' class='imgFluid'>
                            <img src="{{ asset('assets/images/comment1.webp') }}" alt='image' class='imgFluid'>
                        </div>
                        <div class='comment-card__content'>
                            <div class="comment-details">
                                <div class="customer-name">
                                    neurontnP
                                </div>
                                <div class="card-rating">
                                    <i class='bx bxs-star yellow-star'></i>
                                    <i class='bx bxs-star yellow-star'></i>
                                    <i class='bx bxs-star yellow-star'></i>
                                    <i class='bx bxs-star yellow-star'></i>
                                    <i class='bx bxs-star'></i>
                                </div>
                            </div>
                            <div class="comment-pra">
                                I am not sure where you’re getting your information, but great topic.
                            </div>
                            <button class="app-btn themeBtn ">Read</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class='comment-card'>
                        <div class='comment-card__img comment-slider'>
                            <img src="{{ asset('assets/images/comment3.webp') }}" alt='image' class='imgFluid'>
                            <img src="{{ asset('assets/images/comment4.webp') }}" alt='image' class='imgFluid'>
                        </div>
                        <div class='comment-card__content'>
                            <div class="comment-details">
                                <div class="customer-name">
                                    neurontnP
                                </div>
                                <div class="card-rating">
                                    <i class='bx bxs-star yellow-star'></i>
                                    <i class='bx bxs-star yellow-star'></i>
                                    <i class='bx bxs-star yellow-star'></i>
                                    <i class='bx bxs-star yellow-star'></i>
                                    <i class='bx bxs-star'></i>
                                </div>
                            </div>
                            <div class="comment-pra">
                                I am not sure where you’re getting your information, but great topic.
                            </div>
                            <button class="app-btn themeBtn ">Read</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class='comment-card'>
                        <div class='comment-card__img comment-slider '>
                            <img src="{{ asset('assets/images/comment4.webp') }}" alt='image' class='imgFluid'>
                            <img src="{{ asset('assets/images/comment3.webp') }}" alt='image' class='imgFluid'>
                        </div>
                        <div class='comment-card__content'>
                            <div class="comment-details">
                                <div class="customer-name">
                                    neurontnP
                                </div>
                                <div class="card-rating">
                                    <i class='bx bxs-star yellow-star'></i>
                                    <i class='bx bxs-star yellow-star'></i>
                                    <i class='bx bxs-star yellow-star'></i>
                                    <i class='bx bxs-star yellow-star'></i>
                                    <i class='bx bxs-star'></i>
                                </div>
                            </div>
                            <div class="comment-pra">
                                I am not sure where you’re getting your information, but great topic.
                            </div>
                            <button class="app-btn themeBtn ">Read</button>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <div class="newsletter-signup">
        <div class="container">
            <div class="row g-0">
                <div class="col-md-6">
                    <div class="newsletter-signup__img">
                        <img src="{{ asset('assets/images/173.webp') }}" alt='image' class='imgFluid'
                            loading='lazy'>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="newsletter-signup__content">
                        <div class="section-content">
                            <h2 class="subHeading">

                                Your Dubai itinerary is waiting.
                            </h2>
                        </div>
                        <p>Receive a curated 48-hour itinerary featuring the most iconic experiences in Dubai, straight to
                            your inbox.</p>

                        @include('components.newsletter-form')

                    </div>
                </div>
            </div>
            <div class="communications-subscription__privacy">
                <p>By signing up, you agree to receive promotional emails on activities and insider tips. You can
                    unsubscribe or withdraw your consent at any time with future effect. For more information, read our <a
                        href="#">Privacy statement</a></p>

            </div>
        </div>
    </div>
@endsection
@section('css')
    <style type="text/css">
        /*in page css here*/
    </style>
@endsection
@section('js')
    <script type="text/javascript">
        let loadMore = document.getElementById('load-more')
        if (loadMore) {
            loadMore.addEventListener('click', function() {
                const button = this;
                const nextPageUrl = button.dataset.nextPageUrl;
                if (nextPageUrl !== 'null') {
                    loadMoreTours(nextPageUrl, button, )
                }
            });
        }
        const loadMoreTours = async (nextPageUrl, button) => {
            button.innerHTML = `<div class="spinner-border spinner-border-sm"></div>`;
            try {
                const response = await fetch(nextPageUrl, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': getCsrfToken()
                    },
                    credentials: "same-origin"
                });

                const data = await response.json();
                if (data.status === 200) {
                    // Update the button's next page URL
                    button.setAttribute('data-next-page-url', data.next_page_url);

                    // Hide the button if there is no next page URL
                    if (data.next_page_url === null) {
                        button.style.display = 'none';
                    }

                    // Update tours
                    updateTours(data.tours, document.getElementById("tours-row"));
                }
            } catch (error) {
                console.error('Error loading more tours:', error);
            } finally {
                button.innerHTML = `Show More`;
                showTooltips();
            }
        };
        const updateTours = (tours, row) => {
            let newContent = '';

            const imgUrlStart = `${baseUrl}/public`;
            const placeholderImgUrl = `${baseUrl}/public/assets/images/placeholder.png`;
            const detailPageStart = `${baseUrl}/tours/details/`;

            tours.forEach(tour => {
                const imgUrl = tour.img_path ? `${imgUrlStart}/${tour.img_path}` : placeholderImgUrl;

                // Calculate star ratings
                const averageRating = tour.average_rating;
                const filledStars = Math.floor(averageRating);
                const halfStar = averageRating - filledStars >= 0.5 ? 1 : 0;
                const emptyStars = 5 - (filledStars + halfStar);

                // Determine review text
                const reviewCount = tour.reviews.length;
                const reviewText = reviewCount > 0 ?
                    `${reviewCount} Review${reviewCount > 1 ? 's' : ''}` :
                    'No Reviews Yet';

                newContent += `
        <div class="col-md-3">
            <div class="card-content">
                <a href="${detailPageStart}${tour.slug}" class="card_img">
                    <img src="${imgUrl}" alt='image' class='imgFluid' loading='lazy'>
                    <div class="price-details">
                        <div class="price">
                            <span>Top pick</span>
                        </div>
                        <div class="heart-icon">
                            <div class="service-wishlis">
                                <i class='bx bx-heart'></i>
                            </div>
                        </div>
                    </div>
                </a>
                <div class="tour-activity-card__details">
                    <div class="vertical-activity-card__header">
                        ${tour.categories && tour.categories.length > 0 ? `
                                                                                                                <div class="tours-categories">
                                                                                                                    <span>${tour.categories[0].name}</span>
                                                                                                                    <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="${tour.categories.map(category => category.name).join('<br>')}">
                                                                                                                        <i class='bx bxs-info-circle'></i>
                                                                                                                    </button>
                                                                                                                </div>
                                                                                                            ` : ''}
                        <a href="/tours/details/${tour.slug}" class="tour-activity-card__details--title">${tour.title}</a>
                    </div>
                    <div class="card-rating">
                        ${'<i class="bx bxs-star yellow-star"></i>'.repeat(filledStars)}
                        ${halfStar ? '<i class="bx bxs-star-half yellow-star"></i>' : ''}
                        ${'<i class="bx bx-star yellow-star"></i>'.repeat(emptyStars)}
                        <span>${reviewText}</span>
                    </div>
                    ${tour.price_type === 'per_person' ? `
                                                                                                            <div class="baseline-pricing__value baseline-pricing__value--low">
                                                                                                                <p class="baseline-pricing__from">From</p>
                                                                                                                <p class="baseline-pricing__from">${tour.for_adult_price}</p>
                                                                                                                <p class="baseline-pricing__category">Per Person</p>
                                                                                                            </div>
                                                                                                        ` : ''}
                    ${tour.price_type === 'per_car' ? `
                                                                                                            <div class="baseline-pricing__value baseline-pricing__value--low">
                                                                                                                <p class="baseline-pricing__from">From</p>
                                                                                                                <p class="baseline-pricing__from">${tour.for_car_price}</p>
                                                                                                                <p class="baseline-pricing__category">Per Car</p>
                                                                                                            </div>
                                                                                                        ` : ''}
                </div>
            </div>
        </div>`;
            });

            row.insertAdjacentHTML('beforeend', newContent);
        };
    </script>
@endsection
