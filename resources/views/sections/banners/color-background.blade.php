@if (!$content)
    <div class="banner banner--solid" style="background-color: #1c4d993b">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="banner-content">
                        <div class="banner-heading">
                            <h1>
                                <div class="bannerMain-subtitle">Lorem, ipsum dolor.</div>
                                <div class="bannerMain-title">Discover Your <span>Next Adventure</span></div>
                            </h1>
                            <a href="#" class="primary-btn mt-3">Learn More</a>
                        </div>
                    </div>
                </div>
                <form action="" class="banner-search">
                    <i class="bx bx-search"></i>
                    <input name="location" placeholder="Where are you going?" class="banner-search__input">
                </form>
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
                            <img src="https://i.pravatar.cc/150?img=51" alt="Reviewer 1" class="banner-rating__avatar">
                            <img src="https://i.pravatar.cc/150?img=52" alt="Reviewer 2" class="banner-rating__avatar">
                            <img src="https://i.pravatar.cc/150?img=53" alt="Reviewer 3" class="banner-rating__avatar">
                            <img src="https://i.pravatar.cc/150?img=54" alt="Reviewer 4" class="banner-rating__avatar">
                        </div>
                        <div class="banner-rating__info">196 Reviews</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="banner banner--solid" style="background-color: {{ $content->background_color ?? '#1c4d993b' }}">
        @php
            $heading = $content->heading ?? '';
            $words = explode(' ', trim($heading));
            $lastTwoWords = array_slice($words, -2);
            $lastTwoWordsString = implode(' ', $lastTwoWords);
            $mainHeading = implode(' ', array_slice($words, 0, -2));
        @endphp
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="banner-content">
                        <div class="banner-heading">
                            <h1>
                                <div class="bannerMain-subtitle">{{ $content->subHeading }}</div>
                                <div class="bannerMain-title">{{ $mainHeading }}
                                    <span>{{ $lastTwoWordsString }}</span>
                                </div>
                            </h1>
                            <a href="{{ $content->btn_link }}" class="primary-btn mt-3"
                                target="_blank">{{ $content->btn_text }}</a>
                        </div>
                    </div>
                </div>
                <form action="" class="banner-search">
                    <i class="bx bx-search"></i>
                    <input name="location" placeholder="Where are you going?" class="banner-search__input">
                </form>
                @if ($content->review_type == 'google')
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
                @endif
            </div>
        </div>
    </div>
@endif
