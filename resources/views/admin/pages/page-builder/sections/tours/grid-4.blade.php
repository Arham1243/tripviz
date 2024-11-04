@php
    $sectionContent = $pageSection ? json_decode($pageSection->content) : null;
    $tourIds = $sectionContent ? $sectionContent->tour_ids : [];
@endphp
<div class="row">
    <div class="col-lg-12 mb-3">
        <div class="form-fields">
            <label class="title">Section Heading <span class="text-danger">*</span> :</label>
            <input type="text" name="content[heading]" class="field" placeholder="" data-required data-error="Heading"
                value="{{ $sectionContent->heading ?? '' }}">
        </div>
    </div>
    <div class="col-lg-6 mb-3">
        <div class="form-fields">
            <label class="title">View More Text <span class="text-danger">*</span> :</label>
            <input type="text" value="{{ $sectionContent->see_more_text ?? '' }}" name="content[see_more_text]"
                class="field" placeholder="" data-required data-error="View More Text">
        </div>
    </div>
    <div class="col-lg-6 mb-3">
        <div class="form-fields">
            <label class="title">View More Link <span class="text-danger">*</span> :</label>
            <input type="text" value="{{ $sectionContent->see_more_link ?? '' }}" name="content[see_more_link]"
                class="field" placeholder="" data-required data-error="View More Link">
        </div>
    </div>
    <div class="col-lg-12">
        <div class="form-fields">
            <label class="title">Select 4 Tours <span class="text-danger">*</span> :</label>
            <select name="content[tour_ids][]" multiple class="field choice-select" data-max-items="4"
                placeholder="Select Tours" data-required data-error="Tours">
                @foreach ($tours as $item)
                    <option value="{{ $item->id }}" {{ in_array($item->id, $tourIds) ? 'selected' : '' }}>
                        {{ $item->title }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>
