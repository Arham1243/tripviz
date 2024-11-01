<title>{{ $seo->seo_title ?? (isset($title) ? $title . ' | ' . env('APP_NAME') : env('APP_NAME')) }}</title>
@if ($seo)
    @if ($seo->seo_description)
        <meta name="description" content="{{ $seo->seo_description }}">
    @endif
    <meta name="robots" content="{{ $seo->is_seo_index ? 'index, follow' : 'noindex, nofollow' }}">
    @if ($seo->canonical)
        <link rel="canonical" href="{{ $seo->canonical }}">
    @endif
    @if ($seo->fb_title)
        <meta property="og:title" content="{{ $seo->fb_title }}">
    @endif
    @if ($seo->fb_description)
        <meta property="og:description" content="{{ $seo->fb_description }}">
    @endif
    @if ($seo->fb_featured_image)
        <meta property="og:image" content="{{ asset($seo->fb_featured_image) }}">
    @endif
    @if ($seo->tw_title)
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ $seo->tw_title }}">
    @endif
    @if ($seo->tw_description)
        <meta name="twitter:description" content="{{ $seo->tw_description }}">
    @endif
    @if ($seo->tw_featured_image)
        <meta name="twitter:image" content="{{ asset($seo->tw_featured_image) }}">
    @endif
    @if ($seo->schema)
        {!! $seo->schema !!}
    @endif
@endif
