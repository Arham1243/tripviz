@extends('admin.dash_layouts.main')
@section('content')
    <div class="col-md-12">
        <div class="dashboard-content">
            {{ Breadcrumbs::render('admin.blogs.create') }}
            <div class="custom-sec mt-5">
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
                                <input type="text" name="title" class="field" value="{{ old('title') }}"
                                    placeholder="New Blog" required>
                                @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-fields">
                                <label class="title">Content <span class="text-danger">*</span> :</label>
                                <textarea class="editor" name="long_desc"></textarea>



                            </div>
                        </div>
                    </div>
                    <div class="form-box">
                        <div class="form-box__header">
                            <div class="title">Seo Manager</div>
                        </div>
                        <div class="form-box__body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-fields">
                                        <label class="title">Allow search engines to show this service in search results?
                                            <span class="text-danger">*</span> :</label>
                                        <select name="seo_index" class="field" required>
                                            <option {{ old('seo_index') == '1' ? 'checked' : '' }} value="1" selected>
                                                Yes</option>
                                            <option {{ old('seo_index') == '0' ? 'checked' : '' }} value="0">No
                                            </option>
                                        </select>
                                        @error('seo_index')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 mt-4">
                                    <div class="tabs-wrapper">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link text-dark active" id="home-tab"
                                                    data-bs-toggle="tab" data-bs-target="#home" type="button"
                                                    role="tab" aria-controls="home" aria-selected="true">General
                                                    Options</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link text-dark" id="profile-tab" data-bs-toggle="tab"
                                                    data-bs-target="#profile" type="button" role="tab"
                                                    aria-controls="profile" aria-selected="false">Share Facebook</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link text-dark" id="contact-tab" data-bs-toggle="tab"
                                                    data-bs-target="#contact" type="button" role="tab"
                                                    aria-controls="contact" aria-selected="false">Share Twitter</button>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="myTabContent">
                                            <!-- General Options Tab -->
                                            <div class="tab-pane fade show active" id="home" role="tabpanel"
                                                aria-labelledby="home-tab">
                                                <div class="row">
                                                    <div class="form-fields col-md-12">
                                                        <label class="title">Seo Title <span class="text-danger">*</span>
                                                            :</label>
                                                        <input type="text" name="seo_title" class="field"
                                                            value="{{ old('seo_title') }}"
                                                            placeholder="Leave blank to use service title" required>
                                                        @error('seo_title')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-fields col-md-12">
                                                        <label class="title">Seo Description <span
                                                                class="text-danger">*</span> :</label>
                                                        <textarea placeholder="Enter Description..." required name="seo_description" class="field" rows="3">{{ old('seo_description') }}</textarea>
                                                        @error('title')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-fields col-md-4">
                                                        <label class="title">Feature Image <span
                                                                class="text-danger">*</span> :</label>

                                                        <div class="upload" data-upload>
                                                            <div class="upload-box-wrapper">
                                                                <div class="upload-box show" data-upload-box>
                                                                    <input type="file" name="seo_featured_image"
                                                                        id="seo_featured_image"
                                                                        class="upload-box__file d-none" accept="image/*"
                                                                        data-file-input>
                                                                    <div class="upload-box__placeholder"><i
                                                                            class='bx bxs-image'></i></div>
                                                                    <label for="seo_featured_image"
                                                                        class="upload-box__btn themeBtn">Upload
                                                                        Image</label>
                                                                </div>
                                                                <div class="upload-box__img" data-upload-img>
                                                                    <button class="delete-btn" data-delete-btn><i
                                                                            class='bx bxs-trash-alt'></i></button>
                                                                    <img src="{{ asset('admin/assets/images/loading.gif') }}"
                                                                        alt="Uploaded Image" class="imgFluid"
                                                                        data-upload-preview>
                                                                </div>
                                                            </div>
                                                            <div class="text-danger d-none mt-2 text-center"
                                                                data-error-message>Please upload a valid image file</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <!-- Facebook Tab -->
                                            <div class="tab-pane fade" id="profile" role="tabpanel"
                                                aria-labelledby="profile-tab">
                                                <div class="row">
                                                    <div class="form-fields col-md-12">
                                                        <label class="title">Facebook Title <span
                                                                class="text-danger">*</span> :</label>
                                                        <input type="text" name="fb_title" class="field"
                                                            value="{{ old('fb_title') }}"
                                                            placeholder="Leave blank to use service title" required>
                                                        @error('fb_title')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-fields col-md-12">
                                                        <label class="title">Facebook Description <span
                                                                class="text-danger">*</span> :</label>
                                                        <textarea placeholder="Enter Description..." required name="fb_description" class="field" rows="3">{{ old('fb_description') }}</textarea>
                                                        @error('title')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-fields col-md-4">
                                                        <label class="title">Feature Image <span
                                                                class="text-danger">*</span> :</label>

                                                        <div class="upload" data-upload>
                                                            <div class="upload-box-wrapper">
                                                                <div class="upload-box show" data-upload-box>
                                                                    <input type="file" name="fb_featured_image"
                                                                        id="fb_featured_image"
                                                                        class="upload-box__file d-none" accept="image/*"
                                                                        data-file-input>
                                                                    <div class="upload-box__placeholder"><i
                                                                            class='bx bxs-image'></i></div>
                                                                    <label for="fb_featured_image"
                                                                        class="upload-box__btn themeBtn">Upload
                                                                        Image</label>
                                                                </div>
                                                                <div class="upload-box__img" data-upload-img>
                                                                    <button class="delete-btn" data-delete-btn><i
                                                                            class='bx bxs-trash-alt'></i></button>
                                                                    <img src="{{ asset('admin/assets/images/loading.gif') }}"
                                                                        alt="Uploaded Image" class="imgFluid"
                                                                        data-upload-preview>
                                                                </div>
                                                            </div>
                                                            <div class="text-danger d-none mt-2 text-center"
                                                                data-error-message>Please upload a valid image file</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Twitter Tab -->
                                            <div class="tab-pane fade" id="contact" role="tabpanel"
                                                aria-labelledby="contact-tab">
                                                <div class="row">
                                                    <div class="form-fields col-md-12">
                                                        <label class="title">Twitter Title <span
                                                                class="text-danger">*</span> :</label>
                                                        <input type="text" name="tw_title" class="field"
                                                            value="{{ old('tw_title') }}"
                                                            placeholder="Leave blank to use service title" required>
                                                        @error('tw_title')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-fields col-md-12">
                                                        <label class="title">Twitter Description <span
                                                                class="text-danger">*</span> :</label>
                                                        <textarea placeholder="Enter Description..." required name="tw_description" class="field" rows="3">{{ old('tw_description') }}</textarea>
                                                        @error('title')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-fields col-md-4">
                                                        <label class="title">Feature Image <span
                                                                class="text-danger">*</span> :</label>

                                                        <div class="upload" data-upload>
                                                            <div class="upload-box-wrapper">
                                                                <div class="upload-box show" data-upload-box>
                                                                    <input type="file" name="tw_featured_image"
                                                                        id="tw_featured_image"
                                                                        class="upload-box__file d-none" accept="image/*"
                                                                        data-file-input>
                                                                    <div class="upload-box__placeholder"><i
                                                                            class='bx bxs-image'></i></div>
                                                                    <label for="tw_featured_image"
                                                                        class="upload-box__btn themeBtn">Upload
                                                                        Image</label>
                                                                </div>
                                                                <div class="upload-box__img" data-upload-img>
                                                                    <button class="delete-btn" data-delete-btn><i
                                                                            class='bx bxs-trash-alt'></i></button>
                                                                    <img src="{{ asset('admin/assets/images/loading.gif') }}"
                                                                        alt="Uploaded Image" class="imgFluid"
                                                                        data-upload-preview>
                                                                </div>
                                                            </div>
                                                            <div class="text-danger d-none mt-2 text-center"
                                                                data-error-message>Please upload a valid image file</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-box">
                        <div class="form-box__header">
                            <div class="title">Search Engine</div>
                        </div>
                        <div class="form-box__body">
                            <div class="google-preview">
                                <div class="google-preview__header">
                                    <div class="logo">
                                        <img src="{{ asset('favicon.ico') }}" alt="Favicon" class="imgFluid">
                                    </div>
                                    <div class="content">
                                        <div class="title">My travel</div>
                                        <a href=""
                                            class="link">https://docs.google.com/document/d/18tB2C5fCwh4x-9gC7elqdLDDfFdVJbS0JVxlusQ8xgE/edit</a>
                                    </div>
                                </div>
                                <div class="google-preview__content">
                                    <div class="heading">Lorem ipsum dolor sit.</div>
                                    <div class="description">Lorem ipsum dolor sit amet consectetur
                                        adipisicing elit. Velit ex veniam fugit saepe exercitationem,
                                        veritatis repellendus unde laborum illum quis.</div>
                                </div>
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
                    <div class="form-box">
                        <div class="form-box__header">
                            <div class="title">Options</div>
                        </div>
                        <div class="form-box__body">
                            <div class="form-fields">
                                <label class="title">Category <span class="text-danger">*</span> :</label>
                                <select name="category_ids" class="choice-select" placeholder="Select Category">
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                    <option value="3">Option 3</option>
                                </select>
                                @error('category_ids')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-fields">
                                <label class="title">Tags <span class="text-danger">*</span> :</label>
                                <select name="tags_ids[]" class="choice-select" multiple placeholder="Select Tags">
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                    <option value="3">Option 3</option>
                                </select>
                                @error('tags_ids')
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
    <style type="text/css">

    </style>
@endsection
@section('js')
    <script></script>
@endsection
