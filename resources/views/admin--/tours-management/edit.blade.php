@extends('admin.dash_layouts.main')
@section('content')
    @include('admin.dash_layouts.sidebar')
    <div class="main-sec">
        <div class="main-wrapper">
            <div class="row align-items-center mc-b-3">
                <div class="col-lg-12 col-12">
                    <div class="primary-heading color-dark text-center">
                        <h2>Edit Tour</h2>
                    </div>
                </div>
            </div>

            <ul class="nav nav-pills main-tabs justify-content-center mb-5" id="tours-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ session('active_tab') == 'details' ? 'active' : '' }}" id="tours-details-tab"
                        data-toggle="pill" data-target="#tours-details" type="button" role="tab"
                        aria-controls="tours-details" aria-selected="true">Tour details</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ session('active_tab') == 'faqs' ? 'active' : '' }}" id="tour-faqs-tab"
                        data-toggle="pill" data-target="#tour-faqs" type="button" role="tab" aria-controls="tour-faqs"
                        aria-selected="false">Faqs</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ session('active_tab') == 'itineraries' ? 'active' : '' }}"
                        id="tour-itinerary-tab" data-toggle="pill" data-target="#tour-itinerary" type="button"
                        role="tab" aria-controls="tour-itinerary" aria-selected="false">Itinerary</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ session('active_tab') == 'attributes' ? 'active' : '' }}"
                        id="tour-attributes-tab" data-toggle="pill" data-target="#tour-attributes" type="button"
                        role="tab" aria-controls="tour-attributes" aria-selected="false">Attributes</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ session('active_tab') == 'highlights' ? 'active' : '' }}"
                        id="tour-highlights-tab" data-toggle="pill" data-target="#tour-highlights" type="button"
                        role="tab" aria-controls="tour-highlights" aria-selected="false">Highlights</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ session('active_tab') == 'inclusions' ? 'active' : '' }}"
                        id="tour-inclusions-tab" data-toggle="pill" data-target="#tour-inclusions" type="button"
                        role="tab" aria-controls="tour-inclusions" aria-selected="false">Inclusions</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ session('active_tab') == 'exclusions' ? 'active' : '' }}"
                        id="tour-exclusions-tab" data-toggle="pill" data-target="#tour-exclusions" type="button"
                        role="tab" aria-controls="tour-exclusions" aria-selected="false">Exclusions</button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ session('active_tab') == 'additional-items' ? 'active' : '' }}"
                        id="tour-additional-items-tab" data-toggle="pill" data-target="#tour-additional-items"
                        type="button" role="tab" aria-controls="tour-additional-items" aria-selected="false">Additional
                        items</button>
                </li>
            </ul>
            <div class="tab-content" id="tours-tabContent">
                <div class="tab-pane fade {{ session('active_tab') == 'details' ? 'show active' : '' }}" id="tours-details"
                    role="tabpanel" aria-labelledby="tours-details-tab">
                    <form action="{{ route('admin.tours.update', $tour->id) }}" method="POST" enctype="multipart/form-data"
                        class="main-form">
                        @csrf @method('PUT')
                        <input type="hidden" name="price_type" id="price_type"
                            value="{{ old('price_type', $tour->price_type) }}" />
                        <div class="row justify-content-center">
                            <div class="col-lg-6 col-md-12 custom-select2-wrapper">
                                <label>Select Categories:</label>
                                <select multiple name="category_ids[]" class="custom-select2"
                                    placeholder="Select Categories" data-allow-clear="1">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ in_array($category->id, old('category_ids', $tour->categories->pluck('id')->toArray())) ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_ids')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-md-12 custom-select2-wrapper">
                                <label>Select Cities:</label>
                                <select multiple name="city_ids[]" class="custom-select2" placeholder="Select Cities"
                                    data-allow-clear="1">
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}"
                                            {{ in_array($city->id, old('city_ids', $tour->cities->pluck('id')->toArray())) ? 'selected' : '' }}>
                                            {{ $city->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('city_ids')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="form-group">
                                    <label>Title*:</label>
                                    <input type="text" name="title" class="form-control" placeholder="Enter Name"
                                        required value="{{ old('title', $tour->title) }}" />
                                    @error('title')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="form-group">
                                    <label>Short Description*:</label>
                                    <textarea rows="3" class="form-control" name="short_desc" required placeholder="Enter Short Description"> {{ old('short_desc', $tour->short_desc) }}</textarea>
                                    @error('short_desc')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-12">
                                <h6 class="mb-3"><strong>Price*:</strong></h6>
                                <ul class="nav nav-pills mr-3" id="pills-tab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link {{ $tour->price_type === 'per_person' ? 'active' : '' }}"
                                            id="pills-home-tab" data-toggle="pill" data-target="#pills-home"
                                            type="button" role="tab" aria-controls="pills-home"
                                            aria-selected="true">
                                            Per Person
                                        </button>
                                    </li>
                                    <li class="nav-item mx-2" role="presentation">
                                        <button class="nav-link {{ $tour->price_type === 'per_car' ? 'active' : '' }}"
                                            id="pills-profile-tab" data-toggle="pill" data-target="#pills-profile"
                                            type="button" role="tab" aria-controls="pills-profile"
                                            aria-selected="false">
                                            Per Car
                                        </button>
                                    </li>
                                </ul>
                                <div class="tab-content mt-4" id="pills-tabContent">
                                    <div class="tab-pane fade {{ $tour->price_type === 'per_person' ? 'show active' : '' }}"
                                        id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-12 col-12">
                                                <div class="form-group">
                                                    <label>For Adult*:</label>
                                                    <input type="number" name="for_adult_price" class="form-control"
                                                        placeholder="Enter Price" step="0.01"
                                                        value="{{ old('for_adult_price', $tour->normalForAdultPrice()) }}" />
                                                    @error('for_adult_price')
                                                        <span class="error">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12 col-12">
                                                <div class="form-group">
                                                    <label>For Child*:</label>
                                                    <input type="number" name="for_child_price" class="form-control"
                                                        placeholder="Enter Price" step="0.01"
                                                        value="{{ old('for_child_price', $tour->normalForChildPrice()) }}" />
                                                    @error('for_child_price')
                                                        <span class="error">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade {{ $tour->price_type === 'per_car' ? 'show active' : '' }}"
                                        id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-12 col-12">
                                                <div class="form-group">
                                                    <label>For Car*:</label>
                                                    <input type="number" name="for_car_price" class="form-control"
                                                        placeholder="Enter Price" step="0.01"
                                                        value="{{ old('for_car_price', $tour->normalForCarPrice()) }}" />
                                                    @error('for_car_price')
                                                        <span class="error">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="form-group">
                                    <label>Show On Homepage:</label>
                                    <div class="input-field--check">
                                        <input type="checkbox" name="show_on_homepage" id="show_on_homepage" value="1" {{ $tour->show_on_homepage == 1 ? 'checked' : '' }}>
                                        <label for="show_on_homepage" class="toggle">Yes</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 text-center">
                                <div class="img-upload-wrapper mc-b-3">
                                    <h3>Tour Image</h3>
                                    <figure>
                                        <img src="{{ $tour->img_path ? asset($tour->img_path) : asset('admin/assets/images/placeholder.png') }}"
                                            class="thumbnail-img main_image rounded" id="product-img" alt="Image" />
                                    </figure>
                                    <label for="img_path" class="user-img-btn"><i class="fa fa-camera"></i></label>
                                    <input type="file" onchange="readURL(this, 'product-img');" name="img_path"
                                        id="img_path" class="d-none" accept="image/jpeg, image/png" />
                                    @error('img_path')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12 col-12">
                                <div class="text-center">
                                    <button class="primary-btn primary-bg">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="tab-pane fade {{ session('active_tab') == 'faqs' ? 'show active' : '' }}" id="tour-faqs"
                    role="tabpanel" aria-labelledby="tour-faqs-tab">
                    <form action="{{ route('admin.tours-faqs.store') }}" method="POST" class="main-form mt-3">
                        @csrf
                        <input type="hidden" value="{{ $tour->id }}" name="tour_id">
                        <div class="row justify-content-center">


                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="form-group">
                                    <label>Question*:</label>
                                    <input type="text" name="question" class="form-control"
                                        placeholder="Enter Question" required value="{{ old('question') }}">
                                    @if ($errors->has('question'))
                                        <span class="error">{{ $errors->first('question') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="form-group">
                                    <label>Answer*:</label>
                                    <textarea name="answer" class="form-control" placeholder="Enter Answer" required>{{ old('answer') }}</textarea>
                                    @if ($errors->has('answer'))
                                        <span class="error">{{ $errors->first('answer') }}</span>
                                    @endif
                                </div>
                            </div>



                            <div class="col-lg-12 col-12">
                                <div class="text-center">
                                    <button class="primary-btn primary-bg">Add FAQ</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="primary-heading color-dark mt-5 ">
                        <h2>Current FAQs</h2>
                    </div>
                    <div class="table-responsive mt-3 pb-5">
                        <table class="user-table table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Question</th>
                                    <th>Answer</th>
                                    <th>Status</th>
                                    <th>Added On</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($faqs as $faq)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $faq->question }}</td>
                                        <td>{{ $faq->answer }}</td>
                                        <td>
                                            <span class="badge badge-{{ $faq->is_active == 1 ? 'success' : 'danger' }}">
                                                {{ $faq->is_active == 1 ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>{{ date('d-M-Y', strtotime($faq->created_at)) }}</td>
                                        <td>
                                            <div class="dropdown show action-dropdown">
                                                <a class="dropdown-toggle" href="#" role="button"
                                                    id="action-dropdown" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="action-dropdown">
                                                    <button class="dropdown-item edit-faq-btn" data-toggle="modal"
                                                        data-target="#editFaq" data-faq-id="{{ $faq->id }}"
                                                        data-faq-question="{{ $faq->question }}"
                                                        data-faq-answer="{{ $faq->answer }}">
                                                        <i class="fa fa-pen" aria-hidden="true"></i> Edit
                                                    </button>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.tours-faqs.suspend', $faq->id) }}">
                                                        <i class="fa fa-ban" aria-hidden="true"></i>
                                                        {{ $faq->is_active != 0 ? 'Suspend' : 'Activate' }}
                                                    </a>
                                                    <form action="{{ route('admin.tours-faqs.destroy', $faq->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item"
                                                            onclick="return confirm('Are you sure you want to delete?')">
                                                            <i class="fa fa-trash" aria-hidden="true"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade {{ session('active_tab') == 'itineraries' ? 'show active' : '' }}"
                    id="tour-itinerary" role="tabpanel" aria-labelledby="tour-itinerary-tab">
                    <form action="{{ route('admin.tours-itineraries.store') }}" method="POST" class="main-form mt-3"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ $tour->id }}" name="tour_id">
                        <div class="row justify-content-center">


                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="form-group">
                                    <label>Title*:</label>
                                    <input type="text" name="title" class="form-control" placeholder="Enter title"
                                        required value="{{ old('title') }}">
                                    @if ($errors->has('title'))
                                        <span class="error">{{ $errors->first('title') }}</span>
                                    @endif
                                </div>
                            </div>


                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="form-group">
                                    <label>Description*:</label>
                                    <textarea name="short_desc" class="form-control" placeholder="Enter Description" required>{{ old('short_desc') }}</textarea>
                                    @if ($errors->has('short_desc'))
                                        <span class="error">{{ $errors->first('short_desc') }}</span>
                                    @endif
                                </div>
                            </div>


                            <div class="col-lg-4 text-center">
                                <div class="img-upload-wrapper mc-b-3">
                                    <h3>Itinerary Image</h3>
                                    <figure><img src="{{ asset('admin/assets/images/placeholder.png') }}"
                                            class="thumbnail-img main_image rounded" id="itinerary-img" alt="Image">
                                    </figure>
                                    <label for="itinerary-img-file" class="user-img-btn"><i
                                            class="fa fa-camera"></i></label>
                                    <input type="file" required onchange="readURL(this, 'itinerary-img');"
                                        name="img_path" id="itinerary-img-file" class="d-none"
                                        accept="image/jpeg, image/png">
                                    @error('img_path')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12 col-12">
                                <div class="text-center">
                                    <button class="primary-btn primary-bg">Add itinerary</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="primary-heading color-dark mt-5">
                        <h2>Current Itinerary</h2>
                    </div>
                    <div class="table-responsive mt-3 pb-5">
                        <table class="user-table table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Day</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Added On</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($itineraries as $itinerary)
                                    <tr>
                                        <td>{{ $itinerary->day }}</td>
                                        <td>{{ $itinerary->title }}</td>
                                        <td>{{ $itinerary->short_desc }}</td>
                                        <td><a href="{{ asset($itinerary->img_path) }}" data-fancybox="gallery"><img
                                                    src="{{ asset($itinerary->img_path) }}" alt="image"
                                                    class="img-fluid list-img"></a></td>
                                        <td>
                                            <span
                                                class="badge badge-{{ $itinerary->is_active == 1 ? 'success' : 'danger' }}">
                                                {{ $itinerary->is_active == 1 ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>{{ date('d-M-Y', strtotime($itinerary->created_at)) }}</td>
                                        <td>
                                            <div class="dropdown show action-dropdown">
                                                <a class="dropdown-toggle" href="#" role="button"
                                                    id="action-dropdown" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="action-dropdown">
                                                    <button class="dropdown-item edit-itinerary-btn" data-toggle="modal"
                                                        data-target="#editItinerary"
                                                        data-itinerary-id="{{ $itinerary->id }}"
                                                        data-itinerary-title="{{ $itinerary->title }}"
                                                        data-itinerary-description="{{ $itinerary->short_desc }}"
                                                        data-itinerary-image="{{ $itinerary->img_path }}">
                                                        <i class="fa fa-pen" aria-hidden="true"></i> Edit
                                                    </button>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.tours-itineraries.suspend', $itinerary->id) }}">
                                                        <i class="fa fa-ban" aria-hidden="true"></i>
                                                        {{ $itinerary->is_active != 0 ? 'Suspend' : 'Activate' }}
                                                    </a>
                                                    <form
                                                        action="{{ route('admin.tours-itineraries.destroy', $itinerary->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item"
                                                            onclick="return confirm('Are you sure you want to delete?')">
                                                            <i class="fa fa-trash" aria-hidden="true"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="tab-pane fade {{ session('active_tab') == 'attributes' ? 'show active' : '' }}"
                    id="tour-attributes" role="tabpanel" aria-labelledby="tour-attributes-tab">
                    <form action="{{ route('admin.tours-attributes.store') }}" method="POST" class="main-form mt-3"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ $tour->id }}" name="tour_id">
                        <div class="row justify-content-center">


                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="form-group">
                                    <label>Title*:</label>
                                    <input type="text" name="title" class="form-control" placeholder="Enter title"
                                        required value="{{ old('title') }}">
                                    @if ($errors->has('title'))
                                        <span class="error">{{ $errors->first('title') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="form-group">
                                    <label>Icon class <a href="//boxicons.com"
                                            target="_blank">(boxicons.com)</a>*:</label>
                                    <input type="text" name="icon_class"
                                        oninput="showIcon(this,document.querySelector('#attr-icon'))" class="form-control"
                                        placeholder="Enter class" required value="{{ old('icon_class') }}">
                                    @if ($errors->has('icon_class'))
                                        <span class="error">{{ $errors->first('icon_class') }}</span>
                                    @endif
                                    <div class="my-3">
                                        <i id="attr-icon"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-12">
                                <div class="text-center">
                                    <button class="primary-btn primary-bg">Add attribute</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="primary-heading color-dark mt-5">
                        <h2>Current attributes</h2>
                    </div>
                    <div class="table-responsive mt-3 pb-5">
                        <table class="user-table table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Title</th>
                                    <th>Icon Class</th>
                                    <th>Icon</th>
                                    <th>Status</th>
                                    <th>Added On</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($attributes as $attribute)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $attribute->title }}</td>
                                        <td>{{ $attribute->icon_class }}</td>
                                        <td><i class="{{ $attribute->icon_class }} bx-md"></i></td>
                                        <td>
                                            <span
                                                class="badge badge-{{ $attribute->is_active == 1 ? 'success' : 'danger' }}">
                                                {{ $attribute->is_active == 1 ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>{{ date('d-M-Y', strtotime($attribute->created_at)) }}</td>
                                        <td>
                                            <div class="dropdown show action-dropdown">
                                                <a class="dropdown-toggle" href="#" role="button"
                                                    id="action-dropdown" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="action-dropdown">
                                                    <button class="dropdown-item edit-attribute-btn" data-toggle="modal"
                                                        data-target="#editAttribute"
                                                        data-attribute-id="{{ $attribute->id }}"
                                                        data-attribute-title="{{ $attribute->title }}"
                                                        data-attribute-icon="{{ $attribute->icon_class }}">
                                                        <i class="fa fa-pen" aria-hidden="true"></i> Edit
                                                    </button>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.tours-attributes.suspend', $attribute->id) }}">
                                                        <i class="fa fa-ban" aria-hidden="true"></i>
                                                        {{ $attribute->is_active != 0 ? 'Suspend' : 'Activate' }}
                                                    </a>
                                                    <form
                                                        action="{{ route('admin.tours-attributes.destroy', $attribute->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item"
                                                            onclick="return confirm('Are you sure you want to delete?')">
                                                            <i class="fa fa-trash" aria-hidden="true"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="tab-pane fade {{ session('active_tab') == 'highlights' ? 'show active' : '' }}"
                    id="tour-highlights" role="tabpanel" aria-labelledby="tour-highlights-tab">
                    <form action="{{ route('admin.tours.save_highlights') }}" method="POST" class="main-form mt-3"
                        enctype="multipart/form-data">

                        @csrf
                        <input type="hidden" value="{{ $tour->id }}" name="tour_id">
                        <div class="row justify-content-center">

                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="form-group">
                                    <label for="highlights">Highlights:</label>
                                    <textarea id="highlights" class="form-control ckeditor" name="highlights">{!! $tour->highlights ?? '' !!}</textarea>
                                    @error('highlights')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12 col-12">
                                <div class="text-center">
                                    <button class="primary-btn primary-bg">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade {{ session('active_tab') == 'inclusions' ? 'show active' : '' }}"
                    id="tour-inclusions" role="tabpanel" aria-labelledby="tour-inclusions-tab">
                    <form action="{{ route('admin.tours-inclusions.store') }}" method="POST" class="main-form mt-3"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ $tour->id }}" name="tour_id">
                        <div class="row justify-content-center">


                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="form-group">
                                    <label>Title*:</label>
                                    <input type="text" name="title" class="form-control" placeholder="Enter title"
                                        required value="{{ old('title') }}">
                                    @if ($errors->has('title'))
                                        <span class="error">{{ $errors->first('title') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-12 col-12">
                                <div class="text-center">
                                    <button class="primary-btn primary-bg">Add new</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="primary-heading color-dark mt-5">
                        <h2>Current inclusions</h2>
                    </div>
                    <div class="table-responsive mt-3 pb-5">
                        <table class="user-table table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Added On</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($inclusions as $inclusion)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $inclusion->title }}</td>

                                        <td>
                                            <span
                                                class="badge badge-{{ $inclusion->is_active == 1 ? 'success' : 'danger' }}">
                                                {{ $inclusion->is_active == 1 ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>{{ date('d-M-Y', strtotime($inclusion->created_at)) }}</td>
                                        <td>
                                            <div class="dropdown show action-dropdown">
                                                <a class="dropdown-toggle" href="#" role="button"
                                                    id="action-dropdown" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="action-dropdown">
                                                    <button class="dropdown-item edit-inclusion-btn" data-toggle="modal"
                                                        data-target="#editInclusion"
                                                        data-inclusion-id="{{ $inclusion->id }}"
                                                        data-inclusion-title="{{ $inclusion->title }}">
                                                        <i class="fa fa-pen" aria-hidden="true"></i> Edit
                                                    </button>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.tours-inclusions.suspend', $inclusion->id) }}">
                                                        <i class="fa fa-ban" aria-hidden="true"></i>
                                                        {{ $inclusion->is_active != 0 ? 'Suspend' : 'Activate' }}
                                                    </a>
                                                    <form
                                                        action="{{ route('admin.tours-inclusions.destroy', $inclusion->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item"
                                                            onclick="return confirm('Are you sure you want to delete?')">
                                                            <i class="fa fa-trash" aria-hidden="true"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>

                <div class="tab-pane fade {{ session('active_tab') == 'exclusions' ? 'show active' : '' }}"
                    id="tour-exclusions" role="tabpanel" aria-labelledby="tour-exclusions-tab">
                    <form action="{{ route('admin.tours-exclusions.store') }}" method="POST" class="main-form mt-3"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ $tour->id }}" name="tour_id">
                        <div class="row justify-content-center">


                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="form-group">
                                    <label>Title*:</label>
                                    <input type="text" name="title" class="form-control" placeholder="Enter title"
                                        required value="{{ old('title') }}">
                                    @if ($errors->has('title'))
                                        <span class="error">{{ $errors->first('title') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-12 col-12">
                                <div class="text-center">
                                    <button class="primary-btn primary-bg">Add new</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="primary-heading color-dark mt-5">
                        <h2>Current exclusions</h2>
                    </div>
                    <div class="table-responsive mt-3 pb-5">
                        <table class="user-table table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Added On</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($exclusions as $exclusion)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $exclusion->title }}</td>

                                        <td>
                                            <span
                                                class="badge badge-{{ $exclusion->is_active == 1 ? 'success' : 'danger' }}">
                                                {{ $exclusion->is_active == 1 ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>{{ date('d-M-Y', strtotime($exclusion->created_at)) }}</td>
                                        <td>
                                            <div class="dropdown show action-dropdown">
                                                <a class="dropdown-toggle" href="#" role="button"
                                                    id="action-dropdown" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="action-dropdown">
                                                    <button class="dropdown-item edit-exclusion-btn" data-toggle="modal"
                                                        data-target="#editExclusion"
                                                        data-exclusion-id="{{ $exclusion->id }}"
                                                        data-exclusion-title="{{ $exclusion->title }}">
                                                        <i class="fa fa-pen" aria-hidden="true"></i> Edit
                                                    </button>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.tours-exclusions.suspend', $exclusion->id) }}">
                                                        <i class="fa fa-ban" aria-hidden="true"></i>
                                                        {{ $exclusion->is_active != 0 ? 'Suspend' : 'Activate' }}
                                                    </a>
                                                    <form
                                                        action="{{ route('admin.tours-exclusions.destroy', $exclusion->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item"
                                                            onclick="return confirm('Are you sure you want to delete?')">
                                                            <i class="fa fa-trash" aria-hidden="true"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="tab-pane fade {{ session('active_tab') == 'additional-items' ? 'show active' : '' }}"
                    id="tour-additional-items" role="tabpanel" aria-labelledby="tour-additional-items-tab">
                    <form action="{{ route('admin.additional-items.store') }}" method="POST" class="main-form mt-3"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ $tour->id }}" name="tour_id">
                        <div class="row justify-content-center">


                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="form-group">
                                    <label>Select Additional*:</label>
                                    <select name="additional_id" class="form-control" required>
                                        <option value="" disabled selected>select</option>
                                        @foreach ($additionals as $additional)
                                            <option value="{{ $additional->id }}"
                                                {{ old('additional_id') == $additional->id ? 'selected' : '' }}>
                                                {{ $additional->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('additional_id'))
                                        <span class="error">{{ $errors->first('additional_id') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="form-group">
                                    <label>Title*:</label>
                                    <input type="text" name="title" class="form-control" placeholder="Enter title"
                                        required value="{{ old('title') }}">
                                    @if ($errors->has('title'))
                                        <span class="error">{{ $errors->first('title') }}</span>
                                    @endif
                                </div>
                            </div>



                            <div class="col-lg-12 col-12">
                                <div class="text-center">
                                    <button class="primary-btn primary-bg">Add new</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="primary-heading color-dark mt-5">
                        <h2>Current Additional items</h2>
                    </div>
                    <div class="table-responsive mt-3 pb-5">
                        <table class="user-table table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Additional</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Added On</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($additionalItems as $additionalItem)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $additionalItem->additional ? $additionalItem->additional->name : '' }}
                                        </td>
                                        <td>{{ $additionalItem->title }}</td>

                                        <td>
                                            <span
                                                class="badge badge-{{ $additionalItem->is_active == 1 ? 'success' : 'danger' }}">
                                                {{ $additionalItem->is_active == 1 ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>{{ date('d-M-Y', strtotime($additionalItem->created_at)) }}</td>
                                        <td>
                                            <div class="dropdown show action-dropdown">
                                                <a class="dropdown-toggle" href="#" role="button"
                                                    id="action-dropdown" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="action-dropdown">
                                                    <button class="dropdown-item edit-additional-item-btn"
                                                        data-toggle="modal" data-target="#editAdditionalItem"
                                                        data-additional-item-id="{{ $additionalItem->id }}"
                                                        data-additional-item-title="{{ $additionalItem->title }}"
                                                        data-additional-item-parent="{{ $additionalItem->additional_id }}">
                                                        <i class="fa fa-pen" aria-hidden="true"></i> Edit
                                                    </button>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.additional-items.suspend', $additionalItem->id) }}">
                                                        <i class="fa fa-ban" aria-hidden="true"></i>
                                                        {{ $additionalItem->is_active != 0 ? 'Suspend' : 'Activate' }}
                                                    </a>
                                                    <form
                                                        action="{{ route('admin.additional-items.destroy', $additionalItem->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item"
                                                            onclick="return confirm('Are you sure you want to delete?')">
                                                            <i class="fa fa-trash" aria-hidden="true"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>
    </div>


    <div class="modal fade" id="editFaq" tabindex="-1" aria-labelledby="editFaqModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Faq</h5>
                    <button type="button" class="close bg-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.tours-faqs.update', 0) }}" method="POST" id="edit-faq-form">
                    <div class="modal-body">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label class="col-form-label">Question*:</label>
                            <input type="text" class="form-control" id="faq-question" name="question" required>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Answer*:</label>
                            <textarea class="form-control" id="faq-answer" name="answer" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="primary-btn  btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="primary-btn primary-bg">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editItinerary" tabindex="-1" aria-labelledby="editItineraryModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Itinerary</h5>
                    <button type="button" class="close bg-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.tours-itineraries.update', 0) }}" method="POST" id="edit-itinerary-form"
                    enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label class="col-form-label">Title*:</label>
                            <input type="text" class="form-control" id="itinerary-title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Description*:</label>
                            <textarea class="form-control" id="itinerary-description" name="short_desc" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="current-itinerary-tag" class="col-form-label">Itinerary Image*:</label>
                            <input type="file" class="form-control" onchange="readURL(this, 'current-itinerary-img');"
                                id="current-itinerary-tag" name="img_path">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Image:</label><br />
                            <img src="{{ asset('admin/assets/images/placeholder.png') }}" alt="image"
                                class="img-fluid list-img" id="current-itinerary-img">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="primary-btn  btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="primary-btn primary-bg">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editAttribute" tabindex="-1" aria-labelledby="editAttributeModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Attribute</h5>
                    <button type="button" class="close bg-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.tours-attributes.update', 0) }}" method="POST" id="edit-attribute-form"
                    enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label class="col-form-label">Title*:</label>
                            <input type="text" class="form-control" id="attribute-title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Icon class <a href="//boxicons.com"
                                    target="_blank">(boxicons.com)</a>*:</label>
                            <input type="text" class="form-control" id="attribute-icon" name="icon_class" required>
                        </div>

                        <div class="form-group">
                            <label for="current-itinerary-tag" class="col-form-label">Icon:</label><br />
                            <i id="preview-icon" class=" bx-md"></i>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="primary-btn  btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="primary-btn primary-bg">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editInclusion" tabindex="-1" aria-labelledby="editInclusionModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Inclusion</h5>
                    <button type="button" class="close bg-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.tours-inclusions.update', 0) }}" method="POST" id="edit-inclusion-form"
                    enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label class="col-form-label">Title*:</label>
                            <input type="text" class="form-control" id="inclusion-title" name="title" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="primary-btn  btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="primary-btn primary-bg">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editExclusion" tabindex="-1" aria-labelledby="editExclusionModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Exclusion</h5>
                    <button type="button" class="close bg-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.tours-exclusions.update', 0) }}" method="POST" id="edit-exclusion-form"
                    enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label class="col-form-label">Title*:</label>
                            <input type="text" class="form-control" id="exclusion-title" name="title" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="primary-btn  btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="primary-btn primary-bg">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editAdditionalItem" tabindex="-1" aria-labelledby="editAdditionalItemModal"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Additional Item</h5>
                    <button type="button" class="close bg-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.additional-items.update', 0) }}" method="POST"
                    id="edit-additional-item-form" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label class="col-form-label">Title*:</label>
                            <input type="text" class="form-control" id="additional-item-title" name="title"
                                required>
                        </div>

                        <div class="form-group">
                            <label>Select Additional*:</label>
                            <select name="additional_id" class="form-control" required id="additional-item-parent">
                                <option value="" disabled selected>select</option>
                                @foreach ($additionals as $additional)
                                    <option value="{{ $additional->id }}"
                                        {{ old('additional_id') == $additional->id ? 'selected' : '' }}>
                                        {{ $additional->name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('additional_id'))
                                <span class="error">{{ $errors->first('additional_id') }}</span>
                            @endif
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="primary-btn  btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="primary-btn primary-bg">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css"
        integrity="sha512-pVCM5+SN2+qwj36KonHToF2p1oIvoU3bsqxphdOIWMYmgr4ZqD3t5DjKvvetKhXGc/ZG5REYTT6ltKfExEei/Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style type="text/css">
        .main-tabs {
            gap: 0.75rem;
        }

        .img-fluid {
            max-width: 113px;
            height: 113px;
        }

        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            background-color: var(--color-primary);
        }

        .nav-link {
            background: #F0F0F0;
            color: #000;
            font-size: 0.89rem;
            outline: none !important;
        }

        body .btn-danger {
            color: #fff;
            background-color: #dc3545;
            border-color: #dc3545;
        }
    </style>
@endsection

@section('js')
    <script>
        document.getElementById('pills-home-tab').addEventListener('click', function() {
            document.getElementById('price_type').value = 'per_person';
        });

        document.getElementById('pills-profile-tab').addEventListener('click', function() {
            document.getElementById('price_type').value = 'per_car';
        });

        document.getElementById("attribute-icon").addEventListener("input", (e) => {
            showIcon(e.target, document.getElementById("preview-icon"))
        });




        const showIcon = (iconField, previewElement) => {
            previewElement.setAttribute("class", `${iconField.value} bx-md`);
        }

        const fillFormInfo = (btn, formId, fields) => {
            let form = document.getElementById(formId);

            // Update the form's action URL with the ID
            let id = btn.dataset[fields.id];
            form.action = form.action.replace(/\/\d+$/, '/' + id);
            console.log("yes")
            // Populate the form fields
            fields.inputs.forEach(input => {
                let element = document.getElementById(input.id);
                if (input.type === 'text' || input.type === 'textarea') {
                    element.value = btn.dataset[input.datasetKey];
                } else if (input.type === 'image') {
                    element.src = `${input.publicURL}/${btn.dataset[input.datasetKey]}`;
                } else if (input.type === 'select') {
                    element.selectedIndex = btn.dataset[input.datasetKey];
                }
            });
        };


        // FAQ Edit
        document.querySelectorAll(".edit-faq-btn").forEach((btn) => {
            btn.addEventListener("click", () => fillFormInfo(btn, "edit-faq-form", {
                id: 'faqId',
                inputs: [{
                        id: 'faq-question',
                        datasetKey: 'faqQuestion',
                        type: 'text'
                    },
                    {
                        id: 'faq-answer',
                        datasetKey: 'faqAnswer',
                        type: 'textarea'
                    }
                ]
            }));
        });

        // Itinerary Edit
        document.querySelectorAll(".edit-itinerary-btn").forEach((btn) => {
            btn.addEventListener("click", () => fillFormInfo(btn, "edit-itinerary-form", {
                id: 'itineraryId',
                inputs: [{
                        id: 'itinerary-title',
                        datasetKey: 'itineraryTitle',
                        type: 'text'
                    },
                    {
                        id: 'itinerary-description',
                        datasetKey: 'itineraryDescription',
                        type: 'textarea'
                    },
                    {
                        id: 'current-itinerary-img',
                        datasetKey: 'itineraryImage',
                        type: 'image',
                        publicURL: `${document.getElementById("web_base_url").value}/public`
                    }
                ]
            }));
        });

        document.querySelectorAll(".edit-attribute-btn").forEach((btn) => {
            btn.addEventListener("click", () => {
                fillFormInfo(btn, "edit-attribute-form", {
                    id: 'attributeId',
                    inputs: [{
                            id: 'attribute-title',
                            datasetKey: 'attributeTitle',
                            type: 'text'
                        },
                        {
                            id: 'attribute-icon',
                            datasetKey: 'attributeIcon',
                            type: 'text'
                        }
                    ]
                });
                showIcon(document.getElementById("attribute-icon"), document.getElementById(
                    "preview-icon"));
            });
        });

        // Inclusion Edit
        document.querySelectorAll(".edit-inclusion-btn").forEach((btn) => {
            btn.addEventListener("click", () => fillFormInfo(btn, "edit-inclusion-form", {
                id: 'inclusionId',
                inputs: [{
                    id: 'inclusion-title',
                    datasetKey: 'inclusionTitle',
                    type: 'text'
                }]
            }));
        });

        // Exclusion Edit
        document.querySelectorAll(".edit-exclusion-btn").forEach((btn) => {
            btn.addEventListener("click", () => fillFormInfo(btn, "edit-exclusion-form", {
                id: 'exclusionId',
                inputs: [{
                    id: 'exclusion-title',
                    datasetKey: 'exclusionTitle',
                    type: 'text'
                }]
            }));
        });

        // Additional Item Edit
        document.querySelectorAll(".edit-additional-item-btn").forEach((btn) => {
            btn.addEventListener("click", () => fillFormInfo(btn, "edit-additional-item-form", {
                id: 'additionalItemId',
                inputs: [{
                    id: 'additional-item-title',
                    datasetKey: 'additionalItemTitle',
                    type: 'text'
                }, {
                    id: 'additional-item-parent',
                    datasetKey: 'additionalItemParent',
                    type: 'select'
                }]
            }));
        });
    </script>
@endsection
