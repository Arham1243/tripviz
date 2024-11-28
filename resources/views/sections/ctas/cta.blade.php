@if (!$content)
    @include('sections.ctas.styles.' . 'style-1')
@else
    @include('sections.ctas.styles.' . $content->section_style)
@endif
