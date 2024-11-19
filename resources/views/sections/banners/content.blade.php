<div class="col-md-7">
    <div class="banner-content">
        <div class="banner-heading">
            <h1 class="bannerMain-title">
                <div class="title" style="color: {{ $content->title_color }};">{{ $content->title }}</div>
                <div class="subTitle subTitle--lg" style="color: {{ $content->subtitle->text_color[0] }};">
                    {{ $content->subtitle->title[0] }}
                </div>
                <div class="subTitle subTitle--sm" style="color: {{ $content->subtitle->text_color[1] }};">
                    {{ $content->subtitle->title[1] ?? '' }}
                </div>
            </h1>
            @if (isset($content->is_button_enabled))
                <a style="background: {{ $content->btn_background_color ?? 'var(--color-primary)' }};color: {{ $content->btn_text_color ?? '#fff' }};"
                    href="{{ sanitizedLink($content->btn_link) }}" class="primary-btn mt-3"
                    target="_blank">{{ $content->btn_text }} <i class='bx bx-right-arrow-alt'></i></a>
            @endif
        </div>
    </div>
</div>
