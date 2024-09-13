<div class="table-container universal-table">
    <div class="custom-sec">
        <form action="{{ route('admin.blogs-categories.bulk-actions') }}" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col-md-7">
                    <div class="custom-form">
                        <div class="form-fields d-flex gap-3">
                            <select class="field" name="bulk_actions" required>
                                <option value="" disabled selected>Bulk Actions</option>
                                <option value="delete">Delete</option>
                            </select>
                            <button class="themeBtn">Apply</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th class="no-sort">
                                <div class="selection select-all-container"><input type="checkbox" id="select-all">
                                </div>
                            </th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>
                                    <div class="selection item-select-container"><input type="checkbox"
                                            class="bulk-item" name="bulk_select[]" value="{{ $category->slug }}"></div>
                                </td>
                                <td>
                                    <a href="{{ route('admin.blogs-categories.edit', $category->slug) }}"
                                        class="link">{{ $category->name }}</a>
                                </td>
                                <td>{{ $category->slug }}</td>
                                <td>{{ $category->created_at->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </form>
    </div>
</div>
