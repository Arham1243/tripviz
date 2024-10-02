@extends('admin.dash_layouts.main')
@section('content')
    <div class="col-md-12">
        <div class="dashboard-content">
            {{ Breadcrumbs::render('admin.tour-categories.edit', $category) }}
            <div class="custom-sec custom-sec--form">
                <div class="custom-sec__header">
                    <div class="section-content">
                        <h3 class="heading">Edit Category: {{ isset($title) ? $title : '' }}</h3>
                    </div>
                    <a href="{{ buildUrl(url('/'), 'tours/category', $category->slug) }}" target="_blank"
                        class="themeBtn">View</a>
                </div>
            </div>
            <form action="{{ route('admin.tour-categories.update', $category->id) }}" method="POST"
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

                                </div>
                            </div>
                            <div class="form-box">
                                <div class="form-box__header">
                                    <div class="title">Tour Count Section</div>
                                </div>
                                <div class="form-box__body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-fields">
                                                <label class="title">Heading <span class="text-danger">*</span> :</label>
                                                <input type="text" name="tour_count_heading" class="field"
                                                    value="{{ old('tour_count_heading', $category->tour_count_heading) }}"
                                                    placeholder="Heading" data-required data-error="Tour Count Heading">
                                                @error('tour_count_heading')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mt-4 col-md-4 col-12">
                                            <div class="form-fields">
                                                <label class="title">Background Image <span class="text-danger">*</span>
                                                    :</label>
                                                <div class="upload" data-upload>
                                                    <div class="upload-box-wrapper">
                                                        <div class="upload-box {{ empty($category->tour_count_image) ? 'show' : '' }}"
                                                            data-upload-box>
                                                            <input type="file" name="tour_count_image"
                                                                {{ empty($category->tour_count_image) ? 'data-required' : '' }}
                                                                data-error="Tour Count Image" id="tour_count_image"
                                                                class="upload-box__file d-none" accept="image/*"
                                                                data-file-input>
                                                            <div class="upload-box__placeholder"><i
                                                                    class='bx bxs-image'></i>
                                                            </div>
                                                            <label for="tour_count_image"
                                                                class="upload-box__btn themeBtn">Upload
                                                                Image</label>
                                                        </div>
                                                        <div class="upload-box__img {{ !empty($category->tour_count_image) ? 'show' : '' }}"
                                                            data-upload-img>
                                                            <button type="button" class="delete-btn" data-delete-btn><i
                                                                    class='bx bxs-trash-alt'></i></button>
                                                            <a href="{{ asset($category->tour_count_image) }}"
                                                                class="mask" data-fancybox="gallery">
                                                                <img src="{{ asset($category->tour_count_image) }}"
                                                                    class="imgFluid" data-upload-preview>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div data-error-message class="text-danger mt-2 d-none text-center">
                                                        Please
                                                        upload a
                                                        valid image file
                                                    </div>
                                                    @error('tour_count_image')
                                                        <div class="text-danger mt-2 text-center">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="dimensions text-center mt-3">
                                                    <strong>Dimensions:</strong> 1116 &times; 250
                                                </div>
                                                @error('tour_count_heading')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mt-4 col-12">
                                            <div class="form-fields">
                                                <label class="title">Button Link<span class="text-danger">*</span>
                                                    :</label>
                                                <input type="text" name="tour_count_btn_link" class="field"
                                                    value="{{ old('tour_count_btn_link', $category->tour_count_btn_link) }}"
                                                    placeholder="Button Link" data-required data-error="Tour Count Link">
                                                @error('tour_count_btn_link')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <x-seo-options :seo="$seo ?? null" :resource="'tours/category'" :slug="$category->slug" />
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
                                        value="publish"
                                        {{ old('status', $category->status ?? '') == 'publish' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="publish">
                                        Publish
                                    </label>
                                </div>
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="radio" name="status" id="draft"
                                        value="draft"
                                        {{ old('status', $category->status ?? '') == 'draft' ? 'checked' : '' }}>
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
                                            <div class="upload-box {{ empty($category->featured_image) ? 'show' : '' }}"
                                                data-upload-box>
                                                <input type="file" name="featured_image"
                                                    {{ empty($category->featured_image) ? 'data-required' : '' }}
                                                    data-error="Feature Image" id="featured_image"
                                                    class="upload-box__file d-none" accept="image/*" data-file-input>
                                                <div class="upload-box__placeholder"><i class='bx bxs-image'></i>
                                                </div>
                                                <label for="featured_image" class="upload-box__btn themeBtn">Upload
                                                    Image</label>
                                            </div>
                                            <div class="upload-box__img {{ !empty($category->featured_image) ? 'show' : '' }}"
                                                data-upload-img>
                                                <button type="button" class="delete-btn" data-delete-btn><i
                                                        class='bx bxs-trash-alt'></i></button>
                                                <a href="{{ asset($category->featured_image) }}" class="mask"
                                                    data-fancybox="gallery">
                                                    <img src="{{ asset($category->featured_image) }}"
                                                        alt="{{ $category->featured_image_alt_text }}" class="imgFluid"
                                                        data-upload-preview>
                                                </a>
                                                <input type="text" name="featured_image_alt_text" class="field"
                                                    placeholder="Enter alt text"
                                                    value="{{ $category->featured_image_alt_text }}">
                                            </div>
                                        </div>
                                        <div data-error-message class="text-danger mt-2 d-none text-center">Please
                                            upload a
                                            valid image file
                                        </div>
                                        @error('featured_image')
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

                        <div class="form-box">
                            <div class="form-box__header">
                                <div class="title">Tours</div>
                            </div>
                            <div class="form-box__body">
                                <div class="form-fields">
                                    @php
                                        $selectedTopFeaturedTours =
                                            json_decode($category->top_featured_tour_ids, true) ?? [];
                                    @endphp
                                    <label class="title">Top 4 featured tours <span class="text-danger">*</span>
                                        :</label>
                                    <select name="top_featured_tour_ids[]" multiple class="choice-select"
                                        data-max-items="4" placeholder="Select Tours" data-required
                                        data-error="Top 4 featured tours">
                                        @foreach ($tours as $tour)
                                            <option value="{{ $tour->id }}"
                                                {{ in_array($tour->id, old('top_featured_tour_ids', $selectedTopFeaturedTours)) ? 'selected' : '' }}>
                                                {{ $tour->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('top_featured_tour_ids')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-fields">
                                    @php
                                        $selectedBottomFeaturedTours =
                                            json_decode($category->bottom_featured_tour_ids, true) ?? [];
                                    @endphp
                                    <label class="title">Bottom featured tours <span class="text-danger">*</span>
                                        :</label>
                                    <select name="bottom_featured_tour_ids[]" multiple class="choice-select"
                                        placeholder="Select Tours" data-required data-error="Bottom featured tours">
                                        @foreach ($tours as $tour)
                                            <option value="{{ $tour->id }}"
                                                {{ in_array($tour->id, old('bottom_featured_tour_ids', $selectedBottomFeaturedTours)) ? 'selected' : '' }}>
                                                {{ $tour->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('bottom_featured_tour_ids')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-fields">
                                    @php
                                        $selectedRecommendedTours =
                                            json_decode($category->recommended_tour_ids, true) ?? [];
                                    @endphp
                                    <label class="title">Recommended tours <span class="text-danger">*</span>
                                        :</label>
                                    <select name="recommended_tour_ids[]" multiple class="choice-select"
                                        data-max-items="4" placeholder="Select Tours" data-required
                                        data-error="Recommended tours">
                                        @foreach ($tours as $tour)
                                            <option value="{{ $tour->id }}"
                                                {{ in_array($tour->id, old('recommended_tour_ids', $selectedRecommendedTours)) ? 'selected' : '' }}>
                                                {{ $tour->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('recommended_tour_ids')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-box">
                            <div class="form-box__header">
                                <div class="title">Reviews</div>
                            </div>
                            <div class="form-box__body">
                                <div class="form-fields">
                                    @php
                                        $selectedtoursReviews = json_decode($category->tour_reviews_ids, true) ?? [];
                                    @endphp
                                    <label class="title">Featured Reviews<span class="text-danger">*</span>
                                        :</label>
                                    <select name="tour_reviews_ids[]" multiple class="choice-select" data-max-items="4"
                                        placeholder="Select Reviews" data-required data-error="Featured Reviews">
                                        @foreach ($toursReviews as $review)
                                            <option value="{{ $review->id }}"
                                                {{ in_array($review->id, old('tour_reviews_ids', $selectedtoursReviews)) ? 'selected' : '' }}>
                                                {{ $review->title }} (Rating: {{ $review->rating }}/5)
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('tour_reviews_ids')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
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
