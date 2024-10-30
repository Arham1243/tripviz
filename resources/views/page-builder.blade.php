@extends('layouts.main')

@section('content')
    @foreach ($sections as $section)
        @include('sections.' . $section->template_path, ['pivotData' => $section->pivot])
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
