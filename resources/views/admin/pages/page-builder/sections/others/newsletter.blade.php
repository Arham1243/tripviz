@php
    $sectionContent = $pageSection ? json_decode($pageSection->content) : null;
@endphp

<div class="row">
    <div class="col-lg-12 pt-3 pb-4">
        <div class="form-fields">
            <div class="d-flex align-items-center gap-3 mb-3">
                <label class="title title--sm mb-0">Title:</label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-fields">
                    <label class="title">Text <span class="text-danger">*</span> :</label>
                    <input type="text" name="content[title]" class="field" placeholder="" data-error="Title"
                        value="{{ $sectionContent->title ?? '' }}" maxlength="39">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-fields">
                    <div class="title d-flex align-items-center gap-2">
                        <div>
                            Text Color <span class="text-danger">*</span>:
                        </div>
                        <a class="p-0 nav-link" href="//html-color-codes.info" target="_blank">Get Color
                            Codes</a>
                    </div>
                    <div class="field color-picker" data-color-picker-container>
                        <label for="color-picker" data-color-picker></label>
                        <input id="color-picker" type="text" name="content[title_text_color]" data-color-picker-input
                            value="{{ $sectionContent->title_text_color ?? '#000000' }}" inputmode="text" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <hr>
    </div>
    <div class="col-lg-12 pt-3 pb-4">
        <div class="form-fields">
            <div class="d-flex align-items-center gap-3 mb-3">
                <label class="title title--sm mb-0">Description:</label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="form-fields">
                    <label class="title">Text <span class="text-danger">*</span> :</label>
                    <input type="text" name="content[description]" class="field" maxlength="128"
                        value="{{ $sectionContent->description ?? '' }}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-fields">
                    <div class="title d-flex align-items-center gap-2">
                        <div>
                            Text Color <span class="text-danger">*</span>:
                        </div>
                        <a class="p-0 nav-link" href="//html-color-codes.info" target="_blank">Get Color
                            Codes</a>
                    </div>
                    <div class="field color-picker" data-color-picker-container>
                        <label for="color-picker" data-color-picker></label>
                        <input id="color-picker" type="text" name="content[description_text_color]"
                            data-color-picker-input value="{{ $sectionContent->description_text_color ?? '#000000' }}"
                            inputmode="text" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <hr>
    </div>
    <div class="col-lg-12 pt-3 pb-4">
        <div class="form-fields">
            <div class="d-flex align-items-center gap-3 mb-3">
                <label class="title title--sm mb-0">Privacy Statement:</label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="form-fields">
                    <label class="title">Text <span class="text-danger">*</span> :</label>
                    <textarea rows="3" name="content[privacy_statement]" class="field" maxlength="255">{{ $sectionContent->privacy_statement ?? '' }}</textarea>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-fields">
                    <div class="title d-flex align-items-center gap-2">
                        <div>
                            Text Color <span class="text-danger">*</span>:
                        </div>
                        <a class="p-0 nav-link" href="//html-color-codes.info" target="_blank">Get Color
                            Codes</a>
                    </div>
                    <div class="field color-picker" data-color-picker-container>
                        <label for="color-picker" data-color-picker></label>
                        <input id="color-picker" type="text" name="content[privacy_statement_text_color]"
                            data-color-picker-input
                            value="{{ $sectionContent->privacy_statement_text_color ?? '#000000' }}" inputmode="text" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <hr>
    </div>
    <div class="col-lg-12 pt-3 pb-4">
        <div class="form-fields">
            <div class="d-flex align-items-center gap-3 mb-3">
                <label class="title title--sm mb-0">Signup Button:</label>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="form-fields">
                    <label class="title">Button Text <span class="text-danger">*</span> :</label>
                    <input type="text" value="{{ $sectionContent->btn_text ?? '' }}" name="content[btn_text]"
                        class="field" placeholder="" data-error="Button Text" maxlength="8">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-fields">
                    <div class="title d-flex align-items-center gap-2">
                        <div>
                            Button Background Color <span class="text-danger">*</span>:
                        </div>
                        <a class="p-0 nav-link" href="//html-color-codes.info" target="_blank">Get Color
                            Codes</a>
                    </div>
                    <div class="field color-picker" data-color-picker-container>
                        <label for="color-picker" data-color-picker></label>
                        <input id="color-picker" type="text" name="content[btn_background_color]"
                            data-color-picker-input value="{{ $sectionContent->btn_background_color ?? '#1c4d99' }}"
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
                        <a class="p-0 nav-link" href="//html-color-codes.info" target="_blank">Get Color
                            Codes</a>
                    </div>
                    <div class="field color-picker" data-color-picker-container>
                        <label for="color-picker" data-color-picker></label>
                        <input id="color-picker" type="text" name="content[btn_text_color]"
                            data-color-picker-input value="{{ $sectionContent->btn_text_color ?? '#ffffff' }}"
                            data-error="background Color" inputmode="text" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <hr>
    </div>
    <div class="col-lg-12 pt-3 pb-4">
        <div class="form-fields">
            <div class="d-flex align-items-center gap-3 mb-3">
                <label class="title title--sm mb-0">Background Color/Image:</label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="form-fields">
                    <div class="title d-flex align-items-center gap-2">
                        <div>Right Background Color <span class="text-danger">*</span>:</div>
                        <a class="p-0 nav-link" href="//html-color-codes.info" target="_blank">Get
                            Color
                            Codes</a>
                    </div>
                    <div class="field color-picker" data-color-picker-container>
                        <label for="color-picker" data-color-picker></label>
                        <input id="color-picker" type="text" name="content[right_background_color]"
                            data-color-picker-input value="{{ $sectionContent->right_background_color ?? '#C6F7E4' }}"
                            data-error="background Color" inputmode="text">

                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-fields">
                    <label class="title">Left Side Image <span class="text-danger">*</span>:</label>
                    <div class="upload upload--sm mx-0" data-upload>
                        <div class="upload-box-wrapper">
                            <div class="upload-box {{ empty($sectionContent->left_image) ? 'show' : '' }}"
                                data-upload-box>
                                <input type="file" name="content[left_image]" data-error="Feature Image"
                                    id="left_image" class="upload-box__file d-none" accept="image/*" data-file-input>
                                <div class="upload-box__placeholder"><i class='bx bxs-image'></i>
                                </div>
                                <label for="left_image" class="upload-box__btn themeBtn">Upload
                                    Image</label>
                            </div>
                            <div class="upload-box__img {{ !empty($sectionContent->left_image) ? 'show' : '' }}"
                                data-upload-img>
                                <button type="button" class="delete-btn" data-delete-btn=""><i
                                        class='bx bxs-edit-alt'></i></button>
                                <a href="{{ asset($sectionContent->left_image ?? 'admin/assets/images/loading.webp') }}"
                                    class="mask" data-fancybox="gallery">
                                    <img src="{{ asset($sectionContent->left_image ?? 'admin/assets/images/loading.webp') }}"
                                        alt="Uploaded Image" class="imgFluid"
                                        data-placeholder="{{ asset('admin/assets/images/loading.webp') }}"
                                        data-upload-preview="">
                                </a>
                                <input type="text" name="content[left_image_alt_text]" class="field"
                                    placeholder="Enter alt text"
                                    value="{{ $sectionContent->left_image_alt_text ?? 'Alt Text' }}">
                            </div>
                        </div>
                        <div data-error-message class="text-danger mt-2 d-none text-center">Please
                            upload a
                            valid image file
                        </div>
                        <div class="dimensions text-center mt-3">
                            <strong>Dimensions:</strong> 560 &times; 325
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
