<div class="form-fields">
    <label class="title">Section Heading <span class="text-danger">*</span> :</label>
    <input type="text" name="heading" class="field" placeholder="" data-required data-error="Heading">
</div>
<div class="form-fields">
    <label class="title">Right Side Image <span class="text-danger">*</span> :</label>
    <div class="row">
        <div class="col-md-4">
            <div class="upload" data-upload>
                <div class="upload-box-wrapper">
                    <div class="upload-box show" data-upload-box>
                        <input type="file" name="right_image" data-required data-error="Feature Image"
                            id="right_image" class="upload-box__file d-none" accept="image/*" data-file-input>
                        <div class="upload-box__placeholder"><i class='bx bxs-image'></i>
                        </div>
                        <label for="right_image" class="upload-box__btn themeBtn">Upload
                            Image</label>
                    </div>
                    <div class="upload-box__img" data-upload-img>
                        <button type="button" class="delete-btn" data-delete-btn><i
                                class='bx bxs-trash-alt'></i></button>
                        <a href="{{ asset('admin/assets/images/loading.webp') }}" class="mask"
                            data-fancybox="gallery">
                            <img src="{{ asset('admin/assets/images/loading.webp') }}" alt="Banner Right Image"
                                class="imgFluid" data-upload-preview>
                        </a>
                        <input type="text" name="alt_text" class="field" placeholder="Enter alt text"
                            value="Banner Right Image">
                    </div>
                </div>
                <div data-error-message class="text-danger mt-2 d-none text-center">Please
                    upload a
                    valid image file
                </div>
            </div>
        </div>
    </div>
</div>
