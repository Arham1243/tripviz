<div class="table-container universal-table">
    <div class="custom-sec">
        <form id="bulkActionForm" method="POST"
            action="{{ route('admin.bulk-actions', ['resource' => 'tour-categories']) }}">
            @csrf
            <div class="row mb-3">
                <div class="col-md-7">
                    <div class="custom-form">
                        <div class="form-fields d-flex gap-3">
                            <select class="field" id="bulkActions" name="bulk_actions" required>
                                <option value="" disabled selected>Bulk Actions</option>
                                <option value="publish">Publish</option>
                                <option value="draft">Move to Draft</option>
                                <option value="delete">Delete</option>
                            </select>
                            <button type="submit" onclick="confirmBulkAction(event)" class="themeBtn">Apply</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-container table-responsive mt-5 mb-3">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th class="no-sort">
                                <div class="selection select-all-container"><input type="checkbox" id="select-all">
                                </div>
                            </th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>
                                    <div class="selection item-select-container"><input type="checkbox"
                                            class="bulk-item" name="bulk_select[]" value="{{ $category->id }}"></div>
                                </td>
                                <td>
                                    <a href="{{ route('admin.tour-categories.edit', $category->id) }}"
                                        class="link">{{ $category->name }}</a>
                                </td>
                                <td class="p-0">
                                    <span
                                        class="badge rounded-pill bg-{{ $category->status == 'publish' ? 'success' : 'warning' }} ">
                                        {{ $category->status }}
                                    </span>
                                </td>
                                <td>{{ formatDateTime($category->deleted_at) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </form>
    </div>
</div>
