@extends('admin.dash_layouts.main')
@section('content')
    <div class="col-md-12">
        <div class="dashboard-content">
            {{ Breadcrumbs::render('admin.blogs-tags.index') }}
            <div class="section-content mt-5 mb-4">
                <h3 class="heading">{{ isset($title) ? $title : '' }}</h3>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-box">
                        <div class="form-box__header">
                            <div class="title">Add Tag</div>
                        </div>
                        <div class="form-box__body">
                            <div class="form-fields">
                                <label class="title">Name <span class="text-danger">*</span> :</label>
                                <input type="text" name="name" class="field" value="{{ old('name') }}"
                                    placeholder="Tag Name" required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-fields">
                                <button class="themeBtn">Add new</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="table-container universal-table">
                        <div class="custom-sec">
                            <div class="row mb-3">
                                <div class="col-md-7">
                                    <form class="custom-form ">
                                        <div class="form-fields d-flex gap-3">
                                            <select class="field" name="bulk_actions">
                                                <option value="" disabled selected>Bulk Actions</option>
                                                <option value="delete">Delete</option>
                                            </select>
                                            <button class="themeBtn">Apply</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="data-table">
                                    <thead>
                                        <tr>
                                            <th class="no-sort">
                                                <div class="selection select-all-container"><input type="checkbox"
                                                        id="select-all"></div>
                                            </th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="selection item-select-container"><input type="checkbox"
                                                        class="bulk-item" name="bulk_select[]" value="1"></div>
                                            </td>
                                            <td>
                                                <a href="#" class="link">Desert Safari</a>
                                            </td>
                                            <td>desert-safari</td>
                                            <td>28 May 2025</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="selection item-select-container"><input type="checkbox"
                                                        class="bulk-item" name="bulk_select[]" value="2"></div>
                                            </td>
                                            <td>
                                                <a href="#" class="link">Desert Safari</a>
                                            </td>
                                            <td>desert-safari</td>
                                            <td>28 May 2025</td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <style type="text/css">

    </style>
@endsection
@section('js')
    <script type="text/javascript"></script>
@endsection
