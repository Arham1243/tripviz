@extends('admin.dash_layouts.main')
@section('content')
    <div class="col-md-12">
        <div class="dashboard-content">
            {{ Breadcrumbs::render('admin.sections.edit', $section) }}
            <div class="custom-sec custom-sec--form">
                <div class="custom-sec__header">
                    <div class="section-content">
                        <h3 class="heading">Edit Section: {{ isset($title) ? $title : '' }}</h3>
                    </div>
                </div>
            </div>
            <form action="{{ route('admin.sections.update', $section->id) }}" method="POST" enctype="multipart/form-data"
                id="validation-form">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-wrapper">
                            <div class="form-box">
                                <div class="form-box__header">
                                    <div class="title">Section Content</div>
                                </div>
                                <div class="form-box__body">
                                    <div class="form-fields">
                                        <label class="title">Name <span class="text-danger">*</span> :</label>
                                        <input type="text" name="name" class="field"
                                            value="{{ old('name', $section->name) }}" placeholder="" data-required
                                            data-error="Name">
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-fields">
                                        <label class="title">Template Path <span class="text-danger">*</span> :</label>
                                        <input type="text" name="template_path" class="field"
                                            value="{{ old('template_path', $section->template_path) }}" placeholder=""
                                            data-required data-error="Template Path">
                                        @error('template_path')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-fields">
                                        <label class="title">Category <span class="text-danger">*</span> :</label>
                                        <select class="field" name="category" data-required data-error="Name">
                                            <option value="">Select</option>
                                            <option value="Banner Sections"
                                                {{ old('category', $section->category) == 'Banner Sections' ? 'selected' : '' }}>
                                                Banner Sections
                                            </option>
                                            <option value="Location Sections"
                                                {{ old('category', $section->category) == 'Location Sections' ? 'selected' : '' }}>
                                                Location
                                                Sections</option>
                                            <option value="Tour Sections"
                                                {{ old('category', $section->category) == 'Tour Sections' ? 'selected' : '' }}>
                                                Tour Sections
                                            </option>
                                            <option value="Activities Sections"
                                                {{ old('category', $section->category) == 'Activities Sections' ? 'selected' : '' }}>
                                                Activities
                                                Sections</option>
                                            <option value="Call-to-Action"
                                                {{ old('category', $section->category) == 'Call-to-Action' ? 'selected' : '' }}>
                                                Call-to-Action
                                            </option>
                                            <option value="Other Content"
                                                {{ old('category', $section->category) == 'Other Content' ? 'selected' : '' }}>
                                                Other Content
                                            </option>
                                        </select>
                                        @error('category')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="seo-wrapper">
                            <div class="form-box">
                                <div class="form-box__header">
                                    <div class="title">Status</div>
                                </div>
                                <div class="form-box__body">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="active"
                                            value="active"
                                            {{ old('status', $section->status) == 'active' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="active">
                                            active
                                        </label>
                                    </div>
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="radio" name="status" id="inactive"
                                            value="inactive"
                                            {{ old('status', $section->status) == 'inactive' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="inactive">
                                            inactive
                                        </label>
                                    </div>
                                    <button class="themeBtn ms-auto mt-4">Save Changes</button>
                                </div>
                            </div>
                            <div class="form-box">
                                <div class="form-box__header">
                                    <div class="title">Preview Image</div>
                                </div>
                                <div class="form-box__body">
                                    <div class="form-fields">

                                        <div class="upload" data-upload>
                                            <div class="upload-box-wrapper">
                                                <div class="upload-box {{ empty($section->preview_image) ? 'show' : '' }}"
                                                    data-upload-box>
                                                    <input type="file" name="preview_image"
                                                        {{ empty($section->preview_image) ? 'data-required' : '' }}
                                                        data-error="Preview Image" id="preview_image"
                                                        class="upload-box__file d-none" accept="image/*" data-file-input>
                                                    <div class="upload-box__placeholder"><i class='bx bxs-image'></i>
                                                    </div>
                                                    <label for="preview_image" class="upload-box__btn themeBtn">Upload
                                                        Image</label>
                                                </div>
                                                <div class="upload-box__img {{ !empty($section->preview_image) ? 'show' : '' }}"
                                                    data-upload-img>
                                                    <button type="button" class="delete-btn" data-delete-btn><i
                                                            class='bx bxs-trash-alt'></i></button>
                                                    <a href="{{ asset($section->preview_image) }}" class="mask"
                                                        data-fancybox="gallery">
                                                        <img src="{{ asset($section->preview_image) }}" alt="Section"
                                                            class="imgFluid" data-upload-preview>
                                                    </a>
                                                </div>
                                            </div>
                                            <div data-error-message class="text-danger mt-2 d-none text-center">Please
                                                upload a
                                                valid image file
                                            </div>
                                            @error('preview_image')
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
