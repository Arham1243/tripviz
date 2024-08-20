@extends('admin.dash_layouts.main')
@section('content')
    @include('admin.dash_layouts.sidebar')
    <div class="main-sec">
        <div class="main-wrapper">
            <div class="row align-items-center mc-b-3">
                <div class="col-lg-12 col-12">
                    <div class="primary-heading color-dark text-center">
                        <h2>Add Section</h2>
                    </div>
                </div>

            </div>
            <form action="{{ route('admin.sections.store') }}" method="POST" enctype="multipart/form-data" class="main-form">
                @csrf

                <div class="row justify-content-center">
                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="form-group">
                            <label>Section Name*:</label>
                            <input type="text" name="section_name" class="form-control" placeholder="Enter  "
                                required value="{{ old('section_name') }}">
                            @if ($errors->has('section_name'))
                                <span class="error">{{ $errors->first('section_name') }}</span>
                            @endif
                        </div>

                    </div>
                    <div class="col-lg-4 text-center">
                        <div class="img-upload-wrapper">
                            <h3>Preview Image</h3>
                            <figure><img src="{{ asset('admin/assets/images/placeholder.png') }}"
                                    class="thumbnail-img main_image rounded" id="product-img" alt="Image"></figure>
                            <label for="preview_img" class="user-img-btn"><i class="fa fa-camera"></i></label>
                            <input type="file" required onchange="readURL(this, 'product-img');" name="preview_img"
                                id="preview_img" class="d-none" accept="image/jpeg, image/png">
                            @error('preview_img')
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
