@extends('admin.dash_layouts.main')
@section('content')
    <div class="col-md-12">
        <div class="dashboard-content">
            {{ Breadcrumbs::render('admin.blogs.edit', $blog) }}
            <div class="custom-sec custom-sec--form">
                <div class="custom-sec__header">
                    <div class="section-content">
                        <h3 class="heading">Edit Blog: {{ isset($title) ? $title : '' }}</h3>
                    </div>
                </div>
            </div>
            <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data"
                id="validation-form">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-wrapper">
                            <div class="form-box">
                                <div class="form-box__header">
                                    <div class="title">Blog Content</div>
                                </div>
                                <div class="form-box__body">
                                    <div class="form-fields">
                                        <label class="title">Slug <span class="text-danger">*</span> :</label>
                                        <input type="text" name="slug" class="field"
                                            value="{{ old('title', $blog->slug) }}" placeholder="Slug" data-required
                                            data-error="Slug" oninput="formatSlug(this)">
                                        @error('slug')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-fields">
                                        <label class="title">Title <span class="text-danger">*</span> :</label>
                                        <input type="text" name="title" class="field"
                                            value="{{ old('title', $blog->title) }}" placeholder="New Blog" data-required
                                            data-error="Title">
                                        @error('title')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-fields">
                                        <label class="title">Content <span class="text-danger">*</span> :</label>
                                        <textarea class="editor" name="content" data-placeholder="content" data-required data-error="Content">
                                            {!! old('content', $blog->content) !!}
                                        </textarea>
                                        @error('content')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-fields">
                                        <label class="title">Gallery <span class="text-danger">*</span> :</label>
                                        <div class="multiple-upload" data-upload-multiple>
                                            <input type="file" class="gallery-input d-none" multiple
                                                data-upload-multiple-input accept="image/*" id="gallery" name="gallery[]">
                                            <label class="multiple-upload__btn themeBtn" for="gallery">
                                                <i class='bx bx-plus'></i>
                                                Select Images
                                            </label>
                                            <ul class="multiple-upload__imgs mt-4" data-upload-multiple-images>
                                            </ul>
                                            <div class="text-danger error-message d-none" data-upload-multiple-error></div>
                                        </div>

                                    </div>
                                    @if (!$blog->media->isEmpty())
                                        <div class="form-fields mb-5">
                                            <label class="title">Current Gallery images:</label>
                                            <ul class="multiple-upload__imgs">
                                                @foreach ($blog->media as $media)
                                                    <li class="single-image">
                                                        <a href="{{ route('admin.media.delete', $media->id) }}"
                                                            onclick="return confirm('Are you sure you want to delete this media?')"
                                                            class="delete-btn">
                                                            <i class='bx bxs-trash-alt'></i>
                                                        </a>
                                                        <a class="mask" href="{{ asset($media->image_path) }}"
                                                            data-fancybox="gallery">
                                                            <img src="{{ asset($media->image_path) }}" class="imgFluid" />
                                                        </a>
                                                        <input type="text" value="gallery" class="field"
                                                            placeholder="{{ asset($media->alt_text) }}" readonly>
                                                    </li>
                                                @endforeach
                                            </ul>

                                        </div>
                                    @endif
                                    <div class="form-fields">
                                        <label class="title">
                                            Right side top highlighted tour card
                                            <span class="text-danger">*</span> :
                                        </label>
                                        <select name="top_highlighted_tour_id" class="choice-select" data-required
                                            data-error="Right Side Top Highlighted Tour Card">
                                            <option value="" selected>Select Tour</option>
                                            @foreach ($tours as $tour)
                                                <option value="{{ $tour->id }}"
                                                    {{ old('top_highlighted_tour_id', $blog->top_highlighted_tour_id) == $tour->id ? 'selected' : '' }}>
                                                    {{ $tour->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('top_highlighted_tour_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="form-fields">
                                        @php
                                            $selectedTours = json_decode($blog->featured_tours_ids, true) ?? [];
                                        @endphp
                                        <label class="title">Below Blog Slider Tour Card <span class="text-danger">*</span>
                                            :</label>
                                        <select name="featured_tours_ids[]" multiple class="choice-select"
                                            data-max-items="4" placeholder="Select Tours" data-required
                                            data-error="Below Blog Slider Tour Card">
                                            @foreach ($tours as $tour)
                                                <option value="{{ $tour->id }}"
                                                    {{ in_array($tour->id, old('featured_tours_ids', $selectedTours)) ? 'selected' : '' }}>
                                                    {{ $tour->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('featured_tours_ids')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>



                                </div>
                            </div>
                            <div class="seo-options">
                                <div class="form-box">
                                    <div class="form-box__header d-flex align-items-center justify-content-between">
                                        <div class="title">Search Engine</div>
                                        <a href="javascript:void(0)"
                                            onclick="document.getElementById('seo_manager').classList.remove('d-none')"
                                            class="nav-link p-0">Edit</a>
                                    </div>
                                    <div class="form-box__body">
                                        <div class="google-preview">
                                            <div class="google-preview__header">
                                                <div class="logo">
                                                    <img src="{{ asset('favicon.ico') }}" alt="Favicon"
                                                        class="imgFluid">
                                                </div>
                                                <div class="content">
                                                    <div class="title">{{ env('APP_NAME') }}</div>
                                                    <a href="javascript:void(0)"" class="link">{{ env('APP_URL') }}</a>
                                                </div>
                                            </div>
                                            <div class="google-preview__content">
                                                <div class="heading" id="google_title">{{ $seo->seo_title ?? '' }}</div>
                                                <div class="description" id="google_desc">
                                                    {{ $seo->seo_description ?? '' }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-box d-none" id="seo_manager">
                                    <div class="form-box__header">
                                        <div class="title">Seo Manager</div>
                                    </div>
                                    <div class="form-box__body">
                                        <div class="row">
                                            <div class="col-md-7">
                                                <div class="form-fields">
                                                    <label class="title">Allow search engines to show this service in
                                                        search
                                                        results?
                                                        <span class="text-danger">*</span> :</label>
                                                    <select name="is_seo_index" class="field"
                                                        onchange="toggleElement(this, '0', 'seo_options')">
                                                        <option
                                                            {{ old('is_seo_index', $seo->is_seo_index ?? '') == '1' ? 'selected' : '' }}
                                                            value="1">Yes
                                                        </option>
                                                        <option
                                                            {{ old('is_seo_index', $seo->is_seo_index ?? '') == '0' ? 'selected' : '' }}
                                                            value="0">No
                                                        </option>
                                                    </select>

                                                    @error('is_seo_index')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 mt-4 {{ $seo && $seo->is_seo_index != 1 ? 'd-none' : '' }}"
                                                id="seo_options">
                                                <div class="tabs-wrapper">
                                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link text-dark active" id="home-tab"
                                                                data-bs-toggle="tab" data-bs-target="#home"
                                                                type="button" role="tab" aria-controls="home"
                                                                aria-selected="true">General
                                                                Options</button>
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link text-dark" id="profile-tab"
                                                                data-bs-toggle="tab" data-bs-target="#profile"
                                                                type="button" role="tab" aria-controls="profile"
                                                                aria-selected="false">Share
                                                                Facebook</button>
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link text-dark" id="contact-tab"
                                                                data-bs-toggle="tab" data-bs-target="#contact"
                                                                type="button" role="tab" aria-controls="contact"
                                                                aria-selected="false">Share Twitter</button>
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link text-dark" id="schema-tab"
                                                                data-bs-toggle="tab" data-bs-target="#schema"
                                                                type="button" role="tab" aria-controls="schema"
                                                                aria-selected="false">Schema</button>
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link text-dark" id="canonical-tab"
                                                                data-bs-toggle="tab" data-bs-target="#canonical"
                                                                type="button" role="tab" aria-controls="canonical"
                                                                aria-selected="false">Canonical</button>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content-wrapper">
                                                        <div class="tab-content" id="myTabContent">
                                                            <div class="tab-pane fade show active" id="home"
                                                                role="tabpanel" aria-labelledby="home-tab">
                                                                <div class="row">
                                                                    <div class="form-fields col-md-12">
                                                                        <label class="title">
                                                                            Seo Title <span class="text-danger">*</span> :
                                                                        </label>
                                                                        <input type="text" name="seo_title"
                                                                            class="field"
                                                                            value="{{ old('seo_title', $seo->seo_title ?? '') }}"
                                                                            placeholder="Leave blank to use service title"
                                                                            oninput="updateText(this,'google_title')">
                                                                        @error('seo_title')
                                                                            <div class="text-danger">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="form-fields col-md-12">
                                                                        <label class="title">
                                                                            Seo Description <span
                                                                                class="text-danger">*</span>
                                                                            :
                                                                        </label>
                                                                        <textarea name="seo_description" class="field" rows="3" placeholder="Enter Description..."
                                                                            oninput="updateText(this,'google_desc')">{{ old('seo_description', $seo->seo_description ?? '') }}</textarea>
                                                                        @error('seo_description')
                                                                            <div class="text-danger">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="form-fields col-md-4">
                                                                        <label class="title">
                                                                            Seo Feature Image <span
                                                                                class="text-danger">*</span> :
                                                                        </label>
                                                                        <div class="upload" data-upload>
                                                                            <div class="upload-box-wrapper">
                                                                                <div class="upload-box {{ empty($seo->seo_featured_image) ? 'show' : '' }}"
                                                                                    data-upload-box>
                                                                                    <input type="file"
                                                                                        name="seo_featured_image"
                                                                                        id="seo_featured_image"
                                                                                        class="upload-box__file d-none"
                                                                                        accept="image/*" data-file-input>
                                                                                    <div class="upload-box__placeholder">
                                                                                        <i class='bx bxs-image'></i>
                                                                                    </div>
                                                                                    <label for="seo_featured_image"
                                                                                        class="upload-box__btn themeBtn">Upload
                                                                                        Image</label>
                                                                                </div>


                                                                                <div class="upload-box__img {{ !empty($seo->seo_featured_image) ? 'show' : '' }}"
                                                                                    data-upload-img>
                                                                                    <button type="button"
                                                                                        class="delete-btn" data-delete-btn>
                                                                                        <i class='bx bxs-trash-alt'></i>
                                                                                    </button>
                                                                                    <a href="{{ asset($seo ? $seo->seo_featured_image : '') }}"
                                                                                        class="mask"
                                                                                        data-fancybox="gallery">
                                                                                        <img src="{{ asset($seo ? $seo->seo_featured_image : '') }}"
                                                                                            alt="Uploaded Image"
                                                                                            class="imgFluid"
                                                                                            data-upload-preview>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                            <div class="text-danger d-none mt-2 text-center"
                                                                                data-error-message>
                                                                                Please upload a valid image file
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>



                                                            <div class="tab-pane fade" id="profile" role="tabpanel"
                                                                aria-labelledby="profile-tab">
                                                                <div class="row">
                                                                    <!-- Facebook Title -->
                                                                    <div class="form-fields col-md-12">
                                                                        <label class="title">
                                                                            Facebook Title <span
                                                                                class="text-danger">*</span> :
                                                                        </label>
                                                                        <input type="text" name="fb_title"
                                                                            class="field"
                                                                            value="{{ old('fb_title', $seo->fb_title ?? '') }}"
                                                                            placeholder="Leave blank to use service title">
                                                                        @error('fb_title')
                                                                            <div class="text-danger">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>


                                                                    <div class="form-fields col-md-12">
                                                                        <label class="title">
                                                                            Facebook Description <span
                                                                                class="text-danger">*</span> :
                                                                        </label>
                                                                        <textarea name="fb_description" class="field" rows="3" placeholder="Enter Description...">{{ old('fb_description', $seo->fb_description ?? '') }}</textarea>
                                                                        @error('fb_description')
                                                                            <div class="text-danger">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="form-fields col-md-4">
                                                                        <label class="title">
                                                                            Facebook Feature Image <span
                                                                                class="text-danger">*</span> :
                                                                        </label>
                                                                        <div class="upload" data-upload>
                                                                            <div class="upload-box-wrapper">
                                                                                <div class="upload-box {{ empty($seo->fb_featured_image) ? 'show' : '' }}"
                                                                                    data-upload-box>
                                                                                    <input type="file"
                                                                                        name="fb_featured_image"
                                                                                        id="fb_featured_image"
                                                                                        class="upload-box__file d-none"
                                                                                        accept="image/*" data-file-input>
                                                                                    <div class="upload-box__placeholder">
                                                                                        <i class='bx bxs-image'></i>
                                                                                    </div>
                                                                                    <label for="fb_featured_image"
                                                                                        class="upload-box__btn themeBtn">Upload
                                                                                        Image</label>
                                                                                </div>
                                                                                <div class="upload-box__img {{ !empty($seo->fb_featured_image) ? 'show' : '' }}"
                                                                                    data-upload-img>
                                                                                    <button type="button"
                                                                                        class="delete-btn" data-delete-btn>
                                                                                        <i class='bx bxs-trash-alt'></i>
                                                                                    </button>
                                                                                    <a href="{{ asset($seo ? $seo->fb_featured_image : '') }}"
                                                                                        class="mask"
                                                                                        data-fancybox="gallery">
                                                                                        <img src="{{ asset($seo ? $seo->fb_featured_image : '') }}"
                                                                                            alt="Uploaded Image"
                                                                                            class="imgFluid"
                                                                                            data-upload-preview>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                            <div class="text-danger d-none mt-2 text-center"
                                                                                data-error-message>
                                                                                Please upload a valid image file
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane fade" id="contact" role="tabpanel"
                                                                aria-labelledby="contact-tab">
                                                                <div class="row">
                                                                    <!-- Twitter Title -->
                                                                    <div class="form-fields col-md-12">
                                                                        <label class="title">
                                                                            Twitter Title <span
                                                                                class="text-danger">*</span> :
                                                                        </label>
                                                                        <input type="text" name="tw_title"
                                                                            class="field"
                                                                            value="{{ old('tw_title', $seo->tw_title ?? '') }}"
                                                                            placeholder="Leave blank to use service title">
                                                                        @error('tw_title')
                                                                            <div class="text-danger">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>

                                                                    <!-- Twitter Description -->
                                                                    <div class="form-fields col-md-12">
                                                                        <label class="title">
                                                                            Twitter Description <span
                                                                                class="text-danger">*</span> :
                                                                        </label>
                                                                        <textarea name="tw_description" class="field" rows="3" placeholder="Enter Description...">{{ old('tw_description', $seo->tw_description ?? '') }}</textarea>
                                                                        @error('tw_description')
                                                                            <div class="text-danger">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>

                                                                    <!-- Twitter Featured Image -->
                                                                    <div class="form-fields col-md-4">
                                                                        <label class="title">
                                                                            Twitter Feature Image <span
                                                                                class="text-danger">*</span> :
                                                                        </label>
                                                                        <div class="upload" data-upload>
                                                                            <div class="upload-box-wrapper">
                                                                                <div class="upload-box {{ empty($seo->tw_featured_image) ? 'show' : '' }}"
                                                                                    data-upload-box>
                                                                                    <input type="file"
                                                                                        name="tw_featured_image"
                                                                                        id="tw_featured_image"
                                                                                        class="upload-box__file d-none"
                                                                                        accept="image/*" data-file-input>
                                                                                    <div class="upload-box__placeholder">
                                                                                        <i class='bx bxs-image'></i>
                                                                                    </div>
                                                                                    <label for="tw_featured_image"
                                                                                        class="upload-box__btn themeBtn">Upload
                                                                                        Image</label>
                                                                                </div>


                                                                                <div class="upload-box__img {{ !empty($seo->tw_featured_image) ? 'show' : '' }}"
                                                                                    data-upload-img>
                                                                                    <button type="button"
                                                                                        class="delete-btn" data-delete-btn>
                                                                                        <i class='bx bxs-trash-alt'></i>
                                                                                    </button>
                                                                                    <a href="{{ asset($seo ? $seo->tw_featured_image : '') }}"
                                                                                        class="mask"
                                                                                        data-fancybox="gallery">
                                                                                        <img src="{{ asset($seo ? $seo->tw_featured_image : '') }}"
                                                                                            alt="Uploaded Image"
                                                                                            class="imgFluid"
                                                                                            data-upload-preview>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                            <div class="text-danger d-none mt-2 text-center"
                                                                                data-error-message>
                                                                                Please upload a valid image file
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane fade" id="schema" role="tabpanel"
                                                                aria-labelledby="schema-tab">
                                                                <div class="row">
                                                                    <!-- Schema -->
                                                                    <div class="form-fields col-md-12">
                                                                        <label class="title">
                                                                            Schema <span class="text-danger">*</span> :
                                                                        </label>
                                                                        <textarea name="schema" class="field" rows="3">{{ old('schema', $seo->schema ?? '') }}</textarea>
                                                                        @error('schema')
                                                                            <div class="text-danger">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane fade" id="canonical" role="tabpanel"
                                                                aria-labelledby="canonical-tab">
                                                                <div class="row">
                                                                    <!-- Canonical -->
                                                                    <div class="form-fields col-md-12">
                                                                        <label class="title">
                                                                            Canonical <span class="text-danger">*</span> :
                                                                        </label>
                                                                        <input type="url" name="canonical"
                                                                            class="field"
                                                                            value="{{ old('canonical', $seo->canonical ?? '') }}"
                                                                            placeholder="Enter URL">
                                                                        @error('canonical')
                                                                            <div class="text-danger">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>




                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                            value="publish"
                                            {{ old('status', $blog->status ?? '') == 'publish' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="publish">
                                            Publish
                                        </label>
                                    </div>
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="radio" name="status" id="draft"
                                            value="draft"
                                            {{ old('status', $blog->status ?? '') == 'draft' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="draft">
                                            Draft
                                        </label>
                                    </div>
                                    <button class="themeBtn ms-auto mt-4">Save Changes</button>
                                </div>
                            </div>
                            <div class="form-box">
                                <div class="form-box__header">
                                    <div class="title">Author Settings</div>
                                </div>
                                <div class="form-box__body">
                                    <div class="form-fields">
                                        <label class="title">Author <span class="text-danger">*</span> :</label>
                                        <select class="choice-select" name="user_id" data-required data-error="Author">
                                            <option value="" selected>Select</option>
                                            @foreach ($users as $users)
                                                <option value="{{ $users->id }}"
                                                    {{ old('user_id', $blog->user_id) == $users->id ? 'selected' : '' }}>
                                                    {{ $users->full_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('user_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-box">
                                <div class="form-box__header">
                                    <div class="title">Options</div>
                                </div>
                                <div class="form-box__body">
                                    <div class="form-fields">
                                        <label class="title">Categories <span class="text-danger">*</span> :</label>
                                        <select name="category_id" class="choice-select" data-required
                                            data-error="Category">
                                            <option value="" selected>Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category_id', $blog->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-fields">
                                        <label class="title">Tags <span class="text-danger">*</span> :</label>

                                        <select name="tags_ids[]" class="choice-select" multiple
                                            placeholder="Select tags">
                                            @foreach ($tags as $tag)
                                                <option value="{{ $tag->id }}"
                                                    {{ in_array($tag->id, old('tags_ids', $blog->tags->pluck('id')->toArray()) ?? []) ? 'selected' : '' }}>
                                                    {{ $tag->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('tags_ids')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

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
                                                <div class="upload-box {{ empty($blog->featured_image) ? 'show' : '' }}"
                                                    data-upload-box>
                                                    <input type="file" name="featured_image"
                                                        {{ empty($blog->featured_image) ? 'data-required' : '' }}
                                                        data-error="Feature Image" id="featured_image"
                                                        class="upload-box__file d-none" accept="image/*" data-file-input>
                                                    <div class="upload-box__placeholder"><i class='bx bxs-image'></i>
                                                    </div>
                                                    <label for="featured_image" class="upload-box__btn themeBtn">Upload
                                                        Image</label>
                                                </div>
                                                <div class="upload-box__img {{ !empty($blog->featured_image) ? 'show' : '' }}"
                                                    data-upload-img>
                                                    <button type="button" class="delete-btn" data-delete-btn><i
                                                            class='bx bxs-trash-alt'></i></button>
                                                    <a href="{{ asset($blog->featured_image) }}" class="mask"
                                                        data-fancybox="gallery">
                                                        <img src="{{ asset($blog->featured_image) }}"
                                                            alt="Uploaded Image" class="imgFluid" data-upload-preview>
                                                    </a>
                                                    <input type="text" name="feature_image_alt_text" class="field"
                                                        placeholder="Enter Alt Text"
                                                        value="{{ $blog->feature_image_alt_text }}">
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
@section('js')
    <script>
        function updateText(currentInput, ElementId) {
            let textPreview = document.getElementById(ElementId)
            textPreview.textContent = currentInput.value
        }

        function toggleElement(select, toggleOffValue, elementId) {
            const element = document.getElementById(elementId);
            if (select.value === toggleOffValue) {
                element.classList.add('d-none');
            } else {
                element.classList.remove('d-none');
            }
        }
    </script>
@endsection
