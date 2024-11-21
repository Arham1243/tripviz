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
            <div class="col-lg-6 mb-4">
                <div class="form-fields">
                    <label class="title">Sub Title
                        <span class="text-danger">*</span> :</label>
                    <input type="text" name="content[destination_subtitle]" class="field" placeholder=""
                        value="{{ $sectionContent->destination_subtitle ?? '' }}" data-error="Destination Sub Title">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-fields">
                    <div class="title d-flex align-items-center gap-2">
                        <div>
                            Sub Title Text Color <span class="text-danger">*</span>:
                        </div>
                        <a class="p-0 nav-link" href="//html-color-codes.info" target="_blank">Get Color
                            Codes</a>
                    </div>
                    <div class="field color-picker" data-color-picker-container>
                        <label for="color-picker" data-color-picker></label>
                        <input id="color-picker" type="text" name="content[destination_subtitle_text_color]"
                            data-color-picker-input
                            value="{{ $sectionContent->destination_subtitle_text_color ?? '#000000' }}"
                            data-error="background Color" inputmode="text" />
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="form-fields">
                    <div class="title d-flex align-items-center gap-2">
                        <div>Background Color <span class="text-danger">*</span>:</div>
                        <a class="p-0 nav-link" href="//html-color-codes.info" target="_blank">Get
                            Color
                            Codes</a>
                    </div>

                    <div class="field color-picker" data-color-picker-container>
                        <label for="color-picker" data-color-picker></label>
                        <input id="color-picker" type="text" name="content[destination_background_color]"
                            data-color-picker-input value="{{ $sectionContent->destination_background_color ?? '' }}"
                            placeholder="#000000" data-error="background Color" inputmode="text">
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
