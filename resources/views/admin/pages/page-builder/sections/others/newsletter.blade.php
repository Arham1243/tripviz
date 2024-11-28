@php
    $sectionContent = $pageSection ? json_decode($pageSection->content) : null;
@endphp

<div class="row">
    <div class="col-md-12 mb-3">
        <div class="form-fields">
            <label class="title">Title <span class="text-danger">*</span> :</label>
            <input type="text" name="content[title]" class="field" placeholder="" data-error="Title"
                value="{{ $sectionContent->title ?? '' }}" maxlength="39 ">
        </div>
    </div>
    <div class="col-md-12 mb-3">
        <div class="form-fields">
            <label class="title">Description <span class="text-danger">*</span> :</label>
            <textarea name="content[description]" class="field" rows="2" maxlength="255 ">{{ $sectionContent->description ?? '' }} </textarea>
        </div>
    </div>
    <div class="col-md-12 mb-3">
        <div class="form-fields">
            <label class="title">Privacy Statement <span class="text-danger">*</span> :</label>
            <textarea name="content[privacy_statement]" class="field" rows="2" maxlength="255 ">{{ $sectionContent->privacy_statement ?? '' }} </textarea>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="form-fields">
            <label class="title">Left Side Image <span class="text-danger">*</span>:</label>
            <div class="upload upload--sm mx-0" data-upload>
                <div class="upload-box-wrapper">
                    <div class="upload-box {{ empty($sectionContent->left_image) ? 'show' : '' }}" data-upload-box>
                        <input type="file" name="content[left_image]" data-error="Feature Image" id="left_image"
                            class="upload-box__file d-none" accept="image/*" data-file-input>
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
                            value="{{ $sectionContent->left_image_alt_text ?? 'Newletter Left Image' }}">
                    </div>
                </div>
                <div data-error-message class="text-danger mt-2 d-none text-center">Please
                    upload a
                    valid image file
                </div>
                <div class="dimensions text-center mt-3">
                    <strong>Dimensions:</strong> 560 &times; 280
                </div>
            </div>
        </div>
    </div>
</div>
