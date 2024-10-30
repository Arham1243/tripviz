export const sections = {
    water_activities_3_box_layout: `
<div class="form-fields">
<label class="title">Section Heading <span class="text-danger">*</span> :</label>
<input type="text" name="heading" class="field" placeholder="" data-required data-error="Heading">
</div>
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
<tr>
    <td>
        <div class="form-check form-switch" data-enabled-text="Enabled" data-disabled-text="Disabled">
            <input class="form-check-input" data-toggle-switch="" type="checkbox" id="is_special_0"
                value="1" name="activities[is_special][]">
            <label class="form-check-label" for="is_special_0">Enabled</label>
        </div>
    </td>
    <td>
        <input name="activities[title][]" type="text" class="field" placeholder="Title">
    </td>
    <td>
        <textarea name="activities[content][]" class="field" rows="2"></textarea>
    </td>
    <td>
        <div class="upload upload--sm" data-upload="">
            <div class="upload-box-wrapper">
                <div class="upload-box show" data-upload-box="">

                    <div class="upload-box__placeholder"><i class="bx bxs-image"></i>
                    </div>
                    <label for="activities_bg_img_0" class="upload-box__btn themeBtn">Upload
                        Image</label>
                    <input type="file" name="activities[content][backgournd_image][]"
                        id="activities_bg_img_0" class="upload-box__file d-none" accept="image/*"
                        data-file-input="">
                </div>
                <div class="upload-box__img" data-upload-img="">
                    <button type="button" class="delete-btn" data-delete-btn=""><i
                            class="bx bxs-trash-alt"></i></button>
                    <a href="#" class="mask" data-fancybox="gallery">
                        <img src="{{ asset('admin/assets/images/loading.webp') }}"
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
<tr>
    <td>
        <div class="form-check form-switch" data-enabled-text="Enabled"
            data-disabled-text="Disabled">
            <input class="form-check-input" data-toggle-switch="" type="checkbox" id="is_special_1"
                value="1" name="activities[is_special][]">
            <label class="form-check-label" for="is_special_1">Enabled</label>
        </div>
    </td>
    <td>
        <input name="activities[title][]" type="text" class="field" placeholder="Title">
    </td>
    <td>
        <textarea name="activities[content][]" class="field" rows="2"></textarea>
    </td>
    <td>
        <div class="upload upload--sm" data-upload="">
            <div class="upload-box-wrapper">
                <div class="upload-box show" data-upload-box="">

                    <div class="upload-box__placeholder"><i class="bx bxs-image"></i>
                    </div>
                    <label for="activities_bg_img_1" class="upload-box__btn themeBtn">Upload
                        Image</label>
                    <input type="file" name="activities[content][backgournd_image][]"
                        id="activities_bg_img_1" class="upload-box__file d-none" accept="image/*"
                        data-file-input="">
                </div>
                <div class="upload-box__img" data-upload-img="">
                    <button type="button" class="delete-btn" data-delete-btn=""><i
                            class="bx bxs-trash-alt"></i></button>
                    <a href="#" class="mask" data-fancybox="gallery">
                        <img src="{{ asset('admin/assets/images/loading.webp') }}"
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
<tr>
    <td>
        <div class="form-check form-switch" data-enabled-text="Enabled"
            data-disabled-text="Disabled">
            <input class="form-check-input" data-toggle-switch="" type="checkbox" id="is_special_2"
                value="1" name="activities[is_special][]">
            <label class="form-check-label" for="is_special_2">Enabled</label>
        </div>
    </td>
    <td>
        <input name="activities[title][]" type="text" class="field" placeholder="Title">
    </td>
    <td>
        <textarea name="activities[content][]" class="field" rows="2"></textarea>
    </td>
    <td>
        <div class="upload upload--sm" data-upload="">
            <div class="upload-box-wrapper">
                <div class="upload-box show" data-upload-box="">

                    <div class="upload-box__placeholder"><i class="bx bxs-image"></i>
                    </div>
                    <label for="activities_bg_img_2" class="upload-box__btn themeBtn">Upload
                        Image</label>
                    <input type="file" name="activities[content][backgournd_image][]"
                        id="activities_bg_img_2" class="upload-box__file d-none" accept="image/*"
                        data-file-input="">
                </div>
                <div class="upload-box__img" data-upload-img="">
                    <button type="button" class="delete-btn" data-delete-btn=""><i
                            class="bx bxs-trash-alt"></i></button>
                    <a href="#" class="mask" data-fancybox="gallery">
                        <img src="{{ asset('admin/assets/images/loading.webp') }}"
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
</tbody>
</table>
</div>
</div>
`,
    banner_search_bar: `
<div class="form-fields">
<label class="title">Section Heading <span class="text-danger">*</span> :</label>
<input type="text" name="heading" class="field" placeholder="" data-required
data-error="Heading">
</div>
<div class="form-fields">
<label class="title">Right Side Image <span class="text-danger">*</span> :</label>
<div class="row">
<div class="col-md-4">
<div class="upload" data-upload>
    <div class="upload-box-wrapper">
        <div class="upload-box show"
            data-upload-box>
            <input type="file" name="right_image" data-required
                data-error="Feature Image" id="right_image"
                class="upload-box__file d-none" accept="image/*" data-file-input>
            <div class="upload-box__placeholder"><i class='bx bxs-image'></i>
            </div>
            <label for="right_image" class="upload-box__btn themeBtn">Upload
                Image</label>
        </div>
        <div class="upload-box__img"
            data-upload-img>
            <button type="button" class="delete-btn" data-delete-btn><i
                    class='bx bxs-trash-alt'></i></button>
            <a href="{{ asset('admin/assets/images/loading.webp') }}" class="mask"
                data-fancybox="gallery">
                <img src="{{ asset('admin/assets/images/loading.webp') }}" alt="Banner Right Image"
                    class="imgFluid" data-upload-preview>
            </a>
            <input type="text" name="alt_text" class="field"
                placeholder="Enter alt text" value="Banner Right Image">
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
`,
    tours_grid_5_item: `
<div class="form-fields">
<label class="title">Section Heading <span class="text-danger">*</span> :</label>
<input type="text" name="heading" class="field" placeholder="" data-required
data-error="Heading">
</div>
<div class="form-fields">
<label class="title">View More Text <span class="text-danger">*</span> :</label>
<input type="text" name="view_more_text" class="field" placeholder="" data-required
data-error="View More Text">
</div>
<div class="form-fields">
<label class="title">View More Link <span class="text-danger">*</span> :</label>
<input type="url" name="view_more_link" class="field" placeholder="" data-required
data-error="View More Link">
</div>
<div class="form-fields">
<label class="title">Select 5 Tours <span class="text-danger">*</span> :</label>
<select name="tours_ids[]" multiple class="choice-select" data-max-items="5"
placeholder="Select Tours" data-required
data-error="Tours">
@foreach ($tours as $tour)
<option value="{{ $tour->id }}">
    {{ $tour->title }}
</option>
@endforeach
</select>
</div>

`,
};
