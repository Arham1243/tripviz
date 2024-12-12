<tr>
    <td>
        <div class="selection item-select-container"><input type="checkbox" class="bulk-item" name="bulk_select[]"
                value="{{ $category->id }}"></div>
    </td>
    <td>
        <a href="{{ route('admin.blogs-categories.edit', $category->id) }}" class="link"> {!! str_repeat('&nbsp;&nbsp;', $level) !!}
            {{ str_repeat('-', $level) }} {{ $category->name }}</a>
    </td>
    <td>{{ $category->slug }}</td>
    <td>{{ formatDateTime($category->deleted_at) }}</td>
</tr>


@foreach ($category->children as $child)
    @include('admin.blogs.categories.partials.category-row', ['category' => $child, 'level' => $level + 1])
@endforeach
