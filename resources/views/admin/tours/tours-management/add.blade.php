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
                        <div class="form-box">
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
                                        <div class="col-12  mt-4">
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
                                        <div class="col-md-12 mt-4">
                                            <div class="form-fields">
                                                <label class=" d-flex align-items-center mb-3 justify-content-between"><span
                                                    class="title title--sm mb-0">Tour Information:</span>
                                                <span class="title d-flex align-items-center gap-1">Section
                                                    Preview:
                                                    <a href="{{ asset('admin/assets/images/tour-infomation.png') }}"
                                                        data-fancybox="gallery" class="themeBtn p-1"><i
                                                            class='bx  bxs-show'></i></a>
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
                                                                    <input name="tour_information[heading][]" type="text" placeholder="e.g., Timings, What to Bring"
                                                                        class="field">
                                                                </td>
                                                                <td>
                                                                    <div class="repeater-table" data-sub-repeater>
                                                                        <table class="table table-bordered">
                                                                            <tbody data-sub-repeater-list>
                                                                                <tr data-sub-repeater-item>
                                                                                    <td>
                                                                                        <input name="tour_information[items][][]" type="text" placeholder=""
                                                                                            class="field">
                                                                                    </td>
                                                                                    <td>
                                                                                        <button type="button"
                                                                                            class="delete-btn ms-auto delete-btn--static"
                                                                                            data-sub-repeater-remove>
                                                                                            <i class='bx bxs-trash-alt'></i>
                                                                                        </button>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                        <button type="button" class="themeBtn ms-auto" data-sub-repeater-create>
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
                                                    <button type="button" class="themeBtn ms-auto" data-repeater-create>
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
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div x-show="optionTab === 'location'" class="location-options">
                            <div class="form-box" x-data="{ locationType: 'normalLocation' }">
                                <div class="form-box__header d-flex align-items-center justify-content-between">
                                    <div class="title">Tour Locations</div>
                                    <div class="d-flex align-items-center gap-5">
                                        <div class="form-check p-0">
                                            <input class="form-check-input" type="radio" name="location_type"
                                                id="normalLocation" x-model="locationType" value="normalLocation"
                                                checked="">
                                            <label class="form-check-label" for="normalLocation">Location</label>
                                        </div>
                                        <div class="form-check p-0">
                                            <input class="form-check-input" type="radio" name="location_type"
                                                id="normalItinerary" x-model="locationType" value="normalItinerary">
                                            <label class="form-check-label" for="normalItinerary">Normal Itinerary</label>
                                        </div>
                                        <div class="form-check p-0">
                                            <input class="form-check-input" type="radio" name="location_type"
                                                id="itineraryExperience" x-model="locationType"
                                                value="itineraryExperience">
                                            <label class="form-check-label" for="itineraryExperience">Plan Itinerary
                                                Experience</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-box__body">
                                    <div x-show="locationType === 'normalLocation'">
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
                                    <div x-show="locationType === 'normalItinerary'">
                                        <div class="form-fields">
                                            <label class=" d-flex align-items-center mb-3 justify-content-between"><span
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
                                                                                    alt="Uploaded Image" class="imgFluid"
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
                                                <button type="button" class="themeBtn ms-auto" data-repeater-create>Add
                                                    <i class="bx bx-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div x-show="locationType === 'itineraryExperience'">
                                        <div class="plan-itenirary">
                                            <div class="form-fields">
                                                <label class="d-flex align-items-center mb-3 justify-content-between">
                                                    <span class="title title--sm mb-0">Plan Itinerary
                                                        Experience:</span>
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
                                                <input type="url" name="itinerary_experience_iframe" class="field"
                                                    value="{{ old('itinerary_experience_iframe') }}">
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
                                                        <input class="choice-select" name="itinerary[dropoff_location]"
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
                                                <div class="dropdown bootsrap-dropdown mt-4 d-flex justify-content-end">
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
                                                                    <select name="itinerary[stops][sub_stops][main_stop][]"
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
                        <div x-show="optionTab === 'pricing'" class="pricing-options">
                            <div class="form-box" x-data="{ tourType: 'normal' }">
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
                                                <label class="title">Price <span class="text-danger">*</span>:</label>
                                                <input step="0.01" min="0" type="number" name="regular_price"
                                                    class="field" value="{{ old('regular_price') }}" data-required
                                                    data-error="Price">
                                                @error('regular_price')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-fields">
                                                <label class="title">Sale Price <span
                                                        class="text-danger">*</span>:</label>
                                                <input step="0.01" min="0" type="number" name="sale_price"
                                                    class="field" value="{{ old('sale_price') }}" data-required
                                                    data-error="Sale Price">
                                                @error('sale_price')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 my-3">
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
                                                                name="enebled_person_types" id="enebled_person_types"
                                                                value="1" x-model="personType">
                                                            <label class="form-check-label" for="enebled_person_types">
                                                                Enable Person Types
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12" x-show="personType == 1">
                                                    <div x-data="{ tourType: 'normal' }">
                                                        <div class="d-flex align-items-center justify-content-center gap-5 mt-3 mb-4">
                                                            <div class="form-check p-0">
                                                                <input class="form-check-input" type="radio" name="tour_type"
                                                                    id="normal" x-model="tourType" value="normal" checked>
                                                                <label class="form-check-label" for="normal">Normal Tour Price</label>
                                                            </div>
                                                            <div class="form-check p-0">
                                                                <input class="form-check-input" type="radio" name="tour_type"
                                                                    id="private" x-model="tourType" value="private">
                                                                <label class="form-check-label" for="private">Private Tour Price</label>
                                                            </div>
                                                            <div class="form-check p-0">
                                                                <input class="form-check-input" type="radio" name="tour_type"
                                                                    id="water" x-model="tourType" value="water">
                                                                <label class="form-check-label" for="water">Water / Desert
                                                                    Activities</label>
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
                                                                                        name="person_type[title][]"
                                                                                        class="field"
                                                                                        placeholder="Eg: Adult">
                                                                                    <br>
                                                                                    <div class="mt-3">
                                                                                        <input type="text"
                                                                                            name="person_type[description][]"
                                                                                            class="field"
                                                                                            placeholder="Description">
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <input type="number" min="0"
                                                                                        name="person_type[min][]"
                                                                                        class="field">
                                                                                </td>
                                                                                <td>
                                                                                    <input type="number" min="0"
                                                                                        name="person_type[max][]"
                                                                                        class="field">
                                                                                </td>
                                                                                <td>
                                                                                    <input type="number" step="0.01"
                                                                                        min="0"
                                                                                        name="person_type[price][]"
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
                                                                                    <input type="number" step="0.01"
                                                                                        min="0"
                                                                                        name="person_type[price][]"
                                                                                        class="field">
                                                                                </td>
                                                                                <td>
                                                                                    <input type="number" min="0"
                                                                                        name="person_type[min][]"
                                                                                        class="field">
                                                                                </td>
                                                                                <td>
                                                                                    <input type="number" min="0"
                                                                                        name="person_type[max][]"
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
                                                                                <th class="text-end" scope="col">Remove
                                                                                </th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody data-repeater-list>
                                                                            <tr data-repeater-item>
                                                                                <td>
                                                                                    <select id="time-dropdown"
                                                                                        name="water_times[]"
                                                                                        class="field"
                                                                                        x-bind:data-required="tourType === 'water'"
                                                                                        data-error="Desert Activities Time"></select>
                                                                                </td>
                                                                                <td>
                                                                                    <input name="water_prices[]"
                                                                                        type="number" class="field"
                                                                                        placeholder="Price" step="0.01"
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
                                        <div class="col-12 my-3">
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
                                                                name="enebled_extra_price" id="enebled_extra_price"
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
                                                                                <th scope="col">
                                                                                    Name
                                                                                </th>
                                                                                <th scope="col">Price</th>
                                                                                <th scope="col">Type</th>
                                                                                <th></th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody data-repeater-list>
                                                                            <tr data-repeater-item>
                                                                                <td>
                                                                                    <input type="text"
                                                                                        name="extra_price[name][]"
                                                                                        class="field"
                                                                                        placeholder="Extra Price Name">
                                                                                </td>
                                                                                <td>
                                                                                    <input type="number" step="0.01"
                                                                                        min="0"
                                                                                        name="extra_price[price][]"
                                                                                        class="field">
                                                                                </td>
                                                                                <td>
                                                                                    <select class="field"
                                                                                        name="extra_price[type][]">
                                                                                        <option value="one-time">One-time
                                                                                        </option>
                                                                                        <option value="per-hour">Per Hour
                                                                                        </option>
                                                                                        <option value="per-day">Per day
                                                                                        </option>
                                                                                    </select>
                                                                                    <br>
                                                                                    <div class="form-check mt-3">
                                                                                        <input class="form-check-input"
                                                                                            type="checkbox"
                                                                                            name="extra_price[is_per_person]]"
                                                                                            id="is_per_person"
                                                                                            value="1">
                                                                                        <label class="form-check-label"
                                                                                            for="is_per_person">
                                                                                            Price per person
                                                                                        </label>
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
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 my-3">
                                            <hr>
                                        </div>
                                        <div class="col-12 my-3">
                                            <div class="row">
                                                <div class="col-12 mb-2">
                                                    <div class="form-fields">
                                                        <div class="title title--sm mb-0">Service fee:</div>
                                                    </div>
                                                    <div class="form-fields">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="enebled_service_fee" id="enebled_service_fee"
                                                                value="1">
                                                            <label class="form-check-label" for="enebled_service_fee">
                                                                Enable service fee
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-fields mb-4">
                                                <div class="d-flex align-items-center gap-3 mb-2">
                                                    <span class="title mb-0">Whatsapp Number:</span>
                                                    <div class="form-check form-switch" data-enabled-text="Enabled"
                                                        data-disabled-text="Disabled">
                                                        <input class="form-check-input" data-toggle-switch checked
                                                            type="checkbox" id="enable-section" checked value="1"
                                                            name="show_phone">
                                                        <label class="form-check-label"
                                                            for="enable-section">Enabled</label>
                                                    </div>
                                                </div>
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
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-fields">
                                                <label class="title">Start Date <span class="text-danger">*</span>
                                                    :</label>
                                                <input type="text" class="field date-picker"
                                                    placeholder="Select a date" name="start_date">
                                                @error('start_date')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-fields">
                                                <label class="title">End Date <span class="text-danger">*</span>
                                                    :</label>
                                                <input type="text" class="field date-picker"
                                                    placeholder="Select a date" name="end_date">
                                                @error('end_date')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-fields">
                                                <label class="title">Last Booking Date <span class="text-danger">*</span>
                                                    :</label>
                                                <input type="text" class="field date-picker"
                                                    placeholder="Select a date" name="last_booking_date">
                                                @error('last_booking_date')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script src="{{ asset('admin/assets/js/add-tour.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.date-picker').each(function() {
                $(this).flatpickr({
                    dateFormat: "Y-m-d",
                    altInput: true,
                    altFormat: "F j, Y",
                    minDate: "today",
                    disableMobile: true
                });
            });
        });
    </script>
@endpush
