@if (!$content)
    <div class="banner banner--shape" style="background-color: #fff">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="banner-content">
                        <div class="banner-heading">
                            <h1 class="bannerMain-title">Discover Your <br> <span>Next Adventure</span></h1>
                            <a href="#" class="primary-btn mt-3">Learn More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="banner-img">
                        <img data-src="{{ asset('assets/images/baloon.webp') }}" alt="image" class="imgFluid lazy"
                            width="345.89" height="186">
                    </div>
                </div>
                <div class="col-md-12">
                    <form action="" class="banner-search">
                        <i class="bx bx-search"></i>
                        <input name="location" placeholder="Where are you going?" class="banner-search__input">
                    </form>
                </div>
                <div class="col-md-12">
                    <div class="banner-rating">
                        <div class="banner-rating__custom">
                            <img src="{{ asset('assets/images/google.png') }}" alt="Google"
                                class="banner-rating__platform">
                            <div class="banner-rating__stars">
                                <i class="banner-rating__star bx bxs-star" style="color:#fec10b"></i>
                                <i class="banner-rating__star bx bxs-star" style="color:#fec10b"></i>
                                <i class="banner-rating__star bx bxs-star" style="color:#fec10b"></i>
                                <i class="banner-rating__star bx bxs-star" style="color:#fec10b"></i>
                                <i class="banner-rating__star bx bxs-star" style="color:#fec10b"></i>
                            </div>
                            <div class="banner-rating__info">5 Stars</div>
                        </div>
                        <div class="banner-rating__reviews">
                            <div class="banner-rating__avatars">
                                <img src="https://i.pravatar.cc/150?img=51" alt="Reviewer 1"
                                    class="banner-rating__avatar">
                                <img src="https://i.pravatar.cc/150?img=52" alt="Reviewer 2"
                                    class="banner-rating__avatar">
                                <img src="https://i.pravatar.cc/150?img=53" alt="Reviewer 3"
                                    class="banner-rating__avatar">
                                <img src="https://i.pravatar.cc/150?img=54" alt="Reviewer 4"
                                    class="banner-rating__avatar">
                            </div>
                            <div class="banner-rating__info">196 Reviews</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class=destinations>
        <div class=container>
            <div class="row justify-content-between">
                <div class=col-md-4>
                    <div class=destinations-content>
                        <div class=dst1>TOP DESTINATIONS</div>
                        <div class=dst2>
                            Meet With Carefully Selected Destinations!
                            <div class=darrow>
                                <img data-src={{ asset('assets/images/darrow.webp') }} alt=image class="imgFluid lazy"
                                    width=100 height=20.36>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=col-md-8>
                    <div class="row destinations-slider">
                        <div class=col-md>
                            <div class=dst-card>
                                <div class=destinations-img>
                                    <img data-src={{ asset('assets/images/dubai-600.webp') }} alt=image
                                        class="imgFluid lazy">
                                </div>
                                <div class=dst-location>
                                    dubai
                                </div>
                                <div class=dst-num>3</div>
                            </div>
                        </div>
                        <div class=col-md>
                            <div class=dst-card>
                                <div class=destinations-img>
                                    <img data-src={{ asset('assets/images/belek1.webp') }} alt=image
                                        class="imgFluid lazy">
                                </div>
                                <div class=dst-location>
                                    belek
                                </div>
                                <div class=dst-num>3</div>
                            </div>
                        </div>
                        <div class=col-md>
                            <div class=dst-card>
                                <div class=destinations-img>
                                    <img data-src={{ asset('assets/images/antalya-600.webp') }} alt=image
                                        class="imgFluid lazy">
                                </div>
                                <div class=dst-location>
                                    antalya
                                </div>
                                <div class=dst-num>3</div>
                            </div>
                        </div>
                        <div class=col-md>
                            <div class=dst-card>
                                <div class=destinations-img>
                                    <img data-src={{ asset('assets/images/alanya2.webp') }} alt=image
                                        class="imgFluid lazy">
                                </div>
                                <div class=dst-location>
                                    alanya
                                </div>
                                <div class=dst-num>3</div>
                            </div>
                        </div>
                        <div class=col-md>
                            <div class=dst-card>
                                <div class=destinations-img>
                                    <img data-src={{ asset('assets/images/side.webp') }} alt=image
                                        class="imgFluid lazy">
                                </div>
                                <div class=dst-location>
                                    manavgat
                                </div>
                                <div class=dst-num>3</div>
                            </div>
                        </div>
                        <div class=col-md>
                            <div class=dst-card>
                                <div class=destinations-img>
                                    <img data-src={{ asset('assets/images/side.webp') }} alt=image
                                        class="imgFluid lazy">
                                </div>
                                <div class=dst-location>
                                    manavgat
                                </div>
                                <div class=dst-num>3</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    @if ($content->background_type === 'normal_v1_right_side_image')
        <div class="banner banner--shape" style="background-color: #fff">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <div class="banner-content">
                            <div class="banner-heading">
                                <h1>
                                    <div class="bannerMain-title">{{ $content->title }}
                                        <br>
                                        <span>{{ $content->subtitle[0] }}</span>
                                        <br>
                                        <span>{{ $content->subtitle[1] ?? '' }}</span>
                                    </div>
                                </h1>
                                @if (isset($content->is_button_enabled))
                                    <a href="{{ $content->btn_link }}" class="primary-btn mt-3"
                                        target="_blank">{{ $content->btn_text }}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="banner-img">
                            <img data-src="{{ asset($content->right_image ?? 'admin/assets/images/placeholder.png') }}"
                                alt="{{ $content->right_image_alt_text ?? 'Banner Right image' }}"
                                class="imgFluid lazy" width="345.89" height="186">
                        </div>
                    </div>
                    @if (isset($content->is_form_enabled))
                        @if ($content->form_type === 'normal')
                            <div class="col-md-12">
                                <form action="" class="banner-search">
                                    <i class="bx bx-search"></i>
                                    <input name="location" placeholder="Where are you going?"
                                        class="banner-search__input">
                                </form>
                            </div>
                        @elseif($content->form_type === 'date_selection')
                            <div class="col-md-9">
                                <div class="date-search">
                                    <form action="#" class="date-search__btns">
                                        <label for="destination" class="date-search__btn fixed-height">
                                            <div class="first-half">
                                                <i class='bx bxs-map'></i>
                                            </div>
                                            <div class="second-half">
                                                <span class="top-label">Going to</span>
                                                <div class="content">
                                                    <input autocomplete="off" type="text"
                                                        placeholder="Where are you going?" name="destination"
                                                        id="destination" />

                                                </div>
                                            </div>
                                        </label>
                                        <button class="date-search__btn date-range-picker fixed-height"
                                            type="button">
                                            <div class="first-half">
                                                <i class='bx bxs-calendar'></i>
                                            </div>
                                            <div class="second-half">
                                                <span class="top-label">Tour Date</span>
                                                <div class="content d-flex align-items-center">
                                                    <div class="date-wrapper">
                                                        <input readonly="" type="text" class="date"
                                                            name="start_date" id="startDate" />
                                                    </div>
                                                    <div class="date-wrapper">
                                                        <input readonly="" type="text" class="date"
                                                            name="end_date" id="endDate" />
                                                    </div>
                                                </div>
                                            </div>
                                        </button>
                                        <button type="submit" class="primary-btn fixed-height">
                                            <i class="bx bx-search"></i><span>Search</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    @endif

                    @if (isset($content->is_review_enabled))
                        @if ($content->review_type === 'custom')
                            <div class="col-md-12">
                                <a href="{{ $content->custom_review_link }}" class="banner-rating" target="_blank">
                                    <div class="banner-rating__custom">
                                        <img src="{{ asset($content->custom_review_logo_image ?? 'assets/images/placeholder.png') }}"
                                            alt="{{ $content->custom_review_logo_alt_text ?? 'Review Logo' }}"
                                            class="banner-rating__platform">
                                        <div class="banner-rating__stars">
                                            <i class="banner-rating__star bx bxs-star" style="color:#fec10b"></i>
                                            <i class="banner-rating__star bx bxs-star" style="color:#fec10b"></i>
                                            <i class="banner-rating__star bx bxs-star" style="color:#fec10b"></i>
                                            <i class="banner-rating__star bx bxs-star" style="color:#fec10b"></i>
                                            <i class="banner-rating__star bx bxs-star" style="color:#fec10b"></i>
                                        </div>
                                        <div class="banner-rating__info">5 Stars</div>
                                    </div>
                                    <div class="banner-rating__reviews">
                                        <div class="banner-rating__avatars">
                                            <img src="https://i.pravatar.cc/150?img=51" alt="Reviewer 1"
                                                class="banner-rating__avatar">
                                            <img src="https://i.pravatar.cc/150?img=52" alt="Reviewer 2"
                                                class="banner-rating__avatar">
                                            <img src="https://i.pravatar.cc/150?img=53" alt="Reviewer 3"
                                                class="banner-rating__avatar">
                                            <img src="https://i.pravatar.cc/150?img=54" alt="Reviewer 4"
                                                class="banner-rating__avatar">
                                        </div>
                                        <div class="banner-rating__info">{{ $content->custom_review_count }} Reviews
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @else
                            @php
                                $review_link = null;
                                $review_image = null;
                                if ($content->review_type === 'google') {
                                    $review_link = $content->review_google_link;
                                    $review_image = 'assets/images/google.png';
                                } elseif ($content->review_type === 'trustpilot') {
                                    $review_link = $content->review_trustpilot_link;
                                    $review_image = 'assets/images/trustpilot.png';
                                } elseif ($content->review_type === 'tripadvisor') {
                                    $review_link = $content->review_tripadvisor_link;
                                    $review_image = 'assets/images/tripadvisor.png';
                                }
                            @endphp
                            <div class="col-md-12">
                                <a href="{{ $review_link }}" class="banner-rating" target="_blank">
                                    <div class="banner-rating__custom">
                                        <img src="{{ asset($review_image) }}" alt="{{ $content->review_type }} Logo"
                                            class="banner-rating__platform">
                                        <div class="banner-rating__stars">
                                            <i class="banner-rating__star bx bxs-star" style="color:#fec10b"></i>
                                            <i class="banner-rating__star bx bxs-star" style="color:#fec10b"></i>
                                            <i class="banner-rating__star bx bxs-star" style="color:#fec10b"></i>
                                            <i class="banner-rating__star bx bxs-star" style="color:#fec10b"></i>
                                            <i class="banner-rating__star bx bxs-star" style="color:#fec10b"></i>
                                        </div>
                                        <div class="banner-rating__info">5 Stars</div>
                                    </div>
                                    <div class="banner-rating__reviews">
                                        <div class="banner-rating__avatars">
                                            <img src="https://i.pravatar.cc/150?img=51" alt="Reviewer 1"
                                                class="banner-rating__avatar">
                                            <img src="https://i.pravatar.cc/150?img=52" alt="Reviewer 2"
                                                class="banner-rating__avatar">
                                            <img src="https://i.pravatar.cc/150?img=53" alt="Reviewer 3"
                                                class="banner-rating__avatar">
                                            <img src="https://i.pravatar.cc/150?img=54" alt="Reviewer 4"
                                                class="banner-rating__avatar">
                                        </div>
                                        <div class="banner-rating__info">196 Reviews</div>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    @elseif($content->background_type === 'normal_v2_full_screen_background')
        <div class="banner banner--overlay">
            <img data-src="{{ asset($content->background_image ?? 'admin/assets/images/placeholder.png') }}"
                alt="{{ $content->background_alt_text ?? 'Banner image' }}" class="imgFluid lazy banner__bg">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <div class="banner-content">
                            <div class="banner-heading">
                                <h1>
                                    <div class="bannerMain-title">{{ $content->title }}
                                        <br>
                                        <span>{{ $content->subtitle[0] }}</span>
                                        <br>
                                        <span>{{ $content->subtitle[1] ?? '' }}</span>
                                    </div>
                                </h1>
                                @if (isset($content->is_button_enabled))
                                    <a href="{{ $content->btn_link }}" class="primary-btn mt-3"
                                        target="_blank">{{ $content->btn_text }}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @if (isset($content->is_form_enabled))
                        @if ($content->form_type === 'normal')
                            <div class="col-md-12">
                                <form action="" class="banner-search">
                                    <i class="bx bx-search"></i>
                                    <input name="location" placeholder="Where are you going?"
                                        class="banner-search__input">
                                </form>
                            </div>
                        @elseif($content->form_type === 'date_selection')
                            <div class="col-md-9">
                                <div class="date-search">
                                    <form action="#" class="date-search__btns">
                                        <label for="destination" class="date-search__btn fixed-height">
                                            <div class="first-half">
                                                <i class='bx bxs-map'></i>
                                            </div>
                                            <div class="second-half">
                                                <span class="top-label">Going to</span>
                                                <div class="content">
                                                    <input autocomplete="off" type="text"
                                                        placeholder="Where are you going?" name="destination"
                                                        id="destination" />
                                                </div>
                                            </div>
                                        </label>
                                        <button class="date-search__btn date-range-picker fixed-height"
                                            type="button">
                                            <div class="first-half">
                                                <i class='bx bxs-calendar'></i>
                                            </div>
                                            <div class="second-half">
                                                <span class="top-label">Tour Date</span>
                                                <div class="content d-flex align-items-center">
                                                    <div class="date-wrapper">
                                                        <input readonly="" type="text" class="date"
                                                            name="start_date" id="startDate" />
                                                    </div>
                                                    <div class="date-wrapper">
                                                        <input readonly="" type="text" class="date"
                                                            name="end_date" id="endDate" />
                                                    </div>
                                                </div>
                                            </div>
                                        </button>
                                        <button type="submit" class="primary-btn fixed-height">
                                            <i class="bx bx-search"></i><span>Search</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    @endif

                    @if (isset($content->is_review_enabled))
                        @if ($content->review_type === 'custom')
                            <div class="col-md-12">
                                <a href="{{ $content->custom_review_link }}" class="banner-rating" target="_blank">
                                    <div class="banner-rating__custom">
                                        <img src="{{ asset($content->custom_review_logo_image ?? 'assets/images/placeholder.png') }}"
                                            alt="{{ $content->custom_review_logo_alt_text ?? 'Review Logo' }}"
                                            class="banner-rating__platform">
                                        <div class="banner-rating__stars">
                                            <i class="banner-rating__star bx bxs-star" style="color:#fec10b"></i>
                                            <i class="banner-rating__star bx bxs-star" style="color:#fec10b"></i>
                                            <i class="banner-rating__star bx bxs-star" style="color:#fec10b"></i>
                                            <i class="banner-rating__star bx bxs-star" style="color:#fec10b"></i>
                                            <i class="banner-rating__star bx bxs-star" style="color:#fec10b"></i>
                                        </div>
                                        <div class="banner-rating__info">5 Stars</div>
                                    </div>
                                    <div class="banner-rating__reviews">
                                        <div class="banner-rating__avatars">
                                            <img src="https://i.pravatar.cc/150?img=51" alt="Reviewer 1"
                                                class="banner-rating__avatar">
                                            <img src="https://i.pravatar.cc/150?img=52" alt="Reviewer 2"
                                                class="banner-rating__avatar">
                                            <img src="https://i.pravatar.cc/150?img=53" alt="Reviewer 3"
                                                class="banner-rating__avatar">
                                            <img src="https://i.pravatar.cc/150?img=54" alt="Reviewer 4"
                                                class="banner-rating__avatar">
                                        </div>
                                        <div class="banner-rating__info">{{ $content->custom_review_count }}
                                            Reviews
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @else
                            @php
                                $review_link = null;
                                $review_image = null;
                                if ($content->review_type === 'google') {
                                    $review_link = $content->review_google_link;
                                    $review_image = 'assets/images/google.png';
                                } elseif ($content->review_type === 'trustpilot') {
                                    $review_link = $content->review_trustpilot_link;
                                    $review_image = 'assets/images/trustpilot.png';
                                } elseif ($content->review_type === 'tripadvisor') {
                                    $review_link = $content->review_tripadvisor_link;
                                    $review_image = 'assets/images/tripadvisor.png';
                                }
                            @endphp
                            <div class="col-md-12">
                                <a href="{{ $review_link }}" class="banner-rating" target="_blank">
                                    <div class="banner-rating__custom">
                                        <img src="{{ asset($review_image) }}" alt="{{ $content->review_type }} Logo"
                                            class="banner-rating__platform">
                                        <div class="banner-rating__stars">
                                            <i class="banner-rating__star bx bxs-star" style="color:#fec10b"></i>
                                            <i class="banner-rating__star bx bxs-star" style="color:#fec10b"></i>
                                            <i class="banner-rating__star bx bxs-star" style="color:#fec10b"></i>
                                            <i class="banner-rating__star bx bxs-star" style="color:#fec10b"></i>
                                            <i class="banner-rating__star bx bxs-star" style="color:#fec10b"></i>
                                        </div>
                                        <div class="banner-rating__info">5 Stars</div>
                                    </div>
                                    <div class="banner-rating__reviews">
                                        <div class="banner-rating__avatars">
                                            <img src="https://i.pravatar.cc/150?img=51" alt="Reviewer 1"
                                                class="banner-rating__avatar">
                                            <img src="https://i.pravatar.cc/150?img=52" alt="Reviewer 2"
                                                class="banner-rating__avatar">
                                            <img src="https://i.pravatar.cc/150?img=53" alt="Reviewer 3"
                                                class="banner-rating__avatar">
                                            <img src="https://i.pravatar.cc/150?img=54" alt="Reviewer 4"
                                                class="banner-rating__avatar">
                                        </div>
                                        <div class="banner-rating__info">196 Reviews</div>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    @elseif($content->background_type === 'slider_carousel')
        <div class="banner-slider-wrapper">
            <div class="banner-slider">
                @for ($i = 0; $i < 4; $i++)
                    @php
                        $background_image =
                            isset($content->carousel_background_images) && !empty($content->carousel_background_images)
                                ? $content->carousel_background_images[$i]
                                : null;
                        $alt_text = isset($content->carousel_alt_text) ? $content->carousel_alt_text[$i] : null;
                    @endphp
                    <div class="banner banner--overlay">
                        <img data-src="{{ asset($background_image ?? 'admin/assets/images/placeholder.png') }}"
                            alt="{{ $alt_text ?? 'Banner image' }}" class="imgFluid lazy banner__bg">
                    </div>
                @endfor
            </div>
            <div class="banner">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="banner-content">
                                <div class="banner-heading">
                                    <h1>
                                        <div class="bannerMain-title">{{ $content->title }}
                                            <br>
                                            <span>{{ $content->subtitle[0] }}</span>
                                            <br>
                                            <span>{{ $content->subtitle[1] ?? '' }}</span>
                                        </div>
                                    </h1>
                                    @if (isset($content->is_button_enabled))
                                        <a href="{{ $content->btn_link }}" class="primary-btn mt-3"
                                            target="_blank">{{ $content->btn_text }}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if (isset($content->is_form_enabled))
                            @if ($content->form_type === 'normal')
                                <div class="col-md-12">
                                    <form action="" class="banner-search">
                                        <i class="bx bx-search"></i>
                                        <input name="location" placeholder="Where are you going?"
                                            class="banner-search__input">
                                    </form>
                                </div>
                            @elseif($content->form_type === 'date_selection')
                                <div class="col-md-9">
                                    <div class="date-search">
                                        <form action="#" class="date-search__btns">
                                            <label for="destination" class="date-search__btn fixed-height">
                                                <div class="first-half">
                                                    <i class='bx bxs-map'></i>
                                                </div>
                                                <div class="second-half">
                                                    <span class="top-label">Going to</span>
                                                    <div class="content">
                                                        <input autocomplete="off" type="text"
                                                            placeholder="Where are you going?" name="destination"
                                                            id="destination" />
                                                    </div>
                                                </div>
                                            </label>
                                            <button class="date-search__btn date-range-picker fixed-height"
                                                type="button">
                                                <div class="first-half">
                                                    <i class='bx bxs-calendar'></i>
                                                </div>
                                                <div class="second-half">
                                                    <span class="top-label">Tour Date</span>
                                                    <div class="content d-flex align-items-center">
                                                        <div class="date-wrapper">
                                                            <input readonly="" type="text" class="date"
                                                                name="start_date" id="startDate" />
                                                        </div>
                                                        <div class="date-wrapper">
                                                            <input readonly="" type="text" class="date"
                                                                name="end_date" id="endDate" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </button>
                                            <button type="submit" class="primary-btn fixed-height">
                                                <i class="bx bx-search"></i><span>Search</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        @endif
                        @if (isset($content->is_review_enabled))
                            @if ($content->review_type === 'custom')
                                <div class="col-md-12">
                                    <a href="{{ $content->custom_review_link }}" class="banner-rating"
                                        target="_blank">
                                        <div class="banner-rating__custom">
                                            <img src="{{ asset($content->custom_review_logo_image ?? 'assets/images/placeholder.png') }}"
                                                alt="{{ $content->custom_review_logo_alt_text ?? 'Review Logo' }}"
                                                class="banner-rating__platform">
                                            <div class="banner-rating__stars">
                                                <i class="banner-rating__star bx bxs-star" style="color:#fec10b"></i>
                                                <i class="banner-rating__star bx bxs-star" style="color:#fec10b"></i>
                                                <i class="banner-rating__star bx bxs-star" style="color:#fec10b"></i>
                                                <i class="banner-rating__star bx bxs-star" style="color:#fec10b"></i>
                                                <i class="banner-rating__star bx bxs-star" style="color:#fec10b"></i>
                                            </div>
                                            <div class="banner-rating__info">5 Stars</div>
                                        </div>
                                        <div class="banner-rating__reviews">
                                            <div class="banner-rating__avatars">
                                                <img src="https://i.pravatar.cc/150?img=51" alt="Reviewer 1"
                                                    class="banner-rating__avatar">
                                                <img src="https://i.pravatar.cc/150?img=52" alt="Reviewer 2"
                                                    class="banner-rating__avatar">
                                                <img src="https://i.pravatar.cc/150?img=53" alt="Reviewer 3"
                                                    class="banner-rating__avatar">
                                                <img src="https://i.pravatar.cc/150?img=54" alt="Reviewer 4"
                                                    class="banner-rating__avatar">
                                            </div>
                                            <div class="banner-rating__info">
                                                {{ $content->custom_review_count }}
                                                Reviews
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @else
                                @php
                                    $review_link = null;
                                    $review_image = null;
                                    if ($content->review_type === 'google') {
                                        $review_link = $content->review_google_link;
                                        $review_image = 'assets/images/google.png';
                                    } elseif ($content->review_type === 'trustpilot') {
                                        $review_link = $content->review_trustpilot_link;
                                        $review_image = 'assets/images/trustpilot.png';
                                    } elseif ($content->review_type === 'tripadvisor') {
                                        $review_link = $content->review_tripadvisor_link;
                                        $review_image = 'assets/images/tripadvisor.png';
                                    }
                                @endphp
                                <div class="col-md-12">
                                    <a href="{{ $review_link }}" class="banner-rating" target="_blank">
                                        <div class="banner-rating__custom">
                                            <img src="{{ asset($review_image) }}"
                                                alt="{{ $content->review_type }} Logo"
                                                class="banner-rating__platform">
                                            <div class="banner-rating__stars">
                                                <i class="banner-rating__star bx bxs-star" style="color:#fec10b"></i>
                                                <i class="banner-rating__star bx bxs-star" style="color:#fec10b"></i>
                                                <i class="banner-rating__star bx bxs-star" style="color:#fec10b"></i>
                                                <i class="banner-rating__star bx bxs-star" style="color:#fec10b"></i>
                                                <i class="banner-rating__star bx bxs-star" style="color:#fec10b"></i>
                                            </div>
                                            <div class="banner-rating__info">5 Stars</div>
                                        </div>
                                        <div class="banner-rating__reviews">
                                            <div class="banner-rating__avatars">
                                                <img src="https://i.pravatar.cc/150?img=51" alt="Reviewer 1"
                                                    class="banner-rating__avatar">
                                                <img src="https://i.pravatar.cc/150?img=52" alt="Reviewer 2"
                                                    class="banner-rating__avatar">
                                                <img src="https://i.pravatar.cc/150?img=53" alt="Reviewer 3"
                                                    class="banner-rating__avatar">
                                                <img src="https://i.pravatar.cc/150?img=54" alt="Reviewer 4"
                                                    class="banner-rating__avatar">
                                            </div>
                                            <div class="banner-rating__info">196 Reviews</div>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @elseif($content->background_type === 'layout_normal_background_color')
        <div class="banner banner--shape" style="background-color: {{ $content->background_color ?? '#fff' }}">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <div class="banner-content">
                            <div class="banner-heading">
                                <h1 class="bannerMain-title">{{ $content->title }}
                                    <br>
                                    <span>{{ $content->subtitle[0] }}</span>
                                    <br>
                                    <span>{{ $content->subtitle[1] ?? '' }}</span>
                                </h1>
                                @if (isset($content->is_button_enabled))
                                    <a href="{{ $content->btn_link }}" class="primary-btn mt-3"
                                        target="_blank">{{ $content->btn_text }}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @if (isset($content->is_form_enabled))
                        @if ($content->form_type === 'normal')
                            <div class="col-md-12">
                                <form action="" class="banner-search">
                                    <i class="bx bx-search"></i>
                                    <input name="location" placeholder="Where are you going?"
                                        class="banner-search__input">
                                </form>
                            </div>
                        @elseif($content->form_type === 'date_selection')
                            <div class="col-md-9">
                                <div class="date-search">
                                    <form action="#" class="date-search__btns">
                                        <label for="destination" class="date-search__btn fixed-height">
                                            <div class="first-half">
                                                <i class='bx bxs-map'></i>
                                            </div>
                                            <div class="second-half">
                                                <span class="top-label">Going to</span>
                                                <div class="content">
                                                    <input autocomplete="off" type="text"
                                                        placeholder="Where are you going?" name="destination"
                                                        id="destination" />
                                                </div>
                                            </div>
                                        </label>
                                        <button class="date-search__btn date-range-picker fixed-height"
                                            type="button">
                                            <div class="first-half">
                                                <i class='bx bxs-calendar'></i>
                                            </div>
                                            <div class="second-half">
                                                <span class="top-label">Tour Date</span>
                                                <div class="content d-flex align-items-center">
                                                    <div class="date-wrapper">
                                                        <input readonly="" type="text" class="date"
                                                            name="start_date" id="startDate" />
                                                    </div>
                                                    <div class="date-wrapper">
                                                        <input readonly="" type="text" class="date"
                                                            name="end_date" id="endDate" />
                                                    </div>
                                                </div>
                                            </div>
                                        </button>
                                        <button type="submit" class="primary-btn fixed-height">
                                            <i class="bx bx-search"></i><span>Search</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    @endif

                    @if (isset($content->is_review_enabled))
                        @if ($content->review_type === 'custom')
                            <div class="col-md-12">
                                <a href="{{ $content->custom_review_link }}" class="banner-rating" target="_blank">
                                    <div class="banner-rating__custom">
                                        <img src="{{ asset($content->custom_review_logo_image ?? 'assets/images/placeholder.png') }}"
                                            alt="{{ $content->custom_review_logo_alt_text ?? 'Review Logo' }}"
                                            class="banner-rating__platform">
                                        <div class="banner-rating__stars">
                                            <i class="banner-rating__star bx bxs-star" style="color:#fec10b"></i>
                                            <i class="banner-rating__star bx bxs-star" style="color:#fec10b"></i>
                                            <i class="banner-rating__star bx bxs-star" style="color:#fec10b"></i>
                                            <i class="banner-rating__star bx bxs-star" style="color:#fec10b"></i>
                                            <i class="banner-rating__star bx bxs-star" style="color:#fec10b"></i>
                                        </div>
                                        <div class="banner-rating__info">5 Stars</div>
                                    </div>
                                    <div class="banner-rating__reviews">
                                        <div class="banner-rating__avatars">
                                            <img src="https://i.pravatar.cc/150?img=51" alt="Reviewer 1"
                                                class="banner-rating__avatar">
                                            <img src="https://i.pravatar.cc/150?img=52" alt="Reviewer 2"
                                                class="banner-rating__avatar">
                                            <img src="https://i.pravatar.cc/150?img=53" alt="Reviewer 3"
                                                class="banner-rating__avatar">
                                            <img src="https://i.pravatar.cc/150?img=54" alt="Reviewer 4"
                                                class="banner-rating__avatar">
                                        </div>
                                        <div class="banner-rating__info">{{ $content->custom_review_count }} Reviews
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @else
                            @php
                                $review_link = null;
                                $review_image = null;
                                if ($content->review_type === 'google') {
                                    $review_link = $content->review_google_link;
                                    $review_image = 'assets/images/google.png';
                                } elseif ($content->review_type === 'trustpilot') {
                                    $review_link = $content->review_trustpilot_link;
                                    $review_image = 'assets/images/trustpilot.png';
                                } elseif ($content->review_type === 'tripadvisor') {
                                    $review_link = $content->review_tripadvisor_link;
                                    $review_image = 'assets/images/tripadvisor.png';
                                }
                            @endphp
                            <div class="col-md-12">
                                <a href="{{ $review_link }}" class="banner-rating" target="_blank">
                                    <div class="banner-rating__custom">
                                        <img src="{{ asset($review_image) }}" alt="{{ $content->review_type }} Logo"
                                            class="banner-rating__platform">
                                        <div class="banner-rating__stars">
                                            <i class="banner-rating__star bx bxs-star" style="color:#fec10b"></i>
                                            <i class="banner-rating__star bx bxs-star" style="color:#fec10b"></i>
                                            <i class="banner-rating__star bx bxs-star" style="color:#fec10b"></i>
                                            <i class="banner-rating__star bx bxs-star" style="color:#fec10b"></i>
                                            <i class="banner-rating__star bx bxs-star" style="color:#fec10b"></i>
                                        </div>
                                        <div class="banner-rating__info">5 Stars</div>
                                    </div>
                                    <div class="banner-rating__reviews">
                                        <div class="banner-rating__avatars">
                                            <img src="https://i.pravatar.cc/150?img=51" alt="Reviewer 1"
                                                class="banner-rating__avatar">
                                            <img src="https://i.pravatar.cc/150?img=52" alt="Reviewer 2"
                                                class="banner-rating__avatar">
                                            <img src="https://i.pravatar.cc/150?img=53" alt="Reviewer 3"
                                                class="banner-rating__avatar">
                                            <img src="https://i.pravatar.cc/150?img=54" alt="Reviewer 4"
                                                class="banner-rating__avatar">
                                        </div>
                                        <div class="banner-rating__info">196 Reviews</div>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    @endif
    @if (isset($content->is_destination_enabled))
        <div class=destinations style="background-color: {{ $content->destination_background_color ?? '' }}">
            <div class=container>
                <div class="row justify-content-between">
                    <div class=col-md-4>
                        <div class=destinations-content>
                            <h2 class="heading">
                                <div class=dst1>{{ $content->destination_title ?? '' }}</div>
                                <div class=dst2>
                                    {{ $content->destination_subtitle ?? '' }}
                                    <div class=darrow>
                                        <img data-src={{ asset('assets/images/darrow.webp') }} alt=image
                                            class="imgFluid lazy" width=100 height=20.36>
                                    </div>
                                </div>
                            </h2>
                        </div>
                    </div>
                    <div class=col-md-8>
                        @php
                            $styleType = $content->destination_style_type;
                            $contentType = null;
                            $resourceIds = [];
                            $columnMappings = [
                                'city' => [
                                    'name' => 'name',
                                    'image' => 'featured_image',
                                    'alt_text' => 'featured_image_alt_text',
                                    'slug' => 'slug',
                                    'route' => 'city.details',
                                ],
                                'country' => [
                                    'name' => 'name',
                                    'image' => 'featured_image',
                                    'alt_text' => 'featured_image_alt_text',
                                    'slug' => 'slug',
                                    'route' => 'country.details',
                                ],
                                'tour' => [
                                    'name' => 'title',
                                    'image' => 'featured_image',
                                    'alt_text' => 'featured_image_alt_text',
                                    'slug' => 'slug',
                                    'route' => 'tours.details',
                                ],
                            ];

                            if ($styleType === 'normal') {
                                $contentType = $content->destination_content_type_normal;
                                $resourceIds = match ($contentType) {
                                    'city' => $content->destination_city_ids_normal ?? [],
                                    'country' => $content->destination_country_ids_normal ?? [],
                                    'tour' => $content->destination_tour_ids_normal ?? [],
                                    default => [],
                                };
                            } elseif ($styleType === 'carousel') {
                                $contentType = $content->destination_content_type_carousel ?? [];
                                $resourceIds = match ($contentType) {
                                    'city' => $content->destination_city_ids_carousel ?? [],
                                    'country' => $content->destination_country_ids_carousel ?? [],
                                    'tour' => $content->destination_tour_ids_carousel ?? [],
                                    default => [],
                                };
                            }

                            $resourcesToShow = collect([]);
                            if ($contentType && !empty($resourceIds)) {
                                $resourcesToShow = match ($contentType) {
                                    'city' => \App\Models\City::withCount('tours')
                                        ->whereIn('id', $resourceIds)
                                        ->where('status', 'publish')
                                        ->get(),
                                    'country' => \App\Models\Country::whereIn('id', $resourceIds)
                                        ->where('status', 'publish')
                                        ->get(),
                                    'tour' => \App\Models\Tour::whereIn('id', $resourceIds)
                                        ->where('status', 'publish')
                                        ->get(),
                                    default => collect([]),
                                };
                            }
                            $columns = $columnMappings[$contentType] ?? [];

                        @endphp

                        <div
                            class="row g-0 {{ $content->destination_style_type === 'carousel' ? 'destinations-slider' : '' }}">
                            @foreach ($resourcesToShow as $resource)
                                @php
                                    $resourceType = '';
                                    if ($resource instanceof \App\Models\City) {
                                        $resourceType = 'city';
                                    } elseif ($resource instanceof \App\Models\Country) {
                                        $resourceType = 'country';
                                    } elseif ($resource instanceof \App\Models\Tour) {
                                        $resourceType = 'tour';
                                    }
                                @endphp
                                <div class=col-md>
                                    <a href="{{ route($columns['route'], $resource->{$columns['slug']}) }}"
                                        class=dst-card>
                                        <div class=destinations-img>
                                            <img data-src={{ asset($resource->{$columns['image']} ?? 'admin/assets/images/placeholder.png') }}
                                                alt={{ $resource->{$columns['alt_text']} }} class="imgFluid lazy">
                                        </div>
                                        <div class=dst-location>
                                            {{ $resource->{$columns['name']} }}
                                        </div>
                                        @if ($resourceType !== 'tour')
                                            <div class="dst-num">
                                                @if ($resourceType === 'city')
                                                    {{ $resource->tours_count }}
                                                @elseif ($resourceType === 'country')
                                                    {{ $resource->toursCount() }}
                                                @endif
                                            </div>
                                        @endif
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endif

@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endpush
@push('js')
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script>
        function initializeDateRangePicker(selectedDate) {
            $("#startDate").val(selectedDate);
            $("#endDate").val(selectedDate);
            $(".date-range-picker")
                .daterangepicker({
                    locale: {
                        format: "MMM D, YYYY",
                    },
                    opens: "center",
                })
                .on("apply.daterangepicker", function(ev, picker) {
                    $("#startDate").val(picker.startDate.format("MMM D, YYYY"));
                    $("#endDate").val(picker.endDate.format("MMM D, YYYY"));
                });
        }
        const today = new Date();
        const formattedDate = today.toLocaleDateString("en-US", {
            year: "numeric",
            month: "short",
            day: "numeric",
        });

        document.addEventListener("DOMContentLoaded", function() {
            initializeDateRangePicker(formattedDate);
        });
    </script>
@endpush
