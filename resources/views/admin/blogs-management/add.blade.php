@extends('admin.dash_layouts.main')
@section('content')
    <div class="col-md-12">
        <div class="dashboard-content">
            {{ Breadcrumbs::render('admin.blogs.create') }}
            <div class="custom-sec">
                <div class="custom-sec__header">
                    <div class="section-content">
                        <h3 class="heading">{{ isset($title) ? $title : '' }}</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <div class="form-box">
                        <div class="form-box__header">
                            <div class="title">Blog Content</div>
                        </div>
                        <div class="form-box__body">
                            <div class="form-fields">
                                <label class="title">Title <span class="text-danger">*</span> :</label>
                                <input type="url" name="title" class="field" value="{{ old('title') }}"
                                    placeholder="New Blog" required>
                                @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-box">
                        <div class="form-box__header">
                            <div class="title">Publish</div>
                        </div>
                        <div class="form-box__body">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="publish" id="publish">
                                <label class="form-check-label" for="publish">
                                    Publish
                                </label>
                            </div>
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="radio" name="draft" id="draft">
                                <label class="form-check-label" for="draft">
                                    Draft
                                </label>
                            </div>
                            <button class="themeBtn ms-auto mt-4">Save Changes</button>
                        </div>
                    </div>
                    <div class="form-box">
                        <div class="form-box__header">
                            <div class="title">Author Settings</div>
                        </div>
                        <div class="form-box__body">
                            <div class="form-fields">
                                <label class="title">Author <span class="text-danger">*</span> :</label>
                                <select class="choice-select" placeholder="Select">
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                    <option value="3">Option 3</option>
                                </select>
                                @error('author')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />

    <style type="text/css">

    </style>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const choiceSelects = document.querySelectorAll('.choice-select');
            choiceSelects.forEach(select => {
                new Choices(select, {
                    searchEnabled: true,
                    itemSelectText: '',
                    placeholder: true,
                    placeholderValue: select.getAttribute('placeholder'),
                    removeItemButton: true
                });
            });
        }); 
    </script>
@endsection
