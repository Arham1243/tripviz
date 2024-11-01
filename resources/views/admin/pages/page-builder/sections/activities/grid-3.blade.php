@php
    $sectionContent = $pageSection ? json_decode($pageSection->content) : null;

@endphp
<div class="form-fields">
    <label class="title">Section Heading <span class="text-danger">*</span> :</label>
    <input type="text" name="content[heading]" class="field" placeholder="" data-required data-error="Heading"
        value="{{ $sectionContent->heading ?? '' }}">
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
                @for ($i = 0; $i < 3; $i++)
                    @php
                        $activity = isset($sectionContent) ? $sectionContent->activities[$i] : null;
                    @endphp
                    <tr>
                        <td>
                            <div class="form-check form-switch" data-enabled-text="Enabled"
                                data-disabled-text="Disabled">
                                <input class="form-check-input" data-toggle-switch="" type="checkbox"
                                    id="is_special_{{ $i }}" value="1"
                                    name="content[activities][{{ $i }}][is_special]"
                                    {{ isset($activity->is_special) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_special_{{ $i }}">Enabled</label>
                            </div>
                        </td>
                        <td>
                            <input name="content[activities][{{ $i }}][title]" type="text" class="field"
                                placeholder="Title" value="{{ $activity->title ?? '' }}">
                        <td>
                            <textarea name="content[activities][{{ $i }}][content]" class="field" rows="2">{{ $activity->content ?? '' }}</textarea>
                        </td>
                        <td>
                            <div class="upload upload--sm" data-upload="">
                                <div class="upload-box-wrapper">
                                    <div class="upload-box {{ empty($activity->image) ? 'show' : '' }}"
                                        data-upload-box="">

                                        <div class="upload-box__placeholder"><i class="bx bxs-image"></i>
                                        </div>
                                        <label for="activities_bg_img_{{ $i }}"
                                            class="upload-box__btn themeBtn">Upload
                                            Image</label>
                                        <input type="file" data-error="Image {{ $i + 1 }}"
                                            {{ empty($activity->image) ? 'data-required' : '' }}
                                            name="content[activities][{{ $i }}][image]"
                                            id="activities_bg_img_{{ $i }}" class="upload-box__file d-none"
                                            accept="image/*" data-file-input="">
                                    </div>
                                    <div class="upload-box__img {{ !empty($activity->image) ? 'show' : '' }}"
                                        data-upload-img="">
                                        <button type="button" class="delete-btn" data-delete-btn=""><i
                                                class='bx bxs-edit-alt'></i></button>
                                        <a href="{{ asset($activity->image ?? 'admin/assets/images/loading.webp') }}"
                                            class="mask" data-fancybox="gallery">
                                            <img src="{{ asset($activity->image ?? 'admin/assets/images/loading.webp') }}"
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
                @endfor
            </tbody>
        </table>
    </div>
</div>
