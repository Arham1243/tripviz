@extends('admin.dash_layouts.main')
@section('content')
    @include('admin.dash_layouts.sidebar')
    <div class="main-sec">
        <div class="main-wrapper">
            <div class="row align-items-center mc-b-3">
                <div class="col-lg-12 col-12">
                    <div class="primary-heading color-dark text-center">
                        <h2>Edit Story</h2>
                    </div>
                </div>
            </div>
            <form action="{{ route('admin.tour-stories.update', $tourStory->id) }}" method="POST"
                enctype="multipart/form-data" class="main-form">
                @csrf
                @method('PATCH')

                <div class="row justify-content-center">
                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="form-group">
                            <label> Select City*:</label>
                            <select name="city_id" class="form-control" required>
                                <option disabled>Select</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}"
                                        {{ $tourStory->city_id == $city->id ? 'selected' : '' }}>
                                        {{ $city->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('city_id')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="form-group">
                            <label> Title*:</label>
                            <input type="text" name="title" class="form-control" placeholder="Enter Title" required
                                value="{{ old('title', $tourStory->title) }}">
                            @error('title')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="form-group">
                            <label> Estimated Read Time*:</label>
                            <input type="number" name="estimated_read_time" class="form-control"
                                placeholder="Enter Read Time" required
                                value="{{ old('estimated_read_time', $tourStory->estimated_read_time) }}">
                            @error('estimated_read_time')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="form-group">
                            <label> Short Description*:</label>
                            <textarea rows="3" class="form-control" name="short_desc" required placeholder="Enter Short Description">{{ old('short_desc', $tourStory->short_desc) }}</textarea>
                            @error('short_desc')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="form-group">
                            <label for="long_desc"> Long Description:</label>
                            <textarea id="long_desc" class="form-control ckeditor" name="long_desc">{!! old('long_desc', $tourStory->long_desc) !!}</textarea>
                            @error('long_desc')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4 text-center">
                        <div class="img-upload-wrapper">
                            <h3>Story Thumbnail</h3>
                            <figure>
                                <img src="{{ asset($tourStory->img_path ?? 'admin/assets/images/placeholder.png') }}"
                                    class="thumbnail-img main_image rounded" id="product-img" alt="Image">
                            </figure>
                            <label for="img_path" class="user-img-btn"><i class="fa fa-camera"></i></label>
                            <input type="file" onchange="readURL(this, 'product-img');" name="img_path" id="img_path"
                                class="d-none" accept="image/jpeg, image/png">
                            @error('img_path')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="form-group">
                            <label>Show On Homepage:</label>
                            <div class="input-field--check">
                                <input type="checkbox" name="show_on_homepage" id="show_on_homepage" value="1"
                                    value="1"
                                    {{ old('show_on_homepage', $tourStory->show_on_homepage) ? 'checked' : '' }}>
                                <label for="show_on_homepage" class="toggle">Yes</label>
                            </div>
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
    </div>
@endsection

@section('css')
    <style type="text/css">
        /*in page css here*/
        .img-fluid {
            max-width: 113px;
            height: 113px;
        }
    </style>
@endsection

@section('js')
    <script type="text/javascript">
        // Add any custom JavaScript needed for the page
    </script>
@endsection
