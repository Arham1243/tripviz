@php
    $sectionContent = $pageSection ? json_decode($pageSection->content) : null;
    $newsListIdsCheck = $sectionContent ? isset($sectionContent->news_list_ids) : [];
    $newsListIds = $newsListIdsCheck ? $sectionContent->news_list_ids : [];
@endphp

<div class="row">
    <div class="col-lg-12 mb-4 pt-3">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="form-fields">
                    <label class="title">Title<span class="text-danger">*</span> :</label>
                    <input type="text" name="content[title]" class="field" placeholder=""
                        value="{{ $sectionContent->title ?? '' }}" data-error="Destination Title" maxlength="60">
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
                            value="{{ $sectionContent->title_text_color ?? '#000000' }}" inputmode="text" />
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-fields">
                    <label class="title">Sub Title<span class="text-danger">*</span> :</label>
                    <input type="text" name="content[subTitle]" class="field" placeholder=""
                        value="{{ $sectionContent->subTitle ?? '' }}" maxlength="55">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-fields">
                    <div class="title d-flex align-items-center gap-2">
                        <div>
                            sub Title Text Color <span class="text-danger">*</span>:
                        </div>
                        <a class="p-0 nav-link" href="//html-color-codes.info" target="_blank">Get Color
                            Codes</a>
                    </div>
                    <div class="field color-picker" data-color-picker-container>
                        <label for="color-picker" data-color-picker></label>
                        <input id="color-picker" type="text" name="content[subTitle_text_color]"
                            data-color-picker-input value="{{ $sectionContent->subTitle_text_color ?? '#000000' }}"
                            inputmode="text" />
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
            <label class="title title--sm">Read More Button:</label>
            <div class="row mt-2">
                <div class="col-lg-12 mb-4">
                    <div class="form-fields">
                        <label class="title">Button Text <span class="text-danger">*</span> :</label>
                        <input type="text" value="{{ $sectionContent->btn_text ?? '' }}" name="content[btn_text]"
                            class="field" placeholder="" data-error="Button Text" maxlength="33" />
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-fields">
                        <div class="title d-flex align-items-center gap-2">
                            <div>Button Background Color <span class="text-danger">*</span>:</div>
                            <a class="p-0 nav-link" href="//html-color-codes.info" target="_blank">Get Color Codes</a>
                        </div>
                        <div class="field color-picker" data-color-picker-container>
                            <label for="color-picker" data-color-picker></label>
                            <input id="color-picker" type="text" name="content[btn_background_color]"
                                data-color-picker-input value="{{ $sectionContent->btn_background_color ?? '#000000' }}"
                                data-error="background Color" inputmode="text" />
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-fields">
                        <div class="title d-flex align-items-center gap-2">
                            <div>Button Text Color <span class="text-danger">*</span>:</div>
                            <a class="p-0 nav-link" href="//html-color-codes.info" target="_blank">Get Color Codes</a>
                        </div>
                        <div class="field color-picker" data-color-picker-container>
                            <label for="color-picker" data-color-picker></label>
                            <input id="color-picker" type="text" name="content[btn_text_color]"
                                data-color-picker-input value="{{ $sectionContent->btn_text_color ?? '#000000' }}"
                                data-error="background Color" inputmode="text" />
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
            <label class="title title--sm">News:</label>
            <div class="row mt-2">
                <div class="col-lg-6">
                    <div class="form-fields">
                        <label class="title">Select featured News <span class="text-danger">*</span> :</label>
                        <select data-max-items="1" name="content[featured_news_id]" multiple
                            class="field select2-select" placeholder="Select">
                            @foreach ($news as $item)
                                <option value="{{ $item->id }}"
                                    {{ $sectionContent && isset($sectionContent->featured_news_id) && $item->id == $sectionContent->featured_news_id ? 'selected' : '' }}>
                                    {{ $item->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-fields">
                        <label class="title">Select 3 News <span class="text-danger">*</span> :</label>
                        <select data-max-items="3" name="content[news_list_ids][]" multiple
                            class="field select2-select" placeholder="Select">
                            @foreach ($news as $item)
                                <option value="{{ $item->id }}"
                                    {{ in_array($item->id, $newsListIds) ? 'selected' : '' }}>
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
