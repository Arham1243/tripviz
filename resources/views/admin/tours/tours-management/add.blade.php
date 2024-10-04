@extends('admin.dash_layouts.main')
@section('content')
    <div class="col-md-12">
        <div class="dashboard-content">
            {{ Breadcrumbs::render('admin.tours.create') }}
            <div class="custom-sec custom-sec--form">
                <div class="custom-sec__header">
                    <div class="section-content">
                        <h3 class="heading">{{ isset($title) ? $title : '' }}</h3>
                    </div>
                </div>
            </div>
            <form action="{{ route('admin.tours.store') }}" method="POST" enctype="multipart/form-data" id="validation-form">
                @csrf
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-wrapper">
                            <div class="form-box">
                                <div class="form-box__header">
                                    <div class="title">Tour Content</div>
                                </div>
                                <div class="form-box__body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-fields">
                                                <label class="title">Title <span class="text-danger">*</span> :</label>
                                                <input type="text" name="title" class="field"
                                                    value="{{ old('title') }}" placeholder="" data-required
                                                    data-error="Title">
                                                @error('title')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 mt-4">
                                            <div class="form-fields">
                                                <label class="title">Categories <span class="text-danger">*</span>
                                                    :</label>
                                                <select name="category_ids[]" class="choice-select" data-required
                                                    data-error="Category" multiple placeholder="Select Categories">
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}"
                                                            {{ old('category_ids') == $category->id ? 'selected' : '' }}>
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('category_ids')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 mt-4">
                                            <div class="form-fields">
                                                <label class="title">Location <span class="text-danger">*</span> :</label>
                                                <select name="city_ids[]" class="choice-select" data-required
                                                    data-error="Category" multiple placeholder="Select Locations">
                                                    @foreach ($cities as $city)
                                                        <option value="{{ $city->id }}"
                                                            {{ old('city_ids') == $city->id ? 'selected' : '' }}>
                                                            {{ $city->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('city_ids')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 mt-4">
                                            <div class="form-fields">
                                                <label class="title">Content <span class="text-danger">*</span> :</label>
                                                <textarea class="editor" name="content" data-placeholder="content" data-required data-error="Content">
                                            {{ old('content') }}
                                        </textarea>
                                                @error('content')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12  mt-4">
                                            <div class="form-fields">
                                                <label class="title">Badge icon
                                                    <a class="ms-2 p-0 nav-link text-lowercase" href="//boxicons.com"
                                                        target="_blank">(boxicons.com)</a>
                                                    <span class="text-danger">*</span>
                                                    :</label>
                                                <div class="d-flex align-items-center gap-3">

                                                    <input type="text" name="badge_icon_class" class="field"
                                                        value="{{ old('badge_icon_class', 'bx bx-badge-check') }}"
                                                        placeholder="" data-required
                                                        oninput="showIcon(this)"data-error="badge_icon_class">
                                                    <i class="bx bx-badge-check bx-md" data-preview-icon></i>
                                                </div>
                                                @error('badge_icon_class')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror

                                            </div>

                                        </div>
                                        <div class="col-md-6 col-12  mt-4">
                                            <div class="form-fields">
                                                <label class="title">Badge Name <span class="text-danger">*</span>
                                                    :</label>
                                                <input type="text" name="badge_name" class="field"
                                                    value="{{ old('badge_name') }}" placeholder="" data-required
                                                    data-error="Badge Name">
                                                @error('badge_name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-5">
                                            <div class="form-fields">
                                                <label class="title">Features:</label>
                                                <div class="repeater-table" data-repeater>
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">
                                                                    <div class="d-flex align-items-center gap-2"> Icon <a
                                                                            class="p-0 nav-link text-lowercase"
                                                                            href="//boxicons.com"
                                                                            target="_blank">(boxicons.com)</a>
                                                                    </div>
                                                                </th>
                                                                <th scope="col">Title</th>
                                                                <th class="text-end" scope="col">Remove</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody data-repeater-list>
                                                            <tr data-repeater-item>
                                                                <td>
                                                                    <div class="d-flex align-items-center gap-3">
                                                                        <input type="text" class="field"
                                                                            name="features_icons[]"
                                                                            oninput="showIcon(this)"
                                                                            value="bx bx-stopwatch">

                                                                        <i class="bx bx-stopwatch bx-md"
                                                                            data-preview-icon></i>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <input name="features_titles[]" type="text"
                                                                        class="field">
                                                                </td>
                                                                <td>
                                                                    <button type="button"
                                                                        class="delete-btn ms-auto delete-btn--static"
                                                                        data-repeater-remove disabled>
                                                                        <i class='bx bxs-trash-alt'></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <button type="button" class="themeBtn ms-auto"
                                                        data-repeater-create>Add <i class="bx bx-plus"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <div class="form-fields">
                                                <label class="title">Include:</label>

                                                <div class="repeater-table" data-repeater>
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Title</th>
                                                                <th class="text-end" scope="col">Remove</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody data-repeater-list>
                                                            <tr data-repeater-item>
                                                                <td>
                                                                    <input name="inclusions[]" type="text"
                                                                        class="field">
                                                                </td>
                                                                <td>
                                                                    <button type="button"
                                                                        class="delete-btn ms-auto delete-btn--static"
                                                                        data-repeater-remove disabled>
                                                                        <i class='bx bxs-trash-alt'></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <button type="button" class="themeBtn ms-auto"
                                                        data-repeater-create>Add <i class="bx bx-plus"></i></button>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <div class="form-fields">
                                                <label class="title">Exclude:</label>

                                                <div class="repeater-table" data-repeater>
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Title</th>
                                                                <th class="text-end" scope="col">Remove</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody data-repeater-list>
                                                            <tr data-repeater-item>
                                                                <td>
                                                                    <input name="exclusions[]" type="text"
                                                                        class="field">
                                                                </td>
                                                                <td>
                                                                    <button type="button"
                                                                        class="delete-btn ms-auto delete-btn--static"
                                                                        data-repeater-remove disabled>
                                                                        <i class='bx bxs-trash-alt'></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <button type="button" class="themeBtn ms-auto"
                                                        data-repeater-create>Add <i class="bx bx-plus"></i></button>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <div class="form-fields">
                                                <label class="title">FAQs:</label>

                                                <div class="repeater-table" data-repeater>
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Question</th>
                                                                <th scope="col">Answer</th>
                                                                <th class="text-end" scope="col">Remove</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody data-repeater-list>
                                                            <tr data-repeater-item>
                                                                <td>
                                                                    <textarea name="faq_questions[]" class="field"rows="2"></textarea>
                                                                </td>
                                                                <td>
                                                                    <textarea name="faq_answers[]" class="field"rows="2"></textarea>
                                                                </td>
                                                                <td>
                                                                    <button type="button"
                                                                        class="delete-btn ms-auto delete-btn--static"
                                                                        data-repeater-remove disabled>
                                                                        <i class='bx bxs-trash-alt'></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <button type="button" class="themeBtn ms-auto"
                                                        data-repeater-create>Add <i class="bx bx-plus"></i></button>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <div class="form-fields">
                                                <label class="title">Itinerary:</label>

                                                <div class="repeater-table" data-repeater>
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Feature Image</th>
                                                                <th scope="col">Title - Description</th>
                                                                <th scope="col">Content</th>
                                                                <th class="text-end" scope="col">Remove</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody data-repeater-list>
                                                            <tr data-repeater-item>
                                                                <td class="w-25">
                                                                    <div class="upload upload--sm" data-upload>
                                                                        <div class="upload-box-wrapper">
                                                                            <div class="upload-box show" data-upload-box>

                                                                                <div class="upload-box__placeholder"><i
                                                                                        class='bx bxs-image'></i>
                                                                                </div>
                                                                                <label for="itinerary_featured_image"
                                                                                    class="upload-box__btn themeBtn">Upload
                                                                                    Image</label>
                                                                                <input type="file"
                                                                                    name="itinerary_featured_images[]"
                                                                                    id="itinerary_featured_image"
                                                                                    class="upload-box__file d-none"
                                                                                    accept="image/*" data-file-input>
                                                                            </div>
                                                                            <div class="upload-box__img" data-upload-img>
                                                                                <button type="button" class="delete-btn"
                                                                                    data-delete-btn><i
                                                                                        class='bx bxs-trash-alt'></i></button>
                                                                                <a href="#" class="mask"
                                                                                    data-fancybox="gallery">
                                                                                    <img src="{{ asset('admin/assets/images/loading.webp') }}"
                                                                                        alt="Uploaded Image"
                                                                                        class="imgFluid"
                                                                                        data-placeholder="{{ asset('admin/assets/images/loading.webp') }}"
                                                                                        data-upload-preview>
                                                                                </a>
                                                                                <input type="text"
                                                                                    name="itinerary_featured_image_alt_texts[]"
                                                                                    class="field"
                                                                                    placeholder="Enter alt text"
                                                                                    value="Feature Image">
                                                                            </div>
                                                                        </div>
                                                                        <div data-error-message
                                                                            class="text-danger mt-2 d-none text-center">
                                                                            Please
                                                                            upload a
                                                                            valid image file
                                                                        </div>
                                                                    </div>
                                                                    <div class="dimensions text-center mt-3">
                                                                        <strong>Dimensions:</strong> 600 &times; 400
                                                                    </div>
                                                                </td>
                                                                <td class="w-25">
                                                                    <input name="itinerary_titles[]" type="text"
                                                                        class="field" placeholder="Title">
                                                                    <br>
                                                                    <input name="itinerary_description[]" type="text"
                                                                        class="field mt-3" placeholder="Description">
                                                                </td>
                                                                <td>
                                                                    <textarea name="itinerary_content[]" class="field"rows="2"></textarea>
                                                                </td>
                                                                <td>
                                                                    <button type="button"
                                                                        class="delete-btn ms-auto delete-btn--static"
                                                                        data-repeater-remove disabled>
                                                                        <i class='bx bxs-trash-alt'></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <button type="button" class="themeBtn ms-auto"
                                                        data-repeater-create>Add <i class="bx bx-plus"></i></button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-box">
                                <div class="form-box__header">
                                    <div class="title">Tour Banner</div>
                                </div>
                                <div class="form-box__body">
                                    <div class="form-fields">
                                        <label class="title">Banners :</label>
                                        <div class="multiple-upload" data-upload-multiple>
                                            <input type="file" class="gallery-input d-none" multiple
                                                data-upload-multiple-input accept="image/*" id="banners"
                                                name="banners[]" data-required data-error="Tour Banner">
                                            <label class="multiple-upload__btn themeBtn" for="banners">
                                                <i class='bx bx-plus'></i>
                                                Select Images
                                            </label>
                                            <div class="dimensions mt-3">
                                                <strong>Dimensions:</strong> 1350 &times; 500
                                            </div>
                                            <ul class="multiple-upload__imgs" data-upload-multiple-images>
                                            </ul>
                                            <div class="text-danger error-message d-none" data-upload-multiple-error></div>
                                        </div>
                                    </div>
                                    <div class="form-fields mt-4">
                                        @php
                                            $styles = [
                                                1 => 'Style 1',
                                                2 => 'Style 2',
                                                3 => 'Style 3',
                                                4 => 'Style 4',
                                            ];
                                        @endphp
                                        <label class="title">Choose Banner Style :</label>
                                        <select onchange="previewImage(this,'banner-style-preview')" name="banner_style"
                                            class="field">
                                            <option value=""
                                                data-image="{{ asset('admin/assets/images/banner-styles/placeholder.png') }}"
                                                selected>Select</option>
                                            @foreach ($styles as $key => $style)
                                                <option value="{{ $key }}"
                                                    data-image="{{ asset('admin/assets/images/banner-styles/' . $key . '.png') }}">
                                                    {{ $style }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('banner_style')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-fields">
                                        <a href="{{ asset('admin/assets/images/banner-styles/1.png') }}"
                                            data-fancybox="gallery" class="preview-image">
                                            <img src="{{ asset('admin/assets/images/banner-styles/1.png') }}"
                                                alt="image" class="imgFluid" id="banner-style-preview">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <x-seo-options :seo="$seo ?? null" :resource="'tours'" />
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
                                            checked value="publish">
                                        <label class="form-check-label" for="publish">
                                            Publish
                                        </label>
                                    </div>
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="radio" name="status" id="draft"
                                            value="draft">
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
                                                <div class="upload-box show" data-upload-box>
                                                    <input type="file" name="featured_image" data-required
                                                        data-error="Feature Image" id="featured_image"
                                                        class="upload-box__file d-none" accept="image/*" data-file-input>
                                                    <div class="upload-box__placeholder"><i class='bx bxs-image'></i>
                                                    </div>
                                                    <label for="featured_image" class="upload-box__btn themeBtn">Upload
                                                        Image</label>
                                                </div>
                                                <div class="upload-box__img" data-upload-img>
                                                    <button type="button" class="delete-btn" data-delete-btn><i
                                                            class='bx bxs-trash-alt'></i></button>
                                                    <a href="#" class="mask" data-fancybox="gallery">
                                                        <img src="{{ asset('admin/assets/images/loading.webp') }}"
                                                            alt="Uploaded Image" class="imgFluid" data-upload-preview>
                                                    </a>
                                                    <input type="text" name="feature_image_alt_text" class="field"
                                                        placeholder="Enter alt text" value="Feature Image">
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
                            @foreach ($attributes as $attribute)
                                <div class="form-box">
                                    <div class="form-box__header">
                                        <div class="title">Attribute: {{ $attribute->name }}</div>
                                    </div>
                                    <div class="form-box__body">
                                        @foreach (json_decode($attribute->items) as $index => $item)
                                            <div class="form-check mb-1">
                                                <input class="form-check-input" type="checkbox"
                                                    name="attributes[{{ $attribute->id }}][]"
                                                    id="attribute-{{ $attribute->id }}-{{ $index }}"
                                                    value="{{ $item }}">
                                                <label class="form-check-label"
                                                    for="attribute-{{ $attribute->id }}-{{ $index }}">
                                                    {{ $item }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
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
