@php
    $sectionContent = $pageSection ? json_decode($pageSection->content) : null;
    $cityIds = $sectionContent ? $sectionContent->city_ids : [];
@endphp
<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="form-fields">
            <label class="title">Sub Heading <span class="text-danger">*</span> :</label>
            <input type="text" name="content[subHeading]" class="field" placeholder="" data-required
                data-error="sub Heading" value="{{ $sectionContent->subHeading ?? '' }}">
        </div>
    </div>
    <div class="col-lg-6 mb-4">
        <div class="form-fields">
            <label class="title">Heading <span class="text-danger">*</span> :</label>
            <input type="text" name="content[heading]" class="field" placeholder="" data-required
                data-error="Heading" value="{{ $sectionContent->heading ?? '' }}">
        </div>
    </div>
    <div class="col-lg-12">
        <div class="form-fields">
            <label class="title">Select Cities <span class="text-danger">*</span> :</label>
            <select name="content[city_ids][]" should-sort="false" multiple class="field choice-select"
                placeholder="Select Cities" data-required data-error="Cities">
                @foreach ($cities->sortByDesc('tours_count') as $item)
                    <option value="{{ $item->id }}" {{ in_array($item->id, $cityIds) ? 'selected' : '' }}>
                        {{ $item->name }}
                        ({{ $item->tours_count > 0 ? $item->tours_count . ' ' . ($item->tours_count === 1 ? 'tour' : 'tours') . ' available' : 'No tours available' }})
                    </option>
                @endforeach
            </select>

        </div>
    </div>
</div>
