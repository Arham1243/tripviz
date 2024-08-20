<div class=download-app
    @if ($section->preview_img != null) style="background-image: url({{ asset($section->bg_img) }})" @endif>
    <div class=container>
        <div class=row>
            <div class=col-md-6>
                <div class=download-app__details>
                    <div class=section-content>
                        <h2 class=heading>
                            {{ $section->heading ?? '' }}
                        </h2>
                    </div>
                    <p>
                        {{ $section->short_desc ?? '' }}</p>
                    <div class=app-details>
                        <div class=code-details>
                            <div class=qr-code>
                                <img data-src="{{ asset('assets/images/qr.webp') }}" alt=image class="imgFluid lazy"
                                    loading="lazy">
                            </div>
                            <div class=app-search>
                                <h3>Send a link to your mobile phone</h3>
                                <form action=# class=input-details>
                                    <input name="" placeholder="534 867 42 97" class="mobile-number-app app-input">
                                    <button class="app-btn themeBtn">SEND</button>
                                </form>
                            </div>
                        </div>
                        <div class=download-details>
                            <h2 class=link-title>Download App</h2>
                            <div class=download-wrapper>
                                <a href={{ $section->ios_app_link ?? '' }} target="_blank" class=download-details__btn>
                                    <img data-src="{{ asset('assets/images/apple.webp') }}" alt=image
                                        class="imgFluid lazy" loading="lazy">
                                </a>
                                <a href={{ $section->android_app_link ?? '' }} target="_blank"
                                    class=download-details__btn>
                                    <img data-src="{{ asset('assets/images/gp.webp') }}" alt=image class="imgFluid lazy"
                                        loading="lazy">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
