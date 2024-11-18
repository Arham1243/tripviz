@php
    $sectionContent = $pageSection
        ? json_decode($pageSection->content)
        : (object) [
            'title' => null,
            'subtitle' => null,
            'btn_text' => null,
            'btn_link' => null,
            'alt_text' => null,
            'review_type' => null,
            'right_image' => null,
            'custom_review_logo_image' => null,
        ];

@endphp

<div class="row">
    <div class="col-lg-12 mb-3">
        <div class="form-fields">
            <label class="title">Title<span class="text-danger">*</span> :</label>
            <input type="text" name="content[title]" class="field" value="{{ $sectionContent->title ?? '' }}"
                placeholder="" data-error="Title" maxlength="35">
        </div>
    </div>
    <div class="col-lg-12 mb-3">
        <div class="form-fields">
            <label class="title">Sub Title<span class="text-danger">*</span> :</label>
            @php
                $subtitles = $sectionContent->subtitle ?? [''];
            @endphp
            <div x-data="repeater({{ json_encode($subtitles) }}, 2)" class="repeater-table">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Sub Title</th>
                            <th class="text-end" scope="col">Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="(item, index) in items" :key="index">
                            <tr>
                                <td>
                                    <input type="text" class="field" name="content[subtitle][]"
                                        x-model="item.subTitle" :maxlength="index === 0 ? 24 : 55" />
                                </td>
                                <td>
                                    <button :disabled="index === 0" class="delete-btn delete-btn--static ms-auto"
                                        @click="remove(index)">
                                        <i class="bx bxs-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
                <button type="button" x-show="items.length < maxItems" type="button" class="themeBtn ms-auto"
                    @click="addItem">
                    Add Second Line<i class="bx bx-plus"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="col-lg-12 pt-4 pb-3">
        <div class="form-fields">
            <div class="d-flex align-items-center gap-3 mb-3">
                <label class="title title--sm mb-0">Call to Action Button:</label>
                <div class="form-check form-switch" data-enabled-text="Enabled" data-disabled-text="Disabled">
                    <input class="form-check-input" data-toggle-switch=""
                        {{ isset($sectionContent->is_button_enabled) ? 'checked' : '' }} type="checkbox"
                        id="cta_btn_enabled" value="1" name="content[is_button_enabled]">
                    <label class="form-check-label" for="cta_btn_enabled">Enabled</label>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 mb-3">
                    <div class="form-fields">
                        <label class="title">Button Text <span class="text-danger">*</span> :</label>
                        <input type="text" value="{{ $sectionContent->btn_text ?? '' }}" name="content[btn_text]"
                            class="field" placeholder="" data-error="Button Text" maxlength="40">
                    </div>
                </div>
                <div class="col-lg-6 mb-3">
                    <div class="form-fields">
                        <label class="title">Button Link <span class="text-danger">*</span> :</label>
                        <input type="text" value="{{ $sectionContent->btn_link ?? '' }}" name="content[btn_link]"
                            class="field" placeholder="" data-error="Button Link">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-fields">
                        <div class="title d-flex align-items-center gap-2">
                            <div>
                                Select Button Background Color <span class="text-danger">*</span>:
                            </div>
                            <a class="p-0 nav-link" href="//html-color-codes.info" target="_blank">Get Color
                                Codes</a>
                        </div>
                        <div class="field color-picker" data-color-picker-container>
                            <label for="color-picker" data-color-picker></label>
                            <input id="color-picker" type="text" name="content[btn_background_color]"
                                data-color-picker-input value="{{ $sectionContent->btn_background_color ?? '#ffffff' }}"
                                placeholder="#000000" data-error="background Color" inputmode="text" />
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-fields">
                        <div class="title d-flex align-items-center gap-2">
                            <div>
                                Select Button Text Color <span class="text-danger">*</span>:
                            </div>
                            <a class="p-0 nav-link" href="//html-color-codes.info" target="_blank">Get Color
                                Codes</a>
                        </div>
                        <div class="field color-picker" data-color-picker-container>
                            <label for="color-picker" data-color-picker></label>
                            <input id="color-picker" type="text" name="content[btn_text_color]"
                                data-color-picker-input value="{{ $sectionContent->btn_text_color ?? '#1c4d99' }}"
                                placeholder="#000000" data-error="background Color" inputmode="text" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <hr>
    </div>
    <div class="col-lg-12 pt-3 pb-2">
        <div class="form-fields">
            <div class="d-flex align-items-center gap-3 mb-3">
                <label class="title title--sm mb-0">Form Search Service:</label>
                <div class="form-check form-switch" data-enabled-text="Enabled" data-disabled-text="Disabled">
                    <input class="form-check-input" data-toggle-switch=""
                        {{ isset($sectionContent->is_form_enabled) ? 'checked' : '' }} type="checkbox"
                        id="enable-section-form" value="1" name="content[is_form_enabled]">
                    <label class="form-check-label" for="enable-section-form">Enabled</label>
                </div>
            </div>
            <div class="d-flex align-items-center gap-5 px-4 mb-1">
                <div class="form-check p-0">
                    <input class="form-check-input" type="radio" name="content[form_type]" id="normal-form"
                        name="content[form_type]" value="normal"
                        {{ $sectionContent ? ($sectionContent->form_type === 'normal' ? 'checked' : '') : '' }} />
                    <label class="form-check-label" for="normal-form">Normal Search bar</label>
                </div>
                <div class="form-check p-0">
                    <input class="form-check-input" type="radio" name="content[form_type]" id="date_selection"
                        name="content[form_type]"
                        {{ $sectionContent ? ($sectionContent->form_type === 'date_selection' ? 'checked' : '') : '' }}
                        value="date_selection" />
                    <label class="form-check-label" for="date_selection">Search Bar with Tour Date Selection</label>
                </div>
            </div>

        </div>
    </div>
    <div class="col-12">
        <hr>
    </div>
    <div class="col-lg-12 pt-3 pb-2">
        <div class="form-fields">
            <div class="d-flex align-items-center gap-3 mb-3">
                <label class="title title--sm mb-0">Review:</label>
                <div class="form-check form-switch" data-enabled-text="Enabled" data-disabled-text="Disabled">
                    <input class="form-check-input" data-toggle-switch=""
                        {{ isset($sectionContent->is_review_enabled) ? 'checked' : '' }} type="checkbox"
                        id="enable-section" value="1" name="content[is_review_enabled]">
                    <label class="form-check-label" for="enable-section">Enabled</label>
                </div>
            </div>
            <div x-data="{ review_type: '{{ isset($sectionContent->review_type) ? $sectionContent->review_type : 'google' }}' }">
                <div class="d-flex align-items-center gap-5 px-4 mb-3">
                    <div class="form-check p-0">
                        <input class="form-check-input" type="radio" name="content[review_type]" id="google"
                            x-model="review_type" name="content[review_type]" value="google" checked>
                        <label class="form-check-label" for="google">Google</label>
                    </div>
                    <div class="form-check p-0">
                        <input class="form-check-input" type="radio" name="content[review_type]" id="trustpilot"
                            x-model="review_type" name="content[review_type]" value="trustpilot">
                        <label class="form-check-label" for="trustpilot">Trustpilot</label>
                    </div>
                    <div class="form-check p-0">
                        <input class="form-check-input" type="radio" name="content[review_type]" id="tripadvisor"
                            x-model="review_type" name="content[review_type]" value="tripadvisor">
                        <label class="form-check-label" for="tripadvisor">Tripadvisor</label>
                    </div>
                    <div class="form-check p-0">
                        <input class="form-check-input" type="radio" name="content[review_type]" id="custom"
                            x-model="review_type" name="content[review_type]" value="custom">
                        <label class="form-check-label" for="custom">Customize </label>
                    </div>
                </div>
                <div class="py-3" x-show="review_type === 'google'">
                    <div class="form-fields">
                        <label class="title">Google Link <span class="text-danger">*</span> :</label>
                        <input type="text" name="content[review_google_link]" class="field" placeholder=""
                            data-error="Google Review Link" value="{{ $sectionContent->review_google_link ?? '' }}">
                    </div>
                </div>
                <div class="py-3" x-show="review_type === 'trustpilot'">
                    <div class="form-fields">
                        <label class="title">Trustpilot Link <span class="text-danger">*</span> :</label>
                        <input type="text" name="content[review_trustpilot_link]" class="field" placeholder=""
                            data-error="Trustpilot Review Link"
                            value="{{ $sectionContent->review_trustpilot_link ?? '' }}">
                    </div>
                </div>
                <div class="py-3" x-show="review_type === 'tripadvisor'">
                    <div class="form-fields">
                        <label class="title">Tripadvisor Link <span class="text-danger">*</span> :</label>
                        <input type="text" name="content[review_tripadvisor_link]" class="field" placeholder=""
                            data-error="Tripadvisor Review Link"
                            value="{{ $sectionContent->review_tripadvisor_link ?? '' }}">
                    </div>
                </div>
                <div class="py-3" x-show="review_type === 'custom'">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="form-fields">
                                <label class="title">Link <span class="text-danger">*</span> :</label>
                                <input type="text" name="content[custom_review_link]" class="field"
                                    placeholder="" data-error="Review Link"
                                    value="{{ $sectionContent->custom_review_link ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="form-fields">
                                <label class="title">Total no. of Reviews <span class="text-danger">*</span>
                                    :</label>
                                <input type="number" name="content[custom_review_count]" class="field"
                                    placeholder="" data-error="Review Link"
                                    value="{{ $sectionContent->custom_review_count ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-fields">
                                <label class="title">Logo<span class="text-danger">*</span> :</label>
                                <div class="upload upload--sm" data-upload="">
                                    <div class="upload-box-wrapper">
                                        <div class="upload-box {{ empty($sectionContent->custom_review_logo_image) ? 'show' : '' }}"
                                            data-upload-box="">

                                            <div class="upload-box__placeholder"><i class="bx bxs-image"></i>
                                            </div>
                                            <label for="custom_review_logo_image"
                                                class="upload-box__btn themeBtn">Upload
                                                Image</label>
                                            <input type="file" data-error="Image Review Logo"
                                                {{ empty($sectionContent->custom_review_logo_image) ? '' : '' }}
                                                name="content[custom_review_logo_image]" id="custom_review_logo_image"
                                                class="upload-box__file d-none" accept="image/*" data-file-input="">
                                        </div>
                                        <div class="upload-box__img {{ !empty($sectionContent->custom_review_logo_image) ? 'show' : '' }}"
                                            data-upload-img="">
                                            <button type="button" class="delete-btn" data-delete-btn=""><i
                                                    class='bx bxs-edit-alt'></i></button>
                                            <a href="{{ asset($sectionContent->custom_review_logo_image ?? 'admin/assets/images/loading.webp') }}"
                                                class="mask" data-fancybox="gallery">
                                                <img src="{{ asset($sectionContent->custom_review_logo_image ?? 'admin/assets/images/loading.webp') }}"
                                                    alt="Uploaded Image" class="imgFluid"
                                                    data-placeholder="{{ asset('admin/assets/images/loading.webp') }}"
                                                    data-upload-preview="">
                                            </a>
                                            <input type="text" name="content[custom_review_logo_alt_text]"
                                                class="field" placeholder="Enter alt text"
                                                value="{{ $sectionContent->custom_review_logo_alt_text ?? 'Review Logo' }}">
                                        </div>
                                    </div>
                                    <div data-error-message="" class="text-danger mt-2 d-none text-center">
                                        Please
                                        upload a
                                        valid image file
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="col-12">
        <hr>
    </div>
    <div class="col-lg-12 pt-3 pb-2">
        <div class="form-fields">
            <label class="title title--sm mb-3">Background Style:</label>
            <div x-data="{ background_type: '{{ isset($sectionContent->background_type) ? $sectionContent->background_type : 'normal_v1_right_side_image' }}' }">
                <div class="d-flex align-items-center gap-5 px-4 mb-3">
                    <div class="form-check p-0">
                        <input class="form-check-input" type="radio" name="content[background_type]"
                            id="normal_v1_right_side_image" x-model="background_type" name="content[background_type]"
                            value="normal_v1_right_side_image" checked>
                        <label class="form-check-label" for="normal_v1_right_side_image">Right Side
                            Image</label>
                    </div>
                    <div class="form-check p-0">
                        <input class="form-check-input" type="radio" name="content[background_type]"
                            id="normal_v2_full_screen_background" x-model="background_type"
                            name="content[background_type]" value="normal_v2_full_screen_background">
                        <label class="form-check-label" for="normal_v2_full_screen_background">Full-Screen
                            Background</label>
                    </div>
                    <div class="form-check p-0">
                        <input class="form-check-input" type="radio" name="content[background_type]"
                            id="slider_carousel" x-model="background_type" name="content[background_type]"
                            value="slider_carousel">
                        <label class="form-check-label" for="slider_carousel">Slider Carousel</label>
                    </div>
                    <div class="form-check p-0">
                        <input class="form-check-input" type="radio" name="content[background_type]"
                            id="layout_normal_background_color" x-model="background_type"
                            name="content[background_type]" value="layout_normal_background_color">
                        <label class="form-check-label" for="layout_normal_background_color">Background
                            Color</label>
                    </div>
                </div>
                <div class="py-3" x-show="background_type === 'normal_v1_right_side_image'">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-fields">
                                <label class="title">Right Side Image <span class="text-danger">*</span>
                                    :</label>
                                <div class="upload upload--sm mx-0" data-upload>
                                    <div class="upload-box-wrapper">
                                        <div class="upload-box {{ empty($sectionContent->right_image) ? 'show' : '' }}"
                                            data-upload-box>
                                            <input type="file" name="content[right_image]"
                                                {{ empty($sectionContent->right_image) ? '' : '' }}
                                                data-error="Feature Image" id="right_image"
                                                class="upload-box__file d-none" accept="image/*" data-file-input>
                                            <div class="upload-box__placeholder"><i class='bx bxs-image'></i>
                                            </div>
                                            <label for="right_image" class="upload-box__btn themeBtn">Upload
                                                Image</label>
                                        </div>
                                        <div class="upload-box__img {{ !empty($sectionContent->right_image) ? 'show' : '' }}"
                                            data-upload-img>
                                            <button type="button" class="delete-btn" data-delete-btn=""><i
                                                    class='bx bxs-edit-alt'></i></button>
                                            <a href="{{ asset($sectionContent->right_image ?? 'admin/assets/images/loading.webp') }}"
                                                class="mask" data-fancybox="gallery">
                                                <img src="{{ asset($sectionContent->right_image ?? 'admin/assets/images/loading.webp') }}"
                                                    alt="Uploaded Image" class="imgFluid"
                                                    data-placeholder="{{ asset('admin/assets/images/loading.webp') }}"
                                                    data-upload-preview="">
                                            </a>
                                            <input type="text" name="content[right_image_alt_text]" class="field"
                                                placeholder="Enter alt text"
                                                value="{{ $sectionContent->right_image_alt_text ?? 'Banner Right Image' }}">
                                        </div>
                                    </div>
                                    <div data-error-message class="text-danger mt-2 d-none text-center">Please
                                        upload a
                                        valid image file
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="py-3" x-show="background_type === 'normal_v2_full_screen_background'">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-fields">
                                <label class="title">Background Image <span class="text-danger">*</span>
                                    :</label>
                                <div class="upload upload--sm mx-0" data-upload>
                                    <div class="upload-box-wrapper">
                                        <div class="upload-box {{ empty($sectionContent->background_image) ? 'show' : '' }}"
                                            data-upload-box>
                                            <input type="file" name="content[background_image]"
                                                {{ empty($sectionContent->background_image) ? '' : '' }}
                                                data-error="Feature Image" id="background_image"
                                                class="upload-box__file d-none" accept="image/*" data-file-input>
                                            <div class="upload-box__placeholder"><i class='bx bxs-image'></i>
                                            </div>
                                            <label for="background_image" class="upload-box__btn themeBtn">Upload
                                                Image</label>
                                        </div>
                                        <div class="upload-box__img {{ !empty($sectionContent->background_image) ? 'show' : '' }}"
                                            data-upload-img>
                                            <button type="button" class="delete-btn" data-delete-btn=""><i
                                                    class='bx bxs-edit-alt'></i></button>
                                            <a href="{{ asset($sectionContent->background_image ?? 'admin/assets/images/loading.webp') }}"
                                                class="mask" data-fancybox="gallery">
                                                <img src="{{ asset($sectionContent->background_image ?? 'admin/assets/images/loading.webp') }}"
                                                    alt="Uploaded Image" class="imgFluid"
                                                    data-placeholder="{{ asset('admin/assets/images/loading.webp') }}"
                                                    data-upload-preview="">
                                            </a>
                                            <input type="text" name="content[background_alt_text]" class="field"
                                                placeholder="Enter alt text"
                                                value="{{ $sectionContent->background_alt_text ?? 'Banner Image' }}">
                                        </div>
                                    </div>
                                    <div data-error-message class="text-danger mt-2 d-none text-center">Please
                                        upload a
                                        valid image file
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="py-3" x-show="background_type === 'slider_carousel'">
                    <div class="row">
                        @for ($i = 0; $i < 4; $i++)
                            @php
                                $background_image =
                                    $sectionContent && $sectionContent->carousel_background_images
                                        ? $sectionContent->carousel_background_images[$i]
                                        : null;
                                $alt_text =
                                    $sectionContent && $sectionContent->carousel_alt_text
                                        ? $sectionContent->carousel_alt_text[$i]
                                        : null;
                            @endphp
                            <div class="col-md-3">
                                <div class="form-fields">
                                    <label class="title">Carousel Image {{ $i + 1 }} <span
                                            class="text-danger">*</span> :</label>
                                    <div class="upload upload--sm" data-upload>
                                        <div class="upload-box-wrapper">
                                            <div class="upload-box {{ empty($sectionContent->carousel_background_images) ? 'show' : '' }}"
                                                data-upload-box>
                                                <input type="file" name="content[carousel_background_images][]"
                                                    {{ empty($sectionContent->carousel_background_images) ? '' : '' }}
                                                    data-error="Carousel Image {{ $i + 1 }}"
                                                    id="background_image_{{ $i }}"
                                                    class="upload-box__file d-none" accept="image/*" data-file-input>
                                                <div class="upload-box__placeholder"><i class='bx bxs-image'></i>
                                                </div>
                                                <label for="background_image_{{ $i }}"
                                                    class="upload-box__btn themeBtn">Upload
                                                    Image</label>
                                            </div>
                                            <div class="upload-box__img {{ !empty($sectionContent->carousel_background_images) ? 'show' : '' }}"
                                                data-upload-img>
                                                <button type="button" class="delete-btn" data-delete-btn=""><i
                                                        class='bx bxs-edit-alt'></i></button>
                                                <a href="{{ asset($background_image ?? 'admin/assets/images/loading.webp') }}"
                                                    class="mask" data-fancybox="gallery">
                                                    <img src="{{ asset($background_image ?? 'admin/assets/images/loading.webp') }}"
                                                        alt="Uploaded Image" class="imgFluid"
                                                        data-placeholder="{{ asset('admin/assets/images/loading.webp') }}"
                                                        data-upload-preview="">
                                                </a>
                                                <input type="text" name="content[carousel_alt_text][]"
                                                    class="field" placeholder="Enter alt text"
                                                    value="{{ $alt_text ?? 'Carousel Image ' . $i + 1 }}">
                                            </div>
                                        </div>
                                        <div data-error-message class="text-danger mt-2 d-none text-center">
                                            Please
                                            upload a valid image file
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
                <div class="py-3" x-show="background_type === 'layout_normal_background_color'">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-fields">
                                <div class="title d-flex align-items-center gap-2">
                                    <div>Select Background Color <span class="text-danger">*</span>:</div>
                                    <a class="p-0 nav-link" href="//html-color-codes.info" target="_blank">Get
                                        Color
                                        Codes</a>
                                </div>

                                <div class="field color-picker" data-color-picker-container>
                                    <label for="color-picker" data-color-picker></label>
                                    <input id="color-picker" type="text" name="content[background_color]"
                                        data-color-picker-input value="{{ $sectionContent->background_color ?? '' }}"
                                        placeholder="#000000" data-error="background Color" inputmode="text">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <hr>
    </div>
    <div class="col-md-12 pt-3 pb-2">
        <div class="row">
            <div class="col-md-12">
                <div class="form-fields">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <label class="title title--sm mb-0">Destinations / Tour Location:</label>
                        <div class="form-check form-switch" data-enabled-text="Enabled"
                            data-disabled-text="Disabled">
                            <input class="form-check-input" data-toggle-switch=""
                                {{ isset($sectionContent->is_destination_enabled) ? 'checked' : '' }} type="checkbox"
                                id="enable-section-destination" value="1"
                                name="content[is_destination_enabled]">
                            <label class="form-check-label" for="enable-section-destination">Enabled</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-3">
                <div class="form-fields">
                    <label class="title">Title<span class="text-danger">*</span> :</label>
                    <input type="text" name="content[destination_title]" class="field" placeholder=""
                        value="{{ $sectionContent->destination_title ?? '' }}" data-error="Destination Title">
                </div>
            </div>
            <div class="col-lg-6 mb-3">
                <div class="form-fields">
                    <label class="title">Sub Title
                        <span class="text-danger">*</span> :</label>
                    <input type="text" name="content[destination_subtitle]" class="field" placeholder=""
                        value="{{ $sectionContent->destination_subtitle ?? '' }}" data-error="Destination Sub Title">
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="form-fields">
                    <div class="title d-flex align-items-center gap-2">
                        <div>Select Background Color <span class="text-danger">*</span>:</div>
                        <a class="p-0 nav-link" href="//html-color-codes.info" target="_blank">Get
                            Color
                            Codes</a>
                    </div>

                    <div class="field color-picker" data-color-picker-container>
                        <label for="color-picker" data-color-picker></label>
                        <input id="color-picker" type="text" name="content[destination_background_color]"
                            data-color-picker-input value="{{ $sectionContent->destination_background_color ?? '' }}"
                            placeholder="#000000" data-error="background Color" inputmode="text">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-fields">
                    <label class="title title--sm mb-2">Items Style:</label>
                    <div x-data="{ destination_style_type: '{{ isset($sectionContent->destination_style_type) ? $sectionContent->destination_style_type : 'normal' }}' }">
                        <div class="d-flex align-items-center gap-5 px-4">
                            <div class="form-check p-0">
                                <input class="form-check-input" type="radio" name="content[destination_style_type]"
                                    id="normal" x-model="destination_style_type"
                                    name="content[destination_style_type]" value="normal" checked />
                                <label class="form-check-label" for="normal">Normal (up to
                                    5)</label>
                            </div>
                            <div class="form-check p-0">
                                <input class="form-check-input" type="radio" name="content[destination_style_type]"
                                    id="carousel" x-model="destination_style_type"
                                    name="content[destination_style_type]" value="carousel" />
                                <label class="form-check-label" for="carousel">Slider Carousel
                                </label>
                            </div>
                        </div>
                        <div class="py-3 mt-2" x-show="destination_style_type === 'normal'">
                            <div class="form-fields">
                                <label class="title title--sm mb-2">Content Type:</label>
                                <div x-data="{ destination_content_type_normal: '{{ isset($sectionContent->destination_content_type_normal) ? $sectionContent->destination_content_type_normal : 'city' }}' }">
                                    <div class="d-flex align-items-center gap-5 px-4 mb-1">
                                        <div class="form-check p-0">
                                            <input class="form-check-input" type="radio"
                                                name="content[destination_content_type_normal]"
                                                id="destination_content_type_normal_2"
                                                x-model="destination_content_type_normal"
                                                name="content[destination_content_type_normal]" value="city" />
                                            <label class="form-check-label"
                                                for="destination_content_type_normal_2">Cities</label>
                                        </div>
                                        <div class="form-check p-0">
                                            <input class="form-check-input" type="radio"
                                                name="content[destination_content_type_normal]"
                                                id="destination_content_type_normal_3"
                                                x-model="destination_content_type_normal"
                                                name="content[destination_content_type_normal]" value="country" />
                                            <label class="form-check-label"
                                                for="destination_content_type_normal_3">Countries</label>
                                        </div>
                                        <div class="form-check p-0">
                                            <input class="form-check-input" type="radio"
                                                name="content[destination_content_type_normal]"
                                                id="destination_content_type_normal_1"
                                                x-model="destination_content_type_normal"
                                                name="content[destination_content_type_normal]" value="tour" />
                                            <label class="form-check-label"
                                                for="destination_content_type_normal_1">Tours</label>
                                        </div>
                                    </div>
                                    <div class="py-3" x-show="destination_content_type_normal === 'tour'">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-fields">
                                                    <label class="title">Select 5 Tours <span
                                                            class="text-danger">*</span> :</label>
                                                    @php
                                                        $normalSelectedToursIds =
                                                            $sectionContent &&
                                                            isset($sectionContent->destination_tour_ids_normal)
                                                                ? $sectionContent->destination_tour_ids_normal
                                                                : [];
                                                    @endphp
                                                    <select name="content[destination_tour_ids_normal][]" multiple
                                                        class="field select2-select" data-max-items="5"
                                                        placeholder="Select Tours" data-error="Tours">
                                                        @foreach ($tours as $item)
                                                            <option value="{{ $item->id }}"
                                                                {{ in_array($item->id, $normalSelectedToursIds) ? 'selected' : '' }}>
                                                                {{ $item->title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="py-3" x-show="destination_content_type_normal === 'city'">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-fields">
                                                    <label class="title">Select 5 Cities <span
                                                            class="text-danger">*</span> :</label>
                                                    @php
                                                        $normalSelectedCityIds =
                                                            $sectionContent &&
                                                            isset($sectionContent->destination_city_ids_normal)
                                                                ? $sectionContent->destination_city_ids_normal
                                                                : [];
                                                    @endphp
                                                    <select name="content[destination_city_ids_normal][]" multiple
                                                        class="field select2-select" data-max-items="5"
                                                        placeholder="Select Cities" data-error="Cities">
                                                        @foreach ($cities->sortByDesc('tours_count') as $item)
                                                            <option data-choice value="{{ $item->id }}"
                                                                {{ in_array($item->id, $normalSelectedCityIds) ? 'selected' : '' }}>
                                                                {{ $item->name }}
                                                                ({{ $item->tours_count > 0 ? $item->tours_count . ' ' . ($item->tours_count === 1 ? 'tour' : 'tours') . ' available' : 'No tours available' }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="py-3" x-show="destination_content_type_normal === 'country'">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-fields">
                                                    <label class="title">Select 5 Countries <span
                                                            class="text-danger">*</span> :</label>
                                                    @php
                                                        $normalSelectedCountryIds =
                                                            $sectionContent &&
                                                            isset($sectionContent->destination_country_ids_normal)
                                                                ? $sectionContent->destination_country_ids_normal
                                                                : [];
                                                    @endphp
                                                    <select name="content[destination_country_ids_normal][]" multiple
                                                        class="field select2-select" data-max-items="5"
                                                        placeholder="Select Countries" data-error="Countries">
                                                        @foreach ($countries as $item)
                                                            <option value="{{ $item->id }}"
                                                                {{ in_array($item->id, $normalSelectedCountryIds) ? 'selected' : '' }}>
                                                                {{ $item->name }}
                                                                ({{ $item->toursCount() > 0 ? $item->toursCount() . ' ' . ($item->toursCount() === 1 ? 'tour' : 'tours') . ' available' : 'No tours available' }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="py-3 mt-2" x-show="destination_style_type === 'carousel'">
                            <div class="form-fields">
                                <label class="title title--sm mb-2">Content Type:</label>
                                <div x-data="{ destination_content_type_carousel: '{{ isset($sectionContent->destination_content_type_carousel) ? $sectionContent->destination_content_type_carousel : 'city' }}' }">
                                    <div class="d-flex align-items-center gap-5 px-4 mb-1">
                                        <div class="form-check p-0">
                                            <input class="form-check-input" type="radio"
                                                name="content[destination_content_type_carousel]"
                                                id="destination_content_type_carousel_2"
                                                x-model="destination_content_type_carousel"
                                                name="content[destination_content_type_carousel]" value="city" />
                                            <label class="form-check-label"
                                                for="destination_content_type_carousel_2">Cities</label>
                                        </div>
                                        <div class="form-check p-0">
                                            <input class="form-check-input" type="radio"
                                                name="content[destination_content_type_carousel]"
                                                id="destination_content_type_carousel_3"
                                                x-model="destination_content_type_carousel"
                                                name="content[destination_content_type_carousel]" value="country" />
                                            <label class="form-check-label"
                                                for="destination_content_type_carousel_3">Countries</label>
                                        </div>
                                        <div class="form-check p-0">
                                            <input class="form-check-input" type="radio"
                                                name="content[destination_content_type_carousel]"
                                                id="destination_content_type_carousel_1"
                                                x-model="destination_content_type_carousel"
                                                name="content[destination_content_type_carousel]" value="tour" />
                                            <label class="form-check-label"
                                                for="destination_content_type_carousel_1">Tours</label>
                                        </div>
                                    </div>
                                    <div class="py-3" x-show="destination_content_type_carousel === 'tour'">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-fields">
                                                    <label class="title">Select Tours <span
                                                            class="text-danger">*</span>
                                                        :</label>
                                                    @php
                                                        $carouselSelectedTourIds =
                                                            $sectionContent &&
                                                            isset($sectionContent->destination_tour_ids_carousel)
                                                                ? $sectionContent->destination_tour_ids_carousel
                                                                : [];
                                                    @endphp
                                                    <select name="content[destination_tour_ids_carousel][]" multiple
                                                        class="field select2-select" placeholder="Select Tours"
                                                        data-error="Tours">
                                                        @foreach ($tours as $item)
                                                            <option value="{{ $item->id }}"
                                                                {{ in_array($item->id, $carouselSelectedTourIds) ? 'selected' : '' }}>
                                                                {{ $item->title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="py-3" x-show="destination_content_type_carousel === 'city'">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-fields">
                                                    <label class="title">Select Cities <span
                                                            class="text-danger">*</span>
                                                        :</label>
                                                    @php
                                                        $carouselSelectedCityIds =
                                                            $sectionContent &&
                                                            isset($sectionContent->destination_city_ids_carousel)
                                                                ? $sectionContent->destination_city_ids_carousel
                                                                : [];
                                                    @endphp
                                                    <select name="content[destination_city_ids_carousel][]" multiple
                                                        class="field select2-select" placeholder="Select Cities"
                                                        data-error="Cities">
                                                        @foreach ($cities->sortByDesc('tours_count') as $item)
                                                            <option value="{{ $item->id }}"
                                                                {{ in_array($item->id, $carouselSelectedCityIds) ? 'selected' : '' }}>
                                                                {{ $item->name }}
                                                                ({{ $item->tours_count > 0 ? $item->tours_count . ' ' . ($item->tours_count === 1 ? 'tour' : 'tours') . ' available' : 'No tours available' }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="py-3" x-show="destination_content_type_carousel === 'country'">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-fields">
                                                    <label class="title">Select Countries <span
                                                            class="text-danger">*</span> :</label>
                                                    @php
                                                        $carouselSelectedCountryIds =
                                                            $sectionContent &&
                                                            isset($sectionContent->destination_country_ids_carousel)
                                                                ? $sectionContent->destination_country_ids_carousel
                                                                : [];
                                                    @endphp
                                                    <select name="content[destination_country_ids_carousel][]" multiple
                                                        class="field select2-select" placeholder="Select Countries"
                                                        data-error="Countries">
                                                        @foreach ($countries as $item)
                                                            <option value="{{ $item->id }}"
                                                                {{ in_array($item->id, $carouselSelectedCountryIds) ? 'selected' : '' }}>
                                                                {{ $item->name }}
                                                                ({{ $item->toursCount() > 0 ? $item->toursCount() . ' ' . ($item->toursCount() === 1 ? 'tour' : 'tours') . ' available' : 'No tours available' }})
                                                            </option>
                                                        @endforeach
                                                    </select>
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
