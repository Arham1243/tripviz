@if (!$content)
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="banner-content">
                        <div class="banner-heading">
                            <h1>
                                Discover Your
                                <div class="bannerMain-title">Next Adventure</div>
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="banner-img">
                        <img data-src="{{ asset('assets/images/baloon.webp') }}" alt="image" class="imgFluid lazy"
                            width="345.89" height="186">
                    </div>
                </div>
                <form action="" class="banner-form">
                    <div class="search">
                        <input name="location" placeholder="Where are you going?">
                        <i class="bx bx-search"></i>
                    </div>
                </form>
            </div>
        </div>
    </div>
@else
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="banner-content">
                        <div class="banner-heading">
                            @php
                                $heading = $content->heading ?? '';
                                $words = explode(' ', trim($heading));
                                $lastTwoWords = array_slice($words, -2);
                                $lastTwoWordsString = implode(' ', $lastTwoWords);
                                $mainHeading = implode(' ', array_slice($words, 0, -2)); // Get all words except the last two
                            @endphp

                            <h1>
                                {{ $mainHeading }}
                                <div class="bannerMain-title">{{ $lastTwoWordsString }}</div>
                            </h1>


                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="banner-img">
                        <img data-src="{{ asset($content->right_image) }}" alt="image" class="imgFluid lazy"
                            width="345.89" height="186">
                    </div>
                </div>
                <form action="" class="banner-form">
                    <div class="search">
                        <input name="location" placeholder="Where are you going?">
                        <i class="bx bx-search"></i>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif
