@php
    $sectionContent = $pageSection ? json_decode($pageSection->content) : null;
    $tourIds = $sectionContent ? $sectionContent->tour_ids : [];
@endphp
<div class="row">
    <div class="col-lg-12 mb-3">
        <div class="form-fields">
            <label class="title">Heading <span class="text-danger">*</span> :</label>
            <input type="text" name="content[heading]" class="field" placeholder="" data-required data-error="Heading"
                value="{{ $sectionContent->heading ?? '' }}">
        </div>
    </div>
    <div class="col-lg-12 mb-3">
        <div class="form-fields">
            <label class="title">Paragraph <span class="text-danger">*</span> :</label>
            <input type="text" name="content[paragraph]" class="field" placeholder="" data-required
                data-error="Paragraph" value="{{ $sectionContent->paragraph ?? '' }}">
        </div>
    </div>
    <div class="col-lg-6 mb-3">
        <div class="form-fields">
            <label class="title">View More Text <span class="text-danger">*</span> :</label>
            <input type="text" value="{{ $sectionContent->see_more_text ?? '' }}" name="content[see_more_text]"
                class="field" placeholder="" data-required data-error="View More Text">
        </div>
    </div>
    <div class="col-lg-6 mb-3">
        <div class="form-fields">
            <label class="title">View More Link <span class="text-danger">*</span> :</label>
            <input type="text" value="{{ $sectionContent->see_more_link ?? '' }}" name="content[see_more_link]"
                class="field" placeholder="" data-required data-error="View More Link">
        </div>
    </div>
    <div class="col-lg-4">

    </div>
</div>

<div class="form-fields">
    <label class="title"> Image <span class="text-danger">*</span> :</label>
    <div class="upload" data-upload>
        <div class="upload-box-wrapper">
            <div class="upload-box {{ empty($sectionContent->background_image) ? 'show' : '' }}" data-upload-box>
                <input type="file" name="content[background_image]"
                    {{ empty($sectionContent->background_image) ? 'data-required' : '' }} data-error="Feature Image"
                    id="background_image" class="upload-box__file d-none" accept="image/*" data-file-input>
                <div class="upload-box__placeholder"><i class='bx bxs-image'></i></div>
                <label for="background_image" class="upload-box__btn themeBtn">Upload Image</label>
            </div>
            <div class="upload-box__img {{ !empty($sectionContent->background_image) ? 'show' : '' }}" data-upload-img>
                <button type="button" class="delete-btn" data-delete-btn=""><i class='bx bxs-edit-alt'></i></button>
                <a href="{{ asset($sectionContent->background_image ?? 'admin/assets/images/loading.webp') }}"
                    class="mask" data-fancybox="gallery">
                    <img src="{{ asset($sectionContent->background_image ?? 'admin/assets/images/loading.webp') }}"
                        alt="Uploaded Image" class="imgFluid"
                        data-placeholder="{{ asset('admin/assets/images/loading.webp') }}" data-upload-preview="">
                </a>
                <input type="text" name="content[alt_text]" class="field" placeholder="Enter alt text"
                    value="{{ $sectionContent->alt_text ?? 'Cta  Image' }}">
            </div>
        </div>
        <div data-error-message class="text-danger mt-2 d-none text-center">Please upload a valid image
            file
        </div>
    </div>
</div>
