{{-- @php
    $sectionContent = $pageSection
        ? json_decode($pageSection->content)
        : (object) [
            'heading' => null,
            'alt_text' => null,
            'right_image' => null,
        ];

@endphp

<div class="form-fields">
    <label class="title">Section Heading <span class="text-danger">*</span> :</label>
    <input type="text" name="content[heading]" class="field" value="{{ $sectionContent->heading ?? '' }}" placeholder=""
        data-required data-error="Heading">
</div>
<div class="form-fields">
    <label class="title">Right Side Image <span class="text-danger">*</span> :</label>
    <div class="row">
        <div class="col-md-4">
            <div class="upload" data-upload>
                <div class="upload-box-wrapper">
                    <div class="upload-box {{ empty($sectionContent->right_image) ? 'show' : '' }}" data-upload-box>
                        <input type="file" name="content[right_image]"
                            {{ empty($sectionContent->right_image) ? 'data-required' : '' }} data-error="Feature Image"
                            id="right_image" class="upload-box__file d-none" accept="image/*" data-file-input>
                        <div class="upload-box__placeholder"><i class='bx bxs-image'></i></div>
                        <label for="right_image" class="upload-box__btn themeBtn">Upload Image</label>
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
                        <input type="text" name="content[alt_text]" class="field" placeholder="Enter alt text"
                            value="{{ $sectionContent->alt_text ?? 'Banner Right Image' }}">
                    </div>
                </div>
                <div data-error-message class="text-danger mt-2 d-none text-center">Please upload a valid image file
                </div>
            </div>
        </div>
    </div>
</div> --}}
