@php
    $sectionContent = $pageSection ? json_decode($pageSection->content) : null;
    $customTourIdsCheck = $sectionContent ? isset($sectionContent->custom_tour_ids) : [];
    $customTourIds = $customTourIdsCheck ? $sectionContent->custom_tour_ids : [];
@endphp
<div class="row" x-data="{ no_of_items: '{{ $sectionContent->no_of_items ?? '1' }}' }">
    <div class="col-md-6 mb-3">
        <div class="form-fields">
            <label class="title">Title <span class="text-danger">*</span> :</label>
            <input type="text" name="content[title]" class="field" placeholder="" data-error="Title"
                value="{{ $sectionContent->title ?? '' }}" maxlength="40">
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="form-fields">
            <div class="title d-flex align-items-center gap-2">
                <div>Title Text Color <span class="text-danger">*</span>:</div>
                <a class="p-0 nav-link" href="//html-color-codes.info" target="_blank">Get
                    Color
                    Codes</a>
            </div>
            <div class="field color-picker" data-color-picker-container>
                <label for="color-picker" data-color-picker></label>
                <input id="color-picker" type="text" name="content[title_color]" data-color-picker-input
                    value="{{ $sectionContent->title_color ?? '#000000' }}" data-error="background Color"
                    inputmode="text">
            </div>
        </div>
    </div>
    <div class="col-md-12 mb-3">
        <div class="form-fields">
            <label class="title">Description <span class="text-danger">*</span> :</label>
            <textarea maxlength="80" name="content[description]" class="field" data-error="Description" rows="2">{{ $sectionContent->description ?? '' }}</textarea>
        </div>
    </div>
    <div class="col-md-12 mb-3">
        <div class="form-fields">
            <label class="title">No. of items <span class="text-danger">*</span> :</label>
            <input type="number" min="1" x-model="no_of_items" name="content[no_of_items]" class="field"
                placeholder="" data-error="Number of Items" oninput="this.value = this.value <= 0 ? 1 : this.value">
        </div>
    </div>
    <div class="col-12">
        <hr />
    </div>
    <div class="col-lg-12 mb-4 pt-3">
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="form-fields">
                    <div class="d-flex align-items-center gap-3">
                        <label class="title title--sm mb-0">More Button:</label>
                        <div class="form-check form-switch" data-enabled-text="Enabled" data-disabled-text="Disabled">
                            <input class="form-check-input" data-toggle-switch=""
                                {{ isset($sectionContent->is_more_btn_enabled) ? 'checked' : '' }} type="checkbox"
                                id="enable-section-more-btn" value="1" name="content[is_more_btn_enabled]">
                            <label class="form-check-label" for="enable-section-more-btn">Enabled</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="form-fields">
                    <label class="title">button text <span class="text-danger">*</span> :</label>
                    <input type="text" value="{{ $sectionContent->see_more_text ?? '' }}"
                        name="content[see_more_text]" class="field" placeholder="" data-error="View More Text">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-fields">
                    <div class="title d-flex align-items-center gap-2">
                        <div>
                            Select Button Background Color <span class="text-danger">*</span>:
                        </div>
                        <a class="p-0 nav-link" href="//html-color-codes.info" target="_blank">Get Color
                            Codes</a>
                    </div>
                    <div class="field color-picker" data-color-picker-container>
                        <label for="color-picker" data-color-picker></label>
                        <input id="color-picker" type="text" name="content[see_more_background_color]"
                            data-color-picker-input
                            value="{{ $sectionContent->see_more_background_color ?? '#ffffff' }}" placeholder="#000000"
                            data-error="background Color" inputmode="text" />
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-fields">
                    <div class="title d-flex align-items-center gap-2">
                        <div>
                            Select Button Text Color <span class="text-danger">*</span>:
                        </div>
                        <a class="p-0 nav-link" href="//html-color-codes.info" target="_blank">Get Color
                            Codes</a>
                    </div>
                    <div class="field color-picker" data-color-picker-container>
                        <label for="color-picker" data-color-picker></label>
                        <input id="color-picker" type="text" name="content[see_more_text_color]"
                            data-color-picker-input value="{{ $sectionContent->see_more_text_color ?? '#1c4d99' }}"
                            placeholder="#000000" data-error="background Color" inputmode="text" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <hr />
    </div>
    <div class="col-lg-12 mb-4 pt-3">
        <div class="form-fields">
            <label class="title title--sm mb-3">Box Style:</label>
            <div x-data="{ box_type: '{{ isset($sectionContent->box_type) ? $sectionContent->box_type : 'nomral' }}' }">
                <div class="d-flex align-items-center gap-5 px-4">
                    <div class="form-check p-0">
                        <input class="form-check-input" type="radio" name="content[box_type]" id="nomral"
                            x-model="box_type" name="content[box_type]" value="nomral" checked />
                        <label class="form-check-label" for="nomral">Normal</label>
                    </div>
                    <div class="form-check p-0">
                        <input class="form-check-input" type="radio" name="content[box_type]" id="slider_carousel"
                            x-model="box_type" name="content[box_type]" value="slider_carousel" />
                        <label class="form-check-label" for="slider_carousel">Slider Carousel</label>
                    </div>
                    <div class="form-check p-0">
                        <input class="form-check-input" type="radio" name="content[box_type]"
                            id="normal_with_background_color" x-model="box_type" name="content[box_type]"
                            value="normal_with_background_color" />
                        <label class="form-check-label" for="normal_with_background_color">Normal (with
                            background)</label>
                    </div>
                    <div class="form-check p-0">
                        <input class="form-check-input" type="radio" name="content[box_type]"
                            id="slider_carousel_with_background_color" x-model="box_type" name="content[box_type]"
                            value="slider_carousel_with_background_color" />
                        <label class="form-check-label" for="slider_carousel_with_background_color">Slider Carousel
                            (with background)</label>
                    </div>
                </div>
                <div x-show="box_type === 'normal_with_background_color'">
                    <div class="row pt-4">
                        <div class="col-md-12">
                            <div class="form-fields">
                                <div class="title d-flex align-items-center gap-2">
                                    <div>
                                        Select Background Color <span class="text-danger">*</span>:
                                    </div>
                                    <a class="p-0 nav-link" href="//html-color-codes.info" target="_blank">Get Color
                                        Codes</a>
                                </div>

                                <div class="field color-picker" data-color-picker-container>
                                    <label for="color-picker" data-color-picker></label>
                                    <input id="color-picker" type="text" name="content[normal_background_color]"
                                        data-color-picker-input
                                        value="{{ $sectionContent->normal_background_color ?? '' }}"
                                        placeholder="#000000" data-error="background Color" inputmode="text" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div x-show="box_type === 'slider_carousel_with_background_color'">
                    <div class="row pt-4">
                        <div class="col-md-12">
                            <div class="form-fields">
                                <div class="title d-flex align-items-center gap-2">
                                    <div>
                                        Select Background Color <span class="text-danger">*</span>:
                                    </div>
                                    <a class="p-0 nav-link" href="//html-color-codes.info" target="_blank">Get Color
                                        Codes</a>
                                </div>

                                <div class="field color-picker" data-color-picker-container>
                                    <label for="color-picker" data-color-picker></label>
                                    <input id="color-picker" type="text"
                                        name="content[slider_carousel_background_color]" data-color-picker-input
                                        value="{{ $sectionContent->slider_carousel_background_color ?? '' }}"
                                        placeholder="#000000" data-error="background Color" inputmode="text" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <hr />
    </div>
    <div class="col-lg-12 mb-4 pt-3">
        <div class="form-fields">
            <label class="title title--sm mb-3">Select style :</label>
            <div x-data="{ card_style: '{{ isset($sectionContent->card_style) ? $sectionContent->card_style : 'nomral' }}' }">
                <div class="d-flex align-items-center gap-5 px-4">
                    <div class="form-check p-0 ps-1">
                        <input class="form-check-input" type="radio" name="content[card_style]" id="style-1"
                            name="content[card_style]"
                            {{ isset($sectionContent->card_style) ? ($sectionContent->card_style === 'style-1' ? 'checked' : '') : '' }}
                            value="style-1" checked />
                        <label class="form-check-label d-flex align-items-center gap-2" for="style-1">Style 1 <a
                                href="{{ asset('admin/assets/images/tours-blocks/1.jpg') }}" data-fancybox="gallery"
                                title="section preview"
                                class="themeBtn section-preview-image section-preview-image--sm"><i
                                    class='bx bxs-show'></i></a></label>
                    </div>
                    <div class="form-check p-0 ps-1">
                        <input class="form-check-input" type="radio" name="content[card_style]" id="style-2"
                            name="content[card_style]"
                            {{ isset($sectionContent->card_style) ? ($sectionContent->card_style === 'style-2' ? 'checked' : '') : '' }}
                            value="style-2" />
                        <label class="form-check-label d-flex align-items-center gap-2" for="style-2">Style 2 <a
                                href="{{ asset('admin/assets/images/tours-blocks/2.jpg') }}" data-fancybox="gallery"
                                title="section preview"
                                class="themeBtn section-preview-image section-preview-image--sm"><i
                                    class='bx bxs-show'></i></a></label>
                    </div>
                    <div class="form-check p-0 ps-1">
                        <input class="form-check-input" type="radio" name="content[card_style]" id="style-3"
                            name="content[card_style]"
                            {{ isset($sectionContent->card_style) ? ($sectionContent->card_style === 'style-3' ? 'checked' : '') : '' }}
                            value="style-3" />
                        <label class="form-check-label d-flex align-items-center gap-2" for="style-3">Style 3 <a
                                href="{{ asset('admin/assets/images/tours-blocks/3.jpg') }}" data-fancybox="gallery"
                                title="section preview"
                                class="themeBtn section-preview-image section-preview-image--sm"><i
                                    class='bx bxs-show'></i></a></label>
                    </div>
                    <div class="form-check p-0 ps-1">
                        <input class="form-check-input" type="radio" name="content[card_style]" id="style-4"
                            name="content[card_style]"
                            {{ isset($sectionContent->card_style) ? ($sectionContent->card_style === 'style-4' ? 'checked' : '') : '' }}
                            value="style-4" />
                        <label class="form-check-label d-flex align-items-center gap-2" for="style-4">Style 4 <a
                                href="{{ asset('admin/assets/images/tours-blocks/4.jpg') }}" data-fancybox="gallery"
                                title="section preview"
                                class="themeBtn section-preview-image section-preview-image--sm"><i
                                    class='bx bxs-show'></i></a></label>
                    </div>
                    <div class="form-check p-0 ps-1">
                        <input class="form-check-input" type="radio" name="content[card_style]" id="style-5"
                            name="content[card_style]"
                            {{ isset($sectionContent->card_style) ? ($sectionContent->card_style === 'style-5' ? 'checked' : '') : '' }}
                            value="style-5" />
                        <label class="form-check-label d-flex align-items-center gap-2" for="style-5">Style 5 <a
                                href="{{ asset('admin/assets/images/tours-blocks/5.jpg') }}" data-fancybox="gallery"
                                title="section preview"
                                class="themeBtn section-preview-image section-preview-image--sm"><i
                                    class='bx bxs-show'></i></a></label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <hr />
    </div>
    <div class="col-lg-12 mb-3 pt-3">
        <div class="form-fields">
            <label class="title title--sm mb-3">Filters:</label>
            <div x-data="{ filter_type: '{{ isset($sectionContent->filter_type) ? $sectionContent->filter_type : 'filters' }}' }">
                <div class="d-flex align-items-center gap-5 px-4 mb-3">
                    <div class="form-check p-0">
                        <input class="form-check-input" type="radio" name="content[filter_type]" id="filters"
                            x-model="filter_type" name="content[filter_type]" value="filters" checked />
                        <label class="form-check-label" for="filters">Filters</label>
                    </div>
                    <div class="form-check p-0">
                        <input class="form-check-input" type="radio" name="content[filter_type]" id="custom"
                            x-model="filter_type" name="content[filter_type]" value="custom" />
                        <label class="form-check-label" for="custom">Custom</label>
                    </div>
                </div>
                <div x-show="filter_type === 'filters'">
                    <div class="row pt-1 pb-2">
                        <div class="col-md-6">
                            <div class="form-fields">
                                <div class="title">Filter by Category <span class="text-danger">*</span> :</div>
                                <select multiple data-max-items="1" name="content[filter_category_id]"
                                    class="field select2-select" placeholder="Select Category" data-error="Category">
                                    @foreach ($tourCategories as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $sectionContent && isset($sectionContent->filter_category_id) && $item->id == $sectionContent->filter_category_id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                            ({{ $item->tours_count > 0 ? $item->tours_count . ' ' . ($item->tours_count === 1 ? 'tour' : 'tours') . ' available' : 'No tours available' }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-fields">
                                <div class="title">Filter by Location <span class="text-danger">*</span> :</div>
                                <select multiple data-max-items="1" name="content[filter_city_id]"
                                    class="field select2-select" placeholder="Select Location" data-error="Location">
                                    @foreach ($cities as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $sectionContent && isset($sectionContent->filter_city_id) && $item->id == $sectionContent->filter_city_id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                            ({{ $item->tours_count > 0 ? $item->tours_count . ' ' . ($item->tours_count === 1 ? 'tour' : 'tours') . ' available' : 'No tours available' }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div x-show="filter_type === 'custom'">
                    <div class="row pt-1 pb-2">
                        <div class="col-md-12">
                            <div class="form-fields">
                                <label class="title">Select <span x-text="no_of_items" class="px-1"> </span> Tours
                                    <span class="text-danger">*</span> :</label>
                                <select name="content[custom_tour_ids][]" multiple class="field select2-select"
                                    placeholder="Select Tours" data-error="Tours">
                                    @foreach ($tours as $item)
                                        <option value="{{ $item->id }}"
                                            {{ in_array($item->id, $customTourIds) ? 'selected' : '' }}>
                                            {{ $item->title }}
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
    <div class="col-12">
        <hr />
    </div>
    <div class="col-lg-12 mb-2 pt-3">
        <div class="form-fields">
            <label class="title title--sm mb-3">Order By:</label>
            <div x-data="{ order_by: '{{ isset($sectionContent->order_by) ? $sectionContent->order_by : 'latest' }}' }">
                <div class="d-flex align-items-center gap-5 px-4 mb-3">
                    <div class="form-check p-0">
                        <input class="form-check-input" type="radio" name="content[order_by]" id="order_by_latest"
                            x-model="order_by" value="latest" checked />
                        <label class="form-check-label" for="order_by_latest">Sort by Latest</label>
                    </div>
                    <div class="form-check p-0">
                        <input class="form-check-input" type="radio" name="content[order_by]" id="order_by_title"
                            x-model="order_by" value="title" />
                        <label class="form-check-label" for="order_by_title">Sort by Title (A to Z)</label>
                    </div>
                    <div class="form-check p-0">
                        <input class="form-check-input" type="radio" name="content[order_by]"
                            id="order_by_price_low_to_high" x-model="order_by" value="price_low_to_high" />
                        <label class="form-check-label" for="order_by_price_low_to_high">Sort by Price (Low to
                            High)</label>
                    </div>
                    <div class="form-check p-0">
                        <input class="form-check-input" type="radio" name="content[order_by]"
                            id="order_by_price_high_to_low" x-model="order_by" value="price_high_to_low" />
                        <label class="form-check-label" for="order_by_price_high_to_low">Sort by Price (High to
                            Low)</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <hr />
    </div>
    <div class="col-12  mb-4 pt-3">
        <div class="form-fields">
            <div class="title title--sm mb-0">Featured Items:</div>
        </div>
        <div class="form-fields">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="content[show_only_featured_items]"
                    id="show_only_featured_items" value="1"
                    {{ isset($sectionContent->show_only_featured_items) ? 'checked' : '' }}>
                <label class="form-check-label" for="show_only_featured_items">
                    Show only featured items
                </label>
            </div>
        </div>
    </div>
</div>
