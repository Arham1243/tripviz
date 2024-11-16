<div class="col-md-7">
    <div class="banner-content">
        <div class="banner-heading">
            <h1 class="bannerMain-title">
                <div class="title">{{ $content->title }}</div>
                <div class="subTitle subTitle--lg">{{ $content->subtitle[0] }}</div>
                <div class="subTitle subTitle--sm">{{ $content->subtitle[1] ?? '' }}</div>
            </h1>
            @if (isset($content->is_button_enabled))
                <a href="{{ sanitizedLink($content->btn_link) }}" class="primary-btn mt-3"
                    target="_blank">{{ $content->btn_text }}</a>
            @endif
        </div>
    </div>
</div>
