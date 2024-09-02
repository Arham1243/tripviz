@extends('admin.dash_layouts.main')
@section('content')
    @include('admin.dash_layouts.sidebar')
    <div class="main-sec">
        <div class="main-wrapper">
            <div class="row mc-b-3">
                <div class="col-lg-7 col-12">
                    <div class="primary-heading color-dark">
                        <h2>Edit {{ ucwords(str_replace('_', ' ', $section->section_name)) }} section</h2>

                    </div>
                </div>
                <div class="col-lg-5 col-12">
                    <div class="text-right">
                        <a href="{{ asset($section->preview_img ?? 'admin/assets/images/placeholder.png') }}"
                            data-fancybox="gallery">
                            <img src="{{ asset($section->preview_img ?? 'admin/assets/images/placeholder.png') }}"
                                alt="{{ $section->section_name }}" class="imgFluid list-img">
                        </a>
                    </div>
                </div>

            </div>
            <form action="{{ route('admin.sections.update', $section->id) }}" method="POST" enctype="multipart/form-data"
                class="main-form">

                @csrf
                @method('PATCH')
                <div class="row justify-content-center">

                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="form-group">
                            <label> Heading*:</label>
                            <input type="text" name="heading" class="form-control" placeholder="Enter heading" required
                                value="{{ $section->heading }}">
                            @if ($errors->has('heading'))
                                <span class="error">{{ $errors->first('heading') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="form-group">
                            <label> Paragraph*:</label>
                            <input type="text" name="short_desc" class="form-control" placeholder="Enter " required
                                value="{{ $section->short_desc }}">
                            @if ($errors->has('short_desc'))
                                <span class="error">{{ $errors->first('short_desc') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="form-group">
                            <label> IOS app link*:</label>
                            <input type="url" name="ios_app_link" class="form-control" placeholder="Enter" required
                                value="{{ $section->ios_app_link }}">
                            @if ($errors->has('ios_app_link'))
                                <span class="error">{{ $errors->first('ios_app_link') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="form-group">
                            <label> Android app link*:</label>
                            <input type="url" name="android_app_link" class="form-control" placeholder="Enter" required
                                value="{{ $section->android_app_link }}">
                            @if ($errors->has('android_app_link'))
                                <span class="error">{{ $errors->first('android_app_link') }}</span>
                            @endif
                        </div>
                    </div>
                   


                    <div class="col-lg-4 text-center">
                        <div class="img-upload-wrapper">
                            <h3>Background Image</h3>
                            <figure><img src="{{ asset($section->bg_img ?? 'admin/assets/images/placeholder.png') }}"
                                    class="thumbnail-img main_image rounded" id="product-img" alt="Image"></figure>
                            <label for="bg_img" class="user-img-btn"><i class="fa fa-camera"></i></label>
                            <input type="file" {{ !$section->bg_img ? 'required' : '' }}
                                onchange="readURL(this, 'product-img');" name="bg_img" id="bg_img" class="d-none"
                                accept="image/jpeg, image/png">
                            @error('bg_img')
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
    </div>
    </div>

    </div>
@endsection
@section('css')
    <style type="text/css">
        .list-img {
            object-fit: contain;
            width: 250px;
        }
    </style>
@endsection
@section('js')
    <script type="text/javascript"></script>
@endsection
