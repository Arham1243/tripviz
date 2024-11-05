@if (!$content)
    <div class=offers-section>
        <div class=container>
            <div class=offers-section__details>
                <div class=offers-section__img>
                    <img data-src={{ asset('assets/images/group_tour_desktop_banner_image.webp') }} alt=image
                        class="imgFluid lazy" loading="lazy" height="200">
                </div>
                <div class=GroupTourCard_content>
                    <span class=GroupTourCard_title>Bigger Group? Get special offers up to 50% Off!</span>
                    <span class=GroupTourCard_subtitle>We create unforgettable adventures, customised for your
                        group.</span>
                    <div class="GroupTourCard_callBackButton pt-3">
                        <span class="GroupTourCard_text app-btn themeBtn">Get A Callback</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <div class=offers-section>
        <div class=container>
            <div class=offers-section__details>
                <div class=offers-section__img>
                    <img data-src="{{ asset($content->background_image ?? 'admin/assets/images/placeholder.png') }}"
                        alt="{{ $content->alt_text ?? 'image' }}" class="imgFluid lazy" width="345.89" height="186">
                </div>
                <div class=GroupTourCard_content>
                    <span class=GroupTourCard_title>{{ $content->heading }}</span>
                    <span class=GroupTourCard_subtitle>{{ $content->paragraph }}</span>
                    <div class="GroupTourCard_callBackButton pt-3">
                        <a href="{{ $content->see_more_link }}" target="_blank"
                            class="GroupTourCard_text app-btn themeBtn">{{ $content->see_more_text }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
