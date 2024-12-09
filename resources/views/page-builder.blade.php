@extends('layouts.main')
@php
    $seo = $page->seo ?? null;
@endphp
{{-- test 1 --}}
@section('content')
    @foreach ($sections as $section)
        @include('sections.' . $section->template_path, [
            'content' => json_decode($section->pivot->content),
        ])
    @endforeach
@endsection
