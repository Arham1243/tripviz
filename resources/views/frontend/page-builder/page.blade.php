@extends('frontend.layouts.main')
@php
    $seo = $page->seo ?? null;
@endphp
@section('content')
    @foreach ($sections as $section)
        @include('frontend.page-builder.sections.' . $section->template_path, [
            'content' => json_decode($section->pivot->content),
        ])
    @endforeach
@endsection
