@if (!$content)
    <div class="more-offers my-5">
        <div class=container>
            <div class=section-content>
                <h2 class=heading>
                    Top Water Activities in Dubai
                </h2>
            </div>
            <div class="row pt-3">
                <div class=col-lg-6>
                    <div class=more-offers__content>
                        <div class=more-offers__details>
                            <div class=featured-text>Special Offers</div>
                            <h2 class=more-offers-title>Private Arabic Desert Camp</h2>
                            <p class=more-offers-sub-title>A private camp with Arabian-style decor.<br>
                                Sit-out seating from two to fifty guests.<br>
                                Ambient music system for atmosphere.<br>
                                warm cozy bone fire will put charm in the environment.</p>
                            <div class=more-offers__img
                                style="background:url('{{ asset('assets/images/private-arabic-desert-camp.webp') }}')">
                            </div>
                        </div>
                    </div>
                </div>
                <div class=col-lg-3>
                    <div class=more-offers__content>
                        <div class=more-offers__details>
                            <div class=featured-icon><i class=icofont-ui-map></i></div>
                            <h2 class=more-offers-title>Beach Party</h2>
                            <p class=more-offers-sub-title>Beachside setup Decor<br>
                                Relish the live BBQ feasts<br>
                                Seating setup for 2 - 50 People.</p>
                            <div class=more-offers__img
                                style="background:url('{{ asset('assets/images/beach-party.webp') }}')"></div>
                        </div>
                    </div>
                </div>
                <div class=col-lg-3>
                    <div class=more-offers__content>
                        <div class=more-offers__details>
                            <div class=featured-icon><i class=icofont-island-alt></i></div>
                            <h2 class=more-offers-title>Private Dinner</h2>
                            <p class=more-offers-sub-title>Private setup Decor<br>
                                Relish the live BBQ feasts<br>
                                Seating setup for 2 - 50 People.</p>
                            <div class=more-offers__img
                                style="background:url('{{ asset('assets/images/private-dinner.webp') }}')"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="more-offers my-5">
        <div class=container>
            <div class=section-content>
                <h2 class=heading>
                    {{ $content->heading }}
                </h2>
            </div>
            <div class="row pt-3">
                @foreach ($content->activities as $activity)
                    <div class="col-lg-{{ $loop->first ? '6' : '3' }}">
                        <div class=more-offers__content>
                            <div class=more-offers__details>
                                @if (isset($activity->is_special) && $activity->is_special == 1)
                                    <div class=featured-text>Special Offers</div>
                                @endif
                                <h2 class=more-offers-title>{{ $activity->title }}</h2>
                                <p class=more-offers-sub-title>{{ $activity->content }}</p>
                                <div class=more-offers__img style="background:url('{{ asset($activity->image) }}')">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
