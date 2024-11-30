@if (!$content)
    <div class=download-app>
        <div class=container>
            <div class=row>
                <div class=col-md-6>
                    <div class=download-app__details>
                        <div class=section-content>
                            <h2 class=heading>
                                Download App
                            </h2>
                        </div>
                        <p>Plan your next adventure with Tripviz and experience hassle-free booking! Whether you prefer
                            to
                            book in advance or go for a last-minute getaway, Tripviz has you covered.</p>
                        <div class=app-details>
                            <div class=code-details>
                                <div class=qr-code>
                                    <img data-src={{ asset('assets/images/qr.webp') }} alt=image class="imgFluid lazy"
                                        loading="lazy">
                                </div>
                                <div class=app-search>
                                    <h3>Send a link to your mobile phone</h3>
                                    <form action=# class=input-details>
                                        <input name="" placeholder="534 867 42 97"
                                            class="mobile-number-app app-input">
                                        <button class="app-btn themeBtn">SEND</button>
                                    </form>
                                </div>
                            </div>
                            <div class=download-details>
                                <h2 class=link-title>Download App</h2>
                                <div class=download-wrapper>
                                    <a href=# class=download-details__btn>
                                        <img data-src={{ asset('assets/images/apple.webp') }} alt=image
                                            class="imgFluid lazy" loading="lazy">
                                    </a>
                                    <a href=# class=download-details__btn>
                                        <img data-src={{ asset('assets/images/gp.webp') }} alt=image
                                            class="imgFluid lazy" loading="lazy">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    @php
        $isBackgroundColor = isset($content->background_type) ? $content->background_type === 'background_color' : null;
        $isBackgroundImage = isset($content->background_type) ? $content->background_type === 'background_image' : null;
    @endphp
    <div class=download-app
        @if ($isBackgroundColor && $content->background_color) style="background-color: {{ $content->background_color }}; background-image:none;" @endif
        @if ($isBackgroundImage && $content->background_image) style="background-image: url('{{ asset($content->background_image ?? 'admin/assets/images/placeholder.png') }}')" @endif>
        <div class=container>
            <div class=row>
                <div class=col-md-6>
                    <div class=download-app__details>
                        <div class=section-content>
                            <h2 class=heading>
                                {{ $content->title ?? '' }}
                            </h2>
                        </div>
                        <p>
                            {{ $content->description ?? '' }}
                        </p>
                        <div class=app-details>
                            <div class=code-details>
                                <div class=qr-code>
                                    <img data-src={{ asset('assets/images/qr.webp') }} alt=image class="imgFluid lazy"
                                        loading="lazy">
                                </div>
                                <div class=app-search>
                                    <h3>Send a link to your mobile phone</h3>
                                    <form action=# class=input-details>
                                        <input name="" placeholder="534 867 42 97"
                                            class="mobile-number-app app-input">
                                        <button class="app-btn themeBtn">SEND</button>
                                    </form>
                                </div>
                            </div>
                            <div class=download-details>
                                <h2 class=link-title>Download App</h2>
                                <div class=download-wrapper>
                                    <a href="{{ sanitizedLink($content->app_store_link) ?? '' }}" target="_blank"
                                        class=download-details__btn>
                                        <img data-src={{ asset('assets/images/apple.webp') }} alt=image
                                            class="imgFluid lazy" loading="lazy">
                                    </a>
                                    <a href="{{ sanitizedLink($content->play_store_link) ?? '' }}" target="_blank"
                                        class=download-details__btn>
                                        <img data-src={{ asset('assets/images/gp.webp') }} alt=image
                                            class="imgFluid lazy" loading="lazy">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
