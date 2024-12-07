@php
    $sectionContent = $pageSection ? json_decode($pageSection->content) : null;
    $testimonialIdsCheck = $sectionContent ? isset($sectionContent->testimonial_ids) : [];
    $testimonialIds = $testimonialIdsCheck ? $sectionContent->testimonial_ids : [];
@endphp

<div class="row">
    <div class="col-lg-12 pt-3 pb-2">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="form-fields">
                    <label class="title">Title<span class="text-danger">*</span> :</label>
                    <input type="text" name="content[title]" class="field" placeholder=""
                        value="{{ $sectionContent->title ?? '' }}" maxlength="34">
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="form-fields">
                    <div class="title d-flex align-items-center gap-2">
                        <div>
                            Title Text Color <span class="text-danger">*</span>:
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
            <div class="col-lg-6 mb-4">
                <div class="form-fields">
                    <label class="title">Sub Title<span class="text-danger">*</span> :</label>
                    <input type="text" name="content[subTitle]" class="field" placeholder=""
                        value="{{ $sectionContent->subTitle ?? '' }}" maxlength="44">
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="form-fields">
                    <div class="title d-flex align-items-center gap-2">
                        <div>
                            sub Title Text Color <span class="text-danger">*</span>:
                        </div>
                        <a class="p-0 nav-link" href="//html-color-codes.info" target="_blank">Get Color
                            Codes</a>
                    </div>
                    <div class="field color-picker" data-color-picker-container>
                        <label for="color-picker" data-color-picker></label>
                        <input id="color-picker" type="text" name="content[subTitle_text_color]"
                            data-color-picker-input value="{{ $sectionContent->subTitle_text_color ?? '#000000' }}"
                            inputmode="text" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <hr>
    </div>
    <div class="col-lg-12 pt-4 pb-3">
        <div class="form-fields">
            <div class="d-flex align-items-center gap-3 mb-3">
                <label class="title title--sm mb-0">Read Button:</label>
                <div class="form-check form-switch" data-enabled-text="Enabled" data-disabled-text="Disabled">
                    <input class="form-check-input" data-toggle-switch=""
                        {{ isset($sectionContent->is_button_enabled) ? 'checked' : '' }} type="checkbox"
                        id="cta_btn_enabled" value="1" name="content[is_button_enabled]">
                    <label class="form-check-label" for="cta_btn_enabled">Enabled</label>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 mb-4">
                    <div class="form-fields">
                        <label class="title">Button Text <span class="text-danger">*</span> :</label>
                        <input type="text" value="{{ $sectionContent->btn_text ?? '' }}" name="content[btn_text]"
                            class="field" placeholder="" data-error="Button Text" maxlength="20">
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
    </div>
    <div class="col-12">
        <hr>
    </div>
    <div class="col-md-12 pt-3 pb-2">
        <div class="form-fields">
            <label class="title">Select 4 Testimonials <span class="text-danger">*</span> :</label>
            <select data-max-items="4" name="content[testimonial_ids][]" multiple class="field select2-select"
                placeholder="Select Testimonials">
                @foreach ($testimonials as $item)
                    <option value="{{ $item->id }}" {{ in_array($item->id, $testimonialIds) ? 'selected' : '' }}>
                        {{ $item->title }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>
