@extends('admin.dash_layouts.main')
@section('content')
    @include('admin.dash_layouts.sidebar')
    <div class="main-sec">
        <div class="main-wrapper">
            <div class="row align-items-center mc-b-3">
                <div class="col-lg-12 col-12">
                    <div class="primary-heading color-dark text-center">
                        <h2>Edit Testimonial</h2>
                    </div>
                </div>
            </div>
            <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST"
                enctype="multipart/form-data" class="main-form">
                @csrf
                @method('PATCH')

                <div class="row justify-content-center">
                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="form-group">
                            <label> Title*:</label>
                            <input type="text" name="title" class="form-control" placeholder="Enter title" required
                                value="{{ old('title', $testimonial->title) }}">

                            @error('title')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="form-group">
                            <label>Content*:</label>
                            <textarea rows="3" class="form-control" name="content" required placeholder="Enter Short Description">{{ old('content', $testimonial->content) }}</textarea>
                            @error('content')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="working-rating-wrapper">
                            <label> Rating*:</label>
                            <div class="working-rating">
                                @for ($i = 5; $i >= 1; $i--)
                                    <input type="radio" id="star{{ $i }}" name="rating"
                                        value="{{ $i }}" {{ $testimonial->rating == $i ? 'checked' : '' }}
                                        required>
                                    <label class="star" for="star{{ $i }}"
                                        title="{{ ['Awesome', 'Great', 'Very good', 'Good', 'Bad'][$i - 1] }}"></label>
                                @endfor
                            </div>

                            @error('rating')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-4 text-center">
                        <div class="img-upload-wrapper">
                            <h3>Testimonial Thumbnail</h3>
                            <figure>
                                <img src="{{ asset($testimonial->main_img_path ?? 'admin/assets/images/placeholder.png') }}"
                                    class="thumbnail-img main_image rounded" id="product-img" alt="Image">
                            </figure>
                            <label for="main_img_path" class="user-img-btn"><i class="fa fa-camera"></i></label>
                            <input type="file" onchange="readURL(this, 'product-img');" name="main_img_path"
                                id="main_img_path" class="d-none" accept="image/jpeg, image/png"
                                {{ $testimonial->main_img_path == null ? 'required' : '' }}>
                            @error('main_img_path')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-lg-12">
                        <div class="file-upload-contain my-3 form-group">
                            <label class="title mb-3">Other Images:</label>
                            <input id="multiplefileupload" type="file" name="testimonial_images[]" accept=""
                                multiple />
                        </div>
                        @if ($errors->has('testimonial_images'))
                            <span class="text-danger">{{ $errors->first('testimonial_images') }}</span>
                        @endif
                    </div>


                    <div class="col-lg-12 col-12">
                        <div class="text-center">
                            <button class="primary-btn primary-bg">Save Changes</button>
                        </div>
                    </div>
                </div>
            </form>


            @if (!$testimonial->images->isEmpty())
                <div class="col-lg-12 mt-3">
                    <div class="form-group">
                        <div class="primary-heading">
                            <h2>Current Images</h2>
                        </div>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr class="text-left">
                                        <th>S.No</th>
                                        <th>Image</th>
                                        <th>Delete Image</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($testimonial->images as $i => $image)
                                        @php
                                            $i++;
                                        @endphp
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>


                                                <a href="{{ asset($image->img_path ?? 'admin/assets/images/placeholder.png') }}"
                                                    data-fancybox="gallery">
                                                    <img src='{{ asset($image->img_path ?? 'admin/assets/images/placeholder.png') }}'
                                                        alt='image' class='imgFluid list-img' loading='lazy'>
                                                </a>
                                            </td>

                                            <td>
                                                <form action="{{ route('admin.testimonials.image.delete', $image->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="delete-btn"
                                                        onclick="return confirm('Are you sure you want to delete?')">
                                                        <i class="bx bx-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-lg-12 mt-3">
                    <div class="form-group">
                        <div class="primary-heading">
                            <h2>No Current Images</h2>
                        </div>

                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.2.3/css/fileinput.min.css" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/file-upload.css') }}" />
    <style type="text/css">
        /*in page css here*/
        .img-fluid {
            max-width: 113px;
            height: 113px;
        }

        .working-rating {
            width: fit-content;
            border: none;
            display: block;
        }

        body .working-rating>label {
            color: #90a0a366;
            float: right;
            cursor: pointer;
            font-size: 0.75rem;
        }

        .working-rating>label:before {
            margin-right: 7px;
            font-size: 1.75rem;
            content: "\eeb8";
            display: inline-block;
            font-family: boxicons !important;
        }

        .working-rating>input {
            display: none;
        }

        .working-rating>input:checked~label,
        .working-rating:not(:checked)>label:hover,
        .working-rating:not(:checked)>label:hover~label {
            color: #f79426;
        }

        .working-rating>input:checked+label:hover,
        .working-rating>input:checked~label:hover,
        .working-rating>label:hover~input:checked~label,
        .working-rating>input:checked~label:hover~label {
            color: #fece31;
        }
    </style>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.2.3/js/plugins/sortable.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.2.3/themes/fas/theme.min.js"></script>
    <script src="{{ asset('admin/assets/js/file-upload.js') }}"></script>
    <script type="text/javascript"></script>
@endsection
