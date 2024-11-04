@if (!$content)
    <div class=tour-activity__cards2>
        <div class=container>
            <div class=tours-content>
                <div class=section-content>
                    <div class=heading>Top Tours</div>
                </div>
                <div class=more-link>
                    <a href=#>More<i class="bx bx-right-arrow-alt"></i></a>
                </div>
            </div>
            <div class="row pt-3">
                <div class=col-md-4>
                    <div class=card-content>
                        <a href=# class=card_img>
                            <img data-src="{{ asset('assets/images/8c (1).webp') }}" alt=image class="imgFluid lazy"
                                loading="lazy">
                            <div class=price-details>
                                <div class=heart-icon>
                                    <div class=service-wishlis>
                                        <i class="bx bx-heart"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div class=tour-activity-card__details>
                            <div class=vertical-activity-card__header>
                                <div><span> From $159
                                    </span></div>
                                <div class="tour-activity-card__details--title">
                                    Karachi Sightseeing Private Tour: Explore the Captivating City of Lights
                                </div>
                            </div>
                            <div class=tour-activity__RL>
                                <div class=card-rating>
                                    <i class="bx bxs-star"></i>
                                    <span>5.0 1 Rating</span>
                                </div>
                                <div class=card-location>
                                    <i class="bx bx-location-plus"></i>
                                    Dubai
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=col-md-4>
                    <div class=card-content>
                        <a href=# class=card_img>
                            <img data-src={{ asset('assets/images/1b.webp') }} alt=image class="imgFluid lazy"
                                loading="lazy">
                            <div class=price-details>
                                <div class=heart-icon>
                                    <div class=service-wishlis>
                                        <i class="bx bx-heart"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div class=tour-activity-card__details>
                            <div class=vertical-activity-card__header>
                                <div><span> From $159
                                    </span></div>
                                <div class="tour-activity-card__details--title">
                                    Karachi Sightseeing Private Tour: Explore the Captivating City of Lights
                                </div>
                            </div>
                            <div class=tour-activity__RL>
                                <div class=card-rating>
                                    <i class="bx bxs-star"></i>
                                    <span>5.0 1 Rating</span>
                                </div>
                                <div class=card-location>
                                    <i class="bx bx-location-plus"></i>
                                    Dubai
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=col-md-4>
                    <div class=card-content>
                        <a href=# class=card_img>
                            <img data-src={{ asset('assets/images/8c.webp') }} alt=image class="imgFluid lazy"
                                loading="lazy">
                            <div class=price-details>
                                <div class=heart-icon>
                                    <div class=service-wishlis>
                                        <i class="bx bx-heart"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div class=tour-activity-card__details>
                            <div class=vertical-activity-card__header>
                                <div><span> From $159
                                    </span></div>
                                <div class="tour-activity-card__details--title">
                                    Karachi Sightseeing Private Tour: Explore the Captivating City of Lights
                                </div>
                            </div>
                            <div class=tour-activity__RL>
                                <div class=card-rating>
                                    <i class="bx bxs-star"></i>
                                    <span>5.0 1 Rating</span>
                                </div>
                                <div class=card-location>
                                    <i class="bx bx-location-plus"></i>
                                    Dubai
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <div class=tour-activity__cards2>
        <div class=container>
            <div class=tours-content>
                <div class=section-content>
                    <div class=heading>{{ $content->heading }}</div>
                </div>
                <div class=more-link>
                    <a href="{{ $content->see_more_link }}" target="_blank">{{ $content->see_more_text }}<i
                            class="bx bx-right-arrow-alt"></i></a>
                </div>
            </div>
            <div class="row pt-3">
                @php
                    $tours = \App\Models\Tour::whereIn('id', $content->tour_ids)
                        ->where('status', 'publish')
                        ->get();
                @endphp
                @foreach ($tours as $tour)
                    <div class=col-md-4>
                        <div class=card-content>
                            <a href=# class=card_img>
                                <img data-src={{ asset($tour->featured_image ?? 'admin/assets/images/placeholder.png') }}
                                    alt="{{ $tour->featured_image_alt_text ?? 'image' }}" class="imgFluid lazy"
                                    loading="lazy">
                                <div class=price-details>
                                    <div class=heart-icon>
                                        <div class=service-wishlis>
                                            <i class="bx bx-heart"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <div class=tour-activity-card__details>
                                <div class=vertical-activity-card__header>
                                    <div><span> From $159
                                        </span></div>
                                    <div class="tour-activity-card__details--title">
                                        {{ $tour->title }}
                                    </div>
                                </div>
                                <div class=tour-activity__RL>
                                    <div class=card-rating>
                                        <i class="bx bxs-star"></i>
                                        <span>5.0 1 Rating</span>
                                    </div>
                                    <div class=card-location>
                                        <i class="bx bx-location-plus"></i>
                                        Dubai
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
