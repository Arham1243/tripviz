@extends('admin.dash_layouts.main')
@section('content')
    <div class="col-md-12">
        <div class="dashboard-content">
            {{ Breadcrumbs::render('admin.blogs.index') }}
            <div class="table-container universal-table">
                <div class="custom-sec">
                    <div class="custom-sec__header">
                        <div class="section-content">
                            <h3 class="heading">{{ isset($title) ? $title : '' }}</h3>
                        </div>
                        <a href="{{ route('admin.blogs.create') }}" class="themeBtn">Add new blog</a>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-5">
                            <form class="custom-form ">
                                <div class="form-fields d-flex gap-3">
                                    <select class="field" name="bulk_actions">
                                        <option value="" disabled selected>Bulk Actions</option>
                                        <option value="publish">Publish</option>
                                        <option value="pending">Move to pending</option>
                                        <option value="draft">Move to Draft</option>
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
                                        <div class="selection select-all-container"><input type="checkbox" id="select-all">
                                        </div>
                                    </th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Author</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="selection item-select-container"><input type="checkbox"
                                                class="bulk-item" name="bulk_select[]" value="1"></div>
                                    </td>
                                    <td>
                                        <div class="link">Morning in the northern sea</div>
                                    </td>
                                    <td>Sea Travel</td>
                                    <td>Vendor 01</td>
                                    <td>28 May 2025</td>
                                    <td>
                                        <span class="badge rounded-pill bg-success">
                                            publish
                                        </span>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" class="themeBtn"><i class='bx bxs-edit'></i>Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="selection item-select-container"><input type="checkbox"
                                                class="bulk-item" name="bulk_select[]" value="1"></div>
                                    </td>
                                    <td>
                                        <div class="link">Morning in the northern sea</div>
                                    </td>
                                    <td>Sea Travel</td>
                                    <td>Vendor 01</td>
                                    <td>28 May 2025</td>
                                    <td>
                                        <span class="badge rounded-pill bg-success">
                                            publish
                                        </span>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" class="themeBtn"><i class='bx bxs-edit'></i>Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="selection item-select-container"><input type="checkbox"
                                                class="bulk-item" name="bulk_select[]" value="1"></div>
                                    </td>
                                    <td>
                                        <div class="link">Morning in the northern sea</div>
                                    </td>
                                    <td>Sea Travel</td>
                                    <td>Vendor 01</td>
                                    <td>28 May 2025</td>
                                    <td>
                                        <span class="badge rounded-pill bg-success">
                                            publish
                                        </span>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" class="themeBtn"><i class='bx bxs-edit'></i>Edit</a>
                                    </td>
                                </tr>


                            </tbody>
                        </table>
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
