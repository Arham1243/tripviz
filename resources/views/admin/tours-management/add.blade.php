@extends('admin.dash_layouts.main')
@section('content')
    @include('admin.dash_layouts.sidebar')
    <div class="main-sec">
        <div class="main-wrapper">
            <div class="row align-items-center mc-b-3">
                <div class="col-lg-12 col-12">
                    <div class="primary-heading color-dark text-center">
                        <h2>Add Tour</h2>
                    </div>
                </div>
            </div>
            <form action="{{ route('admin.tours.store') }}" method="POST" enctype="multipart/form-data" class="main-form">
                @csrf
                <input type="hidden" name="price_type" id="price_type" value="per_person">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-12 custom-select2-wrapper">
                        <label>Select Categories:</label>
                        <select multiple name="category_ids[]" class="custom-select2" placeholder="Select Categories" data-allow-clear="1">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id[]') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-6 col-md-12 custom-select2-wrapper">
                        <label>Select Cities:</label>
                        <select multiple name="city_ids[]" class="custom-select2" placeholder="Select Cities" data-allow-clear="1">
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}" {{ old('city_id[]') == $city->id ? 'selected' : '' }}>
                                    {{ $city->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('city_id')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="form-group">
                            <label>Title*:</label>
                            <input type="text" name="title" class="form-control" placeholder="Enter Name" required value="{{ old('title') }}">
                            @error('title')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="form-group">
                            <label>Short Description*:</label>
                            <textarea rows="3" class="form-control" name="short_desc" required placeholder="Enter Short Description">{{ old('short_desc') }}</textarea>
                            @error('short_desc')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-12">
                        <h6 class=" mb-3"><strong>Price*:</strong></h6>
                        <ul class="nav nav-pills mr-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab" data-toggle="pill" data-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Per Person</button>
                            </li>
                            <li class="nav-item mx-2" role="presentation">
                                <button class="nav-link" id="pills-profile-tab" data-toggle="pill" data-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Per Car</button>
                            </li>
                        </ul>
                        <div class="tab-content mt-4" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <div class="form-group">
                                            <label>For Adult*:</label>
                                            <input type="number" name="for_adult_price" class="form-control" placeholder="Enter Price" step="0.01" value="{{ old('for_adult_price') }}">
                                            @error('for_adult_price')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <div class="form-group">
                                            <label>For Child*:</label>
                                            <input type="number" name="for_child_price" class="form-control" placeholder="Enter Price" step="0.01" value="{{ old('for_child_price') }}">
                                            @error('for_child_price')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <div class="form-group">
                                            <label>For Car*:</label>
                                            <input type="number" name="for_car_price" class="form-control" placeholder="Enter Price" step="0.01" value="{{ old('for_car_price') }}">
                                            @error('for_car_price')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center">
                        <div class="img-upload-wrapper mc-b-3">
                            <h3>Main Image</h3>
                            <figure><img src="{{ asset('admin/assets/images/placeholder.png') }}" class="thumbnail-img main_image rounded" id="product-img" alt="Image"></figure>
                            <label for="img_path" class="user-img-btn"><i class="fa fa-camera"></i></label>
                            <input type="file" required onchange="readURL(this, 'product-img');" name="img_path" id="img_path" class="d-none" accept="image/jpeg, image/png">
                            @error('img_path')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-12 col-12">
                        <div class="text-center">
                            <button class="primary-btn primary-bg">Add new</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('css')
    <style type="text/css">
        .img-fluid {
            max-width: 113px;
            height: 113px;
        }
        .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
            background-color: var(--color-primary);
        }
        .nav-link {
            outline: none !important;
        }
    </style>
@endsection

@section('js')
<script>
    document.getElementById('pills-home-tab').addEventListener('click', function () {
        document.getElementById('price_type').value = 'per_person';
    });

    document.getElementById('pills-profile-tab').addEventListener('click', function () {
        document.getElementById('price_type').value = 'per_car';
    });
</script>
@endsection
