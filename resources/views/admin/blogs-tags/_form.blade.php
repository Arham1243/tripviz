@php
    $isEdit = isset($item);
    $formTitle = $isEdit ? 'Edit Tag' : 'Add Tag';
    $formAction = $isEdit ? route('admin.blogs-tags.update', $item->slug) : route('admin.blogs-tags.store');
    $buttonText = $isEdit ? 'Save Changes' : 'Add new';
    $itemName = old('name', $item->name ?? '');
@endphp

<div class="form-box">
    <div class="form-box__header">
        <div class="title">{{ $formTitle }}</div>
    </div>

    <form action="{{ $formAction }}" class="form-box__body" method="POST">
        @csrf
        @if ($isEdit)
            @method('PUT')
        @endif

        <div class="form-fields">
            <label class="title">Name <span class="text-danger">*</span> :</label>
            <input type="text" name="name" class="field" value="{{ $itemName }}" placeholder="Tag Name"
                required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-fields">
            <button class="themeBtn">{{ $buttonText }}</button>
        </div>
    </form>
</div>
