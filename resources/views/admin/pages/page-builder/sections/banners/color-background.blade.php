@php
    $sectionContent = $pageSection
        ? json_decode($pageSection->content)
        : (object) [
            'subHeading' => null,
            'heading' => null,
            'btn_text' => null,
            'btn_link' => null,
            'alt_text' => null,
            'review_type' => null,
            'background_color' => null,
        ];

@endphp

<div class="row">
    <div class="col-lg-6 mb-3">
        <div class="form-fields">
            <label class="title">Sub Heading <span class="text-danger">*</span> :</label>
            <input type="text" name="content[subHeading]" class="field" value="{{ $sectionContent->subHeading ?? '' }}"
                placeholder="" data-required data-error="Sub Heading">
        </div>
    </div>
    <div class="col-lg-6 mb-3">
        <div class="form-fields">
            <label class="title">Heading <span class="text-danger">*</span> :</label>
            <input type="text" name="content[heading]" class="field" value="{{ $sectionContent->heading ?? '' }}"
                placeholder="" data-required data-error="Heading">
        </div>
    </div>
    <div class="col-lg-6 mb-3">
        <div class="form-fields">
            <label class="title">Button Text <span class="text-danger">*</span> :</label>
            <input type="text" value="{{ $sectionContent->btn_text ?? '' }}" name="content[btn_text]" class="field"
                placeholder="" data-required data-error="Button Text">
        </div>
    </div>
    <div class="col-lg-6 mb-3">
        <div class="form-fields">
            <label class="title">Button Link <span class="text-danger">*</span> :</label>
            <input type="text" value="{{ $sectionContent->btn_link ?? '' }}" name="content[btn_link]" class="field"
                placeholder="" data-required data-error="Button Link">
        </div>
    </div>
    <div class="col-lg-12 mb-4">
        <div class="form-fields">
            @php
                $reviewTypes = ['google'];
            @endphp
            <label class="title">Review type <span class="text-danger">*</span> :</label>
            <select name="content[review_type]" class="field" data-required data-error="Review type">
                <option value="" selected>Select</option>
                @foreach ($reviewTypes as $type)
                    <option value="{{ $type }}"
                        {{ $sectionContent && $sectionContent->review_type == $type ? 'selected' : '' }}>
                        {{ $type }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-fields">
            <div class="title">Background Color <span class="text-danger">*</span> :</div>
            <div class="field color-picker" data-color-picker-container>
                <label for="color-picker" data-color-picker></label>
                <input id="color-picker" type="text" name="content[background_color]" data-color-picker-input
                    value="{{ $sectionContent->background_color ?? '#C4D6E7' }}" placeholder="#ffffff" data-required
                    data-error="background Color" inputmode="text">

            </div>
        </div>
    </div>
</div>
