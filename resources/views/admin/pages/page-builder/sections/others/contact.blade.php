@php
    $sectionContent = $pageSection ? json_decode($pageSection->content) : null;
@endphp
<div class="row">
    <div class="col-lg-12 mb-4 Contact Details-3">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="form-fields">
                    <label class="title">Title<span class="text-danger">*</span> :</label>
                    <input type="text" name="content[title]" class="field" placeholder=""
                        value="{{ $sectionContent->title ?? '' }}">
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
            <div class="col-md-12">
                <div class="form-fields">
                    <div class="d-flex align-items-center gap-2 lh-1 mb-2">
                        <div class="title mb-0">Sub Title <span class="text-danger">*</span>:</div>
                        <button data-bs-placement="top"
                            title="
                    <div class='d-flex flex-column'>
<div class='d-flex gap-1'><span>Press ctrl + b for bold:</span> <b>Text</b></div>
<div class='d-flex gap-1'><span>Press ctrl + i for italic:</span> <i>Text</i></div>
<div class='d-flex gap-1'><span>Press ctrl + u for italic:</span> <u>Text</u></div>
"
                            type="button" data-tooltip="tooltip" class="tooltip-lg">
                            <i class='bx bxs-info-circle'></i>
                        </button>
                    </div>
                    <div data-editable-field>
                        <input type="hidden" data-editable-field-input value="{{ $sectionContent->subTitle ?? '' }}"
                            name="content[subTitle]">
                        <div data-editable-field-element class="field custom-editor" contenteditable="true"
                            oninput="syncToInput(this)" onkeydown="handleShortcuts(event)" onpaste="handlePaste(event)">
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
            <label class="title title--sm">Contact Details:</label>
            <div class="row mt-3">
                <div class="col-lg-6">
                    <div class="form-fields">
                        <label class="title">Email<span class="text-danger">*</span> :</label>
                        <input type="text" name="content[email]" class="field" placeholder=""
                            value="{{ $sectionContent->email ?? '' }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-fields">
                        <label class="title">Phone<span class="text-danger">*</span> :</label>
                        <input type="text" name="content[phone]" class="field" placeholder=""
                            value="{{ $sectionContent->phone ?? '' }}">
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
            <label class="title title--sm">Social Media:</label>

            @php
                $socialMedia = isset($sectionContent->social)
                    ? json_decode(json_encode($sectionContent->social), true)
                    : [['icon' => '', 'url' => '']];

                $socialMediaItems = [];
                if (isset($socialMedia['icon']) && isset($socialMedia['url'])) {
                    foreach ($socialMedia['icon'] as $index => $icon) {
                        $socialMediaItems[] = [
                            'icon' => $icon,
                            'url' => $socialMedia['url'][$index] ?? '',
                        ];
                    }
                } else {
                    $socialMediaItems = $socialMedia;
                }
            @endphp

            <div x-data="repeater({{ json_encode($socialMediaItems) }}, { icon: '', url: '' }, 3)" class="repeater-table">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">
                                <div class="d-flex align-items-center gap-2"> Icon
                                    <a class="p-0 nav-link" href="//boxicons.com" target="_blank">Boxicons</a>
                                </div>

                            </th>
                            <th scope="col">Url</th>
                            <th class="text-end" scope="col">Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="(item, index) in items" :key="index">
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <input placeholder="bx bxl-facebook-circle" type="text" class="field"
                                            name="content[social][icon][]" x-model="item.icon"
                                            oninput="showIcon(this)" />
                                        <i style="font-size: 1.85rem" :class="item.icon ?? 'bx bxl-facebook-circle'"
                                            data-preview-icon></i>
                                    </div>
                                </td>
                                <td>
                                    <input placeholder="https://www.facebook.com/" type="url" class="field"
                                        name="content[social][url][]" x-model="item.url" />
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
                <button type="button" x-show="items.length < maxItems" type="button" class="themeBtn ms-auto"
                    @click="addItem">
                    Add<i class="bx bx-plus"></i>
                </button>
            </div>
        </div>
    </div>
</div>
