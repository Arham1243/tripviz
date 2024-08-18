@extends('admin.dash_layouts.main')
@section('content')
    @include('admin.dash_layouts.sidebar')
    <div class="main-sec">
        <div class="main-wrapper">
            {{-- <form action="{{ route('admin.tour-reviews.update', $review->id) }}" method="POST" enctype="multipart/form-data"
                class="">

                @csrf
                @method('PATCH') --}}

            <div class="row justify-content-center main-form">
                <div class="col-lg-12 col-12 mb-4">
                    <div class="primary-heading color-dark">
                        <h2>Tour</h2>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-12">
                    <div class="form-group">
                        <label>Title:</label>
                        <input type="text" value="{{ $review->tour->title ?? '' }}" class="form-control" readonly>
                    </div>
                </div>
                <div class="col-lg-12 col-12 py-1">
                    <hr />
                </div>
                <div class="col-lg-12 col-12 mb-4">
                    <div class="primary-heading color-dark">
                        <h2>Review</h2>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="form-group">
                        <label>Title:</label>
                        <input type="text" name="title" value="{{ old('title', $review->title) }}" class="form-control"
                            readonly>
                        @if ($errors->has('title'))
                            <span class="error">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="form-group">
                        <label>Review:</label>
                        <textarea name="review" class="form-control" readonly>{{ old('review', $review->review) }}</textarea>
                        @if ($errors->has('review'))
                            <span class="error">{{ $errors->first('review') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="form-group">
                        <label>Rating:</label>
                    <div class="stars">
                        @for ($i = 0; $i < 5; $i++)
                            <i class='bx {{ $i < $review->rating ? 'bxs' : 'bx' }}-star'></i>
                        @endfor
                    </div>
                    </div>
                </div>
                <div class="col-lg-12 col-12 py-1">
                    <hr />
                </div>

                <div class="col-lg-12 col-12 mb-4">
                    <div class="primary-heading color-dark ">
                        <h2>User Details</h2>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-12 col-center">
                    <div class="user-img-wrapper mc-b-3">
                        <figure class="">
                            <a href="{{ $review->user && $review->user->avatar ? $review->user->avatar :  asset('assets/images/avatar.png') }}"
                                data-fancybox="gallery">
                                <img src="{{ $review->user && $review->user->avatar ? $review->user->avatar :  asset('assets/images/avatar.png') }}"
                                    class="user-details-img" alt="user-img">
                            </a>
                        </figure>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-12">
                    <div class="form-group">
                        <label>User Name:</label>
                        <input type="text" value="{{ $review->user->full_name ?? '' }}" class="form-control" readonly>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-12">
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="text" value="{{ $review->user->email ?? '' }}" class="form-control" readonly>
                    </div>
                </div>

                <div class="col-lg-12 col-12 mt-4">
                    <div class="d-flex align-items-center justify-content-center">
                        <a href="{{ route('admin.tour-reviews.index') }}" class="primary-btn primary-bg mx-3">Go Back</a>
                        <a href="{{ route('admin.tour-reviews.suspend',$review->id) }}"
                            class="primary-btn primary-bg mx-3 {{ $review->is_active == 0 ? 'bg-success' : 'bg-danger' }}">{{ $review->is_active == 0 ? 'Activate' : 'Suspend' }}</a>
                    </div>
                </div>


                {{-- </form> --}}
            </div>
        </div>
    </div>

    </div>
@endsection
@section('css')
    <style type="text/css">
    .stars i {
    color: orange;
    font-size: 1.75rem;
}
    </style>
@endsection
@section('js')
    <script type="text/javascript"></script>
@endsection
