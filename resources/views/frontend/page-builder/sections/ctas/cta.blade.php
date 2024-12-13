@if (!$content)
    @include('frontend.page-builder.sections.ctas.styles.' . 'style-1')
@else
    @include('frontend.page-builder.sections.ctas.styles.' . $content->section_style)
@endif
