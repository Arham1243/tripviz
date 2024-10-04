<div class="table-container universal-table">
    <div class="custom-sec">
        <form id="bulkActionForm" method="POST"
            action="{{ route('admin.bulk-actions', ['resource' => 'tour-attributes']) }}">
            @csrf
            <div class="row mb-3">
                <div class="col-md-7">
                    <div class="custom-form">
                        <div class="form-fields d-flex gap-3">
                            <select class="field" id="bulkActions" name="bulk_actions" required>
                                <option value="" disabled selected>Bulk Actions</option>
                                <option value="delete">Delete</option>
                                <option value="active">Make Active</option>
                                <option value="inactive">Make Inactive</option>
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
                            <th>Date</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>
                                    <div class="selection item-select-container"><input type="checkbox"
                                            class="bulk-item" name="bulk_select[]" value="{{ $item->id }}"></div>
                                </td>
                                <td>
                                    <a href="{{ route('admin.tour-attributes.edit', $item->id) }}"
                                        class="link">{{ $item->name }}</a>
                                </td>
                                <td>
                                    {{ formatDateTime($item->created_at) }}
                                </td>
                                <td>
                                    <span
                                        class="badge rounded-pill bg-{{ $item->status == 'active' ? 'success' : 'danger' }} ">
                                        {{ $item->status }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.tour-attributes.edit', $item->id) }}" class="themeBtn"><i
                                            class='bx bxs-edit'></i>Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </form>
    </div>
</div>
