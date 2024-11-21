@php
    $sectionContent = $pageSection ? json_decode($pageSection->content) : null;
@endphp
<div class="row" x-data="{ no_of_items: '{{ isset($sectionContent->no_of_items) ? $sectionContent->no_of_items ?? '1' : '1' }}' }">
    <div class="col-md-12 pt-3 pb-2">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="form-fields">
                    <label class="title">Title<span class="text-danger">*</span> :</label>
                    <input type="text" name="content[title]" class="field" placeholder=""
                        value="{{ $sectionContent->title ?? '' }}" data-error="Destination Title">
                </div>
            </div>
            <div class="col-md-6 mb-4">
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
                        <input id="color-picker" type="text" name="content[title_text_color]" data-color-picker-input
                            value="{{ $sectionContent->title_text_color ?? '#000000' }}" data-error="background Color"
                            inputmode="text" />
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="form-fields">
                    <label class="title">No. of items <span class="text-danger">*</span> :</label>
                    <input type="number" min="1" x-model="no_of_items" name="content[no_of_items]"
                        class="field" placeholder="" data-error="Number of Items"
                        oninput="this.value = this.value <= 0 ? 1 : this.value">
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
                        <input id="color-picker" type="text" name="content[background_color]" data-color-picker-input
                            value="{{ $sectionContent->background_color ?? '' }}" placeholder="#000000"
                            data-error="background Color" inputmode="text">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-fields">
                    <label class="title title--sm mb-3">Content Type:</label>
                    <div x-data="{ content_type: '{{ isset($sectionContent->content_type) ? $sectionContent->content_type : 'city' }}' }">
                        <div class="d-flex align-items-center gap-5 px-4 mb-1">
                            <div class="form-check p-0">
                                <input class="form-check-input" type="radio" name="content[content_type]"
                                    id="content_type_2" x-model="content_type" name="content[content_type]"
                                    value="city" />
                                <label class="form-check-label" for="content_type_2">Cities</label>
                            </div>
                            <div class="form-check p-0">
                                <input class="form-check-input" type="radio" name="content[content_type]"
                                    id="content_type_3" x-model="content_type" name="content[content_type]"
                                    value="country" />
                                <label class="form-check-label" for="content_type_3">Countries</label>
                            </div>
                            <div class="form-check p-0">
                                <input class="form-check-input" type="radio" name="content[content_type]"
                                    id="content_type_1" x-model="content_type" name="content[content_type]"
                                    value="category" />
                                <label class="form-check-label" for="content_type_1">Categories</label>
                            </div>
                        </div>
                        <div class="py-3" x-show="content_type === 'category'">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-fields">
                                        <label class="title">Select <span x-text="no_of_items" class="px-1"> </span>
                                            Categories <span class="text-danger">*</span>
                                            :</label>
                                        @php
                                            $normalSelectedCategoriesIds =
                                                $sectionContent && isset($sectionContent->category_ids)
                                                    ? $sectionContent->category_ids
                                                    : [];
                                        @endphp
                                        <select name="content[category_ids][]" multiple class="field select2-select"
                                            placeholder="Select Categories" data-error="Categories">
                                            @foreach ($tourCategories as $item)
                                                <option data-choice value="{{ $item->id }}"
                                                    {{ in_array($item->id, $normalSelectedCategoriesIds) ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                    ({{ $item->tours_count > 0 ? $item->tours_count . ' ' . ($item->tours_count === 1 ? 'tour' : 'tours') . ' available' : 'No tours available' }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="py-3" x-show="content_type === 'city'">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-fields">
                                        <label class="title">Select <span x-text="no_of_items" class="px-1">
                                            </span> Cities <span class="text-danger">*</span>
                                            :</label>
                                        @php
                                            $normalSelectedCityIds =
                                                $sectionContent && isset($sectionContent->city_ids)
                                                    ? $sectionContent->city_ids
                                                    : [];
                                        @endphp
                                        <select name="content[city_ids][]" multiple class="field select2-select"
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
                        <div class="py-3" x-show="content_type === 'country'">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-fields">
                                        <label class="title">Select <span x-text="no_of_items" class="px-1">
                                            </span> Countries <span class="text-danger">*</span>
                                            :</label>
                                        @php
                                            $normalSelectedCountryIds =
                                                $sectionContent && isset($sectionContent->country_ids)
                                                    ? $sectionContent->country_ids
                                                    : [];
                                        @endphp
                                        <select name="content[country_ids][]" multiple class="field select2-select"
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
        </div>
    </div>
</div>
