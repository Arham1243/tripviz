<div class="form-fields">
    <label class="title">Section Heading <span class="text-danger">*</span> :</label>
    <input type="text" name="heading" class="field" placeholder="" data-required data-error="Heading">
</div>
<div class="form-fields">
    <label class="title">View More Text <span class="text-danger">*</span> :</label>
    <input type="text" name="view_more_text" class="field" placeholder="" data-required data-error="View More Text">
</div>
<div class="form-fields">
    <label class="title">View More Link <span class="text-danger">*</span> :</label>
    <input type="url" name="view_more_link" class="field" placeholder="" data-required data-error="View More Link">
</div>
<div class="form-fields">
    <label class="title">Select 5 Tours <span class="text-danger">*</span> :</label>
    <select name="tours_ids[]" multiple class="field choice-select" data-max-items="5" placeholder="Select Tours"
        data-required data-error="Tours">
        @foreach ($tours as $tour)
            <option value="{{ $tour->id }}">
                {{ $tour->title }}
            </option>
        @endforeach
    </select>
</div>
