@extends('layouts.main')

@section('content')
    @foreach ($sections as $section)
        @include('sections.' . $section->template_path, [
            'content' => json_decode($section->pivot->content),
        ])
    @endforeach
@endsection

@section('css')
    <style type="text/css">
        /*in page css here*/
    </style>
@endsection

@section('js')
    <script type="text/javascript">
        /*in page js here*/
    </script>
@endsection
