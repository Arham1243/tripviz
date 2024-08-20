<div class=newsletter-signup>
    <div class=container>
        <div class="row g-0">
            <div class=col-md-6>
                <div class=newsletter-signup__img>
                    <img data-src="{{ asset($section->bg_img ?? 'assets/images/placeholder.ong') }}"
                        alt={{ $section->heading ?? '' }} class="imgFluid lazy" loading="lazy">
                </div>
            </div>
            <div class=col-md-6>
                <div class=newsletter-signup__content>
                    <div class=section-content>
                        <h2 class=subHeading>
                            {{ $section->heading ?? '' }}
                        </h2>
                    </div>
                    <p>
                        {{ $section->short_desc ?? '' }}
                    </p>
                    @include('components.newsletter-form')
                </div>
            </div>
        </div>
        <div class=communications-subscription__privacy>
            <p>
                {{ $section->promotion_message ?? '' }}
                <a href={{ route('privacy_policy') }}>Privacy statement</a>
            </p>
        </div>
    </div>
</div>
