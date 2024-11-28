@php
    $sectionContent = $pageSection ? json_decode($pageSection->content) : null;
@endphp

<div class="row">
    <div class="col-lg-12 mb-4 pt-3">
        <div class="form-fields">
            <label class="title title--sm mb-3">Select style:</label>
            <div x-data="{ section_style: '{{ isset($sectionContent->section_style) ? $sectionContent->section_style : 'style-1' }}' }">
                <div class="d-flex align-items-center gap-5 px-4">
                    <div class="form-check p-0 ps-1">
                        <input class="form-check-input" x-model="section_style" type="radio"
                            name="content[section_style]" id="style-1" name="content[section_style]"
                            {{ isset($sectionContent->section_style) ? ($sectionContent->section_style === 'style-1' ? 'checked' : '') : '' }}
                            value="style-1" checked />
                        <label class="form-check-label d-flex align-items-center gap-2" for="style-1">Style 1
                            <a href="{{ asset('admin/assets/images/ctas-blocks/1.png') }}" data-fancybox="gallery"
                                title="section preview"
                                class="themeBtn section-preview-image section-preview-image--sm"><i
                                    class="bx bxs-show"></i></a></label>
                    </div>
                    <div class="form-check p-0 ps-1">
                        <input class="form-check-input" x-model="section_style" type="radio"
                            name="content[section_style]" id="style-2" name="content[section_style]"
                            {{ isset($sectionContent->section_style) ? ($sectionContent->section_style === 'style-2' ? 'checked' : '') : '' }}
                            value="style-2" />
                        <label class="form-check-label d-flex align-items-center gap-2" for="style-2">Style 2
                            <a href="{{ asset('admin/assets/images/ctas-blocks/2.png') }}" data-fancybox="gallery"
                                title="section preview"
                                class="themeBtn section-preview-image section-preview-image--sm"><i
                                    class="bx bxs-show"></i></a></label>
                    </div>
                </div>
                <div x-show="section_style === 'style-1'">
                    <div class="row pt-1">
                        <div class="col-lg-12 mb-4 pt-3">
                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <div class="form-fields">
                                        <label class="title">Title <span class="text-danger">*</span> :</label>
                                        <input type="text" name="content[title]" class="field" placeholder=""
                                            data-error="title" value="{{ $sectionContent->title ?? '' }}"
                                            maxlength="69">
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-fields">
                                        <label class="title">Description <span class="text-danger">*</span> :</label>
                                        <textarea name="content[description]" class="field" rows="2" maxlength="255">{{ $sectionContent->description ?? '' }} </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <hr />
                        </div>
                        <div class="col-lg-12 pt-4 pb-3">
                            <div class="form-fields">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <label class="title title--sm mb-0">Call to Action Button:</label>
                                    <div class="form-check form-switch" data-enabled-text="Enabled"
                                        data-disabled-text="Disabled">
                                        <input class="form-check-input" data-toggle-switch=""
                                            {{ isset($sectionContent->is_button_enabled) ? 'checked' : '' }}
                                            type="checkbox" id="cta_btn_enabled" value="1"
                                            name="content[is_button_enabled]">
                                        <label class="form-check-label" for="cta_btn_enabled">Enabled</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 mb-4">
                                        <div class="form-fields">
                                            <label class="title">Button Text <span class="text-danger">*</span>
                                                :</label>
                                            <input type="text" value="{{ $sectionContent->btn_text ?? '' }}"
                                                name="content[btn_text]" class="field" placeholder=""
                                                data-error="Button Text" maxlength="40">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-4">
                                        <div class="form-fields">
                                            <label class="title">
                                                <div class="d-flex align-items-center gap-2 lh-1">
                                                    <div class="mt-1">Button Link </div>


                                                    <button data-bs-placement="top"
                                                        title="<div class='d-flex flex-column'> <div class='d-flex gap-1'> <strong>Link:</strong> https://abc.com</div> <div class='d-flex gap-1'><strong>Phone:</strong> tel:+971xxxxxxxxx</div> <div class='d-flex gap-1'><strong>Whatsapp:</strong> https://wa.me/971xxxxxxxxx</div> </div>"
                                                        type="button" data-tooltip="tooltip" class="tooltip-lg">
                                                        <i class='bx bxs-info-circle'></i>
                                                    </button>
                                                </div>
                                            </label>
                                            <input type="text" value="{{ $sectionContent->btn_link ?? '' }}"
                                                name="content[btn_link]" class="field" placeholder=""
                                                data-error="Button Link">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-fields">
                                            <div class="title d-flex align-items-center gap-2">
                                                <div>
                                                    Button Background Color <span class="text-danger">*</span>:
                                                </div>
                                                <a class="p-0 nav-link" href="//html-color-codes.info"
                                                    target="_blank">Get Color
                                                    Codes</a>
                                            </div>
                                            <div class="field color-picker" data-color-picker-container>
                                                <label for="color-picker" data-color-picker></label>
                                                <input id="color-picker" type="text"
                                                    name="content[btn_background_color]" data-color-picker-input
                                                    value="{{ $sectionContent->btn_background_color ?? '#1c4d99' }}"
                                                    data-error="background Color" inputmode="text" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-fields">
                                            <div class="title d-flex align-items-center gap-2">
                                                <div>
                                                    Button Text Color <span class="text-danger">*</span>:
                                                </div>
                                                <a class="p-0 nav-link" href="//html-color-codes.info"
                                                    target="_blank">Get Color
                                                    Codes</a>
                                            </div>
                                            <div class="field color-picker" data-color-picker-container>
                                                <label for="color-picker" data-color-picker></label>
                                                <input id="color-picker" type="text"
                                                    name="content[btn_text_color]" data-color-picker-input
                                                    value="{{ $sectionContent->btn_text_color ?? '#ffffff' }}"
                                                    data-error="background Color" inputmode="text" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <hr />
                        </div>
                        <div class="col-lg-12 mb-4 pt-3">
                            <div class="form-fields">
                                <label class="title title--sm mb-3">Background Style:</label>
                                <div x-data="{ background_type: '{{ isset($sectionContent->background_type) ? $sectionContent->background_type : 'background_image' }}' }">
                                    <div class="d-flex align-items-center gap-5 px-4">
                                        <div class="form-check p-0">
                                            <input class="form-check-input" type="radio"
                                                name="content[background_type]" id="background_image_1"
                                                x-model="background_type" name="content[background_type]"
                                                value="background_image" checked />
                                            <label class="form-check-label" for="background_image_1">Background
                                                Image</label>
                                        </div>
                                        <div class="form-check p-0">
                                            <input class="form-check-input" type="radio"
                                                name="content[background_type]" id="background_color_2_color"
                                                x-model="background_type" name="content[background_type]"
                                                value="background_color" />
                                            <label class="form-check-label" for="background_color_2_color">Background
                                                Color</label>
                                        </div>
                                    </div>
                                    <div x-show="background_type === 'background_image'">
                                        <div class="row pt-4">
                                            <div class="col-md-4 mb-4">
                                                <div class="form-fields">
                                                    <label class="title">Background Image <span
                                                            class="text-danger">*</span>:</label>
                                                    <div class="upload upload--sm mx-0" data-upload>
                                                        <div class="upload-box-wrapper">
                                                            <div class="upload-box {{ empty($sectionContent->background_image) ? 'show' : '' }}"
                                                                data-upload-box>
                                                                <input type="file" name="content[background_image]"
                                                                    data-error="Feature Image" id="background_image"
                                                                    class="upload-box__file d-none" accept="image/*"
                                                                    data-file-input />
                                                                <div class="upload-box__placeholder">
                                                                    <i class="bx bxs-image"></i>
                                                                </div>
                                                                <label for="background_image"
                                                                    class="upload-box__btn themeBtn">Upload
                                                                    Image</label>
                                                            </div>
                                                            <div class="upload-box__img {{ !empty($sectionContent->background_image) ? 'show' : '' }}"
                                                                data-upload-img>
                                                                <button type="button" class="delete-btn"
                                                                    data-delete-btn="">
                                                                    <i class="bx bxs-edit-alt"></i>
                                                                </button>
                                                                <a href="{{ asset($sectionContent->background_image ?? 'admin/assets/images/loading.webp') }}"
                                                                    class="mask" data-fancybox="gallery">
                                                                    <img src="{{ asset($sectionContent->background_image ?? 'admin/assets/images/loading.webp') }}"
                                                                        alt="Uploaded Image" class="imgFluid"
                                                                        data-placeholder="{{ asset('admin/assets/images/loading.webp') }}"
                                                                        data-upload-preview="" />
                                                                </a>
                                                                <input type="text"
                                                                    name="content[background_image_alt_text]"
                                                                    class="field" placeholder="Enter alt text"
                                                                    value="{{ $sectionContent->background_image_alt_text ?? 'Cta Background Image' }}">
                                                            </div>
                                                        </div>
                                                        <div data-error-message
                                                            class="text-danger mt-2 d-none text-center">
                                                            Please upload a valid image file
                                                        </div>
                                                        <div class="dimensions text-center mt-3">
                                                            <strong>Dimensions:</strong> 1116 &times; 210
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div x-show="background_type === 'background_color'">
                                        <div class="row pt-4">
                                            <div class="col-md-12">
                                                <div class="form-fields">
                                                    <div class="title d-flex align-items-center gap-2">
                                                        <div>
                                                            Select Background Color <span class="text-danger">*</span>:
                                                        </div>
                                                        <a class="p-0 nav-link" href="//html-color-codes.info"
                                                            target="_blank">Get Color
                                                            Codes</a>
                                                    </div>
                                                    <div class="field color-picker" data-color-picker-container>
                                                        <label for="color-picker" data-color-picker></label>
                                                        <input id="color-picker" type="text"
                                                            name="content[background_color]" data-color-picker-input
                                                            value="{{ $sectionContent->background_color ?? '' }}"
                                                            placeholder="#000000" data-error="background Color"
                                                            inputmode="text" />
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
                <div x-show="section_style === 'style-2'">
                    <div class="row pt-1">
                        <div class="row pt-1">
                            <div class="col-lg-12 mb-4 pt-3">
                                <div class="row">
                                    <div class="col-lg-12 mb-3">
                                        <div class="form-fields">
                                            <label class="title">Title <span class="text-danger">*</span> :</label>
                                            <input type="text" name="content[title_2]" class="field"
                                                placeholder="" data-error="title_2"
                                                value="{{ $sectionContent->title_2 ?? '' }}" maxlength="69">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <div class="form-fields">
                                            <label class="title">Sub Title <span class="text-danger">*</span>
                                                :</label>
                                            <input type="text" name="content[subTitle_2]" class="field"
                                                placeholder="" data-error="subTitle_2"
                                                value="{{ $sectionContent->subTitle_2 ?? '' }}" maxlength="69">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <div class="form-fields">
                                            <label class="title">Sale text <span class="text-danger">*</span>
                                                :</label>
                                            <input type="text" name="content[sale_text_2]" class="field"
                                                placeholder="" data-error="sale_text_2"
                                                value="{{ $sectionContent->sale_text_2 ?? '' }}" maxlength="40">
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-fields">
                                            <label class="title">Description <span class="text-danger">*</span>
                                                :</label>
                                            <textarea name="content[description_2]" class="field" rows="2" maxlength="255">{{ $sectionContent->description_2 ?? '' }} </textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <div class="form-fields">
                                            <label class="title">Sale Ends On <span class="text-danger">*</span>
                                                :</label>
                                            <input type="datetime-local" class="field"
                                                value="{{ $sectionContent->sale_ends_on_2 ?? '' }}"
                                                name="content[sale_ends_on_2]" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <hr />
                            </div>
                            <div class="col-lg-12 pt-4 pb-3">
                                <div class="form-fields">
                                    <div class="d-flex align-items-center gap-3 mb-3">
                                        <label class="title title--sm mb-0">Call to Action Button:</label>
                                        <div class="form-check form-switch" data-enabled-text="Enabled"
                                            data-disabled-text="Disabled">
                                            <input class="form-check-input" data-toggle-switch=""
                                                {{ isset($sectionContent->is_button_enabled_2) ? 'checked' : '' }}
                                                type="checkbox" id="cta_btn_enabled" value="1"
                                                name="content[is_button_enabled_2]">
                                            <label class="form-check-label" for="cta_btn_enabled">Enabled</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 mb-4">
                                            <div class="form-fields">
                                                <label class="title">Button Text <span class="text-danger">*</span>
                                                    :</label>
                                                <input type="text" value="{{ $sectionContent->btn_text_2 ?? '' }}"
                                                    name="content[btn_text_2]" class="field" placeholder=""
                                                    data-error="Button Text" maxlength="40">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-4">
                                            <div class="form-fields">
                                                <label class="title">
                                                    <div class="d-flex align-items-center gap-2 lh-1">
                                                        <div class="mt-1">Button Link </div>
                                                        <button data-bs-placement="top"
                                                            title="<div class='d-flex flex-column'> <div class='d-flex gap-1'> <strong>Link:</strong> https://abc.com</div> <div class='d-flex gap-1'><strong>Phone:</strong> tel:+971xxxxxxxxx</div> <div class='d-flex gap-1'><strong>Whatsapp:</strong> https://wa.me/971xxxxxxxxx</div> </div>"
                                                            type="button" data-tooltip="tooltip" class="tooltip-lg">
                                                            <i class='bx bxs-info-circle'></i>
                                                        </button>
                                                    </div>
                                                </label>
                                                <input type="text" value="{{ $sectionContent->btn_link_2 ?? '' }}"
                                                    name="content[btn_link_2]" class="field" placeholder=""
                                                    data-error="Button Link">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-fields">
                                                <div class="title d-flex align-items-center gap-2">
                                                    <div>
                                                        Button Background Color <span class="text-danger">*</span>:
                                                    </div>
                                                    <a class="p-0 nav-link" href="//html-color-codes.info"
                                                        target="_blank">Get Color
                                                        Codes</a>
                                                </div>
                                                <div class="field color-picker" data-color-picker-container>
                                                    <label for="color-picker" data-color-picker></label>
                                                    <input id="color-picker" type="text"
                                                        name="content[btn_background_color_2]" data-color-picker-input
                                                        value="{{ $sectionContent->btn_background_color_2 ?? '#1c4d99' }}"
                                                        data-error="background Color" inputmode="text" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-fields">
                                                <div class="title d-flex align-items-center gap-2">
                                                    <div>
                                                        Button Text Color <span class="text-danger">*</span>:
                                                    </div>
                                                    <a class="p-0 nav-link" href="//html-color-codes.info"
                                                        target="_blank">Get Color
                                                        Codes</a>
                                                </div>
                                                <div class="field color-picker" data-color-picker-container>
                                                    <label for="color-picker" data-color-picker></label>
                                                    <input id="color-picker" type="text"
                                                        name="content[btn_text_color_2]" data-color-picker-input
                                                        value="{{ $sectionContent->btn_text_color_2 ?? '#ffffff' }}"
                                                        data-error="background Color" inputmode="text" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <hr />
                            </div>
                            <div class="col-lg-12 mb-4 pt-3">
                                <div class="form-fields">
                                    <label class="title title--sm mb-3">Background Style:</label>
                                    <div x-data="{ background_type_2: '{{ isset($sectionContent->background_type_2) ? $sectionContent->background_type_2 : 'background_image' }}' }">
                                        <div class="d-flex align-items-center gap-5 px-4">
                                            <div class="form-check p-0">
                                                <input class="form-check-input" type="radio"
                                                    name="content[background_type_2]" id="background_image_2"
                                                    x-model="background_type_2" name="content[background_type_2]"
                                                    value="background_image" checked />
                                                <label class="form-check-label" for="background_image_2">Background
                                                    Image</label>
                                            </div>
                                            <div class="form-check p-0">
                                                <input class="form-check-input" type="radio"
                                                    name="content[background_type_2]" id="background_color_2"
                                                    x-model="background_type_2" name="content[background_type_2]"
                                                    value="background_color" />
                                                <label class="form-check-label" for="background_color_2">Background
                                                    Color</label>
                                            </div>
                                        </div>
                                        <div x-show="background_type_2 === 'background_image'">
                                            <div class="row pt-4">
                                                <div class="col-md-4 mb-4">
                                                    <div class="form-fields">
                                                        <label class="title">Background Image <span
                                                                class="text-danger">*</span>:</label>
                                                        <div class="upload upload--sm mx-0" data-upload>
                                                            <div class="upload-box-wrapper">
                                                                <div class="upload-box {{ empty($sectionContent->background_image_2) ? 'show' : '' }}"
                                                                    data-upload-box>
                                                                    <input type="file"
                                                                        name="content[background_image_2]"
                                                                        data-error="Feature Image"
                                                                        id="background_image_2_image"
                                                                        class="upload-box__file d-none"
                                                                        accept="image/*" data-file-input />
                                                                    <div class="upload-box__placeholder">
                                                                        <i class="bx bxs-image"></i>
                                                                    </div>
                                                                    <label for="background_image_2_image"
                                                                        class="upload-box__btn themeBtn">Upload
                                                                        Image</label>
                                                                </div>
                                                                <div class="upload-box__img {{ !empty($sectionContent->background_image_2) ? 'show' : '' }}"
                                                                    data-upload-img>
                                                                    <button type="button" class="delete-btn"
                                                                        data-delete-btn="">
                                                                        <i class="bx bxs-edit-alt"></i>
                                                                    </button>
                                                                    <a href="{{ asset($sectionContent->background_image_2 ?? 'admin/assets/images/loading.webp') }}"
                                                                        class="mask" data-fancybox="gallery">
                                                                        <img src="{{ asset($sectionContent->background_image_2 ?? 'admin/assets/images/loading.webp') }}"
                                                                            alt="Uploaded Image" class="imgFluid"
                                                                            data-placeholder="{{ asset('admin/assets/images/loading.webp') }}"
                                                                            data-upload-preview="" />
                                                                    </a>
                                                                    <input type="text"
                                                                        name="content[background_image_alt_text_2]"
                                                                        class="field" placeholder="Enter alt text"
                                                                        value="{{ $sectionContent->background_image_alt_text_2 ?? 'Cta Background Image' }}">
                                                                </div>
                                                            </div>
                                                            <div data-error-message
                                                                class="text-danger mt-2 d-none text-center">
                                                                Please upload a valid image file
                                                            </div>
                                                            <div class="dimensions text-center mt-3">
                                                                <strong>Dimensions:</strong> 1116 &times; 210
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div x-show="background_type_2 === 'background_color'">
                                            <div class="row pt-4">
                                                <div class="col-md-12">
                                                    <div class="form-fields">
                                                        <div class="title d-flex align-items-center gap-2">
                                                            <div>
                                                                Select Background Color <span
                                                                    class="text-danger">*</span>:
                                                            </div>
                                                            <a class="p-0 nav-link" href="//html-color-codes.info"
                                                                target="_blank">Get Color
                                                                Codes</a>
                                                        </div>
                                                        <div class="field color-picker" data-color-picker-container>
                                                            <label for="color-picker" data-color-picker></label>
                                                            <input id="color-picker" type="text"
                                                                name="content[background_color_2]"
                                                                data-color-picker-input
                                                                value="{{ $sectionContent->background_color_2 ?? '' }}"
                                                                placeholder="#000000" data-error="background Color"
                                                                inputmode="text" />
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
    </div>
</div>
