@push('css')
    <link href="https://fonts.googleapis.com/css2?family=Patrick+Hand&display=swap" rel="stylesheet">
@endpush

<div class="banner-moto">
    @if (isset($content->moto_title->title[0]))
        <div class="banner-moto-title"
            style="color: {{ isset($content->moto_title->text_color[0]) ? $content->moto_title->text_color[0] : '' }};">
            {{ $content->moto_title->title[0] }}
        </div>
    @endif

    @if (isset($content->moto_title->title[1]))
        <div class="banner-moto-title"
            style="color: {{ isset($content->moto_title->text_color[1]) ? $content->moto_title->text_color[1] : '' }};">
            {{ $content->moto_title->title[1] }}
        </div>
    @endif
</div>
