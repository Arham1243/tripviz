@php
    $sectionContent = $pageSection ? json_decode($pageSection->content) : null;
@endphp
<div class="row">
    <div class="col-md-12 pt-3 pb-2">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="form-fields">
                    <label class="title">Title<span class="text-danger">*</span> :</label>
                    <input type="text" name="content[destination_title]" class="field" placeholder=""
                        value="{{ $sectionContent->destination_title ?? '' }}" data-error="Destination Title">
                </div>
            </div>
            <div class="col-md-6">
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
                        <input id="color-picker" type="text" name="content[destination_title_text_color]"
                            data-color-picker-input
                            value="{{ $sectionContent->destination_title_text_color ?? '#000000' }}"
                            data-error="background Color" inputmode="text" />
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mb-4">
                <div class="form-fields">
                    <label class="title">Sub Title<span class="text-danger">*</span> :</label>
                    @php
                        $destination_subtitles = isset($sectionContent->destination_subtitle)
                            ? json_decode(json_encode($sectionContent->destination_subtitle), true)
                            : [['title' => '', 'text_color' => '#000000']];

                        $destinationSubtitleItems = [];
                        if (isset($destination_subtitles['title']) && isset($destination_subtitles['text_color'])) {
                            foreach ($destination_subtitles['title'] as $index => $title) {
                                $destinationSubtitleItems[] = [
                                    'title' => $title,
                                    'text_color' => $destination_subtitles['text_color'][$index] ?? '#000000',
                                ];
                            }
                        } else {
                            $destinationSubtitleItems = $destination_subtitles;
                        }
                    @endphp
                    <div x-data="repeater({{ json_encode($destinationSubtitleItems) }}, { title: '', text_color: '#000000' }, 2)" class="repeater-table">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Sub Title</th>
                                    <th scope="col">
                                        <div class="d-flex align-items-center gap-2"> Text color
                                            <a class="p-0 nav-link" href="//html-color-codes.info" target="_blank">Get
                                                Color
                                                Codes</a>
                                        </div>

                                    </th>
                                    <th class="text-end" scope="col">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template x-for="(item, index) in items" :key="index">
                                    <tr>
                                        <td>
                                            <input type="text" class="field"
                                                name="content[destination_subtitle][title][]" x-model="item.title"
                                                maxlength="24" />
                                        </td>
                                        <td>
                                            <div class="field color-picker" data-color-picker-container
                                                x-init="$nextTick(() => InitializeColorPickers($el))">
                                                <label :for="'color-picker-' + index" data-color-picker></label>
                                                <input x-model="item.text_color" :id="'color-picker-' + index"
                                                    type="text" name="content[destination_subtitle][text_color][]"
                                                    data-color-picker-input inputmode="text">
                                            </div>
                                        </td>
                                        <td>
                                            <button :disabled="index === 0"
                                                class="delete-btn delete-btn--static ms-auto" @click="remove(index)">
                                                <i class="bx bxs-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                        <button type="button" x-show="items.length < maxItems" type="button" class="themeBtn ms-auto"
                            @click="addItem">
                            Add Second Line<i class="bx bx-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mb-4">
                <div class="form-fields">
                    <label class="title title--sm mb-3">Background Style:</label>
                    <div x-data="{ destination_background_type: '{{ isset($sectionContent->destination_background_type) ? $sectionContent->destination_background_type : 'normal_v1_right_side_image' }}' }">
                        <div class="d-flex align-items-center gap-5 px-4 mb-3">
                            <div class="form-check p-0">
                                <input class="form-check-input" type="radio"
                                    name="content[destination_background_type]" id="destination_background_color"
                                    x-model="destination_background_type" name="content[destination_background_type]"
                                    value="background_color" />
                                <label class="form-check-label" for="destination_background_color">Background
                                    Color</label>
                            </div>
                            <div class="form-check p-0">
                                <input class="form-check-input" type="radio"
                                    name="content[destination_background_type]" id="destination_background_image_type"
                                    x-model="destination_background_type" name="content[destination_background_type]"
                                    value="background_image" />
                                <label class="form-check-label" for="destination_background_image_type">Background
                                    Image</label>
                            </div>
                        </div>
                        <div class="py-3" x-show="destination_background_type === 'background_color'">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-fields">
                                        <div class="title d-flex align-items-center gap-2">
                                            <div>Background Color <span class="text-danger">*</span>:</div>
                                            <a class="p-0 nav-link" href="//html-color-codes.info" target="_blank">Get
                                                Color Codes</a>
                                        </div>

                                        <div class="field color-picker" data-color-picker-container>
                                            <label for="color-picker" data-color-picker></label>
                                            <input id="color-picker" type="text"
                                                name="content[destination_background_color]" data-color-picker-input
                                                value="{{ $sectionContent->destination_background_color ?? 'transparent' }}"
                                                data-error="background Color" inputmode="text" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="py-3" x-show="destination_background_type === 'background_image'">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-fields">
                                        <label class="title">Background Image <span class="text-danger">*</span>
                                            :</label>
                                        <div class="upload upload--sm mx-0" data-upload>
                                            <div class="upload-box-wrapper">
                                                <div class="upload-box {{ empty($sectionContent->destination_background_image) ? 'show' : '' }}"
                                                    data-upload-box>
                                                    <input type="file" name="content[destination_background_image]"
                                                        {{ empty($sectionContent->destination_background_image) ? '' : '' }}
                                                        data-error="Feature Image" id="destination_background_image"
                                                        class="upload-box__file d-none" accept="image/*"
                                                        data-file-input>
                                                    <div class="upload-box__placeholder">
                                                        <i class="bx bxs-image"></i>
                                                    </div>
                                                    <label for="destination_background_image"
                                                        class="upload-box__btn themeBtn">Upload Image</label>
                                                </div>
                                                <div class="upload-box__img {{ !empty($sectionContent->destination_background_image) ? 'show' : '' }}"
                                                    data-upload-img>
                                                    <button type="button" class="delete-btn" data-delete-btn="">
                                                        <i class="bx bxs-edit-alt"></i>
                                                    </button>
                                                    <a href="{{ asset($sectionContent->destination_background_image ?? 'admin/assets/images/loading.webp') }}"
                                                        class="mask" data-fancybox="gallery">
                                                        <img src="{{ asset($sectionContent->destination_background_image ?? 'admin/assets/images/loading.webp') }}"
                                                            alt="Uploaded Image" class="imgFluid"
                                                            data-placeholder="{{ asset('admin/assets/images/loading.webp') }}"
                                                            data-upload-preview="" />
                                                    </a>
                                                    <input type="text"
                                                        name="content[destination_background_alt_text]" class="field"
                                                        placeholder="Enter alt text"
                                                        value="{{ $sectionContent->destination_background_alt_text ?? 'Destination Image' }}" />
                                                </div>
                                            </div>
                                            <div data-error-message class="text-danger mt-2 d-none text-center">
                                                Please upload a valid image file
                                            </div>
                                            <div class="dimensions text-center mt-3">
                                                <strong>Dimensions:</strong> 1350 &times; 390
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-fields">
                    <label class="title title--sm mb-2">Items Style:</label>
                    <div x-data="{ destination_style_type: '{{ isset($sectionContent->destination_style_type) ? $sectionContent->destination_style_type : 'normal' }}' }">
                        <div class="d-flex align-items-center gap-5 px-4">
                            <div class="form-check p-0">
                                <input class="form-check-input" type="radio" name="content[destination_style_type]"
                                    id="normal" x-model="destination_style_type"
                                    name="content[destination_style_type]" value="normal" checked />
                                <label class="form-check-label" for="normal">Normal (up to
                                    5)</label>
                            </div>
                            <div class="form-check p-0">
                                <input class="form-check-input" type="radio" name="content[destination_style_type]"
                                    id="carousel" x-model="destination_style_type"
                                    name="content[destination_style_type]" value="carousel" />
                                <label class="form-check-label" for="carousel">Slider Carousel
                                </label>
                            </div>
                        </div>
                        <div class="py-3 mt-2" x-show="destination_style_type === 'normal'">
                            <div class="form-fields">
                                <label class="title title--sm mb-2">Content Type:</label>
                                <div x-data="{ destination_content_type_normal: '{{ isset($sectionContent->destination_content_type_normal) ? $sectionContent->destination_content_type_normal : 'city' }}' }">
                                    <div class="d-flex align-items-center gap-5 px-4 mb-1">
                                        <div class="form-check p-0">
                                            <input class="form-check-input" type="radio"
                                                name="content[destination_content_type_normal]"
                                                id="destination_content_type_normal_2"
                                                x-model="destination_content_type_normal"
                                                name="content[destination_content_type_normal]" value="city" />
                                            <label class="form-check-label"
                                                for="destination_content_type_normal_2">Cities</label>
                                        </div>
                                        <div class="form-check p-0">
                                            <input class="form-check-input" type="radio"
                                                name="content[destination_content_type_normal]"
                                                id="destination_content_type_normal_3"
                                                x-model="destination_content_type_normal"
                                                name="content[destination_content_type_normal]" value="country" />
                                            <label class="form-check-label"
                                                for="destination_content_type_normal_3">Countries</label>
                                        </div>
                                        <div class="form-check p-0">
                                            <input class="form-check-input" type="radio"
                                                name="content[destination_content_type_normal]"
                                                id="destination_content_type_normal_1"
                                                x-model="destination_content_type_normal"
                                                name="content[destination_content_type_normal]" value="tour" />
                                            <label class="form-check-label"
                                                for="destination_content_type_normal_1">Tours</label>
                                        </div>
                                    </div>
                                    <div class="py-3" x-show="destination_content_type_normal === 'tour'">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-fields">
                                                    <label class="title">Select 5 Tours <span
                                                            class="text-danger">*</span> :</label>
                                                    @php
                                                        $normalSelectedToursIds =
                                                            $sectionContent &&
                                                            isset($sectionContent->destination_tour_ids_normal)
                                                                ? $sectionContent->destination_tour_ids_normal
                                                                : [];
                                                    @endphp
                                                    <select name="content[destination_tour_ids_normal][]" multiple
                                                        class="field select2-select" data-max-items="5"
                                                        placeholder="Select Tours" data-error="Tours">
                                                        @foreach ($tours as $item)
                                                            <option value="{{ $item->id }}"
                                                                {{ in_array($item->id, $normalSelectedToursIds) ? 'selected' : '' }}>
                                                                {{ $item->title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="py-3" x-show="destination_content_type_normal === 'city'">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-fields">
                                                    <label class="title">Select 5 Cities <span
                                                            class="text-danger">*</span> :</label>
                                                    @php
                                                        $normalSelectedCityIds =
                                                            $sectionContent &&
                                                            isset($sectionContent->destination_city_ids_normal)
                                                                ? $sectionContent->destination_city_ids_normal
                                                                : [];
                                                    @endphp
                                                    <select name="content[destination_city_ids_normal][]" multiple
                                                        class="field select2-select" data-max-items="5"
                                                        placeholder="Select Cities" data-error="Cities">
                                                        @foreach ($cities->sortByDesc('tours_count') as $item)
                                                            <option data-choice value="{{ $item->id }}"
                                                                {{ in_array($item->id, $normalSelectedCityIds) ? 'selected' : '' }}>
                                                                {{ $item->name }}
                                                                ({{ $item->tours_count > 0 ? $item->tours_count . ' ' . ($item->tours_count === 1 ? 'tour' : 'tours') . ' available' : 'No tours available' }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="py-3" x-show="destination_content_type_normal === 'country'">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-fields">
                                                    <label class="title">Select 5 Countries <span
                                                            class="text-danger">*</span> :</label>
                                                    @php
                                                        $normalSelectedCountryIds =
                                                            $sectionContent &&
                                                            isset($sectionContent->destination_country_ids_normal)
                                                                ? $sectionContent->destination_country_ids_normal
                                                                : [];
                                                    @endphp
                                                    <select name="content[destination_country_ids_normal][]" multiple
                                                        class="field select2-select" data-max-items="5"
                                                        placeholder="Select Countries" data-error="Countries">
                                                        @foreach ($countries as $item)
                                                            <option value="{{ $item->id }}"
                                                                {{ in_array($item->id, $normalSelectedCountryIds) ? 'selected' : '' }}>
                                                                {{ $item->name }}
                                                                ({{ $item->toursCount() > 0 ? $item->toursCount() . ' ' . ($item->toursCount() === 1 ? 'tour' : 'tours') . ' available' : 'No tours available' }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="py-3 mt-2" x-show="destination_style_type === 'carousel'">
                            <div class="form-fields">
                                <label class="title title--sm mb-2">Content Type:</label>
                                <div x-data="{ destination_content_type_carousel: '{{ isset($sectionContent->destination_content_type_carousel) ? $sectionContent->destination_content_type_carousel : 'city' }}' }">
                                    <div class="d-flex align-items-center gap-5 px-4 mb-1">
                                        <div class="form-check p-0">
                                            <input class="form-check-input" type="radio"
                                                name="content[destination_content_type_carousel]"
                                                id="destination_content_type_carousel_2"
                                                x-model="destination_content_type_carousel"
                                                name="content[destination_content_type_carousel]" value="city" />
                                            <label class="form-check-label"
                                                for="destination_content_type_carousel_2">Cities</label>
                                        </div>
                                        <div class="form-check p-0">
                                            <input class="form-check-input" type="radio"
                                                name="content[destination_content_type_carousel]"
                                                id="destination_content_type_carousel_3"
                                                x-model="destination_content_type_carousel"
                                                name="content[destination_content_type_carousel]" value="country" />
                                            <label class="form-check-label"
                                                for="destination_content_type_carousel_3">Countries</label>
                                        </div>
                                        <div class="form-check p-0">
                                            <input class="form-check-input" type="radio"
                                                name="content[destination_content_type_carousel]"
                                                id="destination_content_type_carousel_1"
                                                x-model="destination_content_type_carousel"
                                                name="content[destination_content_type_carousel]" value="tour" />
                                            <label class="form-check-label"
                                                for="destination_content_type_carousel_1">Tours</label>
                                        </div>
                                    </div>
                                    <div class="py-3" x-show="destination_content_type_carousel === 'tour'">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-fields">
                                                    <label class="title">Select Tours <span
                                                            class="text-danger">*</span>
                                                        :</label>
                                                    @php
                                                        $carouselSelectedTourIds =
                                                            $sectionContent &&
                                                            isset($sectionContent->destination_tour_ids_carousel)
                                                                ? $sectionContent->destination_tour_ids_carousel
                                                                : [];
                                                    @endphp
                                                    <select name="content[destination_tour_ids_carousel][]" multiple
                                                        class="field select2-select" placeholder="Select Tours"
                                                        data-error="Tours">
                                                        @foreach ($tours as $item)
                                                            <option value="{{ $item->id }}"
                                                                {{ in_array($item->id, $carouselSelectedTourIds) ? 'selected' : '' }}>
                                                                {{ $item->title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="py-3" x-show="destination_content_type_carousel === 'city'">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-fields">
                                                    <label class="title">Select Cities <span
                                                            class="text-danger">*</span>
                                                        :</label>
                                                    @php
                                                        $carouselSelectedCityIds =
                                                            $sectionContent &&
                                                            isset($sectionContent->destination_city_ids_carousel)
                                                                ? $sectionContent->destination_city_ids_carousel
                                                                : [];
                                                    @endphp
                                                    <select name="content[destination_city_ids_carousel][]" multiple
                                                        class="field select2-select" placeholder="Select Cities"
                                                        data-error="Cities">
                                                        @foreach ($cities->sortByDesc('tours_count') as $item)
                                                            <option value="{{ $item->id }}"
                                                                {{ in_array($item->id, $carouselSelectedCityIds) ? 'selected' : '' }}>
                                                                {{ $item->name }}
                                                                ({{ $item->tours_count > 0 ? $item->tours_count . ' ' . ($item->tours_count === 1 ? 'tour' : 'tours') . ' available' : 'No tours available' }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="py-3" x-show="destination_content_type_carousel === 'country'">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-fields">
                                                    <label class="title">Select Countries <span
                                                            class="text-danger">*</span> :</label>
                                                    @php
                                                        $carouselSelectedCountryIds =
                                                            $sectionContent &&
                                                            isset($sectionContent->destination_country_ids_carousel)
                                                                ? $sectionContent->destination_country_ids_carousel
                                                                : [];
                                                    @endphp
                                                    <select name="content[destination_country_ids_carousel][]" multiple
                                                        class="field select2-select" placeholder="Select Countries"
                                                        data-error="Countries">
                                                        @foreach ($countries as $item)
                                                            <option value="{{ $item->id }}"
                                                                {{ in_array($item->id, $carouselSelectedCountryIds) ? 'selected' : '' }}>
                                                                {{ $item->name }}
                                                                ({{ $item->toursCount() > 0 ? $item->toursCount() . ' ' . ($item->toursCount() === 1 ? 'tour' : 'tours') . ' available' : 'No tours available' }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
