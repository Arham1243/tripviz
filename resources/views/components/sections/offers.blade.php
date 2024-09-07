<div class=offers-section>
    <div class=container>
        <div class=offers-section__details>
            <div class=offers-section__img>
                <img data-src="{{ asset($section->bg_img ?? 'assets/images/placeholder.ong') }}"
                    alt={{ $section->heading ?? '' }} class="imgFluid lazy" loading="lazy" height="200">
            </div>
            <div class=GroupTourCard_content>
                <span class=GroupTourCard_title>{{ $section->heading ?? '' }}</span>
                <span class=GroupTourCard_subtitle>
                    {{ $section->short_desc ?? '' }}
                </span>
                <div class="GroupTourCard_callBackButton pt-3">
                    <span class="GroupTourCard_text app-btn themeBtn">Get A Callback</span>
                </div>
            </div>
        </div>
    </div>
</div>
