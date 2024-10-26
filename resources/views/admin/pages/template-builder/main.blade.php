@extends('admin.dash_layouts.main')

@section('content')
    <div class="col-md-12">
        <div class="dashboard-content">
            {{ Breadcrumbs::render('admin.pages.template-builder', $page) }}
            <div class="section-content mt-5 mb-4">
                <h3 class="heading">Edit Template: {{ isset($title) ? $title : '' }}</h3>
            </div>
            <div class="row">
                <div class="col-md-4">

                </div>
                <div class="col-md-8">

                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style type="text/css">
    </style>
@endsection

@section('js')
    <script type="text/javascript"></script>
@endsection
