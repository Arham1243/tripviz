@php
    $isEdit = isset($category);
    $formTitle = $isEdit ? 'Edit Category' : 'Add Category';
    $formAction = $isEdit
        ? route('admin.news-categories.update', $category->slug)
        : route('admin.news-categories.store');
    $buttonText = $isEdit ? 'Save Changes' : 'Add new';
    $categoryName = old('name', $category->name ?? '');
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
            <input type="text" name="name" class="field" value="{{ $categoryName }}" placeholder="Category Name"
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
