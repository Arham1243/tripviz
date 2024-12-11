@php
    $sectionContent = $pageSection ? json_decode($pageSection->content) : null;
@endphp
<div class="row">
    <div class="col-md-6 mb-3">
        <div class="form-fields">
            <label class="title">Title <span class="text-danger">*</span> :</label>
            <input type="text" name="content[title]" class="field" placeholder="" data-error="Title"
                value="{{ $sectionContent->title ?? '' }}" maxlength="40">
        </div>
    </div>
    <div class="col-lg-12 mb-4 pt-3">
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="form-fields">
                    <div class="d-flex align-items-center gap-3">
                        <label class="title title--sm mb-0">More Button:</label>
                        <div class="form-check form-switch" data-enabled-text="Enabled" data-disabled-text="Disabled">
                            <input class="form-check-input" data-toggle-switch=""
                                {{ isset($sectionContent->is_more_btn_enabled) ? 'checked' : '' }} type="checkbox"
                                id="enable-section-more-btn" value="1" name="content[is_more_btn_enabled]">
                            <label class="form-check-label" for="enable-section-more-btn">Enabled</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="form-fields">
                    <label class="title">button text <span class="text-danger">*</span> :</label>
                    <input type="text" value="{{ $sectionContent->see_more_text ?? '' }}"
                        name="content[see_more_text]" class="field" placeholder="" data-error="View More Text">
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
                        <input id="color-picker" type="text" name="content[see_more_background_color]"
                            data-color-picker-input
                            value="{{ $sectionContent->see_more_background_color ?? '#ffffff' }}" placeholder="#000000"
                            data-error="background Color" inputmode="text" />
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
                        <input id="color-picker" type="text" name="content[see_more_text_color]"
                            data-color-picker-input value="{{ $sectionContent->see_more_text_color ?? '#1c4d99' }}"
                            placeholder="#000000" data-error="background Color" inputmode="text" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <hr />
    </div>
    <div class="col-12">
        <div class="form-fields">
            <div class="repeater-table">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Special Offer Badge</th>
                            <th scope="col">Title</th>
                            <th scope="col">Content</th>
                            <th scope="col">Background Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < 3; $i++)
                            @php
                                $activity = isset($sectionContent) ? $sectionContent->activities[$i] : null;
                            @endphp
                            <tr>
                                <td>
                                    <div class="form-check form-switch" data-enabled-text="Enabled"
                                        data-disabled-text="Disabled">
                                        <input class="form-check-input" data-toggle-switch="" type="checkbox"
                                            id="is_special_{{ $i }}" value="1"
                                            name="content[activities][{{ $i }}][is_special]"
                                            {{ isset($activity->is_special) ? 'checked' : '' }}>
                                        <label class="form-check-label"
                                            for="is_special_{{ $i }}">Enabled</label>
                                    </div>
                                </td>
                                <td>
                                    <input name="content[activities][{{ $i }}][title]" type="text"
                                        class="field" placeholder="Title" value="{{ $activity->title ?? '' }}">
                                <td>
                                    <textarea name="content[activities][{{ $i }}][content]" class="field" rows="2">{{ $activity->content ?? '' }}</textarea>
                                </td>
                                <td>
                                    <div class="upload upload--sm" data-upload="">
                                        <div class="upload-box-wrapper">
                                            <div class="upload-box {{ empty($activity->image) ? 'show' : '' }}"
                                                data-upload-box="">

                                                <div class="upload-box__placeholder"><i class="bx bxs-image"></i>
                                                </div>
                                                <label for="activities_bg_img_{{ $i }}"
                                                    class="upload-box__btn themeBtn">Upload
                                                    Image</label>
                                                <input type="file" data-error="Image {{ $i + 1 }}"
                                                    {{ empty($activity->image) ? '' : '' }}
                                                    name="content[activities][{{ $i }}][image]"
                                                    id="activities_bg_img_{{ $i }}"
                                                    class="upload-box__file d-none" accept="image/*"
                                                    data-file-input="">
                                            </div>
                                            <div class="upload-box__img {{ !empty($activity->image) ? 'show' : '' }}"
                                                data-upload-img="">
                                                <button type="button" class="delete-btn" data-delete-btn=""><i
                                                        class='bx bxs-edit-alt'></i></button>
                                                <a href="{{ asset($activity->image ?? 'admin/assets/images/loading.webp') }}"
                                                    class="mask" data-fancybox="gallery">
                                                    <img src="{{ asset($activity->image ?? 'admin/assets/images/loading.webp') }}"
                                                        alt="Uploaded Image" class="imgFluid"
                                                        data-placeholder="{{ asset('admin/assets/images/loading.webp') }}"
                                                        data-upload-preview="">
                                                </a>
                                            </div>
                                        </div>
                                        <div data-error-message="" class="text-danger mt-2 d-none text-center">
                                            Please
                                            upload a
                                            valid image file
                                        </div>
                                    </div>
                                    <div class="dimensions text-center mt-3">
                                        <strong>Dimensions:</strong> 600 × 400
                                    </div>
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
