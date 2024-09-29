@extends('admin.dash_layouts.main')
@section('content')
    <div class="col-md-12">
        <div class="dashboard-content">
            {{ Breadcrumbs::render('admin.locations.edit', $item) }}
            <div class="custom-sec custom-sec--form">
                <div class="custom-sec__header">
                    <div class="section-content">
                        <h3 class="heading">Edit Location: {{ isset($title) ? $title : '' }}</h3>
                    </div>
                    <a href="{{ buildUrl(url('/'), 'location', $item->slug) }}" target="_blank" class="themeBtn">View</a>
                </div>
            </div>
            <form action="{{ route('admin.locations.update', $item->id) }}" method="POST" enctype="multipart/form-data"
                id="validation-form">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-wrapper">
                            <div class="form-box">
                                <div class="form-box__header">
                                    <div class="title">Location Content</div>
                                </div>
                                <div class="form-box__body">
                                    <div class="form-fields">
                                        <label class="title">Name <span class="text-danger">*</span> :</label>
                                        <input type="text" name="name" class="field"
                                            value="{{ old('name', $item->name) }}" placeholder="Name" data-required
                                            data-error="name">
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-fields">
                                        <label class="title">Slug:</label>
                                        <input type="text" name="slug" class="field"
                                            value="{{ old('title', $item->slug) }}" placeholder="Slug">
                                        @error('slug')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-fields">
                                        <label class="title">Parent <span class="text-danger">*</span> :</label>
                                        <select name="parent_location_id" class="choice-select"
                                            {{ !$parentItems->isEmpty() ? 'data-required' : '' }}
                                            data-error="Parent Location">
                                            <option value="" selected>Parent Category</option>

                                            @foreach ($parentItems as $parentItem)
                                                <option value="{{ $parentItem->id }}"
                                                    {{ $item->parent_location_id == $parentItem->id ? 'selected' : '' }}>
                                                    {{ $parentItem->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('parent_location_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-fields">
                                        <label class="title">Description <span class="text-danger">*</span> :</label>
                                        <textarea class="editor" name="content" data-placeholder="content" data-required data-error="Description">
                                            {!! old('content', $item->content) !!}
                                        </textarea>
                                        @error('content')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <x-seo-options :seo="$seo ?? null" :resource="'location'" :slug="$item->slug" />
                        </div>
                    </div>
                    <div class="col-md-3">
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
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="radio" name="status" id="draft"
                                        value="draft"
                                        {{ old('status', $news->status ?? '') == 'draft' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="draft">
                                        Draft
                                    </label>
                                </div>
                                <button class="themeBtn ms-auto mt-4">Save Changes</button>
                            </div>
                        </div>
                        <div class="form-box">
                            <div class="form-box__header">
                                <div class="title">Feature Image</div>
                            </div>
                            <div class="form-box__body">
                                <div class="form-fields">
                                    <div class="upload" data-upload>
                                        <div class="upload-box-wrapper">
                                            <div class="upload-box {{ empty($item->feature_image) ? 'show' : '' }}"
                                                data-upload-box>
                                                <input type="file" name="feature_image"
                                                    {{ empty($item->feature_image) ? 'data-required' : '' }}
                                                    data-error="Feature Image" id="feature_image"
                                                    class="upload-box__file d-none" accept="image/*" data-file-input>
                                                <div class="upload-box__placeholder"><i class='bx bxs-image'></i>
                                                </div>
                                                <label for="feature_image" class="upload-box__btn themeBtn">Upload
                                                    Image</label>
                                            </div>
                                            <div class="upload-box__img {{ !empty($item->feature_image) ? 'show' : '' }}"
                                                data-upload-img>
                                                <button type="button" class="delete-btn" data-delete-btn><i
                                                        class='bx bxs-trash-alt'></i></button>
                                                <a href="{{ asset($item->feature_image) }}" class="mask"
                                                    data-fancybox="gallery">
                                                    <img src="{{ asset($item->feature_image ?? 'admin/assets/images/loading.webp') }}"
                                                        alt="{{ $item->feature_image_alt_text }}" class="imgFluid"
                                                        data-upload-preview>
                                                </a>
                                                <input type="text" name="feature_image_alt_text" class="field"
                                                    placeholder="Enter alt text"
                                                    value="{{ $item->feature_image_alt_text }}">
                                            </div>
                                        </div>
                                        <div data-error-message class="text-danger mt-2 d-none text-center">Please
                                            upload a
                                            valid image file
                                        </div>
                                        @error('feature_image')
                                            <div class="text-danger mt-2 text-center">{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="dimensions text-center mt-3">
                                        <strong>Dimensions:</strong> 270 &times; 260
                                    </div>
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
