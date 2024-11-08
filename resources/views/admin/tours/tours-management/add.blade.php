<x-admin.layout>

    <div class="col-md-12">
        <div class="dashboard-content">
            {{ Breadcrumbs::render('admin.tours.create') }}
            <form action="{{ route('admin.tours.store') }}" method="POST" enctype="multipart/form-data"
                id="validation-form">
                @csrf
                <div class="custom-sec custom-sec--form">
                    <div class="custom-sec__header">
                        <div class="section-content">
                            <h3 class="heading">{{ isset($title) ? $title : '' }}</h3>
                            <div class="permalink">
                                <div class="title">Permalink:</div>
                                <div class="title">
                                    <div class="full-url">{{ buildUrl(url('/'), 'tours/') }}</div>
                                    <input value="edit-slug" type="button" class="link permalink-input"
                                        data-field-id="slug">
                                    <input type="hidden" id="slug" name="tour[general][slug]">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" x-data="{ optionTab: 'general' }">
                    <div class="col-md-3">
                        <div class="form-box">
                            <div class="form-box__header">
                                <div class="title">Tour Information
                                </div>
                            </div>
                            <div class="form-box__body p-0">
                                <ul class="settings">
                                    <li class="settings-item">
                                        <button type="button" class="settings-item__link"
                                            :class="{ 'active': optionTab === 'general' }"
                                            @click="optionTab = 'general'">
                                            <i class="bx bx-cog"></i> General
                                        </button>
                                    </li>
                                    <li class="settings-item">
                                        <button type="button" class="settings-item__link"
                                            :class="{ 'active': optionTab === 'pricing' }"
                                            @click="optionTab = 'pricing'">
                                            <i class="bx bx-dollar"></i> Pricing
                                        </button>
                                    </li>
                                    <li class="settings-item">
                                        <button type="button" class="settings-item__link"
                                            :class="{ 'active': optionTab === 'location' }"
                                            @click="optionTab = 'location'">
                                            <i class="bx bx-map"></i> Location
                                        </button>
                                    </li>
                                    <li class="settings-item">
                                        <button type="button" class="settings-item__link"
                                            :class="{ 'active': optionTab === 'availability' }"
                                            @click="optionTab = 'availability'">
                                            <i class="bx bx-time-five"></i> Availability
                                        </button>
                                    </li>
                                    <li class="settings-item">
                                        <button type="button" class="settings-item__link"
                                            :class="{ 'active': optionTab === 'addOn' }"
                                            @click="optionTab = 'addOn'">
                                            <i class="bx bx-plus-circle"></i> Add On
                                        </button>
                                    </li>
                                    <li class="settings-item">
                                        <button type="button" class="settings-item__link"
                                            :class="{ 'active': optionTab === 'status' }"
                                            @click="optionTab = 'status'">
                                            <i class="bx bx-check-circle"></i> Status
                                        </button>
                                    </li>
                                    <li class="settings-item">
                                        <button type="button" class="settings-item__link"
                                            :class="{ 'active': optionTab === 'seo' }" @click="optionTab = 'seo'">
                                            <i class="bx bx-search-alt"></i> SEO
                                        </button>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div x-show="optionTab === 'general'" class="general-options">
                            <div class="form-box">
                                <div class="form-box__header">
                                    <div class="title">Tour Content</div>
                                </div>
                                <div class="form-box__body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-fields">
                                                <label class="title">Title <span class="text-danger">*</span> :</label>
                                                <input type="text" name="tour[general][title]" class="field"
                                                    value="{{ old('tour[general][title]') }}" placeholder=""
                                                    data-error="Title" data-required>
                                                @error('tour[general][title]')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 mt-4">
                                            <div class="form-fields">
                                                <label class="title">Content <span class="text-danger">*</span>
                                                    :</label>
                                                <textarea class="editor" data-required name="tour[general][content]" data-placeholder="content" data-error="Content">
                                            {{ old('tour[general][content]') }}
                                        </textarea>
                                                @error('tour[general][content]')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12  mt-4">
                                            <div class="form-fields">
                                                <label class="title">Categories <span class="text-danger">*</span>
                                                    :</label>
                                                <select name="tour[general][category_id]" class="choice-select"
                                                    data-error="Category" data-required>
                                                    <option value="" disabled selected>Select Category</option>
                                                    @php
                                                        renderCategories($categories);
                                                    @endphp
                                                </select>
                                                @error('tour[general][category_id]')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12  mt-4">
                                            <div class="form-fields">
                                                <div class="title d-flex align-items-center gap-2">
                                                    <div>
                                                        Badge icon:
                                                    </div>
                                                    <a class="p-0 nav-link" href="//boxicons.com"
                                                        target="_blank">boxicons</a>
                                                </div>
                                                <div class="d-flex align-items-center gap-3">

                                                    <input type="text" name="tour[general][badge_icon_class]"
                                                        class="field"
                                                        value="{{ old('tour[general][badge_icon_class]', 'bx bx-badge-check') }}"
                                                        placeholder="" oninput="showIcon(this)">
                                                    <i class="bx bx-badge-check bx-md" data-preview-icon></i>
                                                </div>
                                                @error('tour[general][badge_icon_class]')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror

                                            </div>

                                        </div>
                                        <div class="col-md-6 col-12  mt-4">
                                            <div class="form-fields">
                                                <label class="title">Badge Name:</label>
                                                <input type="text" name="tour[general][badge_name]" class="field"
                                                    value="{{ old('tour[general][badge_name]') }}" placeholder="">
                                                @error('tour[general][badge_name]')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-5">
                                            <div class="form-fields">
                                                <label class="title title--sm">Features:</label>
                                                <div class="repeater-table">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">
                                                                    <div class="d-flex align-items-center gap-2"> Icon:
                                                                        <a class="p-0 nav-link" href="//boxicons.com"
                                                                            target="_blank">boxicons</a>
                                                                    </div>
                                                                </th>
                                                                <th scope="col">Title</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                                $icons = [
                                                                    'bx bx-stopwatch',
                                                                    'bx bx-user',
                                                                    'bx bx-wifi',
                                                                    'bx bx-calendar',
                                                                    'bx bx-user-check',
                                                                    'bx bxs-map',
                                                                ];
                                                            @endphp
                                                            @for ($i = 0; $i < 6; $i++)
                                                                <tr>
                                                                    <td>
                                                                        <div class="d-flex align-items-center gap-3">
                                                                            <input type="text" class="field"
                                                                                name="tour[general][features][{{ $i }}][icon]"
                                                                                oninput="showIcon(this)"
                                                                                value="{{ $icons[$i] ?? '' }}">
                                                                            <i class="{{ $icons[$i] ?? '' }} bx-md"
                                                                                data-preview-icon></i>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <input
                                                                            name="tour[general][features][{{ $i }}][title]"
                                                                            type="text" class="field"
                                                                            value="{{ $titles[$i] ?? '' }}">
                                                                    </td>
                                                                </tr>
                                                            @endfor

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <div class="form-fields">
                                                <label class="title title--sm">Include:</label>

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
                                                                    <input name="tour[general][inclusions][]"
                                                                        type="text" class="field">
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
                                                        data-repeater-create>Add
                                                        <i class="bx bx-plus"></i></button>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <div class="form-fields">
                                                <label class="title title--sm">Exclude:</label>

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
                                                                    <input name="tour[general][exclusions][]"
                                                                        type="text" class="field">
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
                                                        data-repeater-create>Add
                                                        <i class="bx bx-plus"></i></button>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-4">
                                            <div class="form-fields">
                                                <label
                                                    class=" d-flex align-items-center mb-3 justify-content-between"><span
                                                        class="title title--sm mb-0">Tour Information:</span>
                                                    <span class="title d-flex align-items-center gap-1">Section
                                                        Preview:
                                                        <a href="{{ asset('admin/assets/images/tour-infomation.png') }}"
                                                            data-fancybox="gallery" class="themeBtn p-1"
                                                            title="Section Preivew"><i class='bx  bxs-show'></i></a>
                                                    </span>
                                                </label>
                                                <div class="repeater-table" data-repeater>
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Heading</th>
                                                                <th scope="col">Items</th>
                                                                <th class="text-end" scope="col">Remove</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody data-repeater-list>
                                                            <tr data-repeater-item>
                                                                <td>
                                                                    <input name="tour[general][details][0][name]"
                                                                        type="text"
                                                                        placeholder="e.g., Timings, What to Bring"
                                                                        class="field">
                                                                </td>
                                                                <td>
                                                                    <div class="repeater-table" data-sub-repeater>
                                                                        <table class="table table-bordered">
                                                                            <tbody data-sub-repeater-list>
                                                                                <tr data-sub-repeater-item>
                                                                                    <td>
                                                                                        <input
                                                                                            name="tour[general][details][0][items][]"
                                                                                            type="text"
                                                                                            placeholder="Item"
                                                                                            class="field">
                                                                                        <input
                                                                                            name="tour[general][details][0][urls][]"
                                                                                            type="url"
                                                                                            placeholder="Url"
                                                                                            class="field mt-3">
                                                                                    </td>
                                                                                    <td>
                                                                                        <button type="button"
                                                                                            class="delete-btn ms-auto delete-btn--static"
                                                                                            data-sub-repeater-remove>
                                                                                            <i
                                                                                                class='bx bxs-trash-alt'></i>
                                                                                        </button>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                        <button type="button"
                                                                            class="themeBtn ms-auto"
                                                                            data-sub-repeater-create>
                                                                            Add <i class="bx bx-plus"></i>
                                                                        </button>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <button type="button"
                                                                        class="delete-btn ms-auto delete-btn--static"
                                                                        data-repeater-remove>
                                                                        <i class='bx bxs-trash-alt'></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <button type="button" class="themeBtn ms-auto"
                                                        data-repeater-create>
                                                        Add <i class="bx bx-plus"></i>
                                                    </button>
                                                </div>


                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <div class="form-fields">
                                                <label class="title title--sm">FAQs:</label>
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
                                                                    <textarea name="tour[general][faq][question][]" class="field"rows="2"></textarea>
                                                                </td>
                                                                <td>
                                                                    <textarea name="tour[general][faq][answer][]" class="field"rows="2"></textarea>
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
                                                        data-repeater-create>Add
                                                        <i class="bx bx-plus"></i></button>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-5">
                                            <div class="form-fields">
                                                <label class="d-flex align-items-center justify-content-between"><span
                                                        class="title title--sm mb-0">Banner:</span>
                                                    <span class="title d-flex align-items-center gap-1">Selected
                                                        Banner:
                                                        <a href="{{ asset('admin/assets/images/banner-styles/1.png') }}"
                                                            data-fancybox="gallery" class="themeBtn p-1"
                                                            title="Section Preivew"><i class='bx  bxs-show'></i></a>
                                                    </span>
                                                </label>
                                            </div>

                                            <div class="form-fields">
                                                <input type="hidden" name="tour[general][banner_type]"
                                                    value="1">
                                                <div class="title">
                                                    <div>Banner Image <span class="text-danger">*</span>:</div>
                                                </div>

                                                <div class="upload upload--banner" data-upload>
                                                    <div class="upload-box-wrapper">
                                                        <div class="upload-box show" data-upload-box>
                                                            <input type="file" name="banner_image"
                                                                data-error="Banner Image" id="banner_featured_image"
                                                                class="upload-box__file d-none" accept="image/*"
                                                                data-file-input data-required>
                                                            <div class="upload-box__placeholder"><i
                                                                    class='bx bxs-image'></i>
                                                            </div>
                                                            <label for="banner_featured_image"
                                                                class="upload-box__btn themeBtn">Upload
                                                                Image</label>
                                                        </div>
                                                        <div class="upload-box__img" data-upload-img>
                                                            <button type="button" class="delete-btn"
                                                                data-delete-btn><i
                                                                    class='bx bxs-trash-alt'></i></button>
                                                            <a href="#" class="mask" data-fancybox="gallery">
                                                                <img src="{{ asset('admin/assets/images/loading.webp') }}"
                                                                    alt="Uploaded Image" class="imgFluid"
                                                                    data-upload-preview>
                                                            </a>
                                                            <input type="text" name="banner_image_alt_text"
                                                                class="field" placeholder="Enter alt text"
                                                                value="Feature Image">
                                                        </div>
                                                    </div>
                                                    <div data-error-message
                                                        class="text-danger mt-2 d-none text-center">
                                                        Please
                                                        upload a
                                                        valid image file
                                                    </div>
                                                    @error('banner_image')
                                                        <div class="text-danger mt-2 text-center">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="dimensions text-center mt-3">
                                                    <strong>Dimensions:</strong> 1350 &times; 400
                                                </div>
                                            </div>
                                            <div class="form-fields">
                                                <div class="title">
                                                    <div>Youtube Video <span class="text-danger">*</span>:</div>
                                                </div>
                                                <input type="url" name="tour[general][video_link]" class="field"
                                                    value="{{ old('tour[general][video_link]') }}">
                                                @error('tour[general][video_link]')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-fields">
                                                <div class="multiple-upload" data-upload-multiple>
                                                    <input type="file" class="gallery-input d-none" multiple
                                                        data-upload-multiple-input accept="image/*" id="banners"
                                                        name="gallery[]">
                                                    <label class="multiple-upload__btn themeBtn" for="banners">
                                                        <i class='bx bx-plus'></i>
                                                        Gallery
                                                    </label>
                                                    <div class="dimensions mt-3">
                                                        <strong>Dimensions:</strong> 760 &times; 400
                                                    </div>
                                                    <ul class="multiple-upload__imgs" data-upload-multiple-images>
                                                    </ul>
                                                    <div class="text-danger error-message d-none"
                                                        data-upload-multiple-error>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div x-show="optionTab === 'location'" class="location-options">
                            <div class="form-box" x-data="{ locationType: 'normal_location' }">
                                <div class="form-box__header d-flex align-items-center justify-content-between">
                                    <div class="title">Tour Locations</div>
                                    <div class="d-flex align-items-center gap-5">
                                        <div class="form-check p-0">
                                            <input class="form-check-input" type="radio"
                                                name="tour[location][location_type]" id="normal_location"
                                                x-model="locationType" value="normal_location" checked>
                                            <label class="form-check-label" for="normal_location">Location</label>
                                        </div>
                                        <div class="form-check p-0">
                                            <input class="form-check-input" type="radio"
                                                name="tour[location][location_type]" id="normal_itinerary"
                                                x-model="locationType" value="normal_itinerary">
                                            <label class="form-check-label" for="normal_itinerary">Normal
                                                Itinerary</label>
                                        </div>
                                        <div class="form-check p-0">
                                            <input class="form-check-input" type="radio"
                                                name="tour[location][location_type]" id="itinerary_experience"
                                                x-model="locationType" value="itinerary_experience">
                                            <label class="form-check-label" for="itinerary_experience">Plan Itinerary
                                                Experience</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-box__body">
                                    <div x-show="locationType === 'normal_location'">
                                        <div class="form-fields">
                                            <label class="title">Location <span class="text-danger">*</span>
                                                :</label>
                                            <select name="tour[location][normal_location][city_ids][]"
                                                class="choice-select" data-error="Location" multiple
                                                placeholder="Select Locations" autocomplete="new-password">
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
                                        <div class="form-fields">
                                            <label class="title">Real Tour address <span class="text-danger">*</span>
                                                :</label>
                                            <input type="text" name="tour[location][normal_location][address]"
                                                class="field"
                                                value="{{ old('tour[location][normal_location][address]') }}"
                                                data-error="Real Tour address">
                                            @error('tour[location][normal_location][address]')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div x-show="locationType === 'normal_itinerary'">
                                        <div class="form-fields">
                                            <label
                                                class=" d-flex align-items-center mb-3 justify-content-between"><span
                                                    class="title title--sm mb-0">Itinerary:</span>
                                                <span class="title d-flex align-items-center gap-1">Section
                                                    Preview:
                                                    <a href="{{ asset('admin/assets/images/itinerary.png') }}"
                                                        data-fancybox="gallery" class="themeBtn p-1"
                                                        title="Section Preivew"><i class='bx  bxs-show'></i></a>
                                                </span>
                                            </label>
                                            <div class="repeater-table" data-repeater>
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Day - Title</th>
                                                            <th scope="col">Content</th>
                                                            <th scope="col">Feature Image</th>
                                                            <th class="text-end" scope="col">Remove</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody data-repeater-list>
                                                        <tr data-repeater-item>

                                                            <td class="w-25">
                                                                <input name="tour[location][normal_itinerary][days][]"
                                                                    type="text" class="field" placeholder="Day">
                                                                <br>
                                                                <input name="tour[location][normal_itinerary][title][]"
                                                                    type="text" class="field mt-3"
                                                                    placeholder="Title">
                                                            </td>
                                                            <td>
                                                                <textarea name="tour[location][normal_itinerary][description][]" class="field"rows="2"></textarea>
                                                            </td>
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
                                                                                name="tour[location][normal_itinerary][featured_image][]"
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
                                                                                name="tour[location][normal_itinerary][featured_image_alt_text][]"
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
                                                    data-repeater-create>Add
                                                    <i class="bx bx-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div x-show="locationType === 'itinerary_experience'">
                                        <div class="plan-itenirary">
                                            <div class="form-fields">
                                                <label class="d-flex align-items-center mb-3 justify-content-between">
                                                    <span class="title title--sm mb-0">Plan Itinerary
                                                        Experience:</span>
                                                    <span class="title d-flex align-items-center gap-1">
                                                        Section Preview:
                                                        <a href="{{ asset('admin/assets/images/itinerary-exp.png') }}"
                                                            data-fancybox="gallery" class="themeBtn p-1"
                                                            title="Section Preivew"><i class='bx  bxs-show'></i></a>
                                                    </span>
                                                </label>

                                            </div>
                                            <div class="form-fields">
                                                <div class="title d-flex align-items-center gap-2">
                                                    <div>Map Iframe Link<span class="text-danger p-0">*</span>:</div>
                                                    <a class="p-0 nav-link" href="https://www.google.com/maps/d/"
                                                        target="_blank">Google Map Generator</a>
                                                </div>
                                                <input type="url" name="itinerary_experience[map_iframe]"
                                                    class="field"
                                                    value="{{ old('itinerary_experience[map_iframe]') }}">
                                                @error('itinerary_experience[map_iframe]')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="row mt-4">
                                                <div class="col-md-6 col-12">
                                                    <div class="form-fields">
                                                        <label class="title">Pickup locations:</label>
                                                        <input class="choice-select"
                                                            name="itinerary_experience[pickup_locations]"
                                                            placeholder="Pickup Location Title">
                                                        @error('itinerary_experience[pickup_locations]')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-fields">
                                                        <label class="title">Dropoff locations:</label>
                                                        <input class="choice-select"
                                                            name="itinerary_experience[dropoff_locations]"
                                                            placeholder="Dropoff Location Title">
                                                        @error('itinerary_experience[dropoff_locations]')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-fields mt-3 repeater-table">
                                                <div class="form-fields">
                                                    <label class="title title--sm">Experience:</label>
                                                </div>
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Order</th>
                                                            <th scope="col">Type</th>
                                                            <th scope="col" colspan="2">Fields</th>
                                                            <th class="text-end" scope="col">Remove</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="itinerary-table-body" data-sortable-body></tbody>
                                                </table>
                                                <div
                                                    class="dropdown bootsrap-dropdown mt-4 d-flex justify-content-end">
                                                    <button type="button" class="themeBtn dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        Add <i class="bx bx-chevron-down"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <button type="button" class="dropdown-item"
                                                                data-itinerary-action="add-vehicle">
                                                                <i class='bx bxs-car'></i> Add Vehicle
                                                            </button>
                                                        </li>
                                                        <li>
                                                            <button type="button" class="dropdown-item"
                                                                data-itinerary-action="add-stop">
                                                                <i class="bx bx-star"></i> Add Stop
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="form-check d-none" id="add-stop-btn">
                                                <input class="form-check-input" type="checkbox"
                                                    name="itinerary_experience[enable_sub_stops]"
                                                    id="itinerary_experience_enabled_sub_stops" value="1">
                                                <label class="form-check-label"
                                                    for="itinerary_experience_enabled_sub_stops">Add
                                                    Sub Stops</label>
                                            </div>

                                            <div class="form-fields mt-4 d-none" id="itinerary_experience_sub_stops">
                                                <label class="title title--sm">Sub Stops:</label>
                                                <div class="repeater-table" data-repeater>
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Main Stop</th>
                                                                <th scope="col">Fields</th>
                                                                <th class="text-end" scope="col">Remove</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody data-repeater-list>
                                                            <tr data-repeater-item>
                                                                <td>
                                                                    <select
                                                                        name="itinerary_experience[stops][sub_stops][main_stop][]"
                                                                        class="field main-stop-dropdown">
                                                                        <option value="" selected>Select</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <input
                                                                        name="itinerary_experience[stops][sub_stops][title][]"
                                                                        type="text" class="field"
                                                                        placeholder="Title">
                                                                    <br>
                                                                    <div class="mt-3">
                                                                        <input
                                                                            name="itinerary_experience[stops][sub_stops][activities][]"
                                                                            type="text" class="field"
                                                                            placeholder="Activities">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <button type="button"
                                                                        class="delete-btn ms-auto delete-btn--static"
                                                                        data-repeater-remove>
                                                                        <i class='bx bxs-trash-alt'></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <button type="button" class="themeBtn ms-auto"
                                                        data-repeater-create>Add
                                                        <i class="bx bx-plus"></i></button>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div x-show="optionTab === 'pricing'" class="pricing-options">
                            <div class="form-box">
                                <div class="form-box__header d-flex align-items-center justify-content-between">
                                    <div class="title">Pricing</div>
                                </div>
                                <div class="form-box__body">
                                    <div class="row">
                                        <div class="col-12 mb-2">
                                            <div class="form-fields">
                                                <div class="title title--sm">Tour Price:</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12 mb-3">
                                            <div class="form-fields">
                                                <label class="title">Price <span
                                                        class="text-danger">*</span>:</label>
                                                <input step="0.01" min="0" type="number"
                                                    name="tour[pricing][regular_price]" class="field"
                                                    value="{{ old('tour[pricing][regular_price]') }}"
                                                    data-error="Price">
                                                @error('tour[pricing][regular_price]')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-fields">
                                                <label class="title">Sale Price <span
                                                        class="text-danger">*</span>:</label>
                                                <input step="0.01" min="0" type="number"
                                                    name="tour[pricing][sale_price]" class="field"
                                                    value="{{ old('tour[pricing][sale_price]') }}"
                                                    data-error="Sale Price">
                                                @error('tour[pricing][sale_price]')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 my-2">
                                            <hr>
                                        </div>
                                        <div class="col-12" x-data="{ personType: '0' }">
                                            <div class="row">
                                                <div class="col-12 mb-2">
                                                    <div class="form-fields">
                                                        <div class="title title--sm mb-0">Person Types:</div>
                                                    </div>
                                                    <div class="form-fields">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="tour[pricing][is_person_type_enabled]"
                                                                id="enebled_person_types" value="1"
                                                                x-model="personType"
                                                                @change="personType = personType ? 1 : 0">
                                                            <label class="form-check-label"
                                                                for="enebled_person_types">
                                                                Enable Person Types
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12" x-show="personType == 1">
                                                    <div x-data="{ tourType: 'normal' }">
                                                        <div
                                                            class="d-flex align-items-center justify-content-center gap-5 mt-3 mb-4">
                                                            <div class="form-check p-0">
                                                                <input class="form-check-input" type="radio"
                                                                    name="tour[pricing][price_type]"
                                                                    x-model="tourType" value="normal"
                                                                    id="normalPrice" checked>
                                                                <label class="form-check-label"
                                                                    for="normalPrice">Normal
                                                                    Tour
                                                                    Price</label>
                                                            </div>
                                                            <div class="form-check p-0">
                                                                <input class="form-check-input" type="radio"
                                                                    name="tour[pricing][price_type]"
                                                                    x-model="tourType" value="private"
                                                                    id="privatePrice">
                                                                <label class="form-check-label"
                                                                    for="privatePrice">Private
                                                                    Tour Price</label>
                                                            </div>
                                                            <div class="form-check p-0">
                                                                <input class="form-check-input" type="radio"
                                                                    name="tour[pricing][price_type]"
                                                                    x-model="tourType" value="water"
                                                                    id="waterPrice">
                                                                <label class="form-check-label" for="waterPrice">Water
                                                                    /
                                                                    Desert
                                                                    Activities</label>
                                                            </div>
                                                            <div class="form-check p-0">
                                                                <input class="form-check-input" type="radio"
                                                                    name="tour[pricing][price_type]"
                                                                    x-model="tourType" value="promo"
                                                                    id="promoPrice">
                                                                <label class="form-check-label"
                                                                    for="promoPrice">Promo</label>
                                                            </div>
                                                        </div>

                                                        <div x-show="tourType === 'normal'">
                                                            <div class="form-fields">
                                                                <div class="title">Normal Tour Pricing:</div>
                                                                <div class="repeater-table" data-repeater>
                                                                    <table class="table table-bordered">
                                                                        <thead>
                                                                            <tr>
                                                                                <th scope="col">
                                                                                    Person Type
                                                                                </th>
                                                                                <th scope="col">Min</th>
                                                                                <th scope="col">Max</th>
                                                                                <th scope="col">Price</th>
                                                                                <th></th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody data-repeater-list>
                                                                            <tr data-repeater-item>
                                                                                <td>
                                                                                    <input type="text"
                                                                                        name="tour[pricing][normal][person_type][]"
                                                                                        class="field"
                                                                                        placeholder="Eg: Adult">
                                                                                    <br>
                                                                                    <div class="mt-3">
                                                                                        <input type="text"
                                                                                            name="tour[pricing][normal][person_description][]"
                                                                                            class="field"
                                                                                            placeholder="Description">
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <input type="number"
                                                                                        min="0"
                                                                                        name="tour[pricing][normal][min_person][]"
                                                                                        class="field">
                                                                                </td>
                                                                                <td>
                                                                                    <input type="number"
                                                                                        min="0"
                                                                                        name="tour[pricing][normal][max_person][]"
                                                                                        class="field">
                                                                                </td>
                                                                                <td>
                                                                                    <input type="number"
                                                                                        step="0.01" min="0"
                                                                                        name="tour[pricing][normal][price][]"
                                                                                        class="field">
                                                                                </td>
                                                                                <td>
                                                                                    <button type="button"
                                                                                        class="delete-btn ms-auto delete-btn--static"
                                                                                        data-repeater-remove disabled>
                                                                                        <i
                                                                                            class='bx bxs-trash-alt'></i>
                                                                                    </button>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    <button type="button" class="themeBtn ms-auto"
                                                                        data-repeater-create>Add
                                                                        <i class="bx bx-plus"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div x-show="tourType === 'private'">
                                                            <div class="form-fields">
                                                                <div class="title">Private Tour Pricing:</div>
                                                                <div class="repeater-table">
                                                                    <table class="table table-bordered">
                                                                        <thead>
                                                                            <tr>
                                                                                <th scope="col">Car Price</th>
                                                                                <th scope="col">Min</th>
                                                                                <th scope="col">Max</th>

                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>
                                                                                    <input type="number"
                                                                                        step="0.01" min="0"
                                                                                        name="tour[pricing][private][car_price]"
                                                                                        class="field">
                                                                                </td>
                                                                                <td>
                                                                                    <input type="number"
                                                                                        min="0"
                                                                                        name="tour[pricing][private][min_person]"
                                                                                        class="field">
                                                                                </td>
                                                                                <td>
                                                                                    <input type="number"
                                                                                        min="0"
                                                                                        name="tour[pricing][private][max_person]"
                                                                                        class="field">
                                                                                </td>

                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div x-show="tourType === 'water'">
                                                            <div class="form-fields">
                                                                <div class="repeater-table" data-repeater>
                                                                    <label class="title">Water / Desert Activities
                                                                        Pricing:</label>
                                                                    <table class="table table-bordered">
                                                                        <thead>
                                                                            <tr>
                                                                                <th scope="col">Time</th>
                                                                                <th scope="col">Price</th>
                                                                                <th class="text-end" scope="col">
                                                                                    Remove
                                                                                </th>
                                                                            </tr>
                                                                        </thead>
                                                                        @php
                                                                            $waterMints = [
                                                                                '00:15',
                                                                                '00:30',
                                                                                '00:45',
                                                                                '01:00',
                                                                                '01:15',
                                                                                '01:30',
                                                                                '01:45',
                                                                                '02:00',
                                                                                '02:15',
                                                                                '02:30',
                                                                                '02:45',
                                                                                '03:00',
                                                                                '03:15',
                                                                                '03:30',
                                                                                '03:45',
                                                                                '04:00',
                                                                            ];
                                                                        @endphp
                                                                        <tbody data-repeater-list>
                                                                            <tr data-repeater-item>
                                                                                <td>
                                                                                    <select
                                                                                        name="tour[pricing][water][time][]"
                                                                                        class="field"
                                                                                        data-error="Desert Activities Time">
                                                                                        <option value="">Select
                                                                                            Time
                                                                                        </option>
                                                                                        @foreach ($waterMints as $waterMint)
                                                                                            <option
                                                                                                value="{{ $waterMint }}">

                                                                                                {{ $waterMint }}
                                                                                                ({{ (int) substr($waterMint, 0, 2) * 60 + (int) substr($waterMint, 3, 2) }}
                                                                                                mins)
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </td>
                                                                                <td>
                                                                                    <input
                                                                                        name="tour[pricing][water][water_price][]"
                                                                                        type="number" class="field"
                                                                                        placeholder="Price"
                                                                                        step="0.01" min="0"
                                                                                        data-error="Desert Activities Price">
                                                                                </td>
                                                                                <td>
                                                                                    <button type="button"
                                                                                        class="delete-btn ms-auto delete-btn--static"
                                                                                        data-repeater-remove disabled>
                                                                                        <i
                                                                                            class='bx bxs-trash-alt'></i>
                                                                                    </button>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    <button type="button" class="themeBtn ms-auto"
                                                                        data-repeater-create>Add
                                                                        <i class="bx bx-plus"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div x-show="tourType === 'promo'">
                                                            <div class="form-fields">
                                                                <div class="repeater-table" data-repeater>
                                                                    <label class="title">Promo Pricing:</label>
                                                                    <table class="table table-bordered">
                                                                        <thead>
                                                                            <tr>
                                                                                <th scope="col">Package Title</th>
                                                                                <th scope="col">Pricing Details</th>
                                                                                <th scope="col">Offer Expires At
                                                                                </th>
                                                                                <th class="text-end" scope="col">
                                                                                    Remove
                                                                                </th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody data-repeater-list>
                                                                            <tr data-repeater-item>
                                                                                <td>
                                                                                    <input type="text"
                                                                                        name="tour[pricing][promo][promo_title][]"
                                                                                        class="field"
                                                                                        placeholder="E.g., For One Adult"
                                                                                        data-error="Package Title">
                                                                                </td>
                                                                                <td style="width: 35%">
                                                                                    <div>
                                                                                        <input
                                                                                            name="tour[pricing][promo][original_price][]"
                                                                                            type="number"
                                                                                            class="field"
                                                                                            placeholder="Original Price"
                                                                                            step="0.01"
                                                                                            min="0"
                                                                                            data-error="Original Price">
                                                                                    </div>
                                                                                    <div class="mt-2">
                                                                                        <input
                                                                                            name="tour[pricing][promo][discount_price][]"
                                                                                            type="number"
                                                                                            class="field"
                                                                                            placeholder="Discounted Price"
                                                                                            step="0.01"
                                                                                            min="0"
                                                                                            data-error="Discount Price">
                                                                                    </div>
                                                                                    <div class="mt-2">
                                                                                        <input
                                                                                            name="tour[pricing][promo][promo_price][]"
                                                                                            type="number"
                                                                                            class="field"
                                                                                            placeholder="Promo Price"
                                                                                            step="0.01"
                                                                                            min="0"
                                                                                            data-error="Promo Price">
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <input type="datetime-local"
                                                                                        class="field"
                                                                                        name="tour[pricing][promo][offer_expire_at][]"
                                                                                        data-error="Expiry Date & Time"
                                                                                        autocomplete="off">
                                                                                </td>
                                                                                <td>
                                                                                    <button type="button"
                                                                                        class="delete-btn ms-auto delete-btn--static"
                                                                                        data-repeater-remove disabled>
                                                                                        <i
                                                                                            class='bx bxs-trash-alt'></i>
                                                                                    </button>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    <button type="button" class="themeBtn ms-auto"
                                                                        data-repeater-create>Add
                                                                        <i class="bx bx-plus"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 my-2">
                                            <hr>
                                        </div>
                                        <div class="col-12" x-data="{ extraPrice: '0' }">
                                            <div class="row">
                                                <div class="col-12 mb-2">
                                                    <div class="form-fields">
                                                        <div class="title title--sm mb-0">Extra Price:</div>
                                                    </div>
                                                    <div class="form-fields">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="tour[pricing][is_extra_price_enabled]"
                                                                id="enebled_extra_price"
                                                                @change="extraPrice = extraPrice ? 1 : 0"
                                                                value="1" x-model="extraPrice">
                                                            <label class="form-check-label" for="enebled_extra_price">
                                                                Enable extra price
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12" x-show="extraPrice == 1">
                                                    <div class="row">
                                                        <div class="col-12 mt-3">
                                                            <div class="form-fields">
                                                                <div class="title">Extra Price:</div>
                                                                <div class="repeater-table" data-repeater>
                                                                    <table class="table table-bordered">
                                                                        <thead>
                                                                            <tr>
                                                                                <th scope="col">Name</th>
                                                                                <th scope="col">Price</th>
                                                                                <th scope="col">Type</th>
                                                                                <th></th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody data-repeater-list>
                                                                            <tr data-repeater-item>
                                                                                <td>
                                                                                    <input type="text"
                                                                                        name="tour[pricing][extra_price][0][name]"
                                                                                        class="field"
                                                                                        placeholder="Extra Price Name">
                                                                                </td>
                                                                                <td>
                                                                                    <input type="number"
                                                                                        step="0.01" min="0"
                                                                                        name="tour[pricing][extra_price][0][price]"
                                                                                        class="field">
                                                                                </td>
                                                                                <td>
                                                                                    <select class="field"
                                                                                        name="tour[pricing][extra_price][0][type]">
                                                                                        <option value=""
                                                                                            selected>
                                                                                            Select</option>
                                                                                        <option value="one-time">
                                                                                            One-time
                                                                                        </option>
                                                                                        <option value="per-hour">Per
                                                                                            Hour
                                                                                        </option>
                                                                                        <option value="per-day">Per Day
                                                                                        </option>
                                                                                    </select>
                                                                                    <br>
                                                                                    <div class="form-check mt-3">
                                                                                        <input id="is_per_person"
                                                                                            class="form-check-input"
                                                                                            type="checkbox"
                                                                                            name="tour[pricing][extra_price][0][is_per_person]"
                                                                                            value="1">
                                                                                        <label for="is_per_person"
                                                                                            class="form-check-label">Price
                                                                                            per person</label>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <button type="button"
                                                                                        class="delete-btn ms-auto delete-btn--static"
                                                                                        data-repeater-remove disabled>
                                                                                        <i
                                                                                            class='bx bxs-trash-alt'></i>
                                                                                    </button>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    <button type="button" class="themeBtn ms-auto"
                                                                        data-repeater-create>Add <i
                                                                            class="bx bx-plus"></i></button>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 my-2">
                                            <hr>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-12 mt-3">
                                                            <div class="form-fields">
                                                                <div class="title">Discount by number of people:</div>
                                                                <div class="repeater-table" data-repeater>
                                                                    <table class="table table-bordered">
                                                                        <thead>
                                                                            <tr>
                                                                                <th scope="col">
                                                                                    No of people
                                                                                </th>
                                                                                <th scope="col">Discount
                                                                                </th>
                                                                                <th scope="col">Type</th>
                                                                                <th></th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody data-repeater-list>
                                                                            <tr data-repeater-item>
                                                                                <td>
                                                                                    <div class="row">
                                                                                        <div class="col-md-6">
                                                                                            <input type="number"
                                                                                                min="0"
                                                                                                name="tour[pricing][discount][people_from][]"
                                                                                                class="field"
                                                                                                placeholder="from">
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <input type="number"
                                                                                                min="0"
                                                                                                name="tour[pricing][discount][people_to][]"
                                                                                                class="field"
                                                                                                placeholder="to">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <input type="number"
                                                                                        min="0"
                                                                                        name="tour[pricing][discount][discount][]"
                                                                                        class="field" placeholder="">
                                                                                </td>
                                                                                <td>
                                                                                    <select class="field"
                                                                                        name="tour[pricing][discount][type][]">
                                                                                        <option value=""
                                                                                            selected>
                                                                                            Select</option>
                                                                                        <option value="fixed">Fixed
                                                                                        </option>
                                                                                        <option value="percent">Percent
                                                                                        </option>
                                                                                    </select>
                                                                                </td>
                                                                                <td>
                                                                                    <button type="button"
                                                                                        class="delete-btn ms-auto delete-btn--static"
                                                                                        data-repeater-remove disabled>
                                                                                        <i
                                                                                            class='bx bxs-trash-alt'></i>
                                                                                    </button>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    <button type="button" class="themeBtn ms-auto"
                                                                        data-repeater-create>Add
                                                                        <i class="bx bx-plus"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 my-2">
                                            <hr>
                                        </div>
                                        <div class="col-12 my-2" x-data="{ serviceFee: '0' }">
                                            <div class="row">
                                                <div class="col-12 mb-2">
                                                    <div class="form-fields">
                                                        <div class="title title--sm mb-0">Service fee:</div>
                                                    </div>
                                                    <div class="form-fields">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="enebled_service_fee" value="1"
                                                                name="tour[pricing][enabled_custom_service_fee]"
                                                                x-model="serviceFee"
                                                                @change="serviceFee = serviceFee ? 1 : 0">
                                                            <label class="form-check-label" for="enebled_service_fee">
                                                                Enable service fee
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12" x-show="serviceFee == 1">
                                                    <div class="form-fields mt-2">
                                                        <input step="0.01" min="0" type="number"
                                                            name="tour[pricing][service_fee_price]" class="field"
                                                            value="{{ old('tour[pricing][service_fee_price]') }}"
                                                            data-error="Price">
                                                        @error('tour[pricing][service_fee_price]')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <div class="form-fields mb-4">
                                                <div class="d-flex align-items-center gap-3 mb-2">
                                                    <span class="title mb-0">Whatsapp Number:</span>
                                                    <div class="form-check form-switch" data-enabled-text="Enabled"
                                                        data-disabled-text="Disabled">
                                                        <input class="form-check-input" data-toggle-switch checked
                                                            type="checkbox" id="enable-section" checked
                                                            value="1" name="tour[pricing][show_phone]">
                                                        <label class="form-check-label"
                                                            for="enable-section">Enabled</label>
                                                    </div>
                                                </div>
                                                <div data-flag-input-wrapper>
                                                    <input type="hidden" name="tour[pricing][phone_dial_code]"
                                                        data-flag-input-dial-code value="971">
                                                    <input type="hidden" name="tour[pricing][phone_country_code]"
                                                        data-flag-input-country-code value="ae">
                                                    <input type="text" name="tour[pricing][phone_number]"
                                                        class="field flag-input" data-flag-input
                                                        value="{{ old('tour[pricing][phone_number]') }}"
                                                        placeholder="Phone" data-error="phone" inputmode="numeric"
                                                        pattern="[0-9]*"
                                                        oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                                        maxlength="15">
                                                </div>
                                                @error('tour[pricing][phone_number]')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div x-show="optionTab === 'availability'" class="availability-options">
                            <div class="form-box">
                                <div class="form-box__header">
                                    <div class="title">Availability</div>
                                </div>
                                <div class="form-box__body">
                                    <div class="col-12" x-data="{ fixedDate: '0' }">
                                        <div class="row">
                                            <div class="col-12 mb-2">
                                                <div class="form-fields">
                                                    <div class="title">Fixed dates:</div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="tour[availability][is_fixed_date]" id="fixed_date"
                                                            value="0" x-model="fixedDate"
                                                            @change="fixedDate = fixedDate ? 1 : 0">
                                                        <label class="form-check-label" for="fixed_date">
                                                            Enable Fixed Date
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12" x-show="fixedDate == 1">
                                                <div class="row my-2">
                                                    <div class="col-md-4">
                                                        <div class="form-fields">
                                                            <label class="title">Start Date <span
                                                                    class="text-danger">*</span>
                                                                :</label>
                                                            <input readonly type="text" class="field date-picker"
                                                                placeholder="Select a date"
                                                                name="tour[availability][start_date]"
                                                                autocomplete="off">
                                                            @error('availability[start_date]')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-fields">
                                                            <label class="title">End Date <span
                                                                    class="text-danger">*</span>
                                                                :</label>
                                                            <input readonly type="text" class="field date-picker"
                                                                placeholder="Select a date"
                                                                name="tour[availability][end_date]"
                                                                autocomplete="off">
                                                            @error('availability[end_date]')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-fields">
                                                            <label class="title">Last Booking Date <span
                                                                    class="text-danger">*</span>
                                                                :</label>
                                                            <input readonly type="text" class="field date-picker"
                                                                placeholder="Select a date" autocomplete="off"
                                                                name="tour[availability][last_booking_date]">
                                                            @error('availability[last_booking_date]')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3" x-data="{ openHours: '0' }">
                                        <div class="row">
                                            <div class="col-12 mb-2">
                                                <div class="form-fields">
                                                    <div class="title">Open Hours:</div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="tour[availability][is_open_hours]" id="openHours"
                                                            value="0" x-model="openHours"
                                                            @change="openHours = openHours ? 1 : 0">
                                                        <label class="form-check-label" for="openHours">
                                                            Enable Open Hours
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12" x-show="openHours == 1">
                                                <div class="row my-2">
                                                    <div class="repeater-table form-fields">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">Enable? </th>
                                                                    <th scope="col">Day of Week </th>
                                                                    <th scope="col">Open</th>
                                                                    <th scope="col">Close</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @php
                                                                    $days = [
                                                                        'Monday',
                                                                        'Tuesday',
                                                                        'Wednesday',
                                                                        'Thursday',
                                                                        'Friday',
                                                                    ];
                                                                    $timeSlots = [
                                                                        '00:00:00',
                                                                        '02:00:00',
                                                                        '03:00:00',
                                                                        '04:00:00',
                                                                        '05:00:00',
                                                                        '06:00:00',
                                                                        '07:00:00',
                                                                        '08:00:00',
                                                                        '09:00:00',
                                                                        '10:00:00',
                                                                        '11:00:00',
                                                                        '12:00:00',
                                                                        '13:00:00',
                                                                        '14:00:00',
                                                                        '15:00:00',
                                                                        '16:00:00',
                                                                        '17:00:00',
                                                                        '18:00:00',
                                                                        '19:00:00',
                                                                        '20:00:00',
                                                                        '21:00:00',
                                                                        '22:00:00',
                                                                        '23:00:00',
                                                                    ];

                                                                @endphp
                                                                @for ($i = 0; $i < count($days); $i++)
                                                                    @php
                                                                        $day = $days[$i];
                                                                    @endphp
                                                                    <tr>
                                                                        <td>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox"
                                                                                    name="tour[availability][open_hours][{{ $i }}][enabled]"
                                                                                    id="{{ $day }}"
                                                                                    value="1">
                                                                                <label class="form-check-label"
                                                                                    for="{{ $day }}">
                                                                                    Enable
                                                                                </label>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <input
                                                                                name="tour[availability][open_hours][{{ $i }}][day]"
                                                                                type="text"
                                                                                value="{{ $day }}"
                                                                                class="field" readonly>
                                                                        </td>
                                                                        <td>
                                                                            <select
                                                                                name="tour[availability][open_hours][{{ $i }}][open_time]"
                                                                                class="field">
                                                                                <option value="">Select Time
                                                                                </option>
                                                                                @foreach ($timeSlots as $slot)
                                                                                    <option
                                                                                        value="{{ $slot }}">
                                                                                        {{ date('H:i', strtotime($slot)) }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </td>
                                                                        <td>
                                                                            <select
                                                                                name="tour[availability][open_hours][{{ $i }}][close_time]"
                                                                                class="field">
                                                                                <option value="">Select Time
                                                                                </option>
                                                                                @foreach ($timeSlots as $slot)
                                                                                    <option
                                                                                        value="{{ $slot }}">
                                                                                        {{ date('H:i', strtotime($slot)) }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </td>
                                                                    </tr>
                                                                @endfor
                                                            </tbody>

                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div x-show="optionTab === 'addOn'" class="addOn-options">
                            <div class="form-box">
                                <div class="form-box__header">
                                    <div class="title">Add On (You might also like)</div>
                                </div>
                                <div class="form-box__body">
                                    <div class="form-fields">
                                        <label class="title">Select 4 tours <span class="text-danger">*</span>
                                            :</label>
                                        <select name="related_tour_ids[]" multiple class="choice-select"
                                            data-max-items="4" placeholder="Select Tours"
                                            {{ !$tours->isEmpty() ? '' : '' }} data-error="Top 4 featured tours">
                                            @foreach ($tours as $tour)
                                                <option value="{{ $tour->id }}">
                                                    {{ $tour->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('related_tour_ids[]')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div x-show="optionTab === 'status'" class="status-options">
                            <div class="form-box">
                                <div class="form-box__header">
                                    <div class="title">Publish</div>
                                </div>
                                <div class="form-box__body">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="tour[status][status]"
                                            id="publish" checked value="publish">
                                        <label class="form-check-label" for="publish">
                                            Publish
                                        </label>
                                    </div>
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="radio" name="tour[status][status]"
                                            id="draft" value="draft">
                                        <label class="form-check-label" for="draft">
                                            Draft
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-box">
                                <div class="form-box__header">
                                    <div class="title">Feature Image</div>
                                </div>
                                <div class="form-box__body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-fields">
                                                <div class="upload" data-upload>
                                                    <div class="upload-box-wrapper">
                                                        <div class="upload-box show" data-upload-box>
                                                            <input type="file" name="featured_image"
                                                                data-error="Feature Image" id="featured_image"
                                                                class="upload-box__file d-none" accept="image/*"
                                                                data-file-input data-required>
                                                            <div class="upload-box__placeholder"><i
                                                                    class='bx bxs-image'></i>
                                                            </div>
                                                            <label for="featured_image"
                                                                class="upload-box__btn themeBtn">Upload
                                                                Image</label>
                                                        </div>
                                                        <div class="upload-box__img" data-upload-img>
                                                            <button type="button" class="delete-btn"
                                                                data-delete-btn><i
                                                                    class='bx bxs-trash-alt'></i></button>
                                                            <a href="#" class="mask"
                                                                data-fancybox="gallery">
                                                                <img src="{{ asset('admin/assets/images/loading.webp') }}"
                                                                    alt="Uploaded Image" class="imgFluid"
                                                                    data-upload-preview>
                                                            </a>
                                                            <input type="text" name="featured_image_alt_text"
                                                                class="field" placeholder="Enter alt text"
                                                                value="Feature Image">
                                                        </div>
                                                    </div>
                                                    <div data-error-message
                                                        class="text-danger mt-2 d-none text-center">
                                                        Please
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
                                </div>
                            </div>
                            <div class="form-box">
                                <div class="form-box__header">
                                    <div class="title">Author Settings</div>
                                </div>
                                <div class="form-box__body">
                                    <div class="form-fields">
                                        <label class="title">Author <span class="text-danger">*</span> :</label>
                                        <select class="choice-select" name="tour[status][author_id]"
                                            data-error="Author">
                                            <option value="" selected>Select</option>
                                            @foreach ($users as $users)
                                                <option value="{{ $users->id }}"
                                                    {{ old('tour[status][author_id]') == $users->id ? 'selected' : '' }}>
                                                    {{ $users->full_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('tour[status][author_id]')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-box">
                                <div class="form-box__header">
                                    <div class="title">Tour Featured</div>
                                </div>
                                <div class="form-box__body">
                                    <div class="form-fields">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox"
                                                name="tour[status][is_featured]" id="is_featured" value="1">
                                            <label class="form-check-label" for="is_featured">
                                                Enable featured
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-fields mt-3">
                                        <label class="title">Default State <span class="text-danger">*</span>
                                            :</label>
                                        <select name="tour[status][featured_state]" class="field">

                                            <option value="" selected disabled>Select</option>
                                            <option value="always">Always Available</option>
                                            <option value="specific_dates">Only available on specific Dates</option>
                                        </select>
                                        @error('tour[status][featured_state]')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            @if (!$attributes->isEmpty())
                                @foreach ($attributes as $attribute)
                                    @if (!$attribute->attributeItems->isEmpty())
                                        <div class="form-box">
                                            <div class="form-box__header">
                                                <div class="title">Attribute: {{ $attribute->name }}</div>
                                            </div>
                                            <div class="form-box__body">
                                                @foreach ($attribute->attributeItems as $index => $item)
                                                    <div class="form-check mb-1">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="tour[status][attributes][{{ $attribute->id }}][]"
                                                            id="attribute-{{ $item->id }}-{{ $index }}"
                                                            value="{{ $item->id }}">
                                                        <label class="form-check-label"
                                                            for="attribute-{{ $item->id }}-{{ $index }}">
                                                            {{ $item->item }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endif

                            <div class="form-box">
                                <div class="form-box__header">
                                    <div class="title">Ical</div>
                                </div>
                                <div class="form-box__body">
                                    <div class="form-fields">
                                        <label class="title">Import url <span class="text-danger">*</span>
                                            :</label>
                                        <input type="url" name="tour[status][ical_import_url]" class="field"
                                            placeholder="">
                                        @error('tour[status][ical_import_url]')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-fields">
                                        <label class="title">Export url <span class="text-danger">*</span>
                                            :</label>
                                        <input type="url" name="tour[status][ical_export_url]" class="field"
                                            placeholder="">
                                        @error('tour[status][ical_export_url]')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div x-show="optionTab === 'seo'" class="seo-options">
                            <x-seo-options :seo="$seo ?? null" :resource="'tours'" />
                        </div>
                        <button type="submit" class="themeBtn mt-4 ms-auto">Save Changes<i
                                class='bx bx-check'></i></button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <x-slot name="css">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css">
        <link rel="stylesheet" type="text/css"
            href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    </x-slot>

    <x-slot name="js">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <script src="{{ asset('admin/assets/js/tour-settings.js') }}"></script>
    </x-slot>

</x-admin.layout>
