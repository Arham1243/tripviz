@php
    $sectionContent = $pageSection
        ? json_decode($pageSection->content)
        : (object) [
            'title' => null,
            'subtitle' => null,
            'btn_text' => null,
            'btn_link' => null,
            'alt_text' => null,
            'review_type' => null,
            'right_image' => null,
        ];

@endphp

<div class="form-fields">
    <label class="title">Title<span class="text-danger">*</span> :</label>
    <input type="text" name="content[title]" class="field" value="{{ $sectionContent->title ?? '' }}" placeholder=""
        data-required data-error="Sub Heading">
</div>
<div class="form-fields">
    <label class="title">Sub Title<span class="text-danger">*</span> :</label>
    <div x-data="repeater(2)" class="repeater-table">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Sub Title</th>
                    <th class="text-end" scope="col">Remove</th>
                </tr>
            </thead>
            <tbody>
                <template x-for="(item, index) in items" :key="index">
                    <tr>
                        <td>
                            <input type="text" class="field" name="content[subtitle][]" x-model="item.subTitle" />
                        </td>
                        <td>
                            <button :disabled="index === 0" class="delete-btn delete-btn--static ms-auto"
                                @click="remove(index)">
                                <i class="bx bxs-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
        <button type="button" :disabled="items.length >= maxItems" type="button" class="themeBtn ms-auto"
            @click="addItem">
            Add Second Line<i class="bx bx-plus"></i>
        </button>
    </div>
</div>
<div class="form-fields">
    <label class="title">Review<span class="text-danger">*</span> :</label>
    <div x-data="{ review_type: 'google' }">
        <div class="d-flex align-items-center gap-5 px-4">
            <div class="form-check p-0">
                <input class="form-check-input" type="radio"
                    {{ $sectionContent->review_type == 'google' ? 'selected' : '' }} name="content[review_type]"
                    id="google" x-model="review_type" name="content[review_type]" value="google" checked>
                <label class="form-check-label" for="google">Google</label>
            </div>
            <div class="form-check p-0">
                <input class="form-check-input" type="radio"
                    {{ $sectionContent->review_type == 'trustpilot' ? 'selected' : '' }} name="content[review_type]"
                    id="trustpilot" x-model="review_type" name="content[review_type]" value="trustpilot">
                <label class="form-check-label" for="trustpilot">Trustpilot</label>
            </div>
            <div class="form-check p-0">
                <input class="form-check-input" type="radio"
                    {{ $sectionContent->review_type == 'tripadvisor' ? 'selected' : '' }} name="content[review_type]"
                    id="tripadvisor" x-model="review_type" name="content[review_type]" value="tripadvisor">
                <label class="form-check-label" for="tripadvisor">Tripadvisor</label>
            </div>
            <div class="form-check p-0">
                <input class="form-check-input" type="radio"
                    {{ $sectionContent->review_type == 'custom' ? 'selected' : '' }} name="content[review_type]"
                    id="custom" x-model="review_type" name="content[review_type]" value="custom">
                <label class="form-check-label" for="custom">Customize </label>
            </div>
        </div>
        <div class="py-3" x-show="review_type === 'google'">
            <div class="form-fields">
                <label class="title">Google Link <span class="text-danger">*</span> :</label>
                <input type="text" name="content[review_google_link]" class="field" placeholder="" data-required
                    data-error="Google Review Link">
            </div>
        </div>
        <div class="py-2" x-show="review_type === 'trustpilot'">
            <div class="form-fields">
                <label class="title">Trustpilot Link <span class="text-danger">*</span> :</label>
                <input type="text" name="content[review_trustpilot_link]" class="field" placeholder="" data-required
                    data-error="Trustpilot Review Link">
            </div>
        </div>
        <div class="py-2" x-show="review_type === 'tripadvisor'">
            <div class="form-fields">
                <label class="title">Tripadvisor Link <span class="text-danger">*</span> :</label>
                <input type="text" name="content[review_tripadvisor_link]" class="field" placeholder=""
                    data-required data-error="Tripadvisor Review Link">
            </div>
        </div>
        <div class="py-2" x-show="review_type === 'custom'">
            <div class="form-fields">
                <label class="title">Platform Name <span class="text-danger">*</span> :</label>
                <input type="text" name="content[review_tripadvisor_link]" class="field" placeholder=""
                    data-required data-error="Tripadvisor Review Link">
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-lg-6 mb-3">
        <div class="form-fields">
            <label class="title">Button Text <span class="text-danger">*</span> :</label>
            <input type="text" value="{{ $sectionContent->btn_text ?? '' }}" name="content[btn_text]"
                class="field" placeholder="" data-required data-error="Button Text">
        </div>
    </div>
    <div class="col-lg-6 mb-3">
        <div class="form-fields">
            <label class="title">Button Link <span class="text-danger">*</span> :</label>
            <input type="text" value="{{ $sectionContent->btn_link ?? '' }}" name="content[btn_link]"
                class="field" placeholder="" data-required data-error="Button Link">
        </div>
    </div>
    <div class="col-lg-12 mb-4">
        <div class="form-fields">
            @php
                $review_types = ['google'];
            @endphp
            <label class="title">Review type <span class="text-danger">*</span> :</label>
            <select name="content[review_type]" class="field" data-required data-error="Review type">
                <option value="" selected>Select</option>
                @foreach ($review_types as $type)
                    <option value="{{ $type }}"
                        {{ $sectionContent && $sectionContent->review_type == $type ? 'selected' : '' }}>
                        {{ $type }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-fields">
            <label class="title">Right Side Image <span class="text-danger">*</span> :</label>
            <div class="upload" data-upload>
                <div class="upload-box-wrapper">
                    <div class="upload-box {{ empty($sectionContent->right_image) ? 'show' : '' }}" data-upload-box>
                        <input type="file" name="content[right_image]"
                            {{ empty($sectionContent->right_image) ? 'data-required' : '' }}
                            data-error="Feature Image" id="right_image" class="upload-box__file d-none"
                            accept="image/*" data-file-input>
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
</div>
