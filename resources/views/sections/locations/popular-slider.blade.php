@if (!$content)
    <div class=popular-related-destinations>
        <div class=container>
            <div class=section-content>
                <h2 class=heading>Popular Related Destinations</h2>
            </div>
            <div class="row mt-4">
                <div class=col-md-3>
                    <div class=popular-related-destinations__content>
                        <div class=popular-related-destinations__img>
                            <img data-src={{ asset('assets/images/popular1.webp') }} alt=image class="imgFluid lazy"
                                loading="lazy">
                        </div>
                        <a href=# class=popular-related-destinations__title>
                            Vietnam
                        </a>
                    </div>
                </div>
                <div class=col-md-3>
                    <div class=popular-related-destinations__content>
                        <div class=popular-related-destinations__img>
                            <img data-src={{ asset('assets/images/popular1.webp') }} alt=image class="imgFluid lazy"
                                loading="lazy">
                        </div>
                        <a href=# class=popular-related-destinations__title>
                            Vietnam
                        </a>
                    </div>
                </div>
                <div class=col-md-3>
                    <div class=popular-related-destinations__content>
                        <div class=popular-related-destinations__img>
                            <img data-src={{ asset('assets/images/popular1.webp') }} alt=image class="imgFluid lazy"
                                loading="lazy">
                        </div>
                        <a href=# class=popular-related-destinations__title>
                            Vietnam
                        </a>
                    </div>
                </div>
                <div class=col-md-3>
                    <div class=popular-related-destinations__content>
                        <div class=popular-related-destinations__img>
                            <img data-src={{ asset('assets/images/popular1.webp') }} alt=image class="imgFluid lazy"
                                loading="lazy">
                        </div>
                        <a href=# class=popular-related-destinations__title>
                            Vietnam
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <div class=popular-related-destinations>
        <div class=container>
            <div class=section-content>
                <h2 class=heading> {{ $content->heading }}</h2>
            </div>
            <div class="row mt-4">
                @php
                    $cities = \App\Models\City::whereIn('id', $content->city_ids)
                        ->where('status', 'publish')
                        ->withCount('tours')
                        ->get();
                @endphp
                @foreach ($cities as $city)
                    <div class=col-md-3>
                        <div class=popular-related-destinations__content>
                            <div class=popular-related-destinations__img>
                                <img data-src={{ asset($city->featured_image ?? 'admin/assets/images/placeholder.png') }}
                                    alt="{{ $city->featured_image ?? 'image' }}" class="imgFluid lazy" loading="lazy">
                            </div>
                            <a href=# class=popular-related-destinations__title>
                                {{ $city->name }}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
