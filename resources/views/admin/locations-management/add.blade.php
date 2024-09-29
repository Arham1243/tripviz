@php
    $formTitle = 'Add Location';
    $formAction = route('admin.locations.store');
    $buttonText = 'Add new';
    $item = old('name');
    $slug = old('slug');
@endphp

<div class="form-box">
    <div class="form-box__header">
        <div class="title">{{ $formTitle }}</div>
    </div>

    <form action="{{ $formAction }}" class="form-box__body" method="POST">
        @csrf

        <div class="form-fields">
            <label class="title">Name <span class="text-danger">*</span> :</label>
            <input type="text" name="name" class="field" value="{{ $item }}" placeholder="Name" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-fields">
            <label class="title">Slug:</label>
            <input type="text" name="slug" class="field" value="{{ old('slug') }}" placeholder="Slug"
                data-error="Slug">
            @error('slug')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-fields">
            <label class="title">Parent <span class="text-danger">*</span> :</label>
            <select name="parent_location_id" class="choice-select"
                {{ !$parentItems->isEmpty() ? 'data-required' : '' }} data-error="Category">
                <option value="" selected>Parent Category</option>

                @foreach ($parentItems as $item)
                    <option value="{{ $item->id }}" {{ old('parent_location_id') == $item->id ? 'selected' : '' }}>
                        {{ $item->name }}
                    </option>
                @endforeach
            </select>
            @error('parent_location_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-fields">
            <button class="themeBtn">{{ $buttonText }}</button>
        </div>
    </form>
</div>
