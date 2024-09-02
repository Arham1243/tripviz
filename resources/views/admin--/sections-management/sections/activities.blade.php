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
                            <label>Heading*:</label>
                            <input type="text" name="heading" class="form-control" placeholder="Enter heading" required
                                value="{{ old('heading', $section->heading) }}">
                            @if ($errors->has('heading'))
                                <span class="error">{{ $errors->first('heading') }}</span>
                            @endif
                        </div>
                    </div>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                @for ($i = 1; $i <= 3; $i++)
                                    <th scope="col">Card {{ $i }}</th>
                                @endfor
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @for ($i = 1; $i <= 3; $i++)
                                    <td>
                                        <div class="form-group">
                                            <label>Card Title*:</label>
                                            <input type="text" name="card_title_{{ $i }}" class="form-control"
                                                placeholder="Enter" required
                                                value="{{ old('card_title_' . $i, $section->{'card_title_' . $i}) }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Card Paragraph*:</label>
                                            <textarea name="card_para_{{ $i }}" rows="5" class="form-control" placeholder="Enter" required>{{ old('card_para_' . $i, $section->{'card_para_' . $i}) }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Card Background Image*:</label>
                                            <img src="{{ asset($section->{'card_bg_' . $i} ?? 'admin/assets/images/placeholder.png') }}"
                                                class="list-img" id="card_img_{{ $i }}" alt="Image">
                                            <label for="card_bg_{{ $i }}" class="user-img-btn"><i
                                                    class="fa fa-camera"></i></label>
                                            <input type="file" onchange="readURL(this, 'card_img_{{ $i }}');"
                                                name="card_bg_{{ $i }}" id="card_bg_{{ $i }}"
                                                class="d-none" accept="image/jpeg, image/png"
                                                {{ $section->{'card_bg_' . $i} == null ? 'required' : '' }}>
                                        </div>
                                    </td>
                                @endfor
                            </tr>
                        </tbody>
                    </table>

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
            width: 95%;
            height: 150px;
            display: block;
            margin: 0 auto 0;
        }

        label.user-img-btn {
            justify-content: center !important;
        }
    </style>
@endsection
@section('js')
    <script type="text/javascript"></script>
@endsection
