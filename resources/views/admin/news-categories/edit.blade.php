@extends('admin.dash_layouts.main')
@section('content')
    <div class="col-md-12">
        <div class="dashboard-content">
            {{ Breadcrumbs::render('admin.news-categories.edit', $category) }}
            <div class="custom-sec custom-sec--form">
                <div class="custom-sec__header">
                    <div class="section-content">
                        <h3 class="heading">Edit Category: {{ isset($title) ? $title : '' }}</h3>
                    </div>
                    <a href="{{ buildUrl(url('/'), 'news/category', $category->slug) }}" target="_blank"
                        class="themeBtn">View</a>
                </div>
            </div>
            <form action="{{ route('admin.news-categories.update', $category->id) }}" method="POST"
                enctype="multipart/form-data" id="validation-form">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-wrapper">
                            <div class="form-box">
                                <div class="form-box__header">
                                    <div class="title">Category Content</div>
                                </div>
                                <div class="form-box__body">
                                    <div class="form-fields">
                                        <label class="title">Name <span class="text-danger">*</span> :</label>
                                        <input type="text" name="name" class="field"
                                            value="{{ old('name', $category->name) }}" placeholder="Name" data-required
                                            data-error="name">
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-fields">
                                        <label class="title">Slug:</label>
                                        <input type="text" name="slug" class="field"
                                            value="{{ old('title', $category->slug) }}" placeholder="Slug">
                                        @error('slug')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-fields">
                                        <label class="title">Parent <span class="text-danger">*</span> :</label>
                                        <select name="parent_category_id" class="choice-select"
                                            {{ !$categories->isEmpty() ? 'data-required' : '' }} data-error="Category">
                                            <option value="" selected>Parent Category</option>

                                            @foreach ($categories as $cat)
                                                <option value="{{ $cat->id }}"
                                                    {{ $category->parent_category_id == $cat->id ? 'selected' : '' }}>
                                                    {{ $cat->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('parent_category_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <x-seo-options :seo="$seo ?? null" :resource="'news/category'" :slug="$category->slug" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="seo-wrapper">
                            <div class="form-box">
                                <div class="form-box__header">
                                    <div class="title">Publish</div>
                                </div>
                                <div class="form-box__body">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="publish"
                                            value="publish" checked {{ old('status') }}>
                                        <label class="form-check-label" for="publish">
                                            Publish
                                        </label>
                                    </div>
                                    <button class="themeBtn ms-auto mt-4">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('css')
    <style type="text/css">

    </style>
@endsection
