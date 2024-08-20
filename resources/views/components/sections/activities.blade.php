<div class=more-offers>
    <div class=container>
        <div class=section-content>
            <h2 class=heading>
                {{ $section->heading ?? '' }}
            </h2>
        </div>
        <div class="row pt-3">
            <div class=col-lg-6>
                <div class=more-offers__content>
                    <div class=more-offers__details>
                        <div class=featured-text>Special Offers</div>
                        <h2 class=more-offers-title>
                            {{ $section->card_title_1 ?? '' }}
                        </h2>
                        <p class=more-offers-sub-title>
                            {{ $section->card_para_1 ?? '' }}
                        </p>
                        <div class=more-offers__img
                            style="background-image:url({{ asset($section->card_bg_1 ?? 'assets/images/placeholder.png') }})">
                        </div>
                    </div>
                </div>
            </div>
            <div class=col-lg-3>
                <div class=more-offers__content>
                    <div class=more-offers__details>
                        <div class=featured-icon><i class=icofont-ui-map></i></div>
                        <h2 class=more-offers-title>
                            {{ $section->card_title_2 ?? '' }}
                        </h2>
                        <p class=more-offers-sub-title>
                            {{ $section->card_para_2 ?? '' }}
                        </p>
                        <div class=more-offers__img
                            style="background-image:url({{ asset($section->card_bg_2 ?? 'assets/images/placeholder.png') }})">
                        </div>
                    </div>
                </div>
            </div>
            <div class=col-lg-3>
                <div class=more-offers__content>
                    <div class=more-offers__details>
                        <div class=featured-icon><i class=icofont-island-alt></i></div>
                        <h2 class=more-offers-title>{{ $section->card_title_3 ?? '' }}</h2>
                        <p class=more-offers-sub-title>
                            {{ $section->card_para_3 ?? '' }}
                        </p>
                        <div class=more-offers__img
                            style="background-image:url({{ asset($section->card_bg_3 ?? 'assets/images/placeholder.png') }})">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
