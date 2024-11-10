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
            'background_images' => null,
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
    @for ($i = 0; $i < 4; $i++)
        @php
            $background_image = $sectionContent ? $sectionContent->background_images[$i] : null;
            $alt_text = $sectionContent ? $sectionContent->alt_text[$i] : null;
        @endphp
        <div class="col-md-3">
            <div class="form-fields">
                <label class="title">Carousel Image {{ $i + 1 }} <span class="text-danger">*</span> :</label>
                <div class="upload upload--sm" data-upload>
                    <div class="upload-box-wrapper">
                        <div class="upload-box {{ empty($sectionContent->background_images) ? 'show' : '' }}"
                            data-upload-box>
                            <input type="file" name="content[background_images][]"
                                {{ empty($sectionContent->background_images) ? 'data-required' : '' }}
                                data-error="Carousel Image {{ $i + 1 }}"
                                id="background_image_{{ $i }}" class="upload-box__file d-none"
                                accept="image/*" data-file-input>
                            <div class="upload-box__placeholder"><i class='bx bxs-image'></i></div>
                            <label for="background_image_{{ $i }}" class="upload-box__btn themeBtn">Upload
                                Image</label>
                        </div>
                        <div class="upload-box__img {{ !empty($sectionContent->background_images) ? 'show' : '' }}"
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
                            <input type="text" name="content[alt_text][]" class="field" placeholder="Enter alt text"
                                value="{{ $alt_text ?? 'Carousel Image ' . $i + 1 }}">
                        </div>
                    </div>
                    <div data-error-message class="text-danger mt-2 d-none text-center">Please upload a valid image file
                    </div>
                </div>
            </div>
        </div>
    @endfor
</div>
