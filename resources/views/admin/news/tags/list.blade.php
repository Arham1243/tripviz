<div class="table-container universal-table">
    <div class="custom-sec">
        <form id="bulkActionForm" method="POST" action="{{ route('admin.bulk-actions', ['resource' => 'news-tags']) }}">
            @csrf
            <div class="row mb-3">
                <div class="col-md-7">
                    <div class="custom-form">
                        <div class="form-fields d-flex gap-3">
                            <select class="field" id="bulkActions" name="bulk_actions" required>
                                <option value="" disabled selected>Bulk Actions</option>
                                <option value="delete">Delete</option>
                            </select>
                            <button type="submit" onclick="confirmBulkAction(event)" class="themeBtn">Apply</button>
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
                        @foreach ($tags as $tag)
                            <tr>
                                <td>
                                    <div class="selection item-select-container"><input type="checkbox"
                                            class="bulk-item" name="bulk_select[]" value="{{ $tag->id }}"></div>
                                </td>
                                <td>
                                    <a href="{{ route('admin.news-tags.edit', $tag->id) }}"
                                        class="link">{{ $tag->name }}</a>
                                </td>
                                <td>{{ $tag->slug }}</td>
                                <td>
                                    {{ formatDateTime($tag->created_at) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </form>
    </div>
</div>
