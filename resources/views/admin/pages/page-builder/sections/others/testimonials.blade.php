@php
    $sectionContent = $pageSection ? json_decode($pageSection->content) : null;
    $testimonialIdsCheck = $sectionContent ? isset($sectionContent->testimonial_ids) : [];
    $testimonialIds = $testimonialIdsCheck ? $sectionContent->testimonial_ids : [];
@endphp

<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="form-fields">
            <label class="title">Title<span class="text-danger">*</span> :</label>
            <input type="text" name="content[title]" class="field" placeholder=""
                value="{{ $sectionContent->title ?? '' }}" data-error="Destination Title">
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
                value="{{ $sectionContent->subTitle ?? '' }}">
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
                <input id="color-picker" type="text" name="content[subTitle_text_color]" data-color-picker-input
                    value="{{ $sectionContent->subTitle_text_color ?? '#000000' }}" inputmode="text" />
            </div>
        </div>
    </div>
    <div class="col-md-12">
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
