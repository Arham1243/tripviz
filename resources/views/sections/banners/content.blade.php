<div class="col-md-7">
    <div class="banner-content">
        <div class="banner-heading">
            <h1>
                <div class="bannerMain-title">{{ $content->title }}
                    <br>
                    <span>{{ $content->subtitle[0] }}</span>
                    <br>
                    <span>{{ $content->subtitle[1] ?? '' }}</span>
                </div>
            </h1>
            @if (isset($content->is_button_enabled))
                <a href="{{ $content->btn_link }}" class="primary-btn mt-3" target="_blank">{{ $content->btn_text }}</a>
            @endif
        </div>
    </div>
</div>
