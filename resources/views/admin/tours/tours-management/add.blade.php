@extends('admin.dash_layouts.main')
@section('content')
    <div class="col-md-12">
        <div class="dashboard-content">
            {{ Breadcrumbs::render('admin.tours.create') }}
            <form action="{{ route('admin.tours.store') }}" method="POST" enctype="multipart/form-data" id="validation-form">
                @csrf
                <div class="custom-sec custom-sec--form">
                    <div class="custom-sec__header">
                        <div class="section-content">
                            <h3 class="heading">{{ isset($title) ? $title : '' }}</h3>
                            <div class="permalink">
                                <div class="title">Permalink:</div>
                                <div class="title">
                                    <div class="full-url">{{ buildUrl(url('/'), 'tours/') }}</div>
                                    <input value="edit-slug" type="button" class="link permalink-input" name="slug">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" x-data="{ optionTab: 'general' }">
                    <div class="col-md-3">
                        <div class="form-box form-box--sticky">
                            <div class="form-box__header">
                                <div class="title"><i class='bx bxs-cog'></i> Tour Information
                                </div>
                            </div>
                            <div class="form-box__body p-0">
                                <ul>
                                    <li class="settings-item">
                                        <button type="button" class="settings-item__link"
                                            :class="{ 'active': optionTab === 'general' }"
                                            @click="optionTab = 'general'">General</button>
                                    </li>
                                    <li class="settings-item">
                                        <button type="button" class="settings-item__link"
                                            :class="{ 'active': optionTab === 'location' }"
                                            @click="optionTab = 'location'">Location</button>
                                    </li>
                                    <li class="settings-item">
                                        <button type="button" class="settings-item__link"
                                            :class="{ 'active': optionTab === 'pricing' }"
                                            @click="optionTab = 'pricing'">Pricing</button>
                                    </li>
                                    <li class="settings-item">
                                        <button type="button" class="settings-item__link"
                                            :class="{ 'active': optionTab === 'availability' }"
                                            @click="optionTab = 'availability'">Availability</button>
                                    </li>
                                    <li class="settings-item">
                                        <button type="button" class="settings-item__link"
                                            :class="{ 'active': optionTab === 'status' }"
                                            @click="optionTab = 'status'">Status</button>
                                    </li>
                                    <li class="settings-item">
                                        <button type="button" class="settings-item__link"
                                            :class="{ 'active': optionTab === 'seo' }"
                                            @click="optionTab = 'seo'">SEO</button>
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
                                                <label class="title">Content <span class="text-danger">*</span>
                                                    :</label>
                                                <textarea class="editor" name="content" data-placeholder="content" data-required data-error="Content">
                                            {{ old('content') }}
                                        </textarea>
                                                @error('content')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-12  mt-4">
                                            <div class="form-fields">
                                                <label class="title">Categories <span class="text-danger">*</span>
                                                    :</label>
                                                <select name="category_id[]" class="choice-select" data-required
                                                    data-error="Category" placeholder="Select Categories">
                                                    @php
                                                        renderCategories($categories);
                                                    @endphp
                                                </select>
                                                @error('category_id')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-12  mt-4">

                                            <div class="form-fields">
                                                <label class="title">Whatsapp Number:</label>
                                                <input type="hidden" name="phone_country_code" id="phone_country_code">
                                                <input type="text" name="phone" class="field flag-input"
                                                    value="{{ old('phone') }}" placeholder="Phone" data-error="phone"
                                                    inputmode="numeric" pattern="[0-9]*"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                                    maxlength="15">

                                                @error('phone')
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

                                                    <input type="text" name="badge_icon_class" class="field"
                                                        value="{{ old('badge_icon_class', 'bx bx-badge-check') }}"
                                                        placeholder="" oninput="showIcon(this)">
                                                    <i class="bx bx-badge-check bx-md" data-preview-icon></i>
                                                </div>
                                                @error('badge_icon_class')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror

                                            </div>

                                        </div>
                                        <div class="col-md-6 col-12  mt-4">
                                            <div class="form-fields">
                                                <label class="title">Badge Name:</label>
                                                <input type="text" name="badge_name" class="field"
                                                    value="{{ old('badge_name') }}" placeholder="">
                                                @error('badge_name')
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
                                                            @for ($i = 0; $i < 6; $i++)
                                                                <tr>
                                                                    <td>
                                                                        <div class="d-flex align-items-center gap-3">
                                                                            <input type="text" class="field"
                                                                                name="features_icons[]"
                                                                                oninput="showIcon(this)"
                                                                                value="bx bx-check">

                                                                            <i class="bx bx-check bx-md"
                                                                                data-preview-icon></i>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <input name="features_titles[]" type="text"
                                                                            class="field">
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
                                                        data-repeater-create>Add
                                                        <i class="bx bx-plus"></i></button>
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
                                                        data-repeater-create>Add
                                                        <i class="bx bx-plus"></i></button>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-5">
                                            <div class="form-fields">
                                                <label
                                                    class=" d-flex align-items-center mb-3 justify-content-between"><span
                                                        class="title title--sm mb-0">Itinerary:</span>
                                                    <span class="title d-flex align-items-center gap-1">Section
                                                        Preview:
                                                        <a href="{{ asset('admin/assets/images/itinerary.png') }}"
                                                            data-fancybox="gallery" class="themeBtn p-1"><i
                                                                class='bx  bxs-show'></i></a>
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
                                                                    <input name="itinerary_days[]" type="text"
                                                                        class="field" placeholder="Day">
                                                                    <br>
                                                                    <input name="itinerary_title[]" type="text"
                                                                        class="field mt-3" placeholder="Title">
                                                                </td>
                                                                <td>
                                                                    <textarea name="itinerary_content[]" class="field"rows="2"></textarea>
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
                                                            data-fancybox="gallery" class="themeBtn p-1"><i
                                                                class='bx  bxs-show'></i></a>
                                                    </span>
                                                </label>
                                            </div>

                                            <div class="form-fields">
                                                <div class="title">
                                                    <div>Banner Image <span class="text-danger">*</span>:</div>
                                                </div>
                                                <div class="upload upload--banner" data-upload>
                                                    <div class="upload-box-wrapper">
                                                        <div class="upload-box show" data-upload-box>
                                                            <input type="file" name="banner[featured_image]"
                                                                data-required data-error="Feature Image"
                                                                id="banner_featured_image" class="upload-box__file d-none"
                                                                accept="image/*" data-file-input>
                                                            <div class="upload-box__placeholder"><i
                                                                    class='bx bxs-image'></i>
                                                            </div>
                                                            <label for="banner_featured_image"
                                                                class="upload-box__btn themeBtn">Upload
                                                                Image</label>
                                                        </div>
                                                        <div class="upload-box__img" data-upload-img>
                                                            <button type="button" class="delete-btn" data-delete-btn><i
                                                                    class='bx bxs-trash-alt'></i></button>
                                                            <a href="#" class="mask" data-fancybox="gallery">
                                                                <img src="{{ asset('admin/assets/images/loading.webp') }}"
                                                                    alt="Uploaded Image" class="imgFluid"
                                                                    data-upload-preview>
                                                            </a>
                                                            <input type="text" name="banner[alt_text]" class="field"
                                                                placeholder="Enter alt text" value="Feature Image">
                                                        </div>
                                                    </div>
                                                    <div data-error-message class="text-danger mt-2 d-none text-center">
                                                        Please
                                                        upload a
                                                        valid image file
                                                    </div>
                                                    @error('banner[featured_image]')
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
                                                <input type="url" name="banner[yt_link]" class="field"
                                                    value="{{ old('banner[yt_link]') }}">
                                                @error('banner[yt_link]')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-fields">
                                                <div class="multiple-upload" data-upload-multiple>
                                                    <input type="file" class="gallery-input d-none" multiple
                                                        data-upload-multiple-input accept="image/*" id="banners"
                                                        name="banners[]">
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
                                        <div class="col-md-12 mt-5">
                                            <div class="plan-itenirary">
                                                <div class="form-fields">
                                                    <label class="d-flex align-items-center mb-3 justify-content-between">
                                                        <label class="d-flex align-items-center gap-3">
                                                            <span class="title title--sm mb-0">Plan Itinerary
                                                                Experience:</span>
                                                                <div class="form-check form-switch" data-enabled-text="Enabled" data-disabled-text="Disabled">
                                                                    <input class="form-check-input" data-toggle-switch checked type="checkbox"
                                                                        id="enable-section" checked>
                                                                    <label class="form-check-label"
                                                                        for="enable-section">Enabled</label>
                                                                </div>
                                                        </label>
                                                        <span class="title d-flex align-items-center gap-1">
                                                            Section Preview:
                                                            <a href="{{ asset('admin/assets/images/itinerary-exp.png') }}"
                                                                data-fancybox="gallery" class="themeBtn p-1"><i
                                                                    class='bx  bxs-show'></i></a>
                                                        </span>
                                                    </label>

                                                </div>
                                                <div class="form-fields">
                                                    <div class="title d-flex align-items-center gap-2">
                                                        <div>Map Iframe Link<span class="text-danger p-0">*</span>:</div>
                                                        <a class="p-0 nav-link" href="https://www.google.com/maps/d/"
                                                            target="_blank">Google Map Generator</a>
                                                    </div>
                                                    <input type="url" name="itinerary_experience_iframe"
                                                        class="field" value="{{ old('itinerary_experience_iframe') }}">
                                                    @error('itinerary_experience_iframe')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="row mt-4">
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-fields">
                                                            <label class="title">Pickup locations:</label>
                                                            <input class="choice-select" name="itinerary[pickup_location]"
                                                                placeholder="Pickup Location Title">
                                                            @error('itinerary_experience_pickups')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-fields">
                                                            <label class="title">Dropoff locations:</label>
                                                            <input class="choice-select"
                                                                name="itinerary[dropoff_location]"
                                                                placeholder="Dropoff Location Title">
                                                            @error('itinerary_experience_dropoff')
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
                                                        name="itinerary[enable_sub_stops]"
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
                                                                            name="itinerary[stops][sub_stops][main_stop][]"
                                                                            class="field">
                                                                            <option value="" selected disabled>Select
                                                                            </option>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <input name="itinerary[stops][sub_stops][title][]"
                                                                            type="text" class="field"
                                                                            placeholder="Title">
                                                                        <br>
                                                                        <div class="mt-3">
                                                                            <input
                                                                                name="itinerary[stops][sub_stops][activities][]"
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
                        </div>
                        <div x-show="optionTab === 'location'" class="location-options">
                            <div class="form-box">
                                <div class="form-box__header">
                                    <div class="title">Tour Locations</div>
                                </div>
                                <div class="form-box__body">
                                    <div class="form-fields">
                                        <label class="title">Location <span class="text-danger">*</span> :</label>
                                        <select name="location[city_ids[]]" class="choice-select" data-required
                                            data-error="Location" multiple placeholder="Select Locations">
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
                                        <input type="text" name="location[address]" class="field"
                                            value="{{ old('location[address]') }}" data-required
                                            data-error="Real Tour address">
                                        @error('location[address]')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div x-show="optionTab === 'pricing'" class="pricing-options">
                            <div class="form-box" x-data="{ tourType: 'normal' }">
                                <div class="form-box__header d-flex align-items-center justify-content-between">
                                    <div class="title">Pricing</div>
                                    <div class="d-flex align-items-center gap-5">
                                        <div class="form-check p-0">
                                            <input class="form-check-input" type="radio" name="tour_type"
                                                id="normal" x-model="tourType" value="normal" checked>
                                            <label class="form-check-label" for="normal">Normal Tour</label>
                                        </div>
                                        <div class="form-check p-0">
                                            <input class="form-check-input" type="radio" name="tour_type"
                                                id="private" x-model="tourType" value="private">
                                            <label class="form-check-label" for="private">Private Tour</label>
                                        </div>
                                        <div class="form-check p-0">
                                            <input class="form-check-input" type="radio" name="tour_type"
                                                id="water" x-model="tourType" value="water">
                                            <label class="form-check-label" for="water">Water / Desert
                                                Activities</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-box__body">
                                    <div x-show="tourType === 'normal'">
                                        <div class="form-fields mb-4">
                                            <div class="title title--sm">Normal Tour Pricing:</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-12 mb-3">
                                                <div class="form-fields">
                                                    <label class="title">Child Price <span
                                                            class="text-danger">*</span>:</label>
                                                    <input step="0.01" min="0" type="number"
                                                        name="normal_child_price" class="field"
                                                        value="{{ old('normal_child_price') }}"
                                                        x-bind:data-required="tourType === 'normal'"
                                                        data-error="Child Price">
                                                    @error('normal_child_price')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12 mb-3">
                                                <div class="form-fields">
                                                    <label class="title">Adult Price <span
                                                            class="text-danger">*</span>:</label>
                                                    <input step="0.01" min="0" type="number"
                                                        name="normal_adult_price" class="field"
                                                        value="{{ old('normal_adult_price') }}"
                                                        x-bind:data-required="tourType === 'normal'"
                                                        data-error="Adult Price">
                                                    @error('normal_adult_price')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12 mb-3">
                                                <div class="form-fields">
                                                    <label class="title">Minimum Quantity <span
                                                            class="text-danger">*</span>:</label>
                                                    <input type="number" name="normal_min_qty" class="field"
                                                        value="{{ old('normal_min_qty') }}"
                                                        x-bind:data-required="tourType === 'normal'"
                                                        data-error="Minimum Quantity" min="1">
                                                    @error('normal_min_qty')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12 mb-3">
                                                <div class="form-fields">
                                                    <label class="title">Maximum Quantity <span
                                                            class="text-danger">*</span>:</label>
                                                    <input type="number" name="normal_max_qty" class="field"
                                                        value="{{ old('normal_max_qty') }}"
                                                        x-bind:data-required="tourType === 'normal'"
                                                        data-error="Maximum Quantity" min="1">
                                                    @error('normal_max_qty')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div x-show="tourType === 'private'">
                                        <div class="form-fields mb-4">
                                            <div class="title title--sm">Private Tour Pricing:</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 col-12 mb-3">
                                                <div class="form-fields">
                                                    <label class="title">Car Price <span
                                                            class="text-danger">*</span>:</label>
                                                    <input step="0.01" min="0" type="number"
                                                        name="private_car_price" class="field"
                                                        value="{{ old('private_car_price') }}"
                                                        x-bind:data-required="tourType === 'private'"
                                                        data-error="Car Price">
                                                    @error('private_car_price')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12 mb-3">
                                                <div class="form-fields">
                                                    <label class="title">Minimum Pax <span
                                                            class="text-danger">*</span>:</label>
                                                    <input type="number" name="private_min_qty" class="field"
                                                        value="{{ old('private_min_qty') }}"
                                                        x-bind:data-required="tourType === 'private'"
                                                        data-error="Car Minimum Pax" min="1">
                                                    @error('private_min_qty')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12 mb-3">
                                                <div class="form-fields">
                                                    <label class="title">Maximum Pax <span
                                                            class="text-danger">*</span>:</label>
                                                    <input type="number" name="private_max_qty" class="field"
                                                        value="{{ old('private_max_qty') }}"
                                                        x-bind:data-required="tourType === 'private'"
                                                        data-error="Car Maximum Pax" min="1">
                                                    @error('private_max_qty')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div x-show="tourType === 'water'">
                                        <div class="form-fields mb-4">
                                            <div class="title title--sm">Water / Desert Activities Pricing:</div>
                                        </div>
                                        <div class="form-fields">
                                            <div class="repeater-table" data-repeater>
                                                <label class="title">Enter Prices <span
                                                        class="text-danger">*</span>:</label>
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Time</th>
                                                            <th scope="col">Price</th>
                                                            <th class="text-end" scope="col">Remove</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody data-repeater-list>
                                                        <tr data-repeater-item>
                                                            <td>
                                                                <select id="time-dropdown" name="water_times[]"
                                                                    class="field"
                                                                    x-bind:data-required="tourType === 'water'"
                                                                    data-error="Desert Activities Time"></select>
                                                            </td>
                                                            <td>
                                                                <input name="water_prices[]" type="number"
                                                                    class="field" placeholder="Price" step="0.01"
                                                                    min="0"
                                                                    x-bind:data-required="tourType === 'water'"
                                                                    data-error="Desert Activities Price">
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
                                                <button type="button" class="themeBtn ms-auto" data-repeater-create>Add
                                                    <i class="bx bx-plus"></i></button>
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
                                                            <input type="file" name="featured_image" data-required
                                                                data-error="Feature Image" id="featured_image"
                                                                class="upload-box__file d-none" accept="image/*"
                                                                data-file-input>
                                                            <div class="upload-box__placeholder"><i
                                                                    class='bx bxs-image'></i>
                                                            </div>
                                                            <label for="featured_image"
                                                                class="upload-box__btn themeBtn">Upload
                                                                Image</label>
                                                        </div>
                                                        <div class="upload-box__img" data-upload-img>
                                                            <button type="button" class="delete-btn" data-delete-btn><i
                                                                    class='bx bxs-trash-alt'></i></button>
                                                            <a href="#" class="mask" data-fancybox="gallery">
                                                                <img src="{{ asset('admin/assets/images/loading.webp') }}"
                                                                    alt="Uploaded Image" class="imgFluid"
                                                                    data-upload-preview>
                                                            </a>
                                                            <input type="text" name="feature_image_alt_text"
                                                                class="field" placeholder="Enter alt text"
                                                                value="Feature Image">
                                                        </div>
                                                    </div>
                                                    <div data-error-message class="text-danger mt-2 d-none text-center">
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
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css">
@endpush
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js"></script>
    <script src="{{ asset('admin/assets/js/add-tour.js') }}"></script>
@endpush
