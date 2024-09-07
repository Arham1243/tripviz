@extends('admin.dash_layouts.main')
@section('content')
    @include('admin.dash_layouts.sidebar')
    <div class="main-sec">
        <div class="main-wrapper">
            <div class="row align-items-center mc-b-3">
                <div class="col-lg-12 col-12">
                    <div class="primary-heading color-dark text-center">
                        <h2>Edit Country</h2>
                    </div>
                </div>

            </div>
            <form action="{{ route('admin.countries.update', $country->id) }}" method="POST" enctype="multipart/form-data"
                class="main-form">

                @csrf
                @method('PATCH')

                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="form-group">
                            <label> Select Continent*:</label>
                            <select name="continent_id" class="form-control" required>
                                <option disabled selected>Select</option>
                                @foreach ($continents as $continent)
                                    <option value="{{ $continent->id }}"
                                        {{ old('continent_id', $country->continent_id) == $continent->id ? 'selected' : '' }}>
                                        {{ $continent->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('continent_id'))
                                <span class="error">{{ $errors->first('continent_id') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="form-group">
                            <label>Name*:</label>
                            <input type="text" name="name" value="{{ old('name', $country->name) }}"
                                class="form-control" placeholder="Enter name" required>
                            @if ($errors->has('name'))
                                <span class="error">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>


                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="form-group">
                            <label>Short Description*:</label>
                            <textarea rows="3" class="form-control" name="short_desc" required placeholder="Enter Short Description"> {{ old('short_desc', $country->short_desc) }}</textarea>
                            @error('short_desc')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-lg-4 text-center">
                        <div class="img-upload-wrapper">
                            <h3>Country Thumbnail</h3>

                            <figure><img src="{{ asset($country->img_path ?? 'admin/assets/images/placeholder.png') }}"
                                    class="thumbnail-img main_image rounded" id="product-img" alt="Image"></figure>
                            <label for="img_path" class="user-img-btn"><i class="fa fa-camera"></i></label>
                            <input type="file" {{ $country->img_path == null ? 'required' : '' }}
                                onchange="readURL(this, 'product-img');" name="img_path" id="img_path" class="d-none"
                                accept="image/jpeg, image/png">
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
                                    {{ $country->show_on_homepage == 1 ? 'checked' : '' }}>
                                <label for="show_on_homepage" class="toggle">Yes</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 col-12">
                        <div class="text-center">
                            <button class="primary-btn primary-bg">Save Changes</button>
                        </div>
                    </div>
            </form>
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
