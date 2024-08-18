@extends('admin.dash_layouts.main')
@section('content')
    @include('admin.dash_layouts.sidebar')
    <div class="main-sec">
        <div class="main-wrapper">
            <div class="row align-items-center mc-b-3">
                <div class="col-lg-12 col-12">
                    <div class="primary-heading color-dark text-center">
                        <h2>Add Promotion</h2>
                    </div>
                </div>

            </div>
            <form action="{{ route('admin.promotions.store') }}" method="POST" enctype="multipart/form-data" class="main-form">
                @csrf

                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="form-group">
                            <label> Title*:</label>
                            <input type="text" name="title" class="form-control" placeholder="Enter title" required
                                value="{{ old('title') }}">
                            @error('title')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="form-group">
                            <label> Url*:</label>
                            <input type="url" name="link" class="form-control" placeholder="Enter link" required
                                value="{{ old('link') }}">
                            @error('link')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4 text-center">
                        <div class="img-upload-wrapper">
                            <h3>Promotion Thumbnail</h3>
                            <figure><img src="{{ asset('admin/assets/images/placeholder.png') }}"
                                    class="thumbnail-img main_image rounded" id="product-img" alt="Image"></figure>
                            <label for="img_path" class="user-img-btn"><i class="fa fa-camera"></i></label>
                            <input type="file" required onchange="readURL(this, 'product-img');" name="img_path"
                                id="img_path" class="d-none" accept="image/jpeg, image/png">
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
            </form>
        </div>

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
    <script type="text/javascript"></script>
@endsection
